<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
  header('location:../login.php');
}

if (isset($_POST['submit'])) {
  $product_title = mysqli_real_escape_string($con, $_POST['productname']);
  $description = mysqli_real_escape_string($con, $_POST['productdescription']);
  $p_price = $_POST['productprice'];
  $product_cate = $_POST['productcategory'];
  $product_image = $_FILES['productimage']['name'];
  $tmp_image = $_FILES['productimage']['tmp_name'];
  $product_brand = $_POST['productbrand'];

  // Checking Condition
  if ($product_title == '' || $product_cate == '' || $p_price == '' || $product_image == '' || $description == '' || $product_brand == '') {
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var fillDetailsModal = new bootstrap.Modal(document.getElementById("fillDetailsModal"));
                fillDetailsModal.show();
            });
        </script>';
  } else {
    move_uploaded_file($tmp_image, "./product_images/$product_image");
    $insertQ = "INSERT INTO `products` (product_title, cat_id, price, product_image, product_description, brand_id) VALUES ('$product_title', '$product_cate', '$p_price', '$product_image', '$description', '$product_brand')";
    $result = mysqli_query($con, $insertQ);

    if ($result) {
      $product_id = mysqli_insert_id($con); // Get the generated product ID

      // Insert selected colors into product_color table
      if (!empty($_POST['colors'])) {
        $selectedColors = $_POST['colors'];
        foreach ($selectedColors as $color_id) {
          $insertColorQ = "INSERT INTO `product_color` (product_id, color_id) VALUES ('$product_id', '$color_id')";
          mysqli_query($con, $insertColorQ);
        }
      }
      // Insert product into stock table
      $qty = $_POST['productqty'];
      $insertStockQ = "INSERT INTO `stock` (product_id, qty) VALUES ('$product_id', '$qty')";
      mysqli_query($con, $insertStockQ);
    }
  }
}
?>

<?php include 'header.php'; ?>

<!-- Fill Details Modal -->
<div class="modal fade " style="padding-left: 17px !important;" id="fillDetailsModal" tabindex="-1" role="dialog"
  aria-labelledby="fillDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fillDetailsModalLabel">Fill All Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">Please fill in all the fields to add the product.</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<section>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Add Product</div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="productname">Product Title</label>
                <input type="text" class="form-control" name="productname" placeholder="Product Name">
              </div>
              <div class="form-group">
                <label for="productdescription">Product Description</label>
                <textarea class="form-control" name="productdescription" rows="3"></textarea>
                <small class="form-text text-muted">Add only lines</small>
              </div>
              <div class="form-group">
                <label for="productcategory">Product Category</label>
                <select class="form-control" name="productcategory">
                  <option value="">Select Category</option>
                  <?php
                  $sql = "SELECT * FROM category";
                  $res = mysqli_query($con, $sql);
                  while ($r = mysqli_fetch_assoc($res)) {
                    $categoryID = $r['cat_id'];
                    $categoryName = $r['cat_name'];
                    echo "<option value='$categoryID'>$categoryName</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="productbrand">Product Brand</label>
                <select class="form-control" name="productbrand">
                  <option value="">Select Brand</option>
                  <?php
                  $brandQuery = "SELECT * FROM brands";
                  $brandResult = mysqli_query($con, $brandQuery);
                  while ($brandRow = mysqli_fetch_assoc($brandResult)) {
                    $brandID = $brandRow['brand_id'];
                    $brandName = $brandRow['brand_name'];
                    echo "<option value='$brandID'>$brandName</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="productprice">Product Price</label>
                <input type="text" class="form-control" name="productprice" id="productprice"
                  placeholder="Product Price">
              </div>
              <div class="form-group">
                <label for="productqty">Product Quantity</label>
                <input type="text" class="form-control" name="productqty" id="productqty"
                  placeholder="Product Quantity">
              </div>
              <div class="form-group">
                <label for="productimage">Product Image</label>
                <input type="file" name="productimage" id="productimage" class="form-control-file">
                <div id="image-preview" style="width: 100px; height: 100px;"></div>
              </div>

              <div class="form-group">
                <label for="productcolors">Product Colors</label><br>
                <?php
                $colorQuery = "SELECT * FROM color";
                $colorResult = mysqli_query($con, $colorQuery);
                while ($colorRow = mysqli_fetch_assoc($colorResult)) {
                  $colorID = $colorRow['color_id'];
                  $colorName = $colorRow['color_name'];
                  echo "<label class='checkbox-inline'><input type='checkbox' name='colors[]' value='$colorID'> <span style='background-color: $colorName;width:8px;height:8px;padding:8px;border-radius:100%;display:inline-block'></span></label>";
                }
                ?>
              </div>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>