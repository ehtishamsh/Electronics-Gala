<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location: ../login.php');
  exit;
}

if (!isset($_GET['id'])) {
  header('location: manage-users.php');
  exit;
}

$id = $_GET['id'];

// Retrieve user data from the database
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) < 1) {
  // User not found
  header('location: manage-users.php');
  exit;
}

$user = mysqli_fetch_assoc($result);

// Handle form submission for updating user information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve updated user information
  $name = $_POST['name'];
  $email = $_POST['email'];

  // Update user in the database
  $updateSql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";
  $updateResult = mysqli_query($con, $updateSql);

  if ($updateResult) {
    // User information updated successfully
    header('location: manage-users.php');
    exit;
  } else {
    // Failed to update user information
    $errorMessage = "Failed to update user information. Please try again.";
  }
}

include 'header.php';
?>

<section id="content">
  <div class="content-blog">
    <div class="container">
      <h2>Edit User</h2>

      <?php if (isset($errorMessage)) { ?>
        <div class="alert alert-danger">
          <?php echo $errorMessage; ?>
        </div>
      <?php } ?>

      <form method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>"
            required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>