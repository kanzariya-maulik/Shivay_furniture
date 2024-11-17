<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: #dc3545;
            margin-bottom: 10px;
        }
        .success {
            color: #28a745;
            margin-bottom: 10px;
        }
    </style>

<h2>Change Password</h2>
        <form action="changepswd.php" method="POST">
        <label for="old_password">Old Password:</label><br>
        <input type="password" id="old_password" name="old_password" required><br><br>
        
        <label for="new_password">New Password:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        <input type="submit" value="Change Password">
        </form>

        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("../dbconnection/connection.php");
    session_start();
    $usname=$_SESSION['username'];

    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    
    $query = "SELECT password FROM user_info WHERE username ='{$usname}';";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row["password"];
    
    if ($old_password == $stored_password) {
        if ($new_password == $confirm_password) {
            $update_query = "UPDATE user_info SET password = '$new_password' WHERE username = '$usname';";
            mysqli_query($conn, $update_query);
            echo "Password updated successfully.";
            ?>
            <script>
                window.location.href="Edit.php";
                </script>
            <?php
        } else {
            echo "<h4 style='color:red'>New password and confirm password do not match.</h4>";
        }
    } else {
        echo "<h4 style='color:red'>Old password is incorrect.</h4>";
    }
}
?>
