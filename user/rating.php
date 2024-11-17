<?php
include_once("userheader.php");

$q = "SELECT DISTINCT * FROM user_ratings";

if ($result = mysqli_query($conn, $q)) {
    $ratings = array();
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name']; // Assuming there's a 'name' field in the user_rating table
        $description = $row['description']; // Assuming there's a 'description' field in the user_rating table
        $user_rating = $row['rating']; // Assuming there's a 'rate' field in the user_rating table
        $username = $row['username']; // Assuming there's a 'username' field in the user_rating table
        
        $ratings[] = array(
            'name' => $name,
            'description' => $description,
            'user_rating' => $user_rating,
            'username' => $username
        );
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $user_rating = $_POST['user_rating'];
    $username = $_COOKIE['username'];

    $check_query = "SELECT * FROM user_ratings WHERE name = '$name' AND username = '$username'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        
        $update_query = "UPDATE user_ratings SET description= '$description',rating = $user_rating WHERE name = '$name' AND username = '$username'";
        if (mysqli_query($conn, $update_query)) {
                ?>
                <script>
                    window.location.href="rating.php";
                    </script>
                <?php
        } else {
            echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
        }
    } else {
        // If the user hasn't rated the item yet, insert a new rating
        $insert_query = "INSERT INTO user_ratings (name, description, rating, username) VALUES ('$name', '$description', $user_rating, '$username')";
        if (mysqli_query($conn, $insert_query)) {
            ?>
                <script>
                    window.location.href="rating.php";
                    </script>
                <?php
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>
<style>
    .rating {
        background-color: white;
        color: black;
        padding: 20px;
    }
    .rating h1 {
        text-align: center;
    }
    .rating .container-fluid {
        display: flex;
        flex-wrap: wrap; /* Allow cards to wrap to the next row */
        justify-content: center;
    }
    .rating .card {
        width: calc(25% - 20px); /* Adjusted width to accommodate four cards per row */
        margin: 10px;
    }
    .rating .card-title {
        text-align: center;
    }
    .rating .card-text {
        padding: 0 15px;
    }
    .rating .fa-star {
        color: gold;
    }
    .rate-form {
        font-family: Arial, sans-serif;
        max-width: 400px;
        margin: 0 auto;
        margin-top: 20px;
    }
</style>

<div class="rating">
    <h1>Our Rating</h1>
    <div class="container-fluid">
        <?php 
        $count = 0; // Counter for the number of cards in a row
        foreach ($ratings as $rating): 
        ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $rating['name']; ?></h5>
                    <p class="card-text"><?php echo $rating['description']; ?></p>
                    <p class="card-text">
                        <?php for ($i = 0; $i < $rating['user_rating']; $i++): ?>
                            <i class="fa-solid fa-star"></i>
                        <?php endfor; ?>
                    </p>
                </div>
            </div>
            <?php 
            $count++; 
            // If four cards have been displayed, close the current row and start a new one
            if ($count % 4 == 0): ?>
                </div><div class="container-fluid">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>


<div class="rate-form">
    <h2 class="text-center">Rate Us</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin-bottom: 20px;">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="user_rating">Rating:</label>
            <select id="user_rating" name="user_rating" class="form-control" required>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit Rating</button>
    </form>
</div>
