<?php
ob_start();
include('sidebar.php');
if (!isset($_SESSION['customer']) && empty($_SESSION['customer'])) {
  header('location:login.php');
}

if (!isset($_SESSION['customerid'])) {
  echo '<script>window.location.href = "login.php";</script>';
}
$message = '';
$_POST['agree'] = 'false';
if (isset($_POST['submit'])) {
  $orderid = $_POST['orderid'];
  $reason = $_POST['reason'];
  $status = 'cancelled';
  $insertCancel = "INSERT INTO orderstracking (order_id, status, reason)
	VALUES ('$orderid', '$status', '$reason')";

  if (mysqli_query($con, $insertCancel)) {
    $up_sql = "UPDATE orders SET orderstatus='Cancelled' WHERE id=$orderid";
    mysqli_query($con, $up_sql);
    header('location:cus_order.php');
  }
}
$cid = $_SESSION['customerid'];
$sql = "SELECT * FROM user_data where user_id = $cid";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>
<?php
if (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
  $total = 0;
  foreach ($cart as $key => $value) {
    // echo $key ." : ". $value['quantity'] . "<br>";
    $sql_cart = "SELECT * FROM products where product_id = $key";
    $result_cart = mysqli_query($con, $sql_cart);
    $row_cart = mysqli_fetch_assoc($result_cart);
    $total = $total + ($row_cart['price'] * $value['quantity']);
  }
}
?>
<div class="container">
  <div class="row mt-5 m-auto justify-content-center">
    <div class="col-lg-8">
      <div class="text-content_acc-cancel">
        <h2 class="mb-0">Cancel Order</h2>
      </div>
      <form method='post' class="my-acc-tb_cancel p-4">
        <?php echo $message ?>
        <table class="account-table table table-borderless bg-white">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $c_id = $_SESSION['customerid'];
            if (isset($_GET['id'])) {
              $o_id = $_GET['id'];
            }
            $sql_orders = "SELECT * FROM orders WHERE id='$o_id' AND user_id='$c_id'";
            $result_orders = mysqli_query($con, $sql_orders);
            $row_orders = mysqli_fetch_assoc($result_orders);
            $sql = "SELECT * FROM orderitems WHERE order_id='$o_id'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $prodID = $row["product_id"]
                  ?>
            <tr>
              <td>
                <?php
                    $sql_product = "SELECT * FROM products WHERE product_id='$prodID'";
                    $result_prod = mysqli_query($con, $sql_product);
                    $row_prod = mysqli_fetch_assoc($result_prod);
                    ?>
                <span><img src="admin-area/product_images/<?php echo $row_prod['product_image'] ?>" alt=""
                    style="width: 50px;"></span>
                <a href="single.php?id=<?php echo $prodID; ?>"><?php echo $row_prod['product_title']; ?></a>
              </td>
              <td>
                <?php echo $row["quantity"] ?>
              </td>
              <td>
                <?php echo $row["price"] ?>
              </td>
              <td>
                <?php echo $row["quantity"] * $row["price"] ?>
              </td>
            </tr>
            <?php
              }
            } else {
              echo "0 results";
            }
            ?>
          </tbody>
          <tfooer>
            <tr>
              <th colspan="2"></th>
              <th>Total Price</th>
              <th>
                <?php echo $row_orders['totalprice'] ?>
              </th>
            </tr>
            <tr>
              <th colspan="2"></th>
              <th>Order Status</th>
              <th>
                <?php echo $row_orders['orderstatus'] ?>
              </th>
            </tr>
            <tr>
              <th colspan="2"></th>
              <th>Date</th>
              <th>
                <?php echo date('M j g:i A', strtotime($row_orders["timestamp"])); ?>
              </th>
            </tr>
          </tfooer>
        </table>
        <div class="form-group mt-4">
          <label for="reason">
            <h4>Reason</h4>
          </label>
          <input type="text" class="form-control" name='reason'>
        </div>
        <div class="w-100 text-center mt-5">
          <input type="hidden" name='orderid' value='<?php echo $_GET['id'] ?>'>
          <button type="button" class="btn update_address-btn w-100" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Cancel
          </button>
        </div>
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-confirm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="icon-box">
                <i class="bi bi-x-circle d-flex justify-content-center"></i>
              </div>
              <h4>Are you sure?</h4>
              <div class="modal-body">
                <p>Do you really want to cancel the order? This process cannot be undone.</p>
              </div>
              <div class="modal-footer justify-content-center cancel-order-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nope</button>
                <button type='submit' name='submit' class="btn btn-danger">Yes</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include('content.php');
ob_end_flush();
?>