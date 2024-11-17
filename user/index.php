<?php

include_once("userheader.php");

$q="select imgname from user_dynamic where role='mainimg';";

if($result=mysqli_query($conn,$q)){
    while($row=mysqli_fetch_array($result)){
      $imgname=$row['imgname'];
    }
}
?>
<style>
.main{
    background: linear-gradient(360deg,rgb(00,00,00),rgb(172, 219, 223),rgb(150, 200, 200),rgb(150, 170, 170));
}
.rating{
  background: linear-gradient(rgb(00,00,00),rgb(255,255,255));
}
.about{
  background: linear-gradient(white,pink,lightpink,white);
}
footer{
  background:linear-gradient(white,black) ;
}
</style>
<div class="main">
        <div class="container">
            <div class="row">
                <div class="contantmain">
                  <center>
              <div class="col-5"><br><br><h1>Modern Interior <br> Design Studio</h1><br><br><p>large objects such as tables, chairs, or beds that are used in a room for sitting or lying on or for putting things on or in</p></div>
              <a href="offers.php"><button class="btn">SEE MORE</button></a></div>
            </center>
              <div class="col-6"><div class="innerimg"><img src="../img/<?php echo $imgname; ?>" class="img-fluid"><img src="../img/cjjjj.png" id="res" class="img-fluid"></div>
            </div>
            </div>
        </div>
      </div>
      <?php
      include_once("offers.php");
      ?>
      <?php 
      include_once("rating.php");
      ?>
      <?php
      include_once("about.php");
      ?>
      <?php
      include_once("footer.php");
      ?>
</body>
</html>