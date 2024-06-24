<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $subjectCode = mysqli_real_escape_string($conn, $_POST['subjectCode']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $hashedPassword = md5($password);

    // Insert data into the database
    $sql = "INSERT INTO `faculty` (`name`, `email`, `department`, `subject_code`, `subject_name`, `phone_number`, `password`)
            VALUES ('$name', '$email', '$department', '$subjectCode', '$subject', '$phoneNumber', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
