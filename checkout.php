<?php
ob_start();
include('header.php');
include('nav.php');

function calculate_total_price($con)
{
  $total = 0;
  foreach ($_SESSION['cart'] as $key => $value) {
    $sql_cart = "SELECT * FROM products where product_id = $key";
    $result_cart = mysqli_query($con, $sql_cart);
    $row_cart = mysqli_fetch_assoc($result_cart);
    $total = $total + ($row_cart['price'] * $value['quantity']);
  }
  return $total;
}

function place_order($con, $cid, $payment)
{
  $total = calculate_total_price($con);
  $insertOrder = "INSERT INTO orders (user_id, totalprice, orderstatus, paymentmode) VALUES ('$cid', '$total', 'Order Placed', '$payment')";

  if (mysqli_query($con, $insertOrder)) {
    $orderid = mysqli_insert_id($con);

    foreach ($_SESSION['cart'] as $key => $value) {
      $sql_cart = "SELECT * FROM products WHERE product_id = $key";
      $result_cart = mysqli_query($con, $sql_cart);
      $row_cart = mysqli_fetch_assoc($result_cart);
      $price_product = $row_cart["price"];
      $q = $value["quantity"];
      $selected_color = $value['color'];
      if ($selected_color === NULL) {
        $sql_colors = "SELECT color_id FROM product_color WHERE product_id = $key";
        $result_colors = mysqli_query($con, $sql_colors);

        $color_ids = array();
        while ($row_color = mysqli_fetch_assoc($result_colors)) {
          $color_ids[] = $row_color['color_id'];
        }

        if (!empty($color_ids)) {
          $selected_color_id = $color_ids[array_rand($color_ids)];
        } else {
          $selected_color_id = null;
        }
      } else {
        $selected_color_id = $selected_color;
      }
      $insertordersItems = "INSERT INTO orderitems (order_id, product_id, quantity, price,color_id) VALUES ('$orderid', '$key', '$q', '$price_product','$selected_color_id')";
      if (mysqli_query($con, $insertordersItems)) {
        $updateStock = "UPDATE stock SET qty = qty - $q WHERE product_id = $key";
        mysqli_query($con, $updateStock);
      }
    }

    unset($_SESSION['cart']);
    header("Location: order-confirmation.php?orderid=$orderid");
    exit();
  }
}

if (!isset($_SESSION['customer']) && empty($_SESSION['customer'])) {
  header('location:login.php');
}

if (!isset($_SESSION['customerid'])) {
  echo '<script>window.location.href = "login.php";</script>';
}

$total = 0;
$message = '';
$_POST['agree'] = 'false';

if (isset($_POST['submit'])) {
  if ($_POST['agree'] == true) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $addr1 = isset($_POST['addr1']) ? $_POST['addr1'] : '';
    $addr2 = isset($_POST['addr2']) ? $_POST['addr2'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $Postcode = isset($_POST['Postcode']) ? $_POST['Postcode'] : '';
    $province = isset($_POST['province']) ? $_POST['province'] : '';
    $Phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
    $payment = isset($_POST['payment']) ? $_POST['payment'] : '';
    $agree = isset($_POST['agree']) ? $_POST['agree'] : '';
    $cid = $_SESSION['customerid'];

    $sql = "SELECT * FROM user_data WHERE user_id = $cid";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 1) {
      if (isset($_SESSION['cart'])) {
        calculate_total_price($con);
      }
      place_order($con, $cid, $payment);
    } else {
      $ins_sql = "INSERT INTO user_data (user_id, names, address1, address2, city, province, zip, mobile) 
                        VALUES ('$cid', '$name', '$addr1', '$addr2', '$city', '$province', '$Postcode', '$Phone')";
      $inserted = mysqli_query($con, $ins_sql);

      if ($inserted) {
        if (isset($_SESSION['cart'])) {
          calculate_total_price($con);
        }
        place_order($con, $cid, $payment);
      }
    }
  } else {
    $message = 'Agree to the terms and conditions';
  }
}

