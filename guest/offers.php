<?php

  include_once("guestheader.php");

$q="select imgname,name,description,price from guest
where role='product'";
if ($result = mysqli_query($conn, $q)) {
  $data = array(); // Initialize an empty array to store the results
  while ($row = mysqli_fetch_array($result)) {
      $imgname = $row['imgname'];
      $name = $row['name'];
      $description = $row['description'];
      $price = $row['price'];
      
      // Create an associative array for each row and add it to $data
      $item = array(
          'imgname' => $imgname,
          'name' => $name,
          'description' => $description,
          'price' => $price
      );
      
      // Add the associative array to the $data array
      $data[] = $item;
  }
  $count = 1; // Initialize a counter

foreach ($data as $item) {
    foreach ($item as $key => $value) {
        ${$key . '_' . $count} = $value;
    }
    $count++; 
}

}

?>
<style>
  body{
    background-color: black;
  }
  </style>
<div class="shop">
        <center>
                <h1>Offers</h1>
                <div class="container">
                    <div class="row">
                      <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="../img/products/<?php echo $imgname_1; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $name_1; ?></h5>
                              <p class="card-text"><?php echo $description_1; ?></p>
                              <p class="card-text"><span class="org-price"><?php echo $price_1; ?></span></p>
                              <a href="../guest/guestcart.php" class="btn btn-primary">Add to Cart</a>
                            </div>
                          </div>
                      </div>
                      <div class="col">
                        <div class="card" style="width: 18rem;" >
                            <img src="../img/products/<?php echo $imgname_2; ?>" class="card-img-top" alt="..." height="200vh">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $name_2; ?></h5>
                              <p class="card-text"> <?php echo $description_2; ?><br><br></p>
                              <p class="card-text"><span class="org-price"><?php echo $price_2; ?></p>
                              <a href="../guest/guestcart.php" class="btn btn-primary">Add To Cart</a>
                            </div>
                          </div>
                      </div>
                      <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="../img/products/<?php echo $imgname_3; ?>" class="card-img-top" alt="..." height="250vh">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $name_3; ?></h5>
                              <p class="card-text"><?php echo $description_3; ?></p>
                              <p class="card-text"><span class="org-price"><?php echo $price_3; ?></p>
                              <a href="../guest/guestcart.php" class="btn btn-primary">Add To Cart</a>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
          </center>
</div>