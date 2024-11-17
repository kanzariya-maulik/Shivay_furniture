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
<?php

$productid = $_GET['productid'];
echo $productid;

include_once("../dbconnection/connection.php");

$q="select imagname,name,searchkey,description,price from products where product_id ='{$productid}'";

if($result=mysqli_query($conn,$q)){
    while($row = mysqli_fetch_array($result)){
        $imgname=$row['imagname'];
        $name=$row['name'];
        $searchkey=$row['searchkey'];
        $desc=$row['description'];
        $price=$row['price'];
    }
}

?>

<div class="rating">
    <h1>Edit product</h1>
    <form action="product_edited.php?productid=<?php echo $productid ?>" enctype="multipart/form-data" method="POST">
    <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <img src="../img/products/<?php echo $imgname; ?>" height="200vh" width="200vw">
                    <h3>choose image</h3>
                    <input type="file" name="img"><br>
                    <h3 class="card-title">Name:-<input type="text" name="name" value="<?php echo $name ?>"/></h3>
                    <p class="card-text"><h3>Search Key:-</h3><input type="text" name="searchkey" value="<?php echo $searchkey ?>"/></p>
                    <p class="card-text"><h3>Description:-</h3><br><textarea name="desc" height="20" width="30" ><?php echo $desc ?></textarea></p>
                    <p class="card-text"><h3>Price:-</h3><input type="number" name="price" value="<?php echo $price; ?>"></p>
                </div>
                <input type="submit" name="Update" value="Update">
            </div>
    </div>
    </form>
</div>