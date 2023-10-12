<?php
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]);
    echo "<script>var scrollPosition = window.scrollY;</script>";
    $deleteMessage = "Product deleted from cart";
    $_SESSION['cart_Dmessage'] = $deleteMessage;
    // Redirect back to the referring page
    echo "<script>window.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
}
?>