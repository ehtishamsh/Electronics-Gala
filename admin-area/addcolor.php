<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the color name from the form
  $colorName = $_POST['color_name'];

  // Insert the color into the database
  $sql = "INSERT INTO color (color_name) VALUES ('$colorName')";
  if (mysqli_query($con, $sql)) {
    ?>
<script>
alert("Color Added Successfully")
</script>
<?php
    header('location:color.php');
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
}

include 'header.php';
?>

<!-- HTML form for adding colors -->
<form method="POST" action="" class="my-5 px-5">
  <label for="color_name">Color Name:</label>
  <input type="text" id="color_name" name="color_name" required class="form-control my-3">
  <button type="submit" class="btn btn-success">Add Color</button>
</form>

<?php include 'footer.php'; ?>