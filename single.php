<?php
include('header.php');
include('nav.php');

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $sql = "SELECT * FROM products WHERE product_id='$product_id'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);

  $product_name = $row['product_title'];
  $cat_id = $row['cat_id'];
  $price = $row['price'];
  $product_description = $row['product_description'];
  $thumb = $row['product_image'];
  $productBrand = $row['brand_id'];

  $avgRatingQuery = "SELECT AVG(rating) AS average_rating, COUNT(*) AS total_reviews FROM product_reviews WHERE product_id='$product_id'";
  $avgRatingResult = mysqli_query($con, $avgRatingQuery);
  $avgRatingRow = mysqli_fetch_assoc($avgRatingResult);

  $average_rating = $avgRatingRow['average_rating'];
  $total_reviews = $avgRatingRow['total_reviews'];

  if (isset($_POST['submit-review'])) {
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $c_id = $_SESSION['customerid'];

    // You may need to modify the following SQL query based on your table structure
    $insertQuery = "INSERT INTO product_reviews (product_id, user_id, rating, review, date_added) VALUES ('$product_id', '$c_id', '$rating', '$review', NOW())";
    mysqli_query($con, $insertQuery);
  }
}

?>

<section class="py-5">
  <div class="container">
    <div class="row gx-5">
      <aside class="col-lg-6">
        <div class="border rounded-4 mb-3 d-flex justify-content-center">
          <div id="img-zoomer-box">
            <img src="admin-area/product_images/<?php echo $thumb ?>" id="img-1" class="product-single-img"
              alt="Zoom Image on Mouseover" />
            <div id="img-2"></div>
          </div>
        </div>
        <div class="d-flex justify-content-center mb-3">
          <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
            href="admin-area/product_images/<?php echo $thumb ?>" class="item-thumb">
            <img width="60" height="60" class="rounded-2" src="admin-area/product_images/<?php echo $thumb ?>" />
          </a>
        </div>
      </aside>
      <main class="col-lg-6">
        <div class="ps-lg-3">
          <h4 class="title text-dark">
            <?php echo $product_name ?>
          </h4>
          <div class="d-flex flex-row my-3">
            <div class="text-warning mb-1 me-2">
              <?php
              for ($i = 1; $i <= 5; $i++) {
                $filled = ($i <= round($average_rating)) ? 'filled' : '';
                $color = ($i <= round($average_rating)) ? ' #FF9529' : '#ccc';
                echo '<i class="fa fa-star ' . $filled . '" style="color: ' . $color . '"></i>';
              }
              ?>
              <span class="ms-1 fw-bold">
                <?php echo number_format($average_rating, 1); ?>
              </span>
            </div>
            <span class="fw-bold"> (
              <?php echo $total_reviews; ?> )
            </span>
            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>order</span>

            <?php
            // Check if the product is in stock or out of stock
            $stockQuery = "SELECT qty FROM stock WHERE product_id='$product_id'";
            $stockResult = mysqli_query($con, $stockQuery);
            $stockRow = mysqli_fetch_assoc($stockResult);
            $stockQty = $stockRow['qty'];

            if ($stockQty > 0) {
              echo '<span class="text-success ms-2">In stock</span>';
            } else {
              echo '<span class="text-danger ms-2">Out of stock</span>';
            }
            ?>

          </div>
          <div class="mb-3">
            <span class="h5">
              <?php echo number_format($price) ?>
            </span>
            <span class="text-muted">/ RS</span>
          </div>
          <p class="cutoff-text">
            <?php echo $product_description ?>
          </p>
          <form action="addtocart.php">
            <input type="hidden" name="id" value="<?php echo $product_id; ?>">
            <div class="row">
              <dt class="col-3">Category:</dt>
              <dd class="col-9">
                <?php
                $sql2 = "SELECT * FROM Category WHERE cat_id = '$cat_id'";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo $row2["cat_name"];
                ?>
              </dd>
              <dt class="col-3">Color</dt>
              <dd class="col-9">
                <div class="color-con">
                  <div class="colors">
                    <ul>
                      <?php
                      $colorQuery = "SELECT * FROM color WHERE color_id IN (SELECT color_id FROM product_color WHERE product_id = '$product_id')";
                      $colorResult = mysqli_query($con, $colorQuery);

                      while ($colorRow = mysqli_fetch_assoc($colorResult)) {
                        $color_id = $colorRow['color_id'];
                        $color_name = $colorRow['color_name'];
                        ?>
                        <li>
                          <label>
                            <input type="radio" name="color" value="<?php echo $color_id; ?>">
                            <span class="swatch" style="background-color:<?php echo $color_name; ?>"></span>
                          </label>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </dd>
              <dt class="col-3">Brand</dt>
              <?php $sql = "SELECT * FROM brands Where brand_id='$productBrand'";
              $brandQ = mysqli_query($con, $sql);
              $brandResult = mysqli_fetch_assoc($brandQ);
              ?>
              <dd class="col-9">
                <?php echo $brandResult["brand_name"]; ?>
              </dd>
              <?php
              ?>
            </div>
            <hr />
            <div class="row mb-4">
              <div class="col-md-4 col-6 mb-3">
                <?php if ($stockQty > 0): ?>
                  <label class="mb-2 d-block">Quantity</label>
                  <div class="input-group mb-3" style="width: 100px;">
                    <button class="btn btn-primary btn-sm" type="button" id="decreaseQuantity">-</button>
                    <input type="number" class="form-control quantity-design text-center" name="quantity" value="1"
                      min="1">
                    <button class="btn btn-primary btn-sm" type="button" id="increaseQuantity">+</button>
                  </div>
                </div>
              </div>

              <button class="btn btn-primary shadow-0" type="submit"> <i class="me-1 fa fa-shopping-basket"></i> Add to
                cart </button>
            <?php else: ?>
              <button class="btn btn-secondary" disabled>Out of stock</button>
            <?php endif; ?>
          </form>
        </div>
      </main>
    </div>
  </div>
</section>
<!-- content -->

<section class="bg-light border-top py-4">
  <div class="container">
    <div class="row gx-4">
      <div class="col-lg-8 mb-4">
        <div class="border rounded-2 px-3 py-2 bg-white">
          <!-- Pills navs -->
          <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item d-flex" role="presentation">
              <a class="nav-link d-flex align-items-center justify-content-center w-100 active" id="ex1-tab-1"
                data-mdb-toggle="pill" data-mdb-target="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1"
                aria-selected="true">Reviews</a>
            </li>
            <li class="nav-item d-flex" role="presentation">
              <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-2"
                data-mdb-toggle="pill" data-mdb-target="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2"
                aria-selected="false">Description</a>
            </li>
          </ul>
          <!-- Pills navs -->

          <!-- Pills content -->
          <div class="tab-content" id="ex1-content">
            <div class="tab-pane show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
              <div class="row">
                <div class="col-12 col-md-12 p-3">
                  <div class="reviews-con">
                    <?php
                    // Assuming you have a database connection established
                    
                    // Check if the user has a valid customer ID
                    if (isset($_SESSION['customerid'])) {
                      $customerId = $_SESSION['customerid'];

                      // Check if the user has purchased the product // Replace with the actual product ID
                      $query = "SELECT * FROM orders o
            INNER JOIN orderitems oi ON o.id = oi.order_id
            WHERE o.user_id = $customerId AND oi.product_id = $product_id";
                      $result = mysqli_query($con, $query);

                      if (mysqli_num_rows($result) > 0) {
                        // User has purchased the product, check if they have already posted a review
                        $reviewQuery = "SELECT * FROM product_reviews
                    WHERE user_id = $customerId AND product_id = $product_id";
                        $reviewResult = mysqli_query($con, $reviewQuery);

                        if (mysqli_num_rows($reviewResult) == 0) {
                          // User has not posted a review yet, show the review form
                          ?>
                          <form method="POST">
                            <h4 class="text-center">Post your Review</h4>
                            <div class="form-group d-flex flex-column">
                              <label for="rating">
                                <h6>Rating:</h6>
                              </label>
                              <div class="star-rating">
                                <input type="radio" name="rating" value="5" id="star5"><label for="star5"></label>
                                <input type="radio" name="rating" value="4" id="star4"><label for="star4"></label>
                                <input type="radio" name="rating" value="3" id="star3"><label for="star3"></label>
                                <input type="radio" name="rating" value="2" id="star2"><label for="star2"></label>
                                <input type="radio" name="rating" value="1" id="star1"><label for="star1"></label>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="review">
                                <h6>Review:</h6>
                              </label>
                              <textarea name="review" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 w-100" name="submit-review">Submit
                              Review</button>
                          </form>
                          <?php
                        }
                      }
                    }
                    ?>
                    <div class="reviews-list-container">
                      <?php
                      $reviewsQuery = "SELECT * FROM product_reviews WHERE product_id='$product_id'";
                      $reviewsResult = mysqli_query($con, $reviewsQuery);

                      if (mysqli_num_rows($reviewsResult) == 0) {
                        echo "<p>There are no reviews yet.</p>";
                      } else {
                        ?>
                        <ul class="list-group list-group-flush">
                          <?php
                          while ($reviewRow = mysqli_fetch_assoc($reviewsResult)) {
                            $rating = $reviewRow['rating'];
                            $review = $reviewRow['review'];
                            $dateAdded = $reviewRow['date_added'];
                            $userid = $reviewRow['user_id'];
                            $usernameReview = "SELECT * FROM users WHERE id='$userid'";
                            $userResult = mysqli_query($con, $usernameReview);
                            $userRow = mysqli_fetch_assoc($userResult);
                            ?>
                            <li class="list-group-item d-flex gap-4 mt-2">
                              <div class="user-avatar mt-1">
                                <img src="images/user-avatar.png" alt="">
                              </div>
                              <div class="user-content">
                                <div class="text-content-user mb-2">
                                  <p class="fw-bold">
                                    <?php echo $userRow['name']; ?>
                                  </p>
                                  <span class="date-users">
                                    <?php echo date('Y-m-d', strtotime($dateAdded)); ?>
                                  </span>
                                </div>
                                <div class="star-rating posted-rating mb-2">
                                  <?php
                                  for ($i = 5; $i >= 1; $i--) {
                                    $checked = ($i <= $rating) ? 'checked' : '';
                                    $color = ($i <= $rating) ? ' #FF9529' : '#ccc';
                                    ?>
                                    <label style="color: <?php echo $color; ?>;"></label>
                                    <?php
                                  }
                                  ?>
                                </div>

                                <p class="user-review mb-2">
                                  <?php echo $review; ?>
                                </p>

                              </div>
                            </li>
                            <?php
                          }
                          ?>
                        </ul>
                        <?php
                      }
                      ?>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane mb-2" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
              <!-- Description content -->
              <p class="mb-5">
                <?php echo $product_description ?>
              </p>
              <div class="row mb-2 d-flex flex-wrap">
                <div class="col-12 col-md-7">
                  <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-check text-success me-2"></i>Outstanding features that enhance your experience
                    </li>
                    <li><i class="fas fa-check text-success me-2"></i>Unparalleled comfort and convenience</li>
                    <li><i class="fas fa-check text-success me-2"></i>Exceptional performance and reliability</li>
                    <li><i class="fas fa-check text-success me-2"></i>Advanced technology for an enhanced user
                      experience</li>
                  </ul>
                </div>
                <div class="col-12 col-md-5 mb-0">
                  <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success me-2"></i>Effortless and efficient functionality</li>
                    <li><i class="fas fa-check text-success me-2"></i>Unmatched quality and reliability</li>
                    <li><i class="fas fa-check text-success me-2"></i>Sleek and modern design that stands out</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Pills content -->
        </div>
      </div>
      <div class="col-lg-4">
        <div class="px-0 border rounded-2 shadow-0">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Similar items</h5>
              <?php
              // Fetch similar products based on the same category
              $similarQuery = "SELECT * FROM products WHERE cat_id = '$cat_id' AND product_id != '$product_id' LIMIT 4";
              $similarResult = mysqli_query($con, $similarQuery);

              while ($similarRow = mysqli_fetch_assoc($similarResult)) {
                $similar_product_id = $similarRow['product_id'];
                $similar_product_name = $similarRow['product_title'];
                $similar_product_price = $similarRow['price'];
                $similar_product_thumb = $similarRow['product_image'];
                ?>

                <div class="d-flex mb-3">
                  <a href="single.php?id=<?php echo $similar_product_id ?>" class="me-3">
                    <img src="admin-area/product_images/<?php echo $similar_product_thumb; ?>"
                      style="width: 120px; height: 120px;" class="img-md img-thumbnail" />
                  </a>
                  <div class="info">
                    <a href="single.php?id=<?php echo $similar_product_id ?>" class="nav-link mb-1">
                      <?php echo $similar_product_name; ?>
                    </a>
                    <strong class="text-dark">
                      <?php echo $similar_product_price; ?> RS
                    </strong>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<?php include('footer.php'); ?>