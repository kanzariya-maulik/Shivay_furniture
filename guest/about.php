<?php
include_once("guestheader.php");

$q="select imgname,name,description from guest
where role='team'";
if ($result = mysqli_query($conn, $q)) {
  $data = array(); // Initialize an empty array to store the results
  while ($row = mysqli_fetch_array($result)) {
      $imgname = $row['imgname'];
      $name = $row['name'];
      $description = $row['description'];
      
      // Create an associative array for each row and add it to $data
      $item = array(
          'imgname' => $imgname,
          'name' => $name,
          'description' => $description,
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
echo "fetched";
}else{
  echo mysqli_error($conn);
}

?>
<style>
  body{
    background-color: lightpink;
  }
  </style>
<div class="about">
        <h1>Our team</h1>
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            
            <div class="carousel-inner">
              
              <div class="carousel-item active" data-bs-interval="2000">
                <img src="../img/ceo/<?php echo $imgname_1 ?>" class="d-block img-fluid m-10" alt="...">
                <div class="carousel-caption ">
                  <h5 class="ress"><?php echo $name_1 ?></h5>
                  <p class="ress"><?php echo $description_1 ?></p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="../img/ceo/<?php echo $imgname_2 ?>" class="d-block img-fluid m-10" alt="...">
                <div class="carousel-caption ">
                  <h5 class="ress"><?php echo $name_2 ?></h5>
                  <p class="ress"><?php echo $description_2 ?></p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="../img/ceo/<?php echo $imgname_3 ?>" class="d-block img-fluid m-10" alt="...">
                <div class="carousel-caption ">
                  <h5 class="ress"><?php echo $name_3 ?></h5>
                  <p class="ress"><?php echo $description_3 ?></p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

<?php
include_once("footer.php");
?>