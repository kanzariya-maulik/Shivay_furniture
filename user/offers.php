<?php
include_once("userheader.php");

$q="SELECT * FROM products";
if ($result = mysqli_query($conn, $q)) {
    $data = array(); // Initialize an empty array to store the results
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            'id'=>$row['product_id'],
            'imgname' => $row['imagname'],
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price']
        );
    }
}
?>

<style>
    .shop {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .shop .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .shop .container .col {
        flex: 0 0 calc(33.33% - 20px);
        margin: 10px;
    }

    .card {
        width: 100%;
        height: 100%;
    }

    .card-img-top {
    width: 100%;
    height: 200px; /* Set your desired height */
    object-fit:container; /* Ensures the image covers the entire space without stretching */
}

</style>

<div class="shop">
    <div class="container">
        <?php foreach ($data as $item): ?>
            <div class="col">
                <div class="card">
                    <img src="../img/products/<?php echo $item['imgname']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['name']; ?></h5>
                        <p class="card-text"><?php echo $item['description']; ?></p>
                        <p class="card-text"><span class="org-price"><?php echo $item['price']; ?></span></p>
                        <a href="../user/add_to_cart.php?product_id=<?php echo $item['id']; ?>" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
