<?php
include_once("userheader.php"); // Ensure this includes your database connection

// Check if the cart array exists in session, if not create one
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if product ID is sent via POST or GET based on your form method
if (isset($_GET['product_id'])) { // Change to $_GET if the form uses GET
    $product_id = $_GET['product_id']; // Change to $_GET if necessary

    // Check if the product exists in the database
    $query = "SELECT * FROM products WHERE product_id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($product = mysqli_fetch_assoc($result)) {
            // Check if the product is already in the cart
            if (isset($_SESSION['cart'][$product_id])) {
                // Increment the quantity
                $_SESSION['cart'][$product_id]['quantity'] += 1;
            } else {
                // Add new item to cart
                $_SESSION['cart'][$product_id] = array(
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'imgname' => $product['imagname'], // Add imgname to the cart
                    'quantity' => 1
                ); 
            }
            ?>
            <script>
                window.location.href="usercart.php";
                </script>
            <?php
        } else {
            echo "Product not found.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the database query.";
    }
} else {
    echo "Product ID not provided.";
}

// For debugging purposes
echo "<pre>";
print_r($_SESSION['cart']);
echo "</pre>";
?>
