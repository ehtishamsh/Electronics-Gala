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
      <table class="table table-hover table-light">
        <thead class="thead-dark text-center">
          <tr class="text-center">
            <th>Name</th>
            <th>Email</th>
            <th colspan="2">Operation</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php
          $sql = "SELECT * FROM users";
          $res = mysqli_query($con, $sql);
          while ($r = mysqli_fetch_assoc($res)) {
            ?>
          <tr>
            <th scope="row">
              <?php echo $r['name']; ?>
            </th>
            <td>
              <?php echo $r['email']; ?>
            </td>
            <td class="d-flex align-items-center justify-content-center"><a
                href="edituser.php?id=<?php echo $r['id']; ?>" class="btn btn-primary edit-Btn">Edit</a></td>
            <td><a href="deleteuser.php?id=<?php echo $r['id']; ?>" class="btn btn-danger edit-Btn">Remove</a></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
  </div>

</section>
<?php include 'footer.php' ?>