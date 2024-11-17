<?php include_once("guestheader.php"); ?>

<style>
    body {
        background-color: #f0f0f0;
    }

    .login-container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    }

    .login-container h1 {
        color: #333333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        border-radius: 4px;
        padding: 10px;
        border: 1px solid #cccccc;
        width: 100%;
        margin-bottom: 15px;
    }

    .login-container button[type="submit"] {
        background-color: #333333;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .login-container button[type="submit"]:hover {
        background-color: #555555;
    }

    .login-container a {
        color: #333333;
        text-decoration: none;
    }

    .login-container a:hover {
        text-decoration: underline;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="login-container">
            <h1 class="text-center">Login</h1>
            <form action="../dbconnection/logincheck.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="text-center">
                    <button type="submit" name="btn" class="btn btn-dark">Login</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="forgetpswd.php">Forgot Password?</a>
            </div>
            <div class="text-center mt-3">
                <a href="register.php">Create an Account</a>
            </div>
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>
</body>
</html>
