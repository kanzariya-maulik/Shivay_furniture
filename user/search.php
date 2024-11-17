<?php
include_once("../dbconnection/connection.php");
include_once("userheader.php");

if(isset($_GET['query'])) {
    $search_query = $_GET['query'];

    // Perform the search operation in your database
    $q = "SELECT * FROM products WHERE searchkey LIKE '%$search_query%'";

    // Execute the query
    $result = mysqli_query($conn, $q);
    if(mysqli_num_rows($result) > 0) {
        echo '<div class="shop">';
        echo '<div class="container">';
        
        $count = 0; // Initialize a count variable
        echo '<div class="row">'; // Start a new row
        while($row = mysqli_fetch_array($result)) {
            // Extract information from the row
            $productName = $row['name'];
            $productPrice = $row['price'];
            $productImage = $row['imagname'];
            $productDescription = $row['description'];
    
            // Display the result
            echo '<div class="col-md-4">'; // Each card will occupy 4 columns on medium screens
            echo '<div class="card h-100 mb-4">'; // Add h-100 class to make all cards the same height
            echo "<img src='../img/products/$productImage' class='card-img-top' alt='$productName' style='width: 100%; height: auto;'>"; // Adjust image CSS
            echo '<div class="card-body d-flex flex-column">'; // Use flexbox to align content vertically
            echo "<h5 class='card-title'>$productName</h5>";
            echo "<p class='card-text'>Price: $productPrice</p>";
            echo "<p class='card-text'>$productDescription</p>"; // Add description
            echo "<a href='../user/add_to_cart.php?product_id={$row['product_id']}' class='btn btn-primary mt-auto'>Add to Cart</a>"; // Use mt-auto to push button to the bottom
            echo '</div>';
            echo '</div>';
            echo '</div>';
            
            $count++; // Increment the count
            // Close the current row and start a new row after every third card
            if ($count % 3 == 0) {
                echo '</div>'; // Close the current row
                echo '<div class="row">'; // Start a new row
            }
        }
        echo '</div>'; // Close the last row
        echo '</div>'; // Close container
        echo '</div>'; // Close shop container
    } else {
        echo "No results found.";
    }
    
    
}
?>
