<?php
ob_start();
include('sidebar.php');

$c_id = $_SESSION['customerid'];

// Fetch the current user information from the database.
$sql = "SELECT * FROM users WHERE id='$c_id'";
$details = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($details);
$errorMessage = '';
$updateMessage = '';
if (isset($_POST['submit'])) {
  $name = $_POST['name'];

  // Update user's name
  $update_name_sql = "UPDATE users SET name='$name' WHERE id='$c_id'";
  mysqli_query($con, $update_name_sql);

  // Check if the new password is provided
  $new_password = $_POST['new_password'];
  if (!empty($new_password)) {
    // Verify if the old password input matches the password in the database.
    $old_password = $_POST['old_password'];
    if ($old_password == $user['passwords']) {
      // Update user's password
      $update_password_sql = "UPDATE users SET passwords='$new_password ' WHERE id='$c_id'";
      mysqli_query($con, $update_password_sql);
      $updateMessage = "Profile information updated successfully!";
    } else {
      $errorMessage = "Old password doesn't match. Password not updated.";
    }
  } else {
    $updateMessage = "Profile information updated successfully!";
  }
}
?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-white edit-info-card">
          <h2 class="m-2">Edit Information</h2>
        </div>
        <div class="card-body">
          <?php if (!empty($errorMessage)) { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $errorMessage; ?>
            </div>
          <?php } ?>
          <?php if (!empty($updateMessage)) { ?>
            <div class="modal model-update" id="updateModal">
              <div class="modal-dialog model-dialog-update">
                <div class="modal-content content-update">
                  <!-- Modal content here -->
                  <p>
                    <?php echo $updateMessage; ?>
                  </p>
                  <p>Redirecting in <span id="countdown">5</span> seconds...</p>
                </div>
              </div>
            </div>
          <?php } ?>
          <form method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>"
                required>
            </div>
            <div class="mb-3">
              <button type="button" class="edit-info-card-btn" id="togglePasswordFields">Change
                Password</button>
            </div>
            <div class="password-fields" id="passwordFields">
              <div class="mb-3">
                <label for="old_password" class="form-label">Old Password</label>
                <input type="password" class="form-control" id="old_password" name="old_password">
              </div>
              <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="edit-info-card-btn-sub" name="submit">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include('content.php');
ob_end_flush();
?>