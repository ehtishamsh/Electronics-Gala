<?php ob_start();
include('header.php'); ?>
<?php include('nav.php'); ?>

<div id="cart-items">&nbsp;</div>
<main class="container py-4 head_container">
  <div class="row">
    <div class="col-md-3">
      <div class="filter-sidebar">
        <!-- Brand Filter -->
        <form action="" method="post">
          <?php
          // Retrieve the category ID from the URL parameter
          if (isset($_GET['category'])) {
            ?>
          <p class="mt-2 mb-4 fil-h fw-bold">Brand</p>
          <?php
            $categoryID = $_GET['category'];
            // Query to retrieve brands related to the category
            $brandQuery = "SELECT DISTINCT brands.* FROM brands INNER JOIN products ON products.brand_id = brands.brand_id WHERE products.cat_id = $categoryID";
            $brandResult = mysqli_query($con, $brandQuery);
            while ($row = mysqli_fetch_assoc($brandResult)) {
              ?>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="brand<?php echo $row['brand_id']; ?>" name="brands[]"
              value="<?php echo $row['brand_id']; ?>">
            <label class="form-check-label" for="brand<?php echo $row['brand_id']; ?>">
              <?php echo $row['brand_name']; ?>
            </label>
          </div>
          <?php
            }
          } else {
            ?>
          <p class="mt-2 mb-4 fil-h fw-bold">Categories</p>
          <ul class="list-group category-filter-group">
            <?php
              // Query to retrieve all categories
              $categoryQuery = "SELECT * FROM category";
              $categoryResult = mysqli_query($con, $categoryQuery);
              while ($row = mysqli_fetch_assoc($categoryResult)) {
                ?>
            <a href="filter.php?category=<?php echo $row['cat_id'] ?>"
              class="list-group-item"><?php echo $row['cat_name'] ?></a>
            <?php
              }
              ?>
          </ul>
          <?php
          }
          ?>

          <!-- Color Filter -->
          <p class="my-4 fil-h fw-bold">Color</p>
          <div class="color-con d-flex flex-wrap gap-2">
            <?php
            // Query to retrieve all colors
            $colorQuery = "SELECT * FROM color";
            $colorResult = mysqli_query($con, $colorQuery);

            while ($row = mysqli_fetch_assoc($colorResult)) {
              ?>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="color<?php echo $row['color_id']; ?>" name="colors[]"
                value="<?php echo $row['color_id']; ?>"
                style="background-color: <?php echo $row['color_name']; ?>;border:1px solid #3f3f3f">
            </div>
            <?php
            }
            ?>
          </div>

          <!-- Price Filter -->
          <p class="my-4 fil-h fw-bold">Price</p>
          <div class="wrapper">
            <div class="price-input mb-4">
              <div class="input-group">
                <span class="input-group-text px-1">Min</span>
                <input type="number" class="input-min form-control px-1" name="min_price" value="0">
              </div>
              <div class="separate"></div>
              <div class="input-group">
                <span class="input-group-text px-1">Max</span>
                <input type="number" class="input-max form-control px-1" name="max_price" value="700000">
              </div>
            </div>
            <div class="p-2">
              <div class="slider">
                <div class="progress"></div>
              </div>
              <div class="range-input">
                <input type="range" class="range-min" min="0" max="700000" value="0" step="1000">
                <input type="range" class="range-max" min="0" max="700000" value="700000" step="1000">
              </div>
            </div>
          </div>

          <button class="btn btn-success w-100 mt-2 filter-button" name="submit">Filter</button>
        </form>
      </div>
    </div>

    <div class="col-md-9">
      <div class="d-flex justify-content-end align-items-center mb-3 w-100 filter-sort py-3 px-4">
        <div class="form-group d-flex justify-content-center align-items-center gap-2">
          <label for="sort" class="me-2 sort h-100 w-100 d-flex justify-content-center align-items-center">
            <p>SORT BY:</p>
          </label>
          <select class="form-select" id="sort" onchange="sortProducts()">
            <option value="">Best Match</option>
            <option value="low-to-high-price">Price: Low to High</option>
            <option value="high-to-low-price">Price: High to Low</option>
          </select>
        </div>
      </div>

      <div class="product-list d-flex flex-wrap gap-4">
        <!-- Products -->
        <?php
        // Retrieve the category ID from the URL parameter if set
        if (isset($_GET['category'])) {
          $categoryID = $_GET['category'];
          $conditions = array();

          // Filter by selected brands
          if (isset($_POST['brands'])) {
            $brands = $_POST['brands'];
            $brandConditions = array();
            foreach ($brands as $brand) {
              $brandConditions[] = "products.brand_id = $brand";
            }
            if (!empty($brandConditions)) {
              $conditions[] = "(" . implode(" OR ", $brandConditions) . ")";
            }
          }

          // Filter by selected colors
          if (isset($_POST['colors'])) {
            $colors = $_POST['colors'];
            $colorConditions = array();
            foreach ($colors as $color) {
              $colorConditions[] = "product_color.color_id = $color";
            }
            if (!empty($colorConditions)) {
              $conditions[] = "(" . implode(" OR ", $colorConditions) . ")";
            }
          }

          // Filter by price range
          if (isset($_POST['min_price']) && isset($_POST['max_price'])) {
            $minPrice = $_POST['min_price'];
            $maxPrice = $_POST['max_price'];
            $priceCondition = "products.price BETWEEN $minPrice AND $maxPrice";
            $conditions[] = $priceCondition;
          }

          // Generate the WHERE clause based on the conditions
          $whereClause = "";
          if (!empty($conditions)) {
            $whereClause = "WHERE " . implode(" AND ", $conditions);
          }

          // Query to retrieve filtered products of the specified category
          $productQuery = "SELECT DISTINCT products.* FROM products INNER JOIN product_color ON product_color.product_id = products.product_id $whereClause AND products.cat_id = $categoryID";
        } elseif (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
          $searchQuery = $_GET['search_query'];

          // Query to check if the search query matches a category name exactly
          $categorySearchQuery = "SELECT * FROM category WHERE LOWER(cat_name) = '$searchQuery'";
          $categorySearchResult = mysqli_query($con, $categorySearchQuery);

          // If there is a category that matches the search query exactly, redirect to the category page
          if ($category = mysqli_fetch_assoc($categorySearchResult)) {
            $categoryID = $category['cat_id'];
            header("Location: filter.php?category=$categoryID");
            exit();
          }

          // Query to retrieve products matching the search query
          $productQuery = "SELECT * FROM products WHERE LOWER(product_title) LIKE '%$searchQuery%'";
        } else {
          // Query to retrieve all products
          $productQuery = "SELECT * FROM products";
        }

        $productResult = mysqli_query($con, $productQuery);
        while ($row = mysqli_fetch_assoc($productResult)) {
          $product_id = $row['product_id'];
          $stockQuery = "SELECT qty FROM stock WHERE product_id='$product_id'";
          $stockResult = mysqli_query($con, $stockQuery);
          $stockRow = mysqli_fetch_assoc($stockResult);
          $stockQty = $stockRow['qty'];
          ?>
        <div class="col-sm-2 product-col">
          <div class="product-inner d-flex flex-column justify-content-center align-items-stretch top_products">
            <a href="single.php?id=<?php echo $row['product_id']; ?>" class="h-100">
              <div class="card card_products justify-content-between">
                <?php if ($stockQty <= 0) {
                    echo '<div class="out-of-stock-ribbon">Out of Stock</div>';
                  } ?>
                <div class="card-img-con">
                  <img src="admin-area/product_images/<?php echo $row['product_image'] ?>"
                    class="card-img-top p-3 img-fluid" alt="..." />
                </div>
                <div class="card-body d-flex align-items-center justify-content-between flex-column">
                  <div class="card-title-con">
                    <p class="card-title text-start">
                      <?php echo $row['product_title'] ?>
                    </p>
                  </div>
                  <div class="price">
                    <p>
                      <?php echo number_format($row['price']) ?> Rs.
                    </p>
                  </div>
                  <div class="colors-con d-flex gap-2 mt-1">
                    <?php
                      $colorQuery = "SELECT color_name FROM color INNER JOIN product_color ON color.color_id = product_color.color_id WHERE product_color.product_id = '$product_id'";
                      $colorResult = mysqli_query($con, $colorQuery);
                      while ($colorRow = mysqli_fetch_assoc($colorResult)) {
                        $color_name = $colorRow['color_name'];
                        echo "<div class='color-badge' style='background-color: $color_name;'></div>";
                      }
                      ?>
                  </div>
                </div>
                <?php if ($stockQty > 0): ?>
                <a href="addtocart.php?id=<?php echo $row['product_id']; ?>" class="add-to-cart-btn">Add to cart</a>
                <?php else: ?>
                <a href="" class="add-to-cart-btn-disabled">Out of stock</a>
                <?php endif; ?>
              </div>
            </a>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</main>

<?php include('footer.php');
ob_end_flush(); ?>