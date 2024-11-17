<?php
// Include database connection
include_once('../dbconnection/connection.php');

// Check if offer ID is provided in the URL
if(isset($_GET['id'])) {
    $offerID = $_GET['id'];
    
    // Fetch offer details from the database based on the offer ID
    $query = "SELECT * FROM offer WHERE OfferID = '$offerID'";
    $result = mysqli_query($conn, $query);
    
    if($result && mysqli_num_rows($result) > 0) {
        $offer = mysqli_fetch_assoc($result);
    } else {
        echo "Offer not found.";
        exit();
    }
} else {
    echo "Offer ID not provided.";
    exit();
}

// Function to update offer details
function updateOffer($offerID, $discountValue, $maxUsage, $isActive) {
    global $conn;
    $query = "UPDATE offer SET DiscountValue = '$discountValue', MaxUsage = '$maxUsage', IsActive = '$isActive' WHERE OfferID = '$offerID'";
    mysqli_query($conn, $query);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $discountValue = $_POST['discount_value'];
    $maxUsage = $_POST['max_usage'];
    $isActive = isset($_POST['is_active']) ? 1 : 0; // Check if active checkbox is checked

    // Update the offer details
    updateOffer($offerID, $discountValue, $maxUsage, $isActive);

    // Redirect back to offer management page or any other appropriate page
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
    <title>Edit Offer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Offer</h2>
        <form method="POST">
        <div class="mb-3">
                <label for="discount_value" class="form-label">Redeem Code</label>
                <h2><?php echo $offer['RedeemCode']; ?></h2>
            </div>
            <div class="mb-3">
                <label for="discount_value" class="form-label">Discount Value</label>
                <input type="number" class="form-control" id="discount_value" name="discount_value" value="<?php echo $offer['DiscountValue']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="max_usage" class="form-label">Max Usage</label>
                <input type="number" class="form-control" id="max_usage" name="max_usage" value="<?php echo $offer['MaxUsage']; ?>" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?php if($offer['IsActive']) echo "checked"; ?>>
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Update Offer</button>
        </form>
    </div>
</body>
</html>
