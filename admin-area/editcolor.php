<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

// Check if color id is set in the URL
if (isset($_GET['id'])) {
  $color_id = $_GET['id'];
  $selectQ = "SELECT * FROM color WHERE color_id='$color_id'";
  $result = mysqli_query($con, $selectQ);
  $r = mysqli_fetch_assoc($result);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
  $color_name = $_POST['colorname'];

  // Checking if fields are empty
  if ($color_name == '') {
    echo "<script>alert('Please fill all the fields')</script>";
  } else {
    $updateQ = "UPDATE color SET color_name='$color_name' WHERE color_id='$color_id'";
    $result = mysqli_query($con, $updateQ);

    if ($result) {
      echo "<script>alert('Color Updated'); window.location = 'color.php';</script>";
    }
  }
}
?>

<?php include 'header.php'; ?>

<section>
  <div class="content-blog">
    <div class="container w-50">
      <form method="post" enctype="multipart/form-data">
        <div class="form-group mb-3 mt-2">
          <label for="colorname">Color Name</label>
          <input type="text" class="form-control" name="colorname" value="<?php echo $r['color_name']; ?>"
            placeholder="Color Name">
        </div>
        <div class="text-center">
          <button type="submit" name="submit" class="btn btn-default bg-dark text-light px-4">Update</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>