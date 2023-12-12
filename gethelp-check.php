<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Create a connection
    $conn = new mysqli("localhost", "unn_w21037098", "OMsai@123", "w21037098");
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs to prevent SQL injection
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $messages = mysqli_real_escape_string($conn, $_POST['messages']);
   

    // Insert data into the database
    $sql = "INSERT INTO gethelp (full_name, email, message)
            VALUES ('$fname', '$email', '$messages')";

    if ($conn->query($sql) !== TRUE) {
        echo "There is problem in form submission" . $conn->error;
    }

    // Close the connection
    $conn->close();
    header("Location: gethelp.php?success=Your Form is been Submitted. We will get back to you soon !");
    exit();
}
