<?php
session_start();
include('../db/db.php');

// Redirect to login if user is not logged in
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

include 'header.php';

// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  // Fetch the product details from the database
  $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
  $res = mysqli_query($con, $sql);
  $product = mysqli_fetch_assoc($res);

  // Fetch the stock details from the database
  $sql = "SELECT * FROM stock WHERE product_id = '$product_id'";
  $res = mysqli_query($con, $sql);
  $stock = mysqli_fetch_assoc($res);

  // Handle form submission to update stock quantity
  if (isset($_POST['update_stock'])) {
    $new_qty = $_POST['qty'];

    // Update the stock quantity in the database
    $update_sql = "UPDATE stock SET qty = '$new_qty' WHERE product_id = '$product_id'";
    mysqli_query($con, $update_sql);

    // Redirect back to the stock.php page after updating
    header('location: stock.php');
    exit;
  }
} else {
  // Redirect back to the stock.php page if product ID is not provided
  header('location: stock.php');
  exit;
}
?>

<section id="content">
  <div class="content-blog">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Edit Stock for Product:
                <?php echo $product['product_title']; ?>
              </h2>
            </div>
            <div class="card-body">
              <form method="POST" action="">
                <div class="form-group">
                  <label for="qty">Stock Quantity</label>
                  <input type="text" name="qty" value="<?php echo $stock['qty']; ?>" class="form-control">
                </div>
                <button type="submit" name="update_stock" class="btn btn-primary">Update Stock</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>