<?php
session_start();
include_once("connection.php");

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Check if passwords match
        if ($password == $confirm_password) {
            
            // Sanitize the input to prevent SQL injection
            $username = mysqli_real_escape_string($conn, $_GET['usname']);
            $password = mysqli_real_escape_string($conn, $password);
            
            $sql = "UPDATE user_info SET password = '$password' WHERE username = '$username'";
            if (mysqli_query($conn, $sql)) {
                // Password updated successfully
                echo "Password updated successfully.";
                ?>
                <script>
                    window.location.href="../guest/login.php";
                </script>
                <?php
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        } else {
            echo "Passwords do not match.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success - Update Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 400px; /* Set the width of the form */
        }
        input[type="password"] {
            width: calc(100% - 22px); /* Adjusted width of the input field */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="post">
        <h2>Update Password</h2>
        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Update Password</button>
    </form>
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
