<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Shopping Cart</title>
<style>
    .shopping-cart {
    width: 90%;
    margin: 20px auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

</style>
</head>
<body>
<div class="shopping-cart">
    <h2>Your Shopping Cart</h2>
    <?php 
    session_start(); // Start the session
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): 
    ?>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $product_id => $details) {
                $subtotal = $details['price'] * $details['quantity'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($details['name']); ?></td>
                <td><?php echo $details['quantity']; ?></td>
                <td>$<?php echo number_format($details['price'], 2); ?></td>
                <td>$<?php echo number_format($subtotal, 2); ?></td>
                <td><a href="remove_from_cart.php?product_id=<?php echo $product_id; ?>">Remove</a></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Total</td>
                <td>$<?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <?php else: ?>
    <p>Your cart is empty.</p>
    <?php endif; ?>
</div>
</body>
</html>
