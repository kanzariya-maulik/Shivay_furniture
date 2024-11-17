<style>
    html{
        background-color: #000000;
        color:white;
    }
    h1{
        color:green;
    }
    h4{
        color:green;
    }
    table{
        border-top: 1px solid red;
        width: 100%;
        justify-content: center;
    }
    td{
        border-bottom: 1px solid white;
        width: 25%;
        justify-content: center;
    }
    th{
        border-bottom: 1px solid red;
        width: 25%;
        justify-content: center;
    }
    </style>
<?php

include_once("../dbconnection/connection.php");

$q="select * from user_dynamic where role='mainimg'";

if($result=mysqli_query($conn,$q)){
    while($row = mysqli_fetch_assoc($result)){
        $imgname=$row['imgname'];
        $name=$row['name'];
        $desc=$row['description'];
    }   
}

?>

<h1>User Panel</h1>

<h4>main image</h4>
<table>
    <tr>
    <th>Imgname</th>
    <th>Name</th>
    <th>Description</th>
    </tr>
    <tr>
        <td><image height='40%' width='40%' src="../img/<?php echo $imgname ?>" /></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $desc; ?></td>
    </tr>
</table>
<form action="mainimg_crud.php" enctype="multipart/form-data" method="POST">
    Change the image:
    <input type="file" name="img">
    Change the name:
    <input type="text" name="name" value="<?php echo $name; ?>">
    Change the description 
    <input type="text" name="desc" value="<?php echo $desc; ?>"><br>
    <input type="submit" name="up_btn" style="height:4%;width:4%;">
</form>

<?php

if(isset($_POST['up_btn'])){
    $name=$_POST['name'];
    $desc=$_POST['desc'];

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
        
        $q = "UPDATE user_dynamic SET imgname='{$file}',name='{$name}',description='{$desc}' WHERE role='mainimg'";
        
        if (mysqli_query($conn, $q)) {
            
            $uploadDirectory = '../img/';
            $targetPath = $uploadDirectory . basename($file);
            
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
                echo "File moved successfully";
                ?>
                <script>
                    window.location.href="user_mainimg_crud.php";
                </script>
                <?php
            } else {
                echo "Failed to move file";
            }
        } else {
            echo "Database update failed";
        }
    } else {
        $q = "UPDATE user_dynamic SET name='{$name}',description='{$desc}' WHERE role='mainimg';";
        echo $q;
        if(mysqli_query($conn,$q)) {
            echo "successfully updated user";
            ?>
            <script>
                window.location.href="user_mainimg_crud.php";
            </script>
            <?php
            }
    
    }
    } 