<?php
session_start();

// Check if product_id is provided and if the product exists in the cart
if (isset($_GET['product_id']) && isset($_SESSION['cart'][$_GET['product_id']])) {
    // Remove the product from the cart
    unset($_SESSION['cart'][$_GET['product_id']]);
    header("Location: usercart.php"); // Redirect back to the cart page
    exit();
} else {
    // If product_id is not provided or the product does not exist in the cart, redirect back to the cart page
    header("Location: usercart.php");
    exit();
}
?>
