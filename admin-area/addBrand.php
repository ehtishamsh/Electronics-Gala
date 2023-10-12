<?php
session_start();
include('../db/db.php');
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

if (isset($_POST['submit'])) {
  $brandName = $_POST['brandName'];
  $sql = "INSERT INTO brands (brand_name) VALUES ('$brandName')";

  if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    header('location:brands.php');
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
}
include('header.php');
?>
<div class="container my-5 py-5">
  <div class="card mt-5 c-card">
    <div class="card-header c-header">Add Brand</div>
    <div class="card-body c-body">
      <form action="addBrand.php" method="post">
        <div class="form-group c-form-group">
          <label for="brandName">Name:</label>
          <input type="text" class="form-control" id="brandName" name="brandName">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>