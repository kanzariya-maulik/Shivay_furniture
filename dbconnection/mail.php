<?php
session_start();
include_once("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function sendOTP($username, $otp) {
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        // SMTP configuration
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
        $mail->Subject = 'OTP Confirmation';
        $mail->Body    = '<div style="background-color: #f0f8ff; padding: 20px; font-family: Arial, sans-serif;">
    <img src="https://tse1.mm.bing.net/th?id=OIP.eh5_VShejXlPowCONPTC_AHaHa&pid=Api&P=0&h=180" alt="Logo" style="display: block; margin: 0 auto 20px; height:10%;width:15%;">
    <h1 style="color: #333; text-align: center;">Shivay Furniture</h1>
    <h2 style="color: #333; text-align: center;">OTP Confirmation</h2>
    <div style="background-color: #ffffff; padding: 20px; border-radius: 10px;">
        <p style="color: #666; text-align: center;">Your One Time Password (OTP) is:</p>
        <p style="font-size: 24px; color: #000; text-align: center; padding: 10px; background-color: #f0f0f0; border-radius: 5px; margin-bottom: 20px;">'.$otp.'</p>
        <p style="color: #666; text-align: center;">Please use this OTP to complete your verification.</p>
    </div>
  </div>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // Send email
        $mail->send();

        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Failed to send email
    }
}

$usname = $_POST['username'];

// Prepare a SQL statement to select the username
$sql = "SELECT username FROM user_info WHERE username = '{$usname}'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {
    $otp = rand(100000, 999999);

    // Send OTP email
    if (sendOTP($usname, $otp)) {
        // Store OTP in session
        $_SESSION['otp'] = $otp;
        echo "the otp is ".$_SESSION['otp'];
        $_SESSION['otp_timestamp'] = time();
        echo "and the time is ".$_SESSION['otp_timestamp'];

        echo 'Message has been sent';
        ?>
        <script>
            window.location.href="takeotp.php?usname=<?php echo $usname; ?>";
            </script>
        <?php
    } else {
        echo "Failed to send OTP email. Please try again later.";
    }
} else {
    setcookie("username_error", "Username doesn't exist", time() + 10000, "/");
    ?>
    <script>
        window.location.href = "../guest/forgetpswd.php";
    </script>
    <?php
}
?>
