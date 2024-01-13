<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


include('../includes/config.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Escape user inputs to prevent SQL injection
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $occpu = mysqli_real_escape_string($conn, $_POST['occpu']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $messages = mysqli_real_escape_string($conn, $_POST['messages']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    // Insert data into the database
    $sql = "INSERT INTO feedback (full_name, email, occupation, job_title, business_website, telephone, interest_prompt, may_contact)
            VALUES ('$fname', '$email', '$occpu', '$role', '$website', '$tel', '$messages', '$contact')";

    if ($conn->query($sql) === TRUE) {
        try {
            // Send email notification to the client
            $mailClient = new PHPMailer(true);
            $mailClient->isSMTP();
            $mailClient->Host = "smtp.gmail.com";
            $mailClient->Port = 465;
            $mailClient->SMTPSecure = "ssl";
            $mailClient->SMTPAuth = true;
            $mailClient->Username = "haikase7@gmail.com";
            $mailClient->Password = "mbdc cgej azwc vamd";
            $mailClient->setFrom("haikase7@gmail.com");
            $mailClient->addAddress("haikase7@gmail.com"); // Client's email address
            $mailClient->IsHTML(true);
            $mailClient->Subject = "New Member Notification";
            $mailClient->Body = "<p>You have received a new membership:</p>
            <p>Name: $fname</p>
            <p>Email: $email</p>
            <p>click here to view the form : <a href ='http://haikase.co.uk/login.php'>haikase.co.uk</a></p>";

            $mailClient->send();

            // Send email notification to the user
            $mailUser = new PHPMailer(true);
            $mailUser->isSMTP();
            $mailUser->Host = "smtp.gmail.com";
            $mailUser->Port = 465;
            $mailUser->SMTPSecure = "ssl";
            $mailUser->SMTPAuth = true;
            $mailUser->Username = "haikase7@gmail.com";
            $mailUser->Password = "mbdc cgej azwc vamd";
            $mailUser->setFrom("haikase7@gmail.com");
            $mailUser->addAddress($email); // User's email address from the form
            $mailUser->IsHTML(true);
            $mailUser->Subject = "Thank You for Showing Interest in Haikase.AI ";
            $mailUser->Body = "<p>Dear $fname,</p>
            <p>Thank you ! We'll get back to you as soon as possible.</p>";

            $mailUser->send();
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$e->getMessage()}";
        }
    } else {
        header("Location: ./sorry.php?error=There is problem in form submission😔") . $conn->error;
    }

    // if ($conn->query($sql) !== TRUE) {
    //     echo "There is problem in form submission" . $conn->error;
    // }

    // Close the connection
    $conn->close();
    header("Location: ./thanks.php?success=Form submitted successfully.Thank you for showing interest!");
    exit();
}
