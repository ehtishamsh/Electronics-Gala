<?php
include('sidebar.php');
$c_id = $_SESSION['customerid'];
$sql = "SELECT * FROM users WHERE id='$c_id'";
$details = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($details);
$user_id = $user['id'];
$sql_address = "SELECT * FROM user_data WHERE user_id='$user_id'";
$address_details = mysqli_query($con, $sql_address);
$address = mysqli_fetch_assoc($address_details);
?>

<div class="container cus-info-con">
  <div class="row">
    <div class="col-md-4">
      <!-- User Information -->
      <div class="user-info">
        <img src="images/user-avatar.png" alt="User Image" class="user-image img-fluid">
        <h2>
          <?php echo $user['name']; ?>
        </h2>
        <p>
          <?php echo $user['email']; ?>
        </p>
        <a href="edit_information.php" class="btn update_address-btn btn-sm mt-3">Edit Information</a>
      </div>
    </div>
    <div class="col-md-8">
      <!-- Address Information -->
      <div class="address-info">
        <h3>Address Details</h3>
        <form>
          <div class="mb-3">
            <label for="address1" class="form-label">Address 1</label>
            <input type="text" class="form-control" id="address1" name="address1"
              value="<?php echo $address['address1']; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="address2" class="form-label">Address 2</label>
            <input type="text" class="form-control" id="address2" name="address2"
              value="<?php echo $address['address2']; ?>" readonly>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="zip" class="form-label">Zip Code</label>
              <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $address['zip']; ?>"
                readonly>
            </div>
            <div class="col-md-6 mb-3">
              <label for="province" class="form-label">Province</label>
              <input type="text" class="form-control" id="province" name="province"
                value="<?php echo $address['province']; ?>" readonly>
            </div>
          </div>
          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo $address['city']; ?>"
              readonly>
          </div>
          <a href="update_address.php" class="btn update_address-btn">Edit Address</a>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('content.php'); ?>