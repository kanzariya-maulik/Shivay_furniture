<?php
include_once("guestheader.php");

$q="select imgname,name,description,rating from guest
where role='rating'";
if ($result = mysqli_query($conn, $q)) {
  $data = array(); // Initialize an empty array to store the results
  while ($row = mysqli_fetch_array($result)) {
      $imgname = $row['imgname'];
      $name = $row['name'];
      $description = $row['description'];
      $rate = $row['rating'];
      
      // Create an associative array for each row and add it to $data
      $item = array(
          'imgname' => $imgname,
          'name' => $name,
          'description' => $description,
          'rate' => $rate
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
}else{
  echo mysqli_error($conn);
}

?> 
<div class="rating"><br><br>
<center>
    <center><h1>Our Rating</h1></center><br>
    <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="../img/<?php echo $imgname_1; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $name_1; ?></h5>
                  <p class="card-text"><?php echo $description_1; ?></p>
                  <p class="card-text">
                  <?php 
                    for($i=0; $i<$rate_1; $i++){
                      echo "<i class='fa-solid fa-star'></i>"; 
                    }
                  ?>
                </p>
                </div>
              </div>


          </div>
          <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="../img/<?php echo $imgname_2; ?>" class="card-img-top" alt="..." height="230vh">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $name_2; ?></h5><br><br>
                  <p class="card-text"><?php echo $description_2; ?></p>
                  <p class="card-text">
                  <?php 
                    for($i=0; $i<$rate_2; $i++){
                      echo "<i class='fa-solid fa-star'></i>"; 
                    }
                  ?>
                </p>
                </div>
              </div>
          </div>
          <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="../img/<?php echo $imgname_3; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $name_3; ?></h5>
                  <p class="card-text"><?php echo $description_3; ?></p>
                  <p class="card-text">
                  <?php 
                    for($i=0; $i<$rate_3; $i++){
                      echo "<i class='fa-solid fa-star'></i>"; 
                    }
                  ?>
                </p>
                </div>
              </div>
          </div>
        </div>
      </div>
</div>


</center>
