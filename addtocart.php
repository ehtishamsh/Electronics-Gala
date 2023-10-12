<?php
session_start();
include('db/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
    $color = isset($_GET['color']) ? $_GET['color'] : null;

    // Check if the product exists in the stock table
    $stockQuery = "SELECT qty FROM stock WHERE product_id = '$id'";
    $stockResult = mysqli_query($con, $stockQuery);
    $stockRow = mysqli_fetch_assoc($stockResult);
    $stockQty = $stockRow['qty'];

    // Check if the requested quantity exceeds the available stock
    if ($quantity > $stockQty) {
        $message = "Insufficient stock. Only $stockQty items available.";
    } else {
        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$id])) {
            $currentQuantity = $_SESSION['cart'][$id]['quantity'];

            // Calculate the total quantity after adding the requested quantity
            $newQuantity = $currentQuantity + $quantity;

            // Check if the total quantity exceeds the available stock
            if ($newQuantity > $stockQty) {
                $message = "Insufficient stock. Only $stockQty items available.";
            } else {
                $_SESSION['cart'][$id]['quantity'] = $newQuantity;
                $_SESSION['cart'][$id]['color'] = $color;
                $message = "Item already in cart. Quantity increased.";
            }
        } else {
            $_SESSION['cart'][$id] = array('quantity' => $quantity, 'color' => $color);
            $message = "Item added to cart.";
        }
    }
    // Store the message in a session variable
    $_SESSION['cart_message'] = $message;

    // Redirect back to previous page
    echo "<script>window.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
    exit();

}
?>