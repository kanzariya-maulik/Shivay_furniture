<?php
include_once('../dbconnection/connection.php');

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $order_placed = isset($_POST['order_placed']) ? 1 : 0; // Check if checkbox is checked

    // Update order status in the database
    $query = "UPDATE orders SET placed = '$order_placed' WHERE order_id = '$order_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect to a success page or back to the order details page
        header("Location: orders.php");
        exit();
    } else {
        // Handle database error
        echo "Error updating order status: " . mysqli_error($conn);
    }
} else {
    // Handle if form is not submitted
    echo "Form data not submitted.";
}
?>
