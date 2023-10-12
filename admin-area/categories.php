<?php
session_start();
include('../db/db.php');
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}
?>

<?php include('header.php') ?>
<div class="container p-5">
  <a href="addCategory.php" class="btn btn-dark mb-3">Add Category</a>
  <table class="table table-bordered bg-white">
    <thead class="thead-dark text-center">
      <tr>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      $sqlQ = "SELECT * FROM `category`";
      $result = mysqli_query($con, $sqlQ);

      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td>
              <?php echo $row["cat_name"]; ?>
            </td>
            <td class="d-flex justify-content-center">
              <a href='editCategory.php?id=<?php echo $row["cat_id"]; ?>' class="btn btn-primary edit-Btn mr-5">Edit</a>
              <a href='delCategory.php?id=<?php echo $row["cat_id"]; ?>' class="btn btn-danger delete-btn edit-Btn"
                data-toggle="modal" data-target="#confirmationModal">Delete</a>
            </td>
          </tr>
          <?php
        }
      } else {
        echo "<tr><td colspan='2'>0 results</td></tr>";
      }
      ?>
    </tbody>
  </table>
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex">
          <h5 class="modal-title" id="confirmationModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
              class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this category?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondar edit-Btn" data-dismiss="modal">Cancel</button>
          <a href="#" class="btn btn-danger delete-confirmed-btn edit-Btn">Delete</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php') ?>