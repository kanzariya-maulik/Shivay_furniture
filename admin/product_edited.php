
<?php


include_once("../dbconnection/connection.php");
echo "updating";

$productid=$_GET['productid'];

if(isset($_POST['Update'])){
        $name = $_POST['name'];
        $searchkey = $_POST['searchkey'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        echo $price;
        
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
            
            $q = "UPDATE products SET imagname='{$file}',name='{$name}',description='{$desc}',price={$price} WHERE product_id='{$productid}'";
            
            if (mysqli_query($conn, $q)) {
                
                $uploadDirectory = '../img/products/';
                $targetPath = $uploadDirectory . basename($file);
                
                if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
                    echo "File moved successfully";
                    ?>
                    <script>
                        window.location.href="product_crud.php";
                    </script>
                    <?php
                } else {
                    echo "Failed to move file";
                }
            } else {
                echo "Database update failed".mysqli_error($conn);
            }
        }else {
            echo 'not selected';
        }
        
        }

        ?>