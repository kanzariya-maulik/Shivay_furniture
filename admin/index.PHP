<?php

include_once('../dbconnection/connection.php');

$q="SELECT * FROM user_info where role='user';";
if ($result = mysqli_query($conn, $q)) {
  $data = array();
  while ($row = mysqli_fetch_array($result)) {
      $fname = $row['fname'];
      $lname = $row['lname'];
      $username = $row['username'];
      
      $item = array(
          'fname' => $fname,
          'lname' => $lname,
          'username' => $username
      );
      
      $data[] = $item;
  }
}

$num_rows = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
    <div class="wrapper">
    <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href=""></a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="admin_edit.php?username=<?php echo $_GET['username']; ?>" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../user/offers.php" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Manage Offers</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../guest/index.php" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Back to ...</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="../guest/login.php" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../guest/register.php" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li>
                
            <div class="sidebar-footer">
                <a href="../guest/index.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <form action="#" class="d-none d-sm-inline-block">
                </form>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded">

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-4" id="maindiv">
                <div class="container-fluid">
                <div class="row mb-4">
    <div class="col-md-6 mb-4">
        <div class="card border-0">
            <div class="card-body py-4">
                <h5 class="mb-2 fw-bold">
                    Manage Guest panel
                </h5>
                <a href="guest_crud.php?username=<?php echo $_GET['username']; ?>"><button class="sell_btn">Update Guest</button></a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card border-0">
            <div class="card-body py-4">
                <h5 class="mb-2 fw-bold">
                    Manage users panel
                </h5>
                <a href="user_crud.php?username=<?php echo $_GET['username']; ?>"><button class="sell_btn">Update User</button></a>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-6 mb-4">
        <div class="card border-0">
            <div class="card-body py-4">
                <h5 class="mb-2 fw-bold">
                    Products
                </h5>
                <a href="product_crud.php?username=<?php echo $_GET['username']; ?>"><button class="sell_btn">See Products</button></a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card border-0">
            <div class="card-body py-4">
                <h5 class="mb-2 fw-bold">
                    Manage Offers
                </h5>
                <a href="offer_management.php?username=<?php echo $_GET['username']; ?>"><button class="sell_btn">View Offers</button></a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 mb-4">
<div class="col-md-6 mb-4">
        <div class="card border-0">
            <div class="card-body py-4">
                <h5 class="mb-2 fw-bold">
                    Manage orders
                </h5>
                <a href="orders.php?username=<?php echo $_GET['username']; ?>"><button class="sell_btn">View Offers</button></a>
            </div>
        </div>
    </div>
</div>


                        <h3 class="fw-bold fs-4 my-3">Users details
                        </h3>
                        <div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr class="highlight">
                    <th scope="col">index</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email id</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <script>
    function confirmDelete(username) {
        if (confirm('Are you sure you want to delete this user?')) {
            window.location.href = 'delete.php?usname=' + username;
        }
    }
</script>

            <tbody>
                <?php 
                $count = 1;
                foreach ($data as $item) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $count . "</th>";
                    echo "<td>" . $item['fname'] . "</td>";
                    echo "<td>" . $item['lname'] . "</td>";
                    echo "<td>" . $item['username'] . "</td>";
                    echo "<td><button class=\"can_btn\" onclick=\"confirmDelete('$username')\">Delete</button></td>";

                    echo "<td><a href='edit.php?usname={$username}'><button class='edit_btn'>Edit</button></a></td>";
                    echo "</tr>";
                    $count++;
                }
                ?>
            </tbody>
        </table>
    <script>
        </script>
        <p>Total number of users: <?php echo $num_rows; ?></p>
    </div>
</div>
            </main>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-body-secondary">
                        <div class="col-6 text-start ">
                            <a class="text-body-secondary" href=" #">
                                <strong>shivay furnitures</strong>
                            </a>
                        </div>
                        <div class="col-6 text-end text-body-secondary d-none d-md-block">
                            Modern Interior <br> Design Studio
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</center>
</body>

</html>