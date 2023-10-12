<?php
include('sidebar.php');
if (!isset($_SESSION['customer']) && empty($_SESSION['customer'])) {
  header('location:login.php');
}

if (!isset($_SESSION['customerid'])) {
  echo '<script>window.location.href = "login.php";</script>';
}

$message = '';
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $addr1 = $_POST['addr1'];
  $addr2 = $_POST['addr2'];
  $city = $_POST['city'];
  $Postcode = $_POST['Postcode'];
  $province = $_POST['province'];
  $Phone = $_POST['Phone'];
  $cid = $_SESSION['customerid'];

  $sql = "SELECT * FROM user_data WHERE user_id = $cid";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);

  if (mysqli_num_rows($result) == 1) {
    // Update query
    $up_sql = "UPDATE user_data SET names='$name', address1='$addr1', address2='$addr2', city='$city', province='$province', zip='$Postcode', mobile='$Phone' WHERE user_id=$cid";
    $Updated = mysqli_query($con, $up_sql);

    if ($Updated) {
      $message = '<div class="alert alert-success">Address updated successfully.</div>';
    } else {
      $message = '<div class="alert alert-danger">Failed to update address. Please try again.</div>';
    }
  }
}

$cid = $_SESSION['customerid'];
$sql = "SELECT * FROM user_data WHERE user_id = $cid";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mt-5">
        <div class="card-body">
          <h2 class="text-center mb-4">Update Address</h2>
          <?php echo $message ?>
          <form method="post">
            <div class="mb-3">
              <h3 class="text-uppercase text-center">Shipping Details</h3>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col-md-6">
                  <label for="name" class="form-label">Name</label>
                  <input class="form-control" name="name"
                    value="<?php if (isset($row['names'])) {
                      echo $row['names'];
                    } ?>" type="text">
                </div>
                <div class="col-md-6">
                  <label for="Phone" class="form-label">Phone</label>
                  <input class="form-control" name="Phone" placeholder=""
                    value="<?php if (isset($row['mobile'])) {
                      echo $row['mobile'];
                    } ?>" type="text">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col-md-6">
                  <label for="addr1" class="form-label">Address</label>
                  <input class="form-control" name="addr1" placeholder="Street address"
                    value="<?php if (isset($row['address1'])) {
                      echo $row['address1'];
                    } ?>" type="text">
                </div>
                <div class="col-md-6">
                  <label for="addr2" class="form-label">2nd Address</label>
                  <input class="form-control" name="addr2" placeholder="Apartment, suite, unit etc. (optional)"
                    value="<?php if (isset($row['address2'])) {
                      echo $row['address2'];
                    } ?>" type="text">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col-md-4">
                  <label for="city" class="form-label">Town / City</label>
                  <input class="form-control" name="city" placeholder="Town / City"
                    value="<?php if (isset($row['city'])) {
                      echo $row['city'];
                    } ?>" type="text">
                </div>
                <div class="col-md-4">
                  <label for="Postcode" class="form-label">Postcode</label>
                  <input class="form-control" name="Postcode" placeholder="Postcode / Zip"
                    value="<?php if (isset($row['zip'])) {
                      echo $row['zip'];
                    } ?>" type="text">
                </div>
                <div class="col-md-4">
                  <label for="province" class="form-label">Province</label>
                  <input class="form-control" name="province" placeholder="Province"
                    value="<?php if (isset($row['province'])) {
                      echo $row['province'];
                    } ?>" type="text">
                </div>
              </div>
            </div>
            <div class="text-center">
              <input type="submit" name="submit" value="Update Address" class="btn update_address-btn">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('content.php'); ?>