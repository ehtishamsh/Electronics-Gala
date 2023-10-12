<?php
session_start();
include('db/db.php');

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $locations = $_POST['refPage'];

  // Check if the user is a customer
  $customerQuery = "SELECT * FROM users WHERE email='$email' AND passwords='$password'";
  $customerResult = mysqli_query($con, $customerQuery);
  $customerCount = mysqli_num_rows($customerResult);

  // Check if the user is an admin
  $adminQuery = "SELECT * FROM admin_data WHERE email='$email' AND passwords='$password'";
  $adminResult = mysqli_query($con, $adminQuery);
  $adminCount = mysqli_num_rows($adminResult);

  if ($customerCount > 0) {
    // Customer login
    $_SESSION['customer'] = $email;
    $customerRow = mysqli_fetch_assoc($customerResult);
    $_SESSION['customerid'] = $customerRow['id'];
    header("location:$locations");
    exit();
  } elseif ($adminCount > 0) {
    // Admin login
    $_SESSION['email'] = $email;
    header('location: admin-area/index.php');
    exit();
  } else {
    // Redirect back to the 2nd previous page
    header("location:login.php?message=1");
    exit();
  }
} else {
  header('location: login.php');
  exit();
}
?>