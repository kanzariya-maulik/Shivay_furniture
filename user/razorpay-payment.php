<?php
session_start();

// Include database connection
include_once('../dbconnection/connection.php');

// Check if order ID and payment ID are set and not empty in the GET data
if(isset($_GET['order_id']) && !empty($_GET['order_id']) && isset($_GET['payment_id']) && !empty($_GET['payment_id'])) {

    // Update the order status in the database
    $query = "UPDATE orders SET payment = 1 WHERE order_id = '{$_GET['order_id']}'";
    if(mysqli_query($conn, $query)) {
        // Order status updated successfully
        $paymentMessage = "Payment Done";
        $description = "Thank you for your payment. Your order has been successfully processed.";
    } else {
        // Error occurred while updating order status
        $paymentMessage = "Error: " . mysqli_error($conn);
        $description = "There was an error processing your payment. Please try again later.";
    }
} else {
    // If order ID or payment ID is not set or empty in the GET data
    $paymentMessage = "Missing order ID or payment ID.";
    $description = "We couldn't find the necessary details for processing your payment.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            font-size: 24px;
            color: green;
            margin-bottom: 20px;
        }

        .description {
            font-size: 18px;
            color: #333;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message"><?php echo $paymentMessage; ?></div>
        <div class="description"><?php echo $description; ?></div>
        <a href="offers.php" class="btn">See More Products</a> 
    </div>
</body>
</html>
