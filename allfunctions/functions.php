<?php
//Connection
include './db/db.php';
//Prooducts
function getTopProducts($offset, $limit)
{
  if (!isset($_GET['category'])) {
    global $con;
    // Retrieve the top products based on sales with offset and limit
    $sql = "SELECT * FROM products ORDER BY (SELECT SUM(quantity) FROM orderitems WHERE product_id = products.product_id) DESC LIMIT $offset, $limit";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
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
        <?PHP if ($stockQty <= 0) {
                echo '<div class="out-of-stock-ribbon">Out of Stock</div>';
              } ?>
        <div class="card-img-con">
          <img src="admin-area/product_images/<?php echo $row['product_image'] ?>" class="card-img-top p-3 img-fluid"
            alt="..." />
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
                  $colorQuery = "SELECT color_name FROM color WHERE color_id IN (SELECT color_id FROM product_color WHERE product_id = '$product_id')";
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
  }
}

function getCategory2()
{
  global $con;
  $sql1 = "SELECT * FROM category";
  $result2 = mysqli_query($con, $sql1);

  while ($row1 = mysqli_fetch_assoc($result2)) {
    ?>
<div class="col-3">
  <a href="filter.php?category=<?php echo $row1['cat_id']; ?>" class="cate-items dropdown-item"><img
      src="images/<?php echo $row1['cat-image']; ?>"></a>
</div>
<?php
  }
}

function getCategoryWithImages()
{
  global $con;
  $sql1 = "SELECT * FROM category limit 8";
  $result1 = mysqli_query($con, $sql1);
  //Display Category
  while ($row1 = mysqli_fetch_assoc($result1)) {
    ?>
<div class="col-md-3 custom-col">
  <div class="custom-gap">
    <a href="filter.php?category=<?php echo $row1['cat_id']; ?>">
      <img src="images/<?php echo $row1['cat-image'] ?>" alt="" class="img-fluid custom-border" style="height: 190px" />
    </a>
  </div>
</div>
<?php
  }
}


function customeProductsByCate($cateID, $limit = 6, $offset = 0) {
  if (!isset($_GET['category'])) {
      global $con;
      $sql2 = "SELECT * FROM products WHERE cat_id=$cateID LIMIT $limit OFFSET $offset";
      $result2 = mysqli_query($con, $sql2);

      while ($row2 = mysqli_fetch_assoc($result2)) {
          $product_id = $row2['product_id'];
          $stockQuery = "SELECT qty FROM stock WHERE product_id='$product_id'";
          $stockResult = mysqli_query($con, $stockQuery);
          $stockRow = mysqli_fetch_assoc($stockResult);
          $stockQty = $stockRow['qty'];
          ?>

<div class="col-sm-2 product-col">
  <div class="product-inner d-flex flex-column justify-content-center align-items-stretch top_products">
    <a href="single.php?id=<?php echo $row2['product_id']; ?>" class="h-100">
      <div class="card card_products justify-content-between">
        <?PHP if ($stockQty <= 0) {
                              echo '<div class="out-of-stock-ribbon">Out of Stock</div>';
                          } ?>
        <div class="card-img-con">
          <img src="admin-area/product_images/<?php echo $row2['product_image'] ?>" class="card-img-top p-3 img-fluid"
            alt="..." />
        </div>
        <div class="card-body d-flex align-items-center justify-content-between flex-column">
          <div class="card-title-con">
            <p class="card-title text-start"> <?php echo $row2['product_title'] ?> </p>
          </div>
          <div class="price">
            <p> <?php echo number_format($row2['price']) ?> Rs. </p>
          </div>
          <div class="colors-con d-flex gap-2 mt-1">
            <?php
                                  $colorQuery = "SELECT color_name FROM color WHERE color_id IN (SELECT color_id FROM product_color WHERE product_id = '$product_id')";
                                  $colorResult = mysqli_query($con, $colorQuery);
                                  while ($colorRow = mysqli_fetch_assoc($colorResult)) {
                                      $color_name = $colorRow['color_name'];
                                      echo "<div class='color-badge' style='background-color: $color_name;'></div>";
                                  }
                                  ?>
          </div>
        </div>
        <?php if ($stockQty > 0): ?>
        <a href="addtocart.php?id=<?php echo $row2['product_id']; ?>" class="add-to-cart-btn">Add to cart</a>
        <?php else: ?>
        <a href="" class="add-to-cart-btn-disabled">Out of stock</a>
        <?php endif; ?>
      </div>
    </a>
  </div>
</div>

<?php
      }
  }
}

function getCategoryName($categoryId)
{
  // Run SQL query to fetch category name from database
  global $con;
  $squery = "SELECT * FROM category where cat_id=$categoryId";
  $result = mysqli_query($con, $squery);
  // Check if query was successful
  if (!$result) {
    return "Unknown";
  }
  // Fetch category name from query result
  $row = mysqli_fetch_assoc($result);
  $categoryName = $row['cat_name'];
  // Return category name
  return $categoryName;
}
function categoryName()
{
  if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category_id = $_GET['category'];
    $category_name = getCategoryName($category_id); // Get category name by id
    echo '<h3 class="text-center py-2 px-4 rounded-4 categorys-name">' . $category_name . '</h3>';
  } else {
    echo '<h3 class="text-center py-2 px-4 rounded-4 categorys-name">Products</h3>';
  }
}

?>