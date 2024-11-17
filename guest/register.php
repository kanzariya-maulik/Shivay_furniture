<?php include_once("guestheader.php"); ?>

<style>
    body {
        background-color: #f0f0f0;
    }

    .registration-container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    }

    .registration-container h1 {
        color: #333333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .registration-container input[type="text"],
    .registration-container input[type="password"] {
        border-radius: 4px;
        padding: 10px;
        border: 1px solid #cccccc;
        width: 100%;
        margin-bottom: 15px;
    }

    .registration-container button[type="submit"] {
        background-color: #333333;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .registration-container button[type="submit"]:hover {
        background-color: #555555;
    }

    .registration-container a {
        color: #333333;
        text-decoration: none;
    }

    .registration-container a:hover {
        text-decoration: underline;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="registration-container">
            <h1 class="text-center">Registration</h1>
            <div>
            <?php
            if(isset($_GET['mali'])){
                $mali=$_GET['mali'];
                if($_GET['mali']){
                    echo "<div style='color:red;'>E-mail id is invalid please recheck your registration</div>";
                }
            }
            ?>
            </div>
            <form class="needs-validation" action="../dbconnection/registration.php" method="POST" novalidate>
                <div class="mb-2">
                    <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                </div>
                <div class="mb-2">
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="mb-2">
                    <div class="input-group has-validation">
                        <span class="input-group-text">@</span>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                </div>
                <div class="mb-2">
                    <input type="text" name="mobilenumber" class="form-control" placeholder="Mobile Number" required>
                </div>
                <div class="mb-2">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-2">
                    <input type="password" class="form-control" placeholder="Confirm Password" required>
                </div>
                <div class="mb-2 form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="index.php">Home</a>
            </div>
            <div class="text-center mt-3">
                <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>
</body>

</html>
