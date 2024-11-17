<style>
        html {
            background-color: #000000; /* black background */
            color: white; /* white text */
        }

        h1, h2 {
            color: green; /* green headings */
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto; /* center the table */
        }

        th, td {
            border-bottom: 1px solid red; /* red bottom border for table cells */
            padding: 10px;
            text-align: center;
        }

        th {
            border-bottom: 2px solid red; /* thicker bottom border for table headers */
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .edit_btn {
            background-color: #333; /* dark gray button background */
            color: white; /* white text */
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .edit_btn:hover {
            background-color: #555; /* slightly lighter gray on hover */
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
    }
  
  }
?>

<h1>Guest Panel</h1>

<h4>Team</h4>
<table>
    <tr>
    <th>Imgname</th>
    <th>Name</th>
    <th>Description</th>
    </tr>
    <tr>
        <td><image height='40%' width='40%' src="../img/ceo/<?php echo $imgname ?>" /></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $desc; ?></td>
    </tr>
</table><br><br>
<form action="guest_team_crud.php?name=<?php echo $name; ?>" enctype="multipart/form-data" method="POST">
    Change the image:
    <input type="file" name="img"><br><br>
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
        
        $q = "UPDATE guest SET imgname='{$file}',description='{$desc}' WHERE name='$name'";
        
        if (mysqli_query($conn, $q)) {
            
            $uploadDirectory = '../img/ceo/';
            $targetPath = $uploadDirectory . basename($file);
            
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
                echo "File moved successfully";
                ?>
                <script>
                    window.location.href="guest_team_crud.php?name='<?php echo $name; ?>'";
                </script>
                <?php
            } else {
                echo "Failed to move file";
            }
        } else {
            echo "Database update failed";
        }
    } else {
        $q = "UPDATE guest SET description='{$desc}' WHERE name='$name';";
        echo $q;
        if(mysqli_query($conn,$q)) {
            echo "successfully updated user";
            ?>
            <script>
                window.location.href="guest_team_crud.php?name='<?php echo $name; ?>'";
            </script>
            <?php
            }
    }
    } 