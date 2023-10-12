<?php
session_start();
include('../db/db.php');
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

if (isset($_GET['id'])) {
  $brandId = $_GET['id'];

  // Fetch brand details from the database
  $sqlQ = "SELECT * FROM `brands` WHERE `brand_id` = '$brandId'";
  $result = mysqli_query($con, $sqlQ);
  if (mysqli_num_rows($result) > 0) {
    $brand = mysqli_fetch_assoc($result);
  } else {
    echo "Brand not found.";
    exit;
  }
} else {
  echo "Invalid request.";
  exit;
}

if (isset($_POST['confirm_delete'])) {
  // Delete brand from the database
  $sqlQ = "DELETE FROM `brands` WHERE `brand_id` = '$brandId'";
  $result = mysqli_query($con, $sqlQ);
  if ($result) {
    header("Location: brands.php");
    exit;
  } else {
    echo "Failed to delete brand.";
  }
}

include('header.php');
?>

<div class="container p-5 my-5">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title">Delete Brand</h2>
      <p class="card-text">Are you sure you want to delete the brand
        "<strong>
          <?php echo $brand['brand_name']; ?>
        </strong>"?</p>
      <form method="POST" action="">
        <div class="text-center">
          <button type="submit" class="btn btn-danger" name="confirm_delete">Yes, Delete</button>
          <a href="brands.php" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>