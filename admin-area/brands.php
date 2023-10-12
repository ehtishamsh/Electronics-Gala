<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

include('header.php');
?>

<div class="container p-5">
  <a href="addBrand.php" class="btn btn-dark mb-3">Add Brands</a>
  <table class="table table-hover table-light">
    <thead class="text-center thead-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th colspan='2'>Action</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      $sqlQ = "SELECT * FROM `brands`";
      $result = mysqli_query($con, $sqlQ);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row["brand_id"] . "</td>";
          echo "<td>" . $row["brand_name"] . "</td>";
          echo "<td><a href='editBrand.php?id=" . $row["brand_id"] . "' class='btn btn-primary btn-sm edit-Btn-sm'>Edit</a></td>";
          echo "<td><a href='delBrand.php?id=" . $row["brand_id"] . "' class='btn btn-danger btn-sm edit-Btn-sm'>Delete</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='2'>0 results</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<?php include('footer.php'); ?>