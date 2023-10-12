<?php
session_start();
include '../db/db.php';
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
  header('location:../login.php');
}
if (isset($_GET['id'])) {
  $catid = $_GET['id'];
  $sql = "SELECT * FROM Category where cat_id = '$catid'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);

}

if (isset($_POST['submit'])) {
  $hiddenID = $_POST['hiddenID'];
  $catName = $_POST['catName'];
  $sql = "UPDATE Category SET cat_name='$catName' WHERE cat_id='$hiddenID'";

  if ($con->query($sql) === TRUE) {
    echo "Record updated successfully";
    header('location:categories.php');
  } else {
    echo "Error updating record: " . $con['error'];
  }

}
?>
<?php include('header.php') ?>
<div class="container">

  <div class="card">
    <div class="card-header">
      Edit Category
    </div>
    <div class="card-body">

      <form action="editCategory.php" method='post'>
        <div class="form-group">
          <label for="catName"> Name:</label>
          <input type="text" class="form-control" id="catName" name='catName' value='<?php echo $row['cat_name'] ?>'>
          <input type="hidden" value='<?php echo $catid ?>' name='hiddenID'>
        </div>
        <button type="submit" name='submit' class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php include('footer.php') ?>