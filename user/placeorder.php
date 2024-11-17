<?php
session_start();

// Include database connection
include_once('../dbconnection/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        // Process the order
        $orderId = uniqid(); // Generate a unique order ID
        $userId = $_SESSION['username'];
        $totalAmount = $_POST['final_amount']; // Assuming the final amount is posted from the form
        $productIds = implode(",", array_keys($_SESSION['cart'])); // Assuming product IDs are stored in the cart session

        // Save the order details in the database
        $query = "INSERT INTO orders (order_id, username, total_amount, product_ids) 
                  VALUES ('$orderId', '$userId', '$totalAmount', '$productIds')";
        $result = mysqli_query($conn, $query);

        // If the order is successfully placed
        if ($result) {
            // Clear the cart
            unset($_SESSION['cart']);

            // Redirect to a confirmation page
            header("Location: confirmation.php?order_id=$orderId");
            exit;
        } else {
            // If there was an error while placing the order
            echo "Failed to place the order. Please try again.";
            echo mysqli_error($conn);
        }
    } else {
        // If the user is not logged in, redirect to the login page
        header("Location: login.php");
        exit;
    }
} else {
    // If the form is not submitted, redirect to the homepage
    header("Location: index.php");
    exit;
}
?>
