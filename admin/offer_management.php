<?php
// Include database connection
include_once('../dbconnection/connection.php');

// Fetch offers from the database
$q = "SELECT * FROM offer";
$result = mysqli_query($conn, $q);

// Check if any offers are found
if (!$result || mysqli_num_rows($result) == 0) {
    $offers = array(); // Empty array if no offers found
} else {
    // Fetch offers into an array
    $offers = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to delete an offer
function deleteOffer($offerID) {
    global $conn;
    $q = "DELETE FROM offer WHERE OfferID = '$offerID'";
    mysqli_query($conn, $q);
}

// Check if delete request is made
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $idToDelete = $_GET['id'];
    deleteOffer($idToDelete);
    // Redirect to refresh the page
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
    <title>Offer Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Offer Management</h2>
        <a href="add_offer.php" class="btn btn-primary my-3">Add New Offer</a>
        <a href="index.php?username=<?php echo $_GET['username']; ?>" class="btn btn-primary my-3">ADMIN</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Offer ID</th>
                    <th>Redeem Code</th>
                    <th>Discount Value</th>
                    <th>Max Usage</th>
                    <th>Is Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($offers as $offer): ?>
                <tr>
                    <td><?php echo $offer['OfferID']; ?></td>
                    <td><?php echo $offer['RedeemCode']; ?></td>
                    <td><?php echo $offer['DiscountValue']; ?></td>
                    <td><?php echo $offer['MaxUsage']; ?></td>
                    <td><?php echo $offer['IsActive']; ?></td>
                    <td>
                        <a href="edit_offer.php?id=<?php echo $offer['OfferID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="?delete=true&id=<?php echo $offer['OfferID']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
