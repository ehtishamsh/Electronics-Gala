<?php session_start();
include('../db/db.php');
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}
?>
<?php include 'header.php'; ?>
<section id="content">
  <div class="content-blog">
    <div class="container">
      <a class="btn btn-dark mb-3" href="addcolor.php">Add Color</a>
      <div class="row colors-container">
        <div class="col-12 d-flex justify-content-center">
          <table class="table table-hover table-light">
            <thead class="thead-dark text-center">
              <tr>
                <th>ID</th>
                <th>Color</th>
                <th colspan="2">Operations</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php
              $sql = "SELECT * FROM color";
              $res = mysqli_query($con, $sql);
              while ($r = mysqli_fetch_assoc($res)) {
                ?>
              <tr>
                <th scope="row">
                  <?php echo $r['color_id']; ?>
                </th>
                <td>
                  <span
                    style="background-color: <?php echo $r['color_name']; ?>;width:8px;height:8px;padding:8px;border-radius:100%;display:inline-block"></span>
                </td>
                <td class="text-center"><a href="editcolor.php?id=<?php echo $r['color_id']; ?>"
                    class="btn btn-primary edit-Btn">Edit</a></td>
                <td class="text-center"> <a href="deletecolor.php?id=<?php echo $r['color_id']; ?>"
                    class="btn btn-danger delete-btn edit-Btn" data-toggle="modal"
                    data-target="#confirmationModal">Delete</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
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
          Are you sure you want to delete this color?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary edit-Btn" data-dismiss="modal">Cancel</button>
          <a href="#" class="btn btn-danger delete-confirmed-btn edit-Btn">Delete</a>
        </div>
      </div>
    </div>
  </div>

</section>
<?php include 'footer.php' ?>