<?php include('sidebar.php');
$c_id = $_SESSION['customerid'];
if (isset($_GET['id'])) {
  $o_id = $_GET['id'];
}
$sql_orders = "SELECT * FROM orders WHERE id='$o_id' AND user_id='$c_id'";
$result_orders = mysqli_query($con, $sql_orders);
$row_orders = mysqli_fetch_assoc($result_orders);
$sql = "SELECT * FROM orderitems WHERE order_id='$o_id'";
$result = mysqli_query($con, $sql);
?>

<div class="container mt-5 mb-5">
  <div class="d-flex justify-content-center row">
    <div class="col-md-10">
      <div class="receipt bg-white p-3 rounded">
        <img src="images/logo.png" width="120">
        <?php if ($row_orders['orderstatus'] == 'Order Placed') { ?>
        <h4 class="mt-2 mb-3">Your order is confirmed!</h4>
        <?php } elseif ($row_orders['orderstatus'] == 'In Progress') { ?>
        <h4 class="mt-2 mb-3">Your order is in progress!</h4>
        <?php } elseif ($row_orders['orderstatus'] == 'Delivered') { ?>
        <h4 class="mt-2 mb-3">Your order has been delivered!</h4>
        <?php } ?>

        <h6 class="name">Hello,
          <?php echo $names["name"]; ?>,
        </h6>
        <?php if ($row_orders['orderstatus'] == 'Order Placed') { ?>
        <span class="fs-12 text-black-50">Your order has been confirmed and will be shipped in 7 days</span>
        <?php } ?>

        <hr>

        <div class="d-flex flex-row justify-content-between align-items-center order-details">
          <div>
            <span class="d-block fs-12">Order date</span>
            <span class="fw-bold">
              <?php echo date('M j g:i A', strtotime($row_orders["timestamp"])); ?>
            </span>
          </div>
          <div>
            <span class="d-block fs-12">Payment method</span>
            <span class="fw-bold">
              <?php echo $row_orders['paymentmode'] ?>
              <?php if ($row_orders['paymentmode'] != 'COD') { ?>
              <img class="ms-1 mb-1" src="images/payments_img/mastercard-26128.png" width="20">
              <?php } ?>
            </span>
          </div>
          <div>
            <span class="d-block fs-12">Order Status</span>
            <span class="fw-bold text-success">
              <?php echo $row_orders['orderstatus'] ?>
            </span>
          </div>
        </div>

        <hr>

        <?php if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $prodID = $row["product_id"];
            $sql_product = "SELECT * FROM products WHERE product_id='$prodID'";
            $result_prod = mysqli_query($con, $sql_product);
            $row_prod = mysqli_fetch_assoc($result_prod);
            $imageURL = $row_prod['product_image'];
            ?>
        <div class="d-flex justify-content-between align-items-center product-details">
          <div class="d-flex flex-row product-name-image">
            <a href="single.php?id=<?php echo $prodID; ?>">
              <img src="admin-area/product_images/<?php echo $imageURL; ?>" alt="Product Image" class="product-image"
                style="width: 80px;">
            </a>
            <div class="d-flex flex-column justify-content-between ms-2">
              <div><span class="d-block fw-bold p-name">
                  <?php echo $row_prod['product_title']; ?>
                </span></div>
              <span class="fs-12">Qty:
                <?php echo $row["quantity"] ?>pcs
              </span>
              <span class="fs-12">Price:
                <?php echo $row["price"] ?>
              </span>
              <span class="fs-12 d-flex align-items-center">Color:
                <?php $colorid = $row["color_id"];
                    $sqlq = "SELECT * FROM color WHERE color_id=$colorid";
                    $pSql = mysqli_query($con, $sqlq);
                    $colorRow = mysqli_fetch_assoc($pSql);
                    $color_name = $colorRow['color_name'];
                    echo "<div class='color-badge ms-2' style='background-color: $color_name; width:12px;height:12px;'>
            </div>";
                    ?>
              </span>
            </div>
          </div>
          <div class="product-price-con d-flex justify-content-between">
            <h6>Total:</h6>
            <span>
              <?php echo $row["quantity"] * $row["price"] ?>.RS
            </span>
          </div>
        </div>
        <?php }
        } ?>

        <div class="mt-5 amount row">
          <div class="col-md-6">
            <?php
            $sql = "SELECT * FROM user_data WHERE user_id='$c_id'";
            $d_detail = mysqli_query($con, $sql);
            $result_deliver = mysqli_fetch_assoc($d_detail);
            ?>
            <h4>Billing Information</h4>
            <p>Name:
              <?php echo $result_deliver['names']; ?>
            </p>
            <p>Phone:
              <?php echo $result_deliver['mobile']; ?>
            </p>
            <p>Address:
              <?php echo $result_deliver['address1']; ?>,
              <?php echo $result_deliver['city']; ?>,
              <?php echo $result_deliver['province']; ?>,
              <?php echo $result_deliver['zip']; ?>
            </p>
          </div>
          <div class="col-md-6">
            <div class="billing">
              <div class="d-flex justify-content-between"><span>Subtotal</span><span class="fw-bold">
                  <?php echo $row_orders['totalprice'] ?>
                </span></div>
              <div class="d-flex justify-content-between mt-2"><span>Shipping fee</span><span
                  class="fw-bold">Free</span>
              </div>
              <div class="d-flex justify-content-between mt-2"><span>Tax</span><span class="fw-bold">0</span> </div>
              <hr>
              <div class="d-flex justify-content-between mt-1"><span class="fw-bold">Total</span><span
                  class="fw-bold text-success"> <?php echo $row_orders['totalprice'] ?></span></div>
            </div>
          </div>
        </div>

        <?php if ($row_orders['orderstatus'] == 'order place') { ?>
        <span class="d-block">Expected delivery date</span>
        <span class="fw-bold text-success">12 March 2020</span>
        <?php } elseif ($row_orders['orderstatus'] == 'in progress') { ?>
        <span class="d-block">Expected delivery date</span>
        <span class="fw-bold text-success">Update: Your order is in progress!</span>
        <?php } elseif ($row_orders['orderstatus'] == 'delivered') { ?>
        <span class="d-block">Expected delivery date</span>
        <span class="fw-bold text-success">Update: Your order has been delivered!</span>
        <?php } ?>

        <span class="d-block mt-3 text-black-50 fs-15">We will be sending a shipping confirmation email when the item is
          shipped!</span>
        <hr>

        <div class="d-flex justify-content-between align-items-center footer">
          <div class="thanks">
            <span class="d-block fw-bold">Thanks for shopping</span>
            <span>ELectronic Gala team</span>
          </div>
          <div class="d-flex flex-column justify-content-end align-items-end">
            <span class="d-block fw-bold">Need Help?</span>
            <span>Ask Chatbot</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('content.php'); ?>