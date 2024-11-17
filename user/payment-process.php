<?php
include_once("userheader.php");

// Include database connection
include_once('../dbconnection/connection.php');

// Initialize total amount
$total = 0;

// Initialize final amount
$finalAmount = 0;

// Initialize error message
$errorMsg = "";

// Check if $_SESSION['cart'] is set
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    // Calculate total amount
    foreach ($_SESSION['cart'] as $product_id => $details) {
        $subtotal = $details['price'] * $details['quantity'];
        $total += $subtotal;
    }
} else {
    // Set total amount to 0 or handle as needed
    $total = 0;
}

// Check if discount code is submitted  
if(isset($_POST['discount_code']) && !empty($_POST['discount_code'])) {
    $discountCode = $_POST['discount_code'];

    // Query to check if the discount code exists in the database
    $query = "SELECT * FROM offer WHERE RedeemCode = '$discountCode'";
    $result = mysqli_query($conn, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $discount = mysqli_fetch_assoc($result);
        $discountPercentage = $discount['DiscountValue']; // Assuming the discount value is in percentage

        // Calculate discount amount
        $discountAmount = ($total * $discountPercentage) / 100;

        // Apply the discount to the total amount
        $finalAmount = $total - $discountAmount;
    } else {
        // Handle invalid discount code
        $errorMsg = "Invalid discount code.";
    }
} else {
    // If no discount code entered, final amount is same as total
    $finalAmount = $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content -->
</head>
<body>
    <!-- Your body content -->
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($total > 0) {
                                    foreach ($_SESSION['cart'] as $product_id => $details) {
                                        $subtotal = $details['price'] * $details['quantity'];
                                ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="../img/products/<?php echo $details['imgname']; ?>" alt="Image" class="img-fluid" height="50vh" width="50vh">
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black"><?php echo htmlspecialchars($details['name']); ?></h2>
                                            </td>
                                            <td><?php echo $details['price']; ?></td>
                                            <td>
                                                <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                    </div>
                                                    <input type="text" class="form-control text-center quantity-amount" value="<?php echo $details['quantity']; ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                    <div class="input-group-append">
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $subtotal; ?></td>
                                            <td><a href="remove_from_cart.php?product_id=<?php echo $product_id; ?>" class="btn btn-black btn-sm">X</a></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="6">Your cart is empty.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td colspan="2">$<?php echo number_format($total, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form id="discount-form" method="POST">
                        <div class="form-group row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <input type="text" class="form-control" id="discount_code" name="discount_code" placeholder="Enter Coupon Code">
                                <?php if (!empty($errorMsg)) { ?>
                                    <div class="text-danger"><?php echo $errorMsg; ?></div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <button type="button" id="apply-discount-btn" class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </div>
                    </form><br>
                    <?php if ($total > 0 && isset($_POST['discount_code']) && !empty($_POST['discount_code']) && $discountAmount > 0) { ?>
                        <div>Total: $<?php echo number_format($total, 2); ?></div>
                        <div>Discount: -$<?php echo number_format($discountAmount, 2); ?> (<?php echo $discountPercentage; ?>% off)</div>
                        <div>Final Amount: $<?php echo number_format($finalAmount, 2); ?></div>
                    <?php } else { ?>
                        <div>Total: $<?php echo number_format($total, 2); ?></div>
                    <?php } ?>
                    <div class="col-md-12">
                        <form id="payment-form" action="payment-process.php" method="POST">
                            <input type="hidden" name="final_amount" id="final_amount" value="<?php echo $finalAmount; ?>">
                            <button type="submit" class="btn btn-primary">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary">
        <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
            <!-- Footer content -->
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            $("#apply-discount-btn").click(function() {
                $("#discount-form").submit();
            });

            $("#payment-form").submit(function(e) {
                e.preventDefault();
                var finalAmount = $("#final_amount").val();

                var options = {
                    "key": "rzp_test_zHhNFsppG7bIjH",
                    "amount": finalAmount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "name": "Shivay Furniture",
                    "description": "sf",
                    "image": "https://example.com/your_logo",
                    "handler": function(response) {
                        var paymentid = response.razorpay_payment_id;
                        // Set payment_id input value before form submission
                        $("#payment_id").val(paymentid);
                        $("#payment-form").unbind("submit").submit();
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
            });
        });
    </script>
</body>
</html>
