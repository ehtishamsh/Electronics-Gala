<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
  header('location:../login.php');
}

// Filter variables
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
$filterCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

include 'header.php';
?>

<section id="content">
  <div class="content-blog">
    <div class="container">
      <a class="btn btn-dark mb-3" href="addproduct.php">Add Products</a>
      <div class="mb-3">
        <form action="" method="GET">
          <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search by product name"
              value="<?php echo $searchKeyword; ?>">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Search</button>
            </div>
          </div>
        </form>
      </div>

      <div class="mb-3">
        <form action="" method="GET">
          <div class="input-group">
            <select name="category" class="form-control">
              <option value="all" <?php echo ($filterCategory == 'all') ? 'selected' : ''; ?>>All Categories</option>
              <?php
              // Retrieve categories from the database
              $categorySql = "SELECT * FROM category";
              $categoryResult = mysqli_query($con, $categorySql);
              while ($category = mysqli_fetch_assoc($categoryResult)) {
                $categoryId = $category['cat_id'];
                $categoryName = $category['cat_name'];
                ?>
                <option value="<?php echo $categoryId; ?>" <?php echo ($filterCategory == $categoryId) ? 'selected' : ''; ?>><?php echo $categoryName; ?></option>
              <?php } ?>
            </select>
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Filter</button>
            </div>
          </div>
        </form>
      </div>

      <table class="table table-hover table-light">
        <thead class="thead-dark text-center">
          <tr class="text-center">
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Thumbnail</th>
            <th colspan="2">Operations</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php
          // Construct SQL query with search and filter conditions
          $sql = "SELECT p.*, c.cat_name, b.brand_name
                  FROM products p
                  JOIN category c ON p.cat_id = c.cat_id
                  JOIN brands b ON p.brand_id = b.brand_id";

          if (!empty($searchKeyword)) {
            $sql .= " WHERE p.product_title LIKE '%$searchKeyword%'";
          }

          if ($filterCategory != 'all') {
            $sql .= " AND p.cat_id = $filterCategory";
          }

          $res = mysqli_query($con, $sql);
          while ($r = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
              <th scope="row">
                <?php echo $r['product_id']; ?>
              </th>
              <td>
                <?php echo $r['product_title']; ?>
              </td>
              <td>
                <?php echo $r['cat_name']; ?>
              </td>
              <td>
                <?php echo $r['brand_name']; ?>
              </td>
              <td>
                <?php
                if ($r['product_image']) {
                  echo '<img src="product_images/' . $r['product_image'] . '" alt="Product Image" style="width: 50px; height: 50px;">';
                } else {
                  echo "No Image";
                }
                ?>
              </td>
              <td class="d-flex align-items-center justify-content-center">
                <a href="editproduct.php?id=<?php echo $r['product_id']; ?>"
                  class="btn btn-success btn-sm edit-Btm-sm">Edit</a>
              </td>
              <td>
                <a href="delproduct.php?id=<?php echo $r['product_id']; ?>"
                  class="btn btn-danger btn-sm  edit-Btm-sm">Delete</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php include 'footer.php' ?>