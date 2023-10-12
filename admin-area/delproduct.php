<?php
session_start();
include('../db/db.php');
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
	header('location:../login.php');
}

if (isset($_GET['id'])) {
	$product_id = $_GET['id'];

	// Fetch brand details from the database
	$sqlQ = "SELECT * FROM `products` WHERE `product_id` = '$product_id'";
	$result = mysqli_query($con, $sqlQ);
	if (mysqli_num_rows($result) > 0) {
		$products = mysqli_fetch_assoc($result);
	} else {
		echo "Product not found.";
		exit;
	}
} else {
	echo "Invalid request.";
	exit;
}

if (isset($_POST['confirm_delete'])) {
	// Delete brand from the database
	$sqlQ = "DELETE FROM `products` WHERE `product_id` = '$product_id'";
	$result = mysqli_query($con, $sqlQ);
	if ($result) {
		// Delete from stock table
		$sqlStockDelete = "DELETE FROM `stock` WHERE `product_id` = '$product_id'";
		$resultStockDelete = mysqli_query($con, $sqlStockDelete);

		// Delete from product_color table
		$sqlColorDelete = "DELETE FROM `product_color` WHERE `product_id` = '$product_id'";
		$resultColorDelete = mysqli_query($con, $sqlColorDelete);

		if ($resultStockDelete && $resultColorDelete) {
			header("Location: products.php");
			exit;
		} else {
			echo "Failed to delete product from stock or product_color.";
		}
	} else {
		echo "Failed to delete product.";
	}
}
include('header.php');
?>

<div class="container p-5 my-5">
	<div class="card">
		<div class="card-body">
			<h2 class="card-title">Delete Product</h2>
			<p class="card-text">Are you sure you want to delete the Product
				"<strong>
					<?php echo $products['product_title']; ?>
				</strong>"?</p>
			<form method="POST" action="">
				<div class="text-center">
					<button type="submit" class="btn btn-danger" name="confirm_delete">Yes, Delete</button>
					<a href="products.php" class="btn btn-secondary">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>