<?php
session_start();
  include_once("../dbconnection/connection.php");

    $q="select imgname from user_info where username='{$_SESSION['username']}';";

    if($result=mysqli_query($conn,$q)){
      while($row = mysqli_fetch_array($result)){
        $imgname=$row['imgname'];
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <title>Shivay Furniture</title>
    <link rel="shortcut icon" href="../img/sofa.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="path/to/fontawesome/css/all.min.css">
</head>
<link rel="stylesheet" href="../style.css">
<script href="script.js"></script>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark" style="backgroundcolor: black;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html"><h6 class="logo">shivay furniture</h6></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown" style="display: flex;justify-content: space-between;">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php" style="color: whitesmoke;">
              <i class="fas fa-home"></i>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="offers.php" style="color: whitesmoke;">
              <i class="fas fa-gift"></i>
              offers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rating.php" style="color: whitesmoke;">
              <i class="fas fa-star"></i>
              Ratings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="usercart.php" style="color: whitesmoke;">
              <i class="fas fa-shopping-cart"></i>
              My cart
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php" style="color: whitesmoke;">
              <i class="fas fa-users"></i>
              About us
            </a>
          </li>
                    
                    
            </a>
                
              </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color: whitesmoke;">
              <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-user"></i>User profile</button>
              <div class="offcanvas offcanvas-end" style="background-color: black;" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
              <div class="offcanvas-header" style="justify-content: center;">
              <h2 id="offcanvasRightLabel">User</h2>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" style="color: white;">X</button>
              </div>
                  <div class="offcanvas-body" style="justify-content: center;">
                     <img src="../dbconnection/userimg/<?php echo $imgname; ?>" height="250vh" width="100%" /><br><br>
                     <h1 style="color: whitesmoke;">User Name :-
                     <?php 
                     echo $_SESSION["username"];
                     ?> 
                    </h1>
                     <center>
                    <a href="admin/index.php"> 
                      <button style="background-color: rgb(172, 219, 223);color: black;border-radius: 20%;" ><a style="text-decoration: none;color:black;" href="Edit.php?<?php  echo $_SESSION["username"]; ?>">Edit user profile</a></button>
                      
                     </a>
                     <button style="background-color: rgb(172, 219, 223);color: black;border-radius: 20%;" ><a style="text-decoration: none;color:black;" href="../guest/index.php">Log Out</a></button>
                    </center>
                    </div>
            </a>
            <div class="user-popup-container"> 
                
                    </div>
                
              </div>
          </li>
        </ul>
        <form class="d-flex" role="search" id="fr" action="search.php" method="GET"> <!-- Added action attribute -->
            <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      </div>
    </div>
  </nav>
