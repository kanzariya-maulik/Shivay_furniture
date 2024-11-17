<?php
include_once("connection.php");

if(isset($_POST['btn'])){
$password=$_POST['password'];
$usname=$_POST['username'];
echo "clicked";

$q="select password,role from user_info
    where username= '".$usname."';";

    $result = mysqli_query($conn, $q);

    if (!$result) {
        echo "Error running query: " . mysqli_error($conn);
        exit;
    }
    
    $num_rows = mysqli_num_rows($result);
    
    if ($num_rows > 0) {
        while ($row = mysqli_fetch_array($result)){
            if($password==$row['password']){
                if($row['role']=='user'){
                    session_start();
                    $_SESSION['username'] = $usname;
                    echo "session created";
                ?>
                <script>
                        window.location.href="../user/index.php";
                </script>
                <?php
            }else{
                $_SESSION['username'] = $usname;
                ?>
                <script>
                    window.location.href="../admin/index.php?username="+"<?php echo $usname; ?>";
                    </script>
                <?php
            }
        }else{
            setcookie("error","password is incorrect",time()+100,"../");
            ?>
            <script>
                window.location.href="../guest/login.php";
                </script>
            <?php
        }
    }
} else {
    setcookie("error","username is incorrect",time()+100,"../");
    ?>
    <script>
        window.location.href="../guest/login.php";
        </script>
    <?php
    }
}