<?php
session_start();
include('../db/db.php');
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}
?>
<?php include('header.php') ?>
<div class="container">
  <table class="table table-hover table-light">
    <thead class="thead-dark text-center">
      <tr>
        <th>ID</th>
        <th>Customer Name</th>
        <th>Total Price</th>
        <th>Order Status</th>
        <th>Payment</th>
        <th>Date</th>
        <th>View Details</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
                $sql = "SELECT orders.totalprice, orders.orderstatus, orders.paymentmode, orders.timestamp, orders.id, user_data.names
                FROM orders JOIN user_data ON orders.user_id=user_data.user_id ORDER BY `orders`.`id` DESC";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                  // output data of each row
                  while ($row = mysqli_fetch_assoc($result)) {
                    ?>
      <tr>
        <td>
          <?php echo $row["id"] ?>
        </td>
        <td>
          <?php echo $row["names"] ?>
        </td>
        <td>
          <?php echo $row["totalprice"] ?>
        </td>
        <td>
          <?php echo $row["orderstatus"] ?>
        </td>
        <td>
          <?php echo $row["paymentmode"] ?>
        </td>
        <td>
          <?php echo date('M j g:i A', strtotime($row["timestamp"])); ?>
        </td>
        <td><a href='order-process.php?id=<?php echo $row["id"] ?>'
            class="btn btn-primary d-flex justify-content-center gap-2"><span><i class="fa-regular fa-eye"></i>
            </span><span>View</span></a>
      </tr>
      <?php
                  }
                } else {
                  echo "0 results";
                }
                ?>
    </tbody>
  </table>
</div>
<?php include('footer.php') ?>