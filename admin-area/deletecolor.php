<?php
session_start();
include('../db/db.php');
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
  header('location: ../login.php');
}
if (isset($_GET['id'])) {
  $color_id = $_GET['id'];
  $sql = "DELETE FROM color WHERE color_id='$color_id'";
  $result = mysqli_query($con, $sql);
  header('location:color.php');
}
?>