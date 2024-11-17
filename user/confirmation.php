<?php
session_start();

// Include database connection
include_once('../dbconnection/connection.php');

// Check if the order ID is set in the URL
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Retrieve order details from the database
    $query = "SELECT * FROM orders WHERE order_id = '$orderId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
    } else {
        // If no order found with the provided ID
        echo "Invalid order ID.";
        exit;
    }
} else {
    // If order ID is not set in the URL
    echo "Order ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Add your CSS links here -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .confirmation-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    <div class="confirmation-container">
        <h1>Order Confirmation</h1>
        <p>Thank you for your order! Your order details are as follows:</p>
        <p><strong>Order ID:</strong> <?php echo $order['order_id']; ?></p>
        <p><strong>Total Amount:</strong> $<?php echo number_format($order['total_amount'], 2); ?></p>
        <p><strong>Product IDs:</strong> <?php echo $order['product_ids']; ?></p>
        <!-- Add any additional order details you want to display here -->

        <form action="razorpay-payment.php" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
            <input type="hidden" name="total_amount" value="<?php echo $order['total_amount']; ?>">
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <button class="btn" id="rzp-button">Pay Now</button>
        </form>

        <a href="offers.php"><button class="btn">Cash on Delivery</button></a>
    </div>

    <script>
        var orderId = "<?php echo $orderId; ?>";
        var totalAmount = "<?php echo $order['total_amount']; ?>";

        var options = {
            "key": "rzp_test_zHhNFsppG7bIjH",
            "amount": totalAmount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "name": "Shivay Furniture",
            "description": "sf",
            "image": "https://example.com/your_logo",
            "handler": function (response) {
    // Redirect to razorpay-payment.php with encoded order ID and payment ID
    var encodedOrderId = encodeURIComponent(orderId);
    var encodedPaymentId = encodeURIComponent(response.razorpay_payment_id);
    window.location.href = "razorpay-payment.php?order_id=" + encodedOrderId + "&payment_id=" + encodedPaymentId;
},

            "prefill": {
                "name": "", // Prefill customer name if available
                "email": "<?php echo $order['username']; ?>" // Prefill customer email if available
            },
            "theme": {
                "color": "#007bff"
            }
        };

        var rzpButton = document.getElementById('rzp-button');
        rzpButton.onclick = function(e) {
            var rzp = new Razorpay(options);
            rzp.open();
            e.preventDefault();
        };
    </script>
</body>
</html>