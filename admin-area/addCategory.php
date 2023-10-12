<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

if (isset($_POST['submit'])) {
  $catName = $_POST['catName'];

  // File upload handling
  $image = $_FILES['catImage']['name'];
  $tempImage = $_FILES['catImage']['tmp_name'];
  $imagePath = "../images/" . $image;
  move_uploaded_file($tempImage, $imagePath);

  $sql = "INSERT INTO category (`cat_name`, `cat-image`) VALUES ('$catName', '$imagePath')";

  if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    header('location:categories.php');
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
}
?>

<?php include('header.php') ?>

<div class="container p-5">
  <div class="card">
    <div class="card-header">Add Category</div>
    <div class="card-body">
      <form action="addCategory.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="catName">Name:</label>
          <input type="text" class="form-control" id="catName" name="catName">
          <label for="catImage">Image:</label>
          <input type="file" class="form-control-file" id="catImage" name="catImage">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add</button>
      </form>
    </div>
  </div>
</div>

<?php include('footer.php') ?>