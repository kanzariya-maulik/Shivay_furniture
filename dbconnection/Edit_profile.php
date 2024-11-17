<?php

include_once("connection.php");
session_start();

$usname = $_SESSION['username'];

if (isset($_POST['upbtn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobilenum = $_POST['mobilenumber'];

    echo $fname." ".$lname." ".$mobilenum;


function isUploadedFileAnImage($inputName) {
    if (isset($_FILES[$inputName])) {
        $fileType = $_FILES[$inputName]['type'];
        $allowedMimeTypes = ['image/jpeg','image/jpg', 'image/png', 'image/gif', 'image/webp'];
        
        if (in_array($fileType, $allowedMimeTypes)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

if (isUploadedFileAnImage('img')) {
    $file = $_FILES['img']['name'];
    
    $q = "UPDATE user_info SET fname='{$fname}', lname='{$lname}', mobilenumber={$mobilenum}, imgname='{$file}' WHERE username='{$usname}'";
    
    if (mysqli_query($conn, $q)) {
        
        $uploadDirectory = 'userimg/';
        $targetPath = $uploadDirectory . basename($file);
        
        if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
            echo "File moved successfully";
            ?>
            <script>
                window.location.href="../user/Edit.php";
            </script>
            <?php
        } else {
            echo "Failed to move file";
        }
    } else {
        echo "Database update failed";
    }
} else {

    $q = "UPDATE user_info SET fname='{$fname}', lname='{$lname}', mobilenumber={$mobilenum} WHERE username='{$usname}'";

    if(mysqli_query($conn,$q)) {
            ?>
            <script>
                window.location.href="../user/Edit.php";
            </script>
            <?php
    }

}  
}  
?>