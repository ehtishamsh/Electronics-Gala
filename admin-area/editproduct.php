<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

// Check if product id is set in the URL
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $product_id = mysqli_real_escape_string($con, $product_id);
  $selectQ = "SELECT * FROM products WHERE product_id='$product_id'";
  $result = mysqli_query($con, $selectQ);
  $r = mysqli_fetch_assoc($result);

  // Check if product ID exists in stock table
  $stockQ = "SELECT * FROM stock WHERE product_id='$product_id'";
  $stockResult = mysqli_query($con, $stockQ);
  $stockExists = mysqli_num_rows($stockResult) > 0;
}

// Fetch brands
$brandQuery = "SELECT * FROM brands";
$brandResult = mysqli_query($con, $brandQuery);

// Fetch stock information
if ($stockExists) {
  $stock = mysqli_fetch_assoc($stockResult);
} else {
  $stock = null;
}

// Check if form is submitted
if (isset($_POST['submit'])) {
  $product_title = $_POST['productname'];
  $description = $_POST['productdescription'];
  $p_price = $_POST['productprice'];
  $product_cate = $_POST['productcategory'];
  $product_brand = $_POST['productbrand'];
  $product_image = $_FILES['productimage']['name'];
  $tmp_image = $_FILES['productimage']['tmp_name'];
  $qty = $_POST['productqty'];

  // Escaping the input values
  $product_title = mysqli_real_escape_string($con, $product_title);
  $description = mysqli_real_escape_string($con, $description);
  $p_price = mysqli_real_escape_string($con, $p_price);
  $product_cate = mysqli_real_escape_string($con, $product_cate);
  $product_brand = mysqli_real_escape_string($con, $product_brand);
  $qty = mysqli_real_escape_string($con, $qty);

  // Checking if fields are empty
  if ($product_title == '' || $product_cate == '' || $p_price == '' || $description == '' || $product_brand == '') {
    echo '<script> alert("Please fill all the fields"); </script>';
  } else {
    // Update product information
    if ($product_image != '') {
      $product_image = mysqli_real_escape_string($con, $product_image);
      move_uploaded_file($tmp_image, "./product_images/$product_image");
      $updateQ = "UPDATE products SET product_title='$product_title', cat_id='$product_cate', price='$p_price', brand_id='$product_brand', product_image='$product_image', product_description='$description' WHERE product_id='$product_id'";
    } else {
      $updateQ = "UPDATE products SET product_title='$product_title', cat_id='$product_cate', price='$p_price', brand_id='$product_brand', product_description='$description' WHERE product_id='$product_id'";
    }
    $result = mysqli_query($con, $updateQ);

    // Update product colors
    if ($result) {
      // Remove existing color associations
      $deleteColorsQ = "DELETE FROM product_color WHERE product_id='$product_id'";
      mysqli_query($con, $deleteColorsQ);

      // Insert new color associations
      if (!empty($_POST['colors'])) {
        $colors = $_POST['colors'];
        foreach ($colors as $color) {
          $color = mysqli_real_escape_string($con, $color);
          $insertColorQ = "INSERT INTO product_color (product_id, color_id) VALUES ('$product_id', '$color')";
          mysqli_query($con, $insertColorQ);
        }
      }

      // Insert or update stock information
      if ($stockExists) {
        // Update existing stock quantity
        $updateStockQ = "UPDATE stock SET qty='$qty' WHERE product_id='$product_id'";
        mysqli_query($con, $updateStockQ);
      } else {
        // Insert new stock information
        $insertStockQ = "INSERT INTO stock (product_id, qty) VALUES ('$product_id', '$qty')";
        mysqli_query($con, $insertStockQ);
      }
    }

    echo '<script> alert("Product Updated"); window.location = "products.php"; </script>';
  }
}
?>

<?php include 'header.php'; ?>

<section>
  <div class="content-blog">
    <div class="container w-50">
      <form method="post" enctype="multipart/form-data">
        <div class="form-group mb-3 mt-2">
          <label for="Productname">Product Title</label>
          <input type="text" class="form-control" name="productname"
            value="<?php echo htmlspecialchars($r['product_title']); ?>" placeholder="Product Name">
        </div>
        <div class="form-group mb-3">
          <label for="productdescription">Product Description</label>
          <textarea class="form-control" name="productdescription"
            rows="3"><?php echo htmlspecialchars($r['product_description']); ?></textarea>
          <p class="text">Add only lines</p>
        </div>
        <div class="form-group mb-3">
          <label for="productcategory">Product Category</label>
          <select class="form-control" name="productcategory">
            <option value="">Select Category</option>
            <?php
            $sql = "SELECT * FROM category";
            $res = mysqli_query($con, $sql);
            while ($category = mysqli_fetch_assoc($res)) {
              $categoryID = $category['cat_id'];
              $categoryName = $category['cat_name'];
              $selected = ($categoryID == $r['cat_id']) ? 'selected' : '';
              echo "<option value='$categoryID' $selected>$categoryName</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group mb-3">
          <label for="productbrand">Product Brand</label>
          <select class="form-control" name="productbrand">
            <option value="">Select Brand</option>
            <?php
            while ($brandRow = mysqli_fetch_assoc($brandResult)) {
              $brandID = $brandRow['brand_id'];
              $brandName = $brandRow['brand_name'];
              $selectedBrand = ($brandID == $r['brand_id']) ? 'selected' : '';
              echo "<option value='$brandID' $selectedBrand>$brandName</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group mb-3">
          <label for="productprice">Product Price</label>
          <input type="text" class="form-control" name="productprice" id="productprice" placeholder="Product Price"
            value="<?php echo htmlspecialchars($r['price']); ?>">
        </div>
        <div class="form-group mb-3">
          <label for="productimage">Product Image</label>
          <div class="mb-2">
            <img src="./product_images/<?php echo htmlspecialchars($r['product_image']); ?>" alt="Product Image"
              style="max-width: 200px;">
          </div>
          <input type="file" name="productimage">
        </div>
        <div class="form-group">
          <label for="productcolors">Product Colors</label><br>
          <?php
          $colorQuery = "SELECT * FROM color";
          $colorResult = mysqli_query($con, $colorQuery);
          $selectedColors = array();

          // Fetch the selected colors for the product
          $productColorsQuery = "SELECT color_id FROM product_color WHERE product_id='$product_id'";
          $productColorsResult = mysqli_query($con, $productColorsQuery);
          while ($productColorRow = mysqli_fetch_assoc($productColorsResult)) {
            $selectedColors[] = $productColorRow['color_id'];
          }

          while ($colorRow = mysqli_fetch_assoc($colorResult)) {
            $colorID = $colorRow['color_id'];
            $colorName = $colorRow['color_name'];
            $isChecked = in_array($colorID, $selectedColors) ? 'checked' : '';
            echo "<label class='checkbox-inline'><input type='checkbox' name='colors[]' value='$colorID' $isChecked> <span style='background-color: $colorName;width:8px;height:8px;padding:8px;border-radius:100%;display:inline-block'></span></label>";
          }
          ?>
        </div>
        <div class="form-group mb-3">
          <label for="productqty">Product Quantity</label>
          <input type="text" class="form-control" name="productqty" id="productqty" placeholder="Product Quantity"
            value="<?php echo ($stockExists) ? htmlspecialchars($stock['qty']) : ''; ?>">
        </div>
        <div class="text-center">
          <button type="submit" name="submit" class="btn btn-default bg-dark text-light px-4">Update</button>
        </div>
      </form>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>