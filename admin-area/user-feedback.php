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
        <thead>
          <tr class="text-center thead-dark">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php
          $sql = "SELECT * FROM feedback";
          $res = mysqli_query($con, $sql);
          while ($r = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
              <th scope="row">
                <?php echo $r['id']; ?>
              </th>
              <td>
                <?php echo $r['name']; ?>
              </td>
              <td>
                <a href="mailto:<?php echo $r['email']; ?>"><?php echo $r['email']; ?></a>
              </td>
              <td>
                <a href="tel:<?php echo $r['phone']; ?>"><?php echo $r['phone']; ?></a>
              </td>
              <td class="message-text">
                <?php echo $r['message']; ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
<?php include 'footer.php' ?>