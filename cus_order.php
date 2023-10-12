<?php include('sidebar.php'); ?>
<div class="text-content_acc">
  <p class="mb-0">My Orders</p>
</div>
<div class="table-responsive my-acc-tb p-4">
  <table class="cart-table account-table table table-bordered">
    <thead class="text-center">
      <tr>
        <th>Total Price</th>
        <th>Order Status</th>
        <th>Payment Mode</th>
        <th>Date and Time</th>
        <th colspan="2">Operations</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      $c_id = $_SESSION['customerid'];
      $sql = "SELECT * FROM orders WHERE user_id='$c_id' ORDER BY timestamp DESC";
      $result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td>
              <div class="row-con-table">
                <?php echo $row["totalprice"] ?>
              </div>
            </td>
            <td>
              <div class="row-con-table">
                <?php
                $orderStatus = $row["orderstatus"];
                $dotColor = '';
                $textColor = '';
                if ($orderStatus == 'Order Placed') {
                  $dotColor = '#f19d04';
                  $textColor = '#f19d04';
                } elseif ($orderStatus == 'In Progress') {
                  $dotColor = '#0b63b2';
                  $textColor = '#0b63b2';
                } elseif ($orderStatus == 'Delivered') {
                  $dotColor = 'green';
                  $textColor = 'green';
                } else {
                  $dotColor = 'red';
                  $textColor = 'red';
                }
                echo '<span style="background-color: ' . $dotColor . '; width: 8px; height: 8px; display: inline-block; border-radius: 50%; margin-right: 5px;"></span>';
                echo '<span class="fw-bold" style="color: ' . $textColor . ';">' . $orderStatus . '</span>';
                ?>
              </div>
            </td>
            <td>
              <div class="row-con-table">
                <?php echo $row["paymentmode"] ?>
              </div>
            </td>
            <td>
              <div class="row-con-table">
                <?php echo date('M j g:i A', strtotime($row["timestamp"])); ?>
              </div>
            </td>
            <td>
              <div class="row-con-table">
                <a href="view-order.php?id=<?php echo $row["id"] ?>"
                  class="btn btn-success d-flex justify-content-center gap-2">
                  <span><i class="fa-regular fa-eye"></i></span>
                  <span>View</span>
                </a>
              </div>
            </td>
            <?php
            // Calculate the time difference between the current time and the order timestamp
            $orderTimestamp = strtotime($row["timestamp"]);
            $currentTimestamp = time();
            $timeDifferenceInSeconds = $currentTimestamp - $orderTimestamp;
            $hoursDifference = floor($timeDifferenceInSeconds / 3600);

            if ($row["orderstatus"] != 'Cancelled' && $hoursDifference <= 12) {
              ?>
              <td>
                <div class="row-con-table">
                  <a href="cancel-order.php?id=<?php echo $row["id"] ?>" class="btn btn-danger">
                    <span><i class="fa-regular fa-trash-can"></i></span>
                    <span>Cancel</span>
                  </a>
                </div>
              </td>
              <?php
            } else {
              echo '<td></td>';
            }
            ?>
          </tr>
          <?php
        }
      } else {
        echo "<tr><td colspan='6'>0 results</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>
<?php include('content.php'); ?>