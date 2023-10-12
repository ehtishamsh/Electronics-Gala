<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>

<?php if (empty($_SESSION['cart'])) { ?>
  <div class="py-5 my-5">
    <div class="container py-4">
      <div class="row">
        <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center">
          <img src="images/bag.svg" alt="" class="img-fluid mb-4">
          <h2>Your shopping cart is empty</h2>
          <p class="mb-4 cart-empty-text">
            Return to the store to add items for your delivery slot. Before proceed to checkout you must add some products
            to your shopping cart. You will find a lot of interesting products on our shop page.
          </p>
          <a href="index.php" class="btn btn-warning">Explore Products</a>
        </div>
      </div>
    </div>
  </div>
<?php } else { ?>
  <div class="container-fluid px-0 whole-proges py-4">
    <div class="container head_container py-4">
      <div class="progress-bar">
        <div class="progress-bar__progress p-3" style="width: 45%;"></div>
      </div>
      <div class="step-icons">
        <i class="bi bi-cart-fill active"></i>
        <i class="bi bi-arrow-right-circle active"></i>
        <i class="bi bi-credit-card"></i>
        <i class="bi bi-check-circle"></i>
      </div>
      <div class="heading_cart text-center mt-5">
        <h2 class="fw-bold">Shopping Cart</h2>
      </div>
    </div>
  </div>
  <div id="cart-items" class="mb-5 py-5">&nbsp;</div>
  <div class="container head_container my-5 pb-5">
    <form action="" method="post">
      <div class="container head_container my-5 p-3 pb-5 rounded cart">
        <div class="row no-gutters pb-5">
          <div class="col-md-8">
            <div class="product-details mr-2">
              <div class="d-flex flex-row align-items-center"><a href="index.php" class=""
                  style="cursor:pointer;text-decoration: none;"><i class="fa-solid fa-arrow-left-long"></i><span
                    class="ms-2">Continue Shopping</span></a></div>
              <hr>
              <h6 class="mb-0">Shopping cart</h6>
              <div class="d-flex justify-content-between"><span>You have
                  <?php echo $cart_count; ?> items in your
                  cart
                </span>
              </div>
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
                  <div class="d-flex flex-row"><img class="rounded cart-img"
                      src="admin-area/product_images/<?php echo $cartr['product_image']; ?>" alt="">
                    <div class="ms-2 cart-body-text  d-flex flex-column justify-content-center"><span
                        class="fw-bold d-block">
                        <?php echo $cartr['product_title']; ?>
                      </span>
                      <div class="d-flex flex-column mt-2"> <span class="spec">
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
                        <span class="spec">Price:
                          <?php echo $cartr['price']; ?> RS.
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
                      <?php echo $cartr['price'] * $value['quantity']; ?>
                    </span><a href="deleteCart.php?id=<?php echo $key; ?>" class=""
                      style="cursor:pointer;text-decoration: none;"><i class="fa-regular fa-trash-can ms-3"></i></a>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
          </div>
          <div class="col-md-4 cart-price-body">
            <div class="payment-info">
              <h4 class="text-center">Cart Summary</h4>
              <hr class="line">
              <div class="d-flex justify-content-between information"><span>Subtotal</span><span>
                  <?php if (isset($english_format_number)) {
                    echo $english_format_number;
                  } else {
                    echo "0000";
                  }
                  ?>
                  Rs.
                </span></div>
              <div class="d-flex justify-content-between information"><span>Shipping</span><span>Free</span></div>
              <div class="d-flex justify-content-between information"><span>Total(Incl. taxes)</span><span>
                  <?php if (isset($english_format_number)) {
                    echo $english_format_number;
                  } else {
                    echo "0000";
                  }
                  ?>
                  Rs.
                </span>
              </div><a href="checkout.php" class="btn btn-primary btn-block d-flex justify-content-between mt-3 w-100"
                type="a"><span>
                  <?php if (isset($english_format_number)) {
                    echo $english_format_number;
                  } else {
                    echo "0000";
                  }
                  ?>
                  Rs.
                </span><span>Checkout<i class="fa fa-long-arrow-right ms-1"></i></span></a>
            </div>
          </div>
        </div>
      </div>
    </form>
  <?php } ?>

</div>

<?php include('footer.php'); ?>