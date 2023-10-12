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

// Handle delete confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    // Delete user from the database
    $deleteSql = "DELETE FROM users WHERE id = $id";
    $deleteResult = mysqli_query($con, $deleteSql);

    if ($deleteResult) {
      // User deleted successfully
      header('location: manage-users.php');
      exit;
    } else {
      // Failed to delete user
      $errorMessage = "Failed to delete user. Please try again.";
    }
  } else {
    // User canceled the delete operation
    header('location: manage-users.php');
    exit;
  }
}

include 'header.php';
?>

<section id="content">
  <div class="content-blog">
    <div class="container">
      <h2>Delete User</h2>

      <?php if (isset($errorMessage)) { ?>
      <div class="alert alert-danger">
        <?php echo $errorMessage; ?>
      </div>
      <?php } ?>

      <div class="alert alert-warning">
        Are you sure you want to delete the user:
        <?php echo $user['name']; ?>?
      </div>

      <form method="POST">
        <input type="hidden" name="confirm" value="yes">
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
        <a href="manage-users.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>