<?php
// Include database connection
include_once('../dbconnection/connection.php');

// Function to add a new offer
function addOffer($redeemCode, $discountValue, $maxUsage, $isActive) {
    global $conn;
    // Prepare the SQL statement
    $q = "INSERT INTO offer (RedeemCode, DiscountValue, MaxUsage, IsActive) VALUES ('$redeemCode', '$discountValue', '$maxUsage', '$isActive')";
    // Execute the SQL statement
    if(mysqli_query($conn, $q)){
        echo "runeed";
    }else{
        echo mysqli_error($conn);
    }
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $redeemCode = $_POST['redeem_code'];
    $discountValue = $_POST['discount_value'];
    $maxUsage = $_POST['max_usage'];
    $isActive = isset($_POST['is_active']) ? 1 : 0; // Check if active checkbox is checked

    // Add the new offer
    addOffer($redeemCode, $discountValue, $maxUsage, $isActive);

    // Redirect to offer management page
    header("Location: offer_management.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Offer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Function to show or hide error messages
        function toggleError(elementId, errorMessage, show) {
            var errorElement = document.getElementById(elementId);
            errorElement.textContent = errorMessage;
            errorElement.style.display = show ? 'block' : 'none';
        }

        // Function to validate redeem code format
        function validateRedeemCode(inputValue) {
            var redeemCodeRegex = /^[A-Z0-9]+$/;
            return redeemCodeRegex.test(inputValue);
        }

        // Function to check if redeem code is unique
        function isRedeemCodeUnique(inputValue) {
            // You may implement AJAX call here to check uniqueness on the server side
            return true; // For demonstration purposes, always return true
        }

        // Function to handle form submission
        function handleSubmit() {
            var redeemCodeInput = document.getElementById('redeem_code');
            var redeemCodeError = document.getElementById('redeem_code_error');
            var redeemCodeValue = redeemCodeInput.value.trim();

            // Reset error message
            toggleError('redeem_code_error', '', false);

            // Validate redeem code format
            if (!validateRedeemCode(redeemCodeValue)) {
                toggleError('redeem_code_error', 'Redeem code must contain only capital letters and numbers.', true);
                return false;
            }

            // Check redeem code uniqueness
            if (!isRedeemCodeUnique(redeemCodeValue)) {
                toggleError('redeem_code_error', 'Redeem code already exists. Please choose a different one.', true);
                return false;
            }

            return true; // Allow form submission
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Offer</h2>
        <form method="POST" onsubmit="return handleSubmit()">
            <div class="mb-3">
                <label for="redeem_code" class="form-label">Redeem Code</label>
                <input type="text" class="form-control" id="redeem_code" name="redeem_code" pattern="[A-Z0-9]+" title="Redeem code must contain only capital letters and numbers." required>
                <span id="redeem_code_error" class="text-danger" style="display: none;"></span>
            </div>
            <div class="mb-3">
                <label for="discount_value" class="form-label">Discount Value</label>
                <input type="number" class="form-control" id="discount_value" name="discount_value" required>
            </div>
            <div class="mb-3">
                <label for="max_usage" class="form-label">Max Usage</label>
                <input type="number" class="form-control" id="max_usage" name="max_usage" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Add Offer</button>
        </form>
    </div>
</body>
</html>
