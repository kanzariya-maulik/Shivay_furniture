<?php
// Include the database connection file
include_once('../dbconnection/connection.php');

// Function to fetch product information based on product IDs
function getProductInfo($product_ids, $conn) {
    // Sanitize the input to prevent SQL injection
    $product_ids_array = explode(',', $product_ids);
    $product_info = array();

    // Loop through each product ID and fetch its information
    foreach ($product_ids_array as $product_id) {
        $product_id = mysqli_real_escape_string($conn, $product_id);
        $query = "SELECT * FROM products WHERE product_id = '$product_id'";
        $result = mysqli_query($conn, $query);

        // If the product is found, add its information to the product_info array
        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            $product_info[$product_id] = $product['name']; // Change this according to your product table structure
        } else {
            $product_info[$product_id] = 'Product Not Found'; // Or any default value
        }
    }

    return $product_info;
}

// Check if order_id is provided as a query parameter
if (isset($_GET['order_id'])) {
    // Sanitize the input to prevent SQL injection
    $order_id = mysqli_real_escape_string($conn, $_GET['order_id']);

    // Query to retrieve the order details based on the order ID
    $query = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the order details
        $order = mysqli_fetch_assoc($result);

        // Fetch product information using the getProductInfo function
        $product_info = getProductInfo($order['product_ids'], $conn);

        // Display the order details in a form for editing
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Order</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }

                form {
                    max-width: 500px;
                    margin: 0 auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                }

                h1 {
                    text-align: center;
                }

                label {
                    font-weight: bold;
                }

                input[type="text"],
                select {
                    width: 100%;
                    padding: 8px;
                    margin-top: 5px;
                    margin-bottom: 10px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                }

                select {
                    margin-bottom: 20px;
                }

                input[type="submit"] {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                }

                input[type="submit"]:hover {
                    background-color: #45a049;
                }

                .product-info {
                    margin-bottom: 10px;
                }
            </style>
        </head>
        <body>
            <h1>Edit Order <?php echo $order['order_id']; ?></h1>
            <form action="update_order.php" method="POST">
                <!-- Include form fields to edit the order details -->
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $order['username']; ?>"><br><br>

                <label for="total_amount">Total Amount:</label>
                <input type="text" id="total_amount" name="total_amount" value="<?php echo $order['total_amount']; ?>"><br><br>

                <?php
                // Loop through each product and display its information
                foreach ($product_info as $product_id => $product_name) {
                    // Display product name and total products
                    ?>
                    <div class="product-info">
                        <label>Product Name:</label>
                        <input type="text" value="<?php echo $product_name; ?>" readonly>
                    </div>
                    <div class="product-info">
                        <label>Total Products:</label>
                        <input type="text" value="<?php echo count(explode(',', $order['product_ids'])); ?>" readonly>
                    </div>
                    <?php
                }
                ?>

                <!-- Checkbox for order placed -->
                <div class="product-info">
                    <label for="order_placed">Order Placed:</label>
                    <input type="checkbox" id="order_placed" name="order_placed" value="1">
                </div>

                <!-- Hidden field to pass order_id to the update script -->
                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">

                <input type="submit" value="Update">
            </form>
        </body>
        </html>

        <?php
    } else {
        echo "Order not found.";
    }
} else {
    echo "Order ID not provided.";
}
?>
