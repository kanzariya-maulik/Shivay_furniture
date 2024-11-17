<?php
include_once('../dbconnection/connection.php');

// Retrieve orders data from the database
$q = "SELECT * FROM orders";
if ($result = mysqli_query($conn, $q)) {
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to count the number of products in each order
function countProductsInOrder($product_ids)
{
    // Split the product_ids string into individual product IDs
    $product_ids_array = explode(',', $product_ids);

    // Count the number of product IDs
    return count($product_ids_array);
}

// Function to fetch product names based on product IDs
function getProductNames($product_ids, $conn)
{
    // Sanitize product IDs to prevent SQL injection
    $product_ids = mysqli_real_escape_string($conn, $product_ids);

    // Fetch product names from the database
    $query = "SELECT CONCAT(name, ' (', product_id, ')') AS product FROM products WHERE product_id IN ($product_ids)";
    $result = mysqli_query($conn, $query);

    // Store product names in an array
    $product_names = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $product_names[] = $row['product'];
    }

    // Return comma-separated product names
    return implode(', ', $product_names);
}

// Count the occurrence of each product ID
$product_counts = [];
foreach ($orders as $order) {
    $product_ids_array = explode(',', $order['product_ids']);
    foreach ($product_ids_array as $product_id) {
        if (array_key_exists($product_id, $product_counts)) {
            $product_counts[$product_id]++;
        } else {
            $product_counts[$product_id] = 1;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        body {
            background-color: #ffffff; /* white */
            color: #000000; /* black */
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2; /* light gray */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* light gray */
        }

        h1 {
            text-align: center;
            color: #000000; /* black */
            margin-top: 20px;
        }

        .summary {
            background-color: #d6e6f5; /* light blue */
        }

        .summary h3 {
            color: #000000; /* black */
        }

        .btn {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #008CBA; /* Blue */
        }

        .btn-delete {
            background-color: #f44336; /* Red */
        }

        .btn-placed {
            background-color: #ffa500; /* Orange */
        }
    </style>
</head>
<body>
<h1>Orders</h1>

<!-- Display orders information in a table -->
<table>
    <tr>
        <th>Order ID</th>
        <th>Username</th>
        <th>Total Amount</th>
        <th>Name(Product IDs)</th>
        <th>Number of Products</th>
        <th>Payment Status</th>
        <th>Placed</th> <!-- New column for Placed status -->
        <th>Actions</th>
    </tr>
    <?php foreach ($orders as $order) : ?>
        <tr>
            <td><?php echo $order['order_id']; ?></td>
            <td><?php echo $order['username']; ?></td>
            <td><?php echo $order['total_amount']; ?></td>
            <td><?php echo getProductNames($order['product_ids'], $conn); ?></td>
            <td><?php echo countProductsInOrder($order['product_ids']); ?></td>
            <td><?php echo $order['payment'] ? 'Paid' : 'Pending'; ?></td>
            <td><?php echo $order['placed'] == 1 ? 'Sent' : $order['placed']; ?></td> <!-- Display "Sent" if placed is 1 -->
            <td>
                <a href="edit_order.php?order_id=<?php echo $order['order_id']; ?>"><button
                            class="btn btn-edit">Edit</button></a>
                <a href="delete_product_mail.php?order_id=<?php echo $order['order_id']; ?>"><button
                            class="btn btn-delete">Delete</button></a>
                <?php if (!$order['placed']) : ?> <!-- Display Placed button if order is not placed -->
                    <a href="place_order.php?order_id=<?php echo $order['order_id']; ?>"><button
                                class="btn btn-placed">Place</button></a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <!-- Summary of ordered products -->
    <tr class="summary">
        <td colspan="8">
            <h3>Summary of Ordered Products</h3>
            <?php
            foreach ($product_counts as $product_id => $count) {
                echo "Product: $product_id - " . getProductNames($product_id, $conn) . ", Ordered $count times<br>";
            }
            ?>
        </td>
    </tr>
</table>
</body>
</html>
