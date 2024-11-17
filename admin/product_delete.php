
<?php
include_once("../dbconnection/connection.php");
?>
<script>

    let a=confirm("you want to delete this entery from store");
    if(a==false){
        window.location.href="product_crud.php";
    }
    </script>

<?php

$productid = $_GET['productid'];


$q="delete from products where product_id='{$productid}'";

if(mysqli_query($conn, $q)){
    ?>
    <script>
        alert("deleted successfully");
        window.location.href="product_crud.php";
    </script>
    <?php
}else{
    ?>
    <script>
        alert("<?php echo mysqli_error($conn); ?>");
        window.location.href="product_crud.php";
    </script>
    <?php
}