<?php
session_start();
include('../db/db.php');

// Redirect to login if user is not logged in
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

include 'header.php';

// Check if a search query is submitted
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$searchCondition = '';
if (!empty($searchQuery)) {
  // If a search query is provided, add a search condition to the SQL query
  $searchCondition = "AND products.product_title LIKE '%$searchQuery%'";
}

$sql = "SELECT products.*, category.cat_name, stock.qty FROM products 
        JOIN category ON products.cat_id = category.cat_id 
        JOIN stock ON products.product_id = stock.product_id 
        WHERE 1 $searchCondition 
        ORDER BY stock.qty ASC";



$res = mysqli_query($con, $sql);
?>

<section id="content">
  <div class="content-blog">
    <div class="container">
      <form method="GET" action="">
        <div class="form-group">
          <input type="text" name="search" placeholder="Search by product name"
            value="<?php echo htmlentities($searchQuery); ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
      </form>

      <div class="table-responsive mt-4">
        <table class="table table-hover table-light">
          <thead class="thead-dark text-center">
            <tr>
              <th>Stock</th>
              <th>Name</th>
              <th>Category</th>
              <th>Thumbnail</th>
              <th>Operations</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php while ($r = mysqli_fetch_assoc($res)) { ?>
              <tr>
                <td>
                  <strong>
                    <?php echo $r['qty']; ?>
                  </strong>
                </td>
                <td>
                  <?php echo $r['product_title']; ?>
                </td>
                <td>
                  <?php echo $r['cat_name']; ?>
                </td>
                <td>
                  <?php if ($r['product_image']) { ?>
                    <img src="product_images/<?php echo $r['product_image']; ?>" alt="Product Image"
                      style="width: 50px; height: 50px;">
                  <?php } else { ?>
                    No Image
                  <?php } ?>
                </td>
                <td class="text-center">
                  <a href="editstock.php?id=<?php echo $r['product_id']; ?>" class="btn btn-primary">Set Stock</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>