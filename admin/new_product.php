<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha284-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="path/to/fontawesome/css/all.min.css">
    <style>
    .rating {
        background-color:lightgray;
        color: black;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* subtle shadow effect */
    }

    .rating h1 {
        text-align: center;
        color: #333; /* dark gray for headings */
    }

    .rating .container-fluid {
        display: flex;
        justify-content: center;
    }

    .rating .card {
        width: 22rem;
        margin: 10px;
        border: none;
        background-color: #e0f7fa; /* light blue background for cards */
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1); /* subtle shadow effect */
    }

    .rating .card-title {
        text-align: center;
        color: #333; /* dark gray for titles */
    }

    .rating .card-text {
        padding: 0 15px;
        color: #555; /* medium gray for text */
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

    input[type="file"] {
        margin-bottom: 10px;
    }

    input[type="text"],
    textarea,
    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #333;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #555;
    }
</style>

</style>

<div class="rating">
    <h1>Add New Product</h1>
    <form action="new_product.php" enctype="multipart/form-data" method="POST">
    <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h3>choose image</h3>
                    <input type="file" name="img"><br>
                    <h3 class="card-title">Name:-<input type="text" name="name"/></h3>
                    <p class="card-text"><h3>Search Key:-</h3><input type="text" name="searchkey"/></p>
                    <p class="card-text"><h3>Description:-</h3><br><textarea name="desc" height="20" width="30"></textarea></p>
                    <p class="card-text"><h3>Price:-</h3><input type="number" name="price"></p>
                </div>
                <input type="submit" name="btn" value="Add">
            </div>
    </div>
    </form>
</div>
<?php 

include_once("../dbconnection/connection.php");

if(isset($_POST['btn'])){
$name = $_POST['name'];
$searchkey = $_POST['searchkey'];
$desc = $_POST['desc'];
$price = $_POST['price'];

$maxProductIdQuery = "SELECT MAX(product_id) AS max_product_id FROM products";
$maxProductIdResult = mysqli_query($conn, $maxProductIdQuery);

if ($maxProductIdResult) {
    $row = mysqli_fetch_assoc($maxProductIdResult);
    $maxProductId = $row['max_product_id'];
    
    $newProductId = $maxProductId + 1;
}

function isUploadedFileAnImage($inputName) {
    if (isset($_FILES[$inputName])) {
        $fileType = $_FILES[$inputName]['type'];
        $allowedMimeTypes = ['image/jpeg','image/jpg', 'image/png', 'image/gif', 'image/webp'];
        
        if (in_array($fileType, $allowedMimeTypes)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

if (isUploadedFileAnImage('img')) {
    $file = $_FILES['img']['name'];

    $q = "insert into products (imagname,name,searchkey,description,price,product_id) values('{$file}','{$name}','{$searchkey}','{$desc}','{$price}',{$newProductId})";
    
    if (mysqli_query($conn, $q)) {
        
        $uploadDirectory = '../img/products/';
        $targetPath = $uploadDirectory . basename($file);
        
        if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
            echo "File moved successfully";
            ?>
            <script>
                window.location.href="product_crud.php";
            </script>
            <?php
        } else {
            echo "Failed to move file";
        }
    } else {
        echo "Database update failed";
    }
}else {
    echo 'not selected';
}

}
?>