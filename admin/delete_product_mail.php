<?php
include_once('../dbconnection/connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../dbconnection/PHPMailer-master/src/Exception.php';
require '../dbconnection/PHPMailer-master/src/PHPMailer.php';
require '../dbconnection/PHPMailer-master/src/SMTP.php';

// Function to send cancellation email
function sendCancellationEmail($username) {
    // Create a PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'shivayfurniture9@gmail.com';
        $mail->Password   = 'bnky aurf qusv fmjy'; // Consider using environment variables
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Email content
        $mail->setFrom('shivayfurniture9@gmail.com', 'Shivay furniture');
        $mail->addAddress($username, ""); // Assuming $username is the email address
        $mail->addReplyTo('shivayfurniture9@gmail.com', 'Information');
        $mail->addCC('shivayfurniture9@gmail.com');
        $mail->addBCC('shivayfurniture9@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'Order Cancellation';
        $mail->Body    = '<div>
            <!-- Your HTML content here -->
        </div>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // Send email
        $mail->send();

        return true; // Email sent successfully
    } catch (Exception $e) {
        // Handle exceptions
        return false; // Failed to send email
    }
}

if (isset($_GET['order_id'])) {
    // Prevent SQL injection
    $order_id = mysqli_real_escape_string($conn, $_GET['order_id']);

    // Query to retrieve the order details based on the order ID
    $query = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the order details
        $order = $result->fetch_assoc();
        $username = $order['username'];

        // Send cancellation email
        if (sendCancellationEmail($username)) {
            // If email sent successfully, proceed to delete the order from the database
            $delete_query = "DELETE FROM orders WHERE order_id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param("s", $order_id);
            $stmt->execute();

            // Redirect to orders.php after sending email and deleting order
            header("Location: orders.php");
            exit();
        } else {
            // Failed to send cancellation email
            echo "Failed to send cancellation email. Please try again later.";
        }
    } else {
        // Order not found
        echo "Order not found.";
    }
} else {
    // No order ID provided
    echo "Order ID not provided.";
}
?>