$cid = $_SESSION['customerid'];
$sql = "SELECT * FROM user_data WHERE user_id = $cid";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>
<?php if (isset($_SESSION['cart'])) {
  calculate_total_price($con);
} ?>
<div class="container-fluid px-0 whole-proges py-4">
  <div class="container head_container py-4">
    <div class="progress-bar">
      <div class="progress-bar__progress p-3" style="width: 100%;"></div>
    </div>
    <div class="step-icons">
      <i class="bi bi-cart-fill active"></i>
      <i class="bi bi-arrow-right-circle active"></i>
      <i class="bi bi-credit-card active"></i>
      <i class="bi bi-check-circle active"></i>
    </div>
    <div class="heading_cart text-center mt-5">
      <h2 class="fw-bold">Secure Checkout</h2>
    </div>
  </div>
</div>
<div id="cart-items" class="mb-5">&nbsp;</div>
<div class="container py-4 hero_container px-0">
  <form method='post'>
    <div class="container hero_container px-0 py-4">
      <div class="row justify-content-between">
        <div class="col-md-4 col-lg-4 order-md-last mt-">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Your cart</span>
            <span class="badge bg-primary rounded-pill">
              <?php echo $cart_count; ?>
            </span>
          </h4>
          <ul class="list-group cart-ul-list">
            <li class="list-group-item lh-sm text-center py-4">
              <h5 class="fw-bold">Order Summary</h5>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm py-4">
              <div>
                <h6 class="my-0">Cart Subtotal</h6>
              </div>
              <span class="text-body-secondary">
                <?php echo calculate_total_price($con); ?>.00/-
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm py-4">
              <div>
                <h6 class="my-0">Shipping Fee</h6>
              </div>
              <span class="text-body-secondary">0.00/-</span>
            </li>
            <li class="list-group-item d-flex justify-content-between py-4">
              <span>Total (PKR)</span>
              <strong>
                <?php echo calculate_total_price($con); ?>.00/-
              </strong>
            </li>
          </ul>
        </div>
        <?php if (mysqli_num_rows($result) == 1): ?>
        <div class="col-md-7">
          <div class="card bg-white text-dark custom-table">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Shipping Address</h5>
                <a href="update_address.php" class="btn btn-sm update_address-btn">Update Address</a>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <?php echo $row['names']; ?>
                </li>
                <li class="list-group-item">
                  <?php echo $row['mobile']; ?>
                </li>
                <li class="list-group-item">
                  <?php echo $row['address1']; ?>
                </li>
                <li class="list-group-item">
                  <?php echo $row['address2']; ?>
                </li>
                <li class="list-group-item">
                  <?php echo $row['city']; ?>
                </li>
                <li class="list-group-item">
                  <?php echo $row['zip']; ?>
                </li>
                <li class="list-group-item">
                  <?php echo $row['province']; ?>
                </li>
              </ul>
            </div>
          </div>
          <hr class="my-4">
          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input name="payment" type="radio" class="form-check-input" checked="" required="" value="COD"
                id="radio1">
              <label class="form-check-label" for="radio1">Cash on delivary</label>
            </div>
            <div class="form-check">
              <input id="radio2" name="payment" type="radio" class="form-check-input" required="" value="Credit/Debit">
              <label class="form-check-label" for="radio2">Credit Card</label>
            </div>
          </div>
          <div id="creditCardFields" style="display: none;">
            <div class="form-group">
              <label for="cardNumber">Card Number</label>
              <input type="text" class="form-control" id="cardNumber" name="cardNumber">
            </div>
            <div class="form-group">
              <label for="cardName">Cardholder Name</label>
              <input type="text" class="form-control" id="cardName" name="cardName">
            </div>
            <div class="form-group">
              <label for="expiryDate">Expiry Date</label>
              <input type="text" class="form-control" id="expiryDate" name="expiryDate">
            </div>
            <div class="form-group">
              <label for="cvv">CVV</label>
              <input type="text" class="form-control" id="cvv" name="cvv">
            </div>
          </div>

          <hr class="my-4">
          <div class="col-md-12 text-center">
            <input name="agree" value='true' id="checkboxG2" class="mr-2 css-checkbox " type="checkbox">
            <label for="checkboxG2">I've read and accept the <a href="terms.php">terms &amp; conditions</a></label>
          </div>
          <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">Place Order</button>
        </div>
      </div>
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Order confirmation</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="products-checkout mb-4">
                <?php
                  $cart = $_SESSION['cart'];
                  $total_price = 0;

                  foreach ($cart as $key => $value) {
                    $cartsql = "SELECT * FROM products WHERE product_id=$key";
                    $cartres = mysqli_query($con, $cartsql);
                    $cartr = mysqli_fetch_assoc($cartres);
                    $total_price = $total_price + ($cartr['price'] * $value['quantity']);
                    $english_format_number = number_format($total_price);
                    ?>

                <div class="d-flex justify-content-between align-items-center mt-3 p-3 items rounded">
                  <div class="d-flex flex-row"><img class="rounded cart-img2"
                      src="admin-area/product_images/<?php echo $cartr['product_image']; ?>" alt="">
                    <div class="ms-2 cart-body-text2  d-flex flex-column justify-content-center"><span
                        class="fw-bold d-block">
                        <?php echo $cartr['product_title']; ?>
                      </span>
                      <div class="d-flex flex-column mt-2">
                        <span class="spec">
                          <?php
                              $product_id = $cartr['product_id'];
                              $selected_color = $value['color'];
                              // Get the selected color from the cart
                              $colorQuery = "SELECT color_name FROM color WHERE color_id='$selected_color'";
                              $colorResult = mysqli_query($con, $colorQuery);
                              $colorRow = mysqli_fetch_assoc($colorResult);
                              if ($colorRow != null) {
                                $color_name = $colorRow['color_name'];
                                echo $color_name;
                              } else {
                                echo "Random Color";
                              }
                              ?>
                        </span>
                      </div>
                    </div>
                  </div>
                  <span class="d-block d-flex justify-content-center align-items-center">
                    <span class="cart_qty me-1">Qty: </span>
                    <?php echo $value['quantity']; ?>
                  </span>
                  <div class="d-flex flex-row align-items-center price-cart-body"> <span class="d-block ms-5 fw-bold">
                      <span class="cart_qty me-1">Total Price:
                      </span>
                      <?php echo $english_format_number; ?>
                  </div>
                </div>
                <?php
                  }
                  ?>
              </div>
              <div class="pay-ment"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="submit" value="Place Order">
              </div>
            </div>
          </div>
        </div>
        <?php else: ?>
        <div class="col-md-7 col-lg-7">
          <div class="row">
            <div class="col-12">
              <label for="name" class="form-label">Name</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" placeholder="Name" required="" value="<?php if (isset($row['names'])) {
                    echo $row['names'];
                  } ?>" name="name">
                <div class="invalid-feedback">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="Phone" class="form-label">Phone</label>
              <input type="Phone" class="form-control" id="Phone" placeholder="+92" name='Phone' value="<?php if (isset($row['mobile'])) {
                  echo $row['mobile'];
                } ?>">
              <div class="invalid-feedback">
                Please enter a valid Phone address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address1" class="form-label">Address</label>
              <input type="text" class="form-control" id="address1" placeholder="1234 Main St" required="" name='addr1'
                value="<?php if (isset($row['address1'])) {
                    echo $row['address1'];
                  } ?>">
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Address 2 <span
                  class="text-body-secondary">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" name='addr2'
                placeholder="Apartment, suite, unit etc. (optional)" value="<?php if (isset($row['address2'])) {
                    echo $row['address2'];
                  } ?>">
            </div>

            <div class="col-md-5">
              <label for="city" class="form-label">Town / City</label>
              <input id="city" class="form-control" name='city' placeholder="Town / City" value="<?php if (isset($row['city'])) {
                  echo $row['city'];
                } ?>" type="text">
              <div class="invalid-feedback">
                Please select a valid city.
              </div>
            </div>

            <div class="col-md-4">
              <label for="province" class="form-label">Province</label>
              <input id="province" class="form-control" name='province' placeholder="Province" value="<?php if (isset($row['province'])) {
                  echo $row['province'];
                } ?>" type="text">
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="postcode" class="form-label">Postcode</label>
              <input id="postcode" class="form-control" name='Postcode' placeholder="Postcode / Zip" value="<?php if (isset($row['zip'])) {
                  echo $row['zip'];
                } ?>" type="text">
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>
          <hr class="my-4">
          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input name="payment" type="radio" class="form-check-input" checked="" required="" value="COD"
                id="radio1">
              <label class="form-check-label" for="radio1">Cash on delivary</label>
            </div>
            <div class="form-check">
              <input id="radio2" name="payment" type="radio" class="form-check-input" required="" value="Credit/Debit">
              <label class="form-check-label" for="radio2">Credit Card</label>
            </div>
          </div>
          <div id="creditCardFields" style="display: none;">
            <div class="form-group">
              <label for="cardNumber">Card Number</label>
              <input type="text" class="form-control" id="cardNumber" name="cardNumber">
            </div>
            <div class="form-group">
              <label for="cardName">Cardholder Name</label>
              <input type="text" class="form-control" id="cardName" name="cardName">
            </div>
            <div class="form-group">
              <label for="expiryDate">Expiry Date</label>
              <input type="text" class="form-control" id="expiryDate" name="expiryDate">
            </div>
            <div class="form-group">
              <label for="cvv">CVV</label>
              <input type="text" class="form-control" id="cvv" name="cvv">
            </div>
          </div>

          <hr class="my-4">
          <div class="col-md-12 text-center">
            <input name="agree" value='true' id="checkboxG2" class="mr-2 css-checkbox " type="checkbox">
            <label for="checkboxG2">I've read and accept the <a href="terms.php">terms &amp; conditions</a></label>
          </div>
          <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">Place Order</button>
        </div>
      </div>
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Order confirmation</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="products-checkout mb-4">
                <?php
                  $cart = $_SESSION['cart'];
                  $total_price = 0;

                  foreach ($cart as $key => $value) {
                    $cartsql = "SELECT * FROM products WHERE product_id=$key";
                    $cartres = mysqli_query($con, $cartsql);
                    $cartr = mysqli_fetch_assoc($cartres);
                    $total_price = $total_price + ($cartr['price'] * $value['quantity']);
                    $english_format_number = number_format($total_price);
                    ?>

                <div class="d-flex justify-content-between align-items-center mt-3 p-3 items rounded">
                  <div class="d-flex flex-row"><img class="rounded cart-img2"
                      src="admin-area/product_images/<?php echo $cartr['product_image']; ?>" alt="">
                    <div class="ms-2 cart-body-text2  d-flex flex-column justify-content-center"><span
                        class="fw-bold d-block">
                        <?php echo $cartr['product_title']; ?>
                      </span>
                      <div class="d-flex flex-column mt-2">
                        <span class="spec">
                          <?php
                              $product_id = $cartr['product_id'];
                              $selected_color = $value['color'];
                              // Get the selected color from the cart
                              $colorQuery = "SELECT color_name FROM color WHERE color_id='$selected_color'";
                              $colorResult = mysqli_query($con, $colorQuery);
                              $colorRow = mysqli_fetch_assoc($colorResult);

                              if ($colorRow != null) {
                                $color_name = $colorRow['color_name'];
                                echo $color_name;
                              } else {
                                echo "Random Color";
                              }
                              ?>
                        </span>
                      </div>
                    </div>
                  </div>
                  <span class="d-block d-flex justify-content-center align-items-center">
                    <span class="cart_qty me-1">Qty: </span>
                    <?php echo $value['quantity']; ?>
                  </span>
                  <div class="d-flex flex-row align-items-center price-cart-body"> <span class="d-block ms-5 fw-bold">
                      <span class="cart_qty me-1">Total Price:
                      </span>
                      <?php echo $english_format_number; ?>
                  </div>
                </div>
                <?php
                  }
                  ?>
              </div>
              <div class="pay-ment"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="submit" value="Place Order">
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
</div>
</form>
</div>

<?php
include('footer.php');
ob_end_flush();
?>