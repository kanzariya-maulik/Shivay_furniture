<?php

include_once("../dbconnection/connection.php");

$usname = $_COOKIE['up_usname'];

echo $usname;
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
        
        $uploadDirectory = '../dbconnection/userimg/';
        $targetPath = $uploadDirectory . basename($file);
        
        if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
            echo "File moved successfully";
            setcookie('up_usname',$usname,time()+84200,"/");
            ?>
            <script>
                window.location.href="edit.php";
            </script>
            <?php
        } else {
            echo "Failed to move file";
        }
    } else {
        echo "Database update failed";
    }
} else {
    $q = "UPDATE user_info SET fname='{$fname}', lname='{$lname}',mobilenumber={$mobilenum} WHERE username='{$usname}'";
    if(mysqli_query($conn,$q)) {
        echo "successfully updated user";
        setcookie('up_usname',$usname,time()+84200,"/");
        ?>
        <script>
            window.location.href="edit.php";
        </script>
        <?php
        }

}
}    
?>