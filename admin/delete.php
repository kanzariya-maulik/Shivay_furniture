<?php 

include_once("../dbconnection/connection.php");

$usname=$_GET['usname'];
echo $usname;   

$q="delete from user_info where username='".$usname."'";

echo $q;

if(mysqli_query($conn,$q)){
    echo "success";
    ?>
    <script>
        window.location.href="index.php";
        </script>
    <?php
}else{
    mysqli_error($conn);
}