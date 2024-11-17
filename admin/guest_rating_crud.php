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
// Get the raw URL parameter
$raw_name = $_GET["name"];

// Check if the parameter contains special characters or integers
if (preg_match('/[^\w\s]/', $raw_name) || preg_match('/\d/', $raw_name)) {
    // Remove any % sign and single quotes from the parameter
    $clean_name = str_replace(['%', "'"], '', $raw_name);

    // Now you have a cleaned name without % and single quotes
    $name = $clean_name;
} else {
    // Use $_GET['name'] directly
    $name = urldecode($raw_name);
}

// Proceed with your database query or other operations using $name


$q="select * from guest where name='$name'";

if ($result = mysqli_query($conn, $q)) {
    while ($row = mysqli_fetch_array($result)) {
        $imgname = $row['imgname'];
        $desc = $row['description'];
        $rate = $row['rating'];
    }
  
  }
?>

<h1>Guest Panel</h1>

<h4>Rating</h4>
<table>
    <tr>
    <th>Imgname</th>
    <th>Name</th>
    <th>Description</th>
    <th>rate</th>
    </tr>
    <tr>
        <td><image height='40%' width='40%' src="../img/<?php echo $imgname ?>" /></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $desc; ?></td>
        <td><?php echo $rate; ?></td>
    </tr>
</table><br><br>
<form action="guest_rating_crud.php?name=<?php echo $name; ?>" enctype="multipart/form-data" method="POST">
    Change the image:
    <input type="file" name="img"><br><br>
    Change the rate:
    <input type="number" name="rate" max="5" value="<?php echo $rate; ?>"><br><br>
    Change the description :<br>
    <input type="text" name="desc" style="height:10rem;width:30rem;" value="<?php echo $desc; ?>"><br><br>
    <input type="submit" name="up_btn" style="height:4%;width:4%;">
</form>
<a href="guest_crud.php"> 
<input type="button" style="height:4%;" value="Guest Panel">
</a>

<?php
// https://chat.whatsapp.com/EWknOFkWL0W8lYoWKqQ24k
if(isset($_POST['up_btn'])){
    $desc=$_POST['desc'];
    $rate=$_POST['rate'];

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
        
        $q = "UPDATE guest SET imgname='{$file}',rate='{$rate}',description='{$desc}' WHERE name='$name'";
        
        if (mysqli_query($conn, $q)) {
            
            $uploadDirectory = '../img/';
            $targetPath = $uploadDirectory . basename($file);
            
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
                echo "File moved successfully";
                ?>
                <script>
                    window.location.href="guest_rating_crud.php?name='<?php echo $name; ?>'";
                </script>
                <?php
            } else {
                echo "Failed to move file";
            }
        } else {
            echo "Database update failed";
        }
    } else {
        $q = "UPDATE guest SET rate='{$rate}',description='{$desc}' WHERE name='$name';";
        echo $q;
        if(mysqli_query($conn,$q)) {
            echo "successfully updated user";
            ?>
            <script>
                window.location.href="guest_rating_crud.php?name='<?php echo $name; ?>'";
            </script>
            <?php
            }
    }
    } 