<?php
session_start();
include_once("connection.php");
$username=$_SESSION['username'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'shivayfurniture9@gmail.com';
        $mail->Password   = 'bnky aurf qusv fmjy';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('shivayfurniture9@gmail.com', 'Shivay furniture');
        $mail->addAddress($username, ""); // Assuming $username is the email address
        $mail->addReplyTo('shivayfurniture9@gmail.com', 'Information');
        $mail->addCC('shivayfurniture9@gmail.com');
        $mail->addBCC('shivayfurniture9@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Account Conformation';
        $mail->Body    = '<div style="background-color: #f0f8ff; padding: 20px; font-family: Arial, sans-serif;">
    <img src="https://tse1.mm.bing.net/th?id=OIP.eh5_VShejXlPowCONPTC_AHaHa&pid=Api&P=0&h=180" alt="Logo" style="display: block; margin: 0 auto 20px; height:10%;width:15%;">
    <h1 style="color: #333; text-align: center;">Shivay Furniture</h1>
    <p><b>Congratulations ! </b><br>your account created succesfully click link to see todays offer</p>
    <a href="http://localhost/SHIVAY%20furniture/guest/login.php"><h2>See Offers</h2></a>
    ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // Send email
        $mail->send();
        ?>
        <script>
            window.location.href="../guest/login.php";
            </script>
        <?php
// Email sent successfully
    } catch (Exception $e) {
        $q="delete from user_info where username='{$username}'";
        if(mysqli_query($conn,$q)){
         
        ?>
        <script>
            window.location.href="../guest/register.php?mali=false";
            </script>
        <?php   
        }
        else{
            echo "error in fetching details";
        }
    }