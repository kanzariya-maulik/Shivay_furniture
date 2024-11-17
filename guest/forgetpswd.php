<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
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
        input[type="text"] {
            width: calc(100% - 22px); /* Adjusted width of the input field */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"], button[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #45a049;
        }
        #countdown {
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form action="../dbconnection/mail.php" method="post">
        <div style="color:red;">
        <?php 
        if(isset($_COOKIE['username_error'])){
             echo $_COOKIE['username_error'];
             setcookie("username_error", "", time() - 3600, "/");
            } 
        ?></div>
        
        <h2>Enter Username</h2>
        <input type="text" name="username" placeholder="Enter username" required>
        
        <button type="submit">Send OTP</button>
        <a href="login.php"><button type="button">Login</button></a>
    </form>
</body>
</html>
