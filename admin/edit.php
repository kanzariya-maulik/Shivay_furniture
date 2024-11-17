
<?php 
include_once("../dbconnection/connection.php");

    
if(isset($_COOKIE['up_usname'])){
    $usname=$_COOKIE['up_usname'];
}else{
    $usname=$_GET['usname'];
}

    setcookie("up_usname",$usname,time()+84200,"/");

$q="select * from user_info
    where username= '".$usname."';";

    $result = mysqli_query($conn, $q);

    if (!$result) {
        echo "Error running query: " . mysqli_error($conn);
        exit;
    }
    
    $num_rows = mysqli_num_rows($result);
    
    if ($num_rows > 0) {
        while ($row = mysqli_fetch_array($result)){
                $fname= $row['fname'];
                $lname= $row['lname'];
                $email= $row['username'];
                $mobilenum=$row['mobilenumber'];
                $imgname=$row['imgname'];
        }
    }

?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="path/to/fontawesome/css/all.min.css">
<style>
    body {
    background: linear-gradient(black,white);
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
    </style>
<form id="passwordForm" action="update.php" enctype="multipart/form-data" method="POST">
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="../dbconnection/userimg/<?php echo $imgname; ?>">
            <span class="font-weight-bold"><?php echo $fname." " ?><?php echo $lname ?></span>
            <span class="text-black-50"><?php echo $email ?></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="col-md-6">
    <label class="labels">Name</label>
    <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
    <small class="error-message" style="color: red;"></small>
</div>
<div class="col-md-6">
    <label class="labels">Surname</label>
    <input type="text" class="form-control" name="lname" value="<?php echo $lname ?>">
    <small class="error-message" style="color: red;"></small>
</div>

<div class="col-md-12">
    <label class="labels">Mobile Number</label>
    <input type="text" class="form-control" name="mobilenumber" value="<?php echo $mobilenum; ?>">
    <small class="error-message" style="color: red;"></small>
            </div><h6>Change profile picture</h6>
            <input type="file" name="img">

            <h6><a href="../dbconnection/mail.php">Change password</a></h6>

            <div class="mt-5 text-center"><input class="btn btn-primary profile-button" name="upbtn" type="submit" value="Save Profile" /></div>
            <div class="mt-5 text-center"><a href="index.php"><input class="btn btn-primary profile-button" name="btn" type="button" value="Admin panel" /></a></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>