<?php

include_once("../dbconnection/connection.php");
setcookie("username","",time()-100,"../");

?>
<!DOCTYPE html>
<html lang="en">
<head>
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
      <a class="navbar-brand" href="index.php"><h6 class="logo">shivay furniture</h6></a>
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
            <a class="nav-link" href="guestcart.php" style="color: whitesmoke;">
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
        </ul>
        <form class="d-flex" role="search" id="fr">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <li id="fr" class="nav-item">
          <a href="login.php">
          <button class="btn" style="margin:2px 0px" href="login.php">Login</button>
          </a>
              
          </li>
      </div>
    </div>
  </nav>
