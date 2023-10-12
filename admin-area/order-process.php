<?php ob_start();
session_start();
include('../db/db.php');
include('header.php');

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

if (isset($_POST['submit'])) {
  $orderid = $_POST['orderid'];
  $reason = $_POST['reason'];
  $status = $_POST['status'];

  $insertCancel = "INSERT INTO orderstracking (order_id, status, reason) VALUES ('$orderid', '$status', '$reason')";

  if (mysqli_query($con, $insertCancel)) {
    $up_sql = "UPDATE orders SET orderstatus='$status' WHERE id=$orderid";
    mysqli_query($con, $up_sql);
    header('location:orders.php');
  }
}
?>
<form method='post'>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="billing-details">
          <table class="cart-table account-table table table-bordered bg-white text-dark">
            <thead class="text-center">
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Status</th>
                <th>Payment Mode</th>
                <th>Image</th>
                <th>Color</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php
              if (isset($_GET['id'])) {
                $o_id = $_GET['id'];
              }
              $sql = "SELECT * FROM orders WHERE id='$o_id'";
              $result = mysqli_query($con, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $userid = $row['user_id'];
                  $sql_proID = "SELECT * FROM orderitems WHERE order_id='$o_id'";
                  $result_proID = mysqli_query($con, $sql_proID);
                  while ($row_prodID = mysqli_fetch_assoc($result_proID)) {
                    $p_id = $row_prodID['product_id'];
                    $color_id = $row_prodID['color_id'];
                    $quantity = $row_prodID['quantity'];
                    $sql_ProName = "SELECT * FROM products WHERE product_id='$p_id'";
                    $result_ProName = mysqli_query($con, $sql_ProName);
                    $row_ProName = mysqli_fetch_assoc($result_ProName);
                    ?>
              <tr>
                <td class="align-middle">
                  <?php echo $row_ProName['product_title']; ?>
                </td>
                <td class="align-middle">
                  <?php echo $row_ProName['price']; ?>
                </td>
                <td class="align-middle">
                  <?php echo $quantity; ?>
                </td>
                <td class="align-middle">
                  <?php echo $row["orderstatus"]; ?>
                </td>
                <td class="align-middle">
                  <?php echo $row["paymentmode"]; ?>
                </td>
                <td class="align-middle">
                  <?php
                        echo '<img src="product_images/' . $row_ProName['product_image'] . '" alt="Product Image" class="product-image-table" style="width: 100px;">';
                        ?>
                </td>
                <td class="align-middle">
                  <?php
                        $colorSql = "SELECT * FROM color WHERE color_id='$color_id'";
                        $pSql = mysqli_query($con, $colorSql);
                        $colorRow = mysqli_fetch_assoc($pSql);
                        $color_name = $colorRow['color_name'];
                        echo "<div class='color-badge m-auto' style='background-color: $color_name; width:30px;height:30px;'></div>";
                        ?>
                </td>
              </tr>
              <?php
                  }
                  ?>
              <tr>
                <td class="align-middle" colspan="7">
                  <div class="d-flex justify-content-center align-items-center">
                    <h5 class="font-weight-bold">TOTAL PRICE:&nbsp;&nbsp;</h5>
                    <p class="mb-0">
                      <?php echo $row["totalprice"]; ?>
                    </p>

                  </div>

                </td>
              </tr>
              <?php
                }
              } else {
                echo "0 results";
              }
              ?>
            </tbody>
          </table>

          <?php
          $sql_user = "SELECT * FROM user_data WHERE user_id='$userid'";
          $result_user = mysqli_query($con, $sql_user);
          $row_user = mysqli_fetch_assoc($result_user);
          ?>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Billing Address</h5>
              <p class="card-text">
                <strong>Name:</strong>
                <?php echo $row_user["names"]; ?> <br>
                <strong>Address:</strong>
                <?php echo $row_user["address1"]; ?> <br>
                <?php if ($row_user["address2"] != "") { ?>
                <strong>Address 2:</strong>
                <?php echo $row_user["address2"]; ?>
                <?php } ?> <br>
                <strong>City:</strong>
                <?php echo $row_user["city"]; ?> <br>
                <strong>Province:</strong>
                <?php echo $row_user["province"]; ?> <br>
                <strong>Zip Code:</strong>
                <?php echo $row_user["zip"]; ?> <br>
                <strong>Phone:</strong>
                <?php echo $row_user["mobile"]; ?>
              </p>
            </div>
          </div>

          <div class="space30"></div>

          <div class="form-group">
            <label for="sel1">Change Status:</label>
            <select class="form-control" name="status">
              <option value='In Progress'>In Progress</option>
              <option value='Dispatched'>Dispatched</option>
              <option value='Delivered'>Delivered</option>
              <option value='Cancelled'>Cancelled</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 text-center">
        <input type="hidden" name='orderid' value='<?php echo $_GET['id'] ?>'>
        <input type='submit' name='submit' value='Change Status' class="btn btn-primary">
      </div>
    </div>
  </div>
  </div>
</form>
<?php include('footer.php');
ob_end_flush();
?>