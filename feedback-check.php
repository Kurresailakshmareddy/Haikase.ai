<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Create a connection
    $conn = new mysqli('localhost', 'haikase', 'haikase.AI@123.ai', 'haikase');
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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

    if ($conn->query($sql) !== TRUE) {
        echo "There is problem in form submission" . $conn->error;
    }

    // Close the connection
    $conn->close();
    header("Location: feedback_form.php?success=Form submitted successfully");
    exit();
}
