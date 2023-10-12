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

if (isset($_POST['update_brand'])) {
  // Retrieve updated brand details
  $updatedBrandName = $_POST['brand_name'];

  // Update brand in the database
  $sqlQ = "UPDATE `brands` SET `brand_name` = '$updatedBrandName' WHERE `brand_id` = '$brandId'";
  $result = mysqli_query($con, $sqlQ);
  if ($result) {
    echo "Brand updated successfully.";
    header("Location: brands.php");
    exit;
  } else {
    echo "Failed to update brand.";
  }
}

include('header.php');
?>

<div class="container p-5 my-5">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title">Edit Brand</h2>
      <form method="POST" action="">
        <div class="form-group">
          <label for="brand_name">Brand Name:</label>
          <input type="text" class="form-control" id="brand_name" name="brand_name"
            value="<?php echo $brand['brand_name']; ?>" required>
        </div>
        <div class="text-center d-flex justify-content-center">
          <button type="submit" class="btn btn-primary mr-4" name="update_brand">Update</button>
          <a href="brands.php" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>