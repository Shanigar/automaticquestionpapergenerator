<?php
// Get the parameters from the AJAX call


// Perform the database update operation
// Replace the database credentials and update query with your own

// Example:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";


$facultyName = $_GET['facultyName'];
$subjectName = $_GET['subjectName'];
$subjectCode = $_GET['subjectCode'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(empty($facultyName)) {
    echo "Faculty name cannot be empty";
    exit;
}

// SQL to update faculty details
$sql = "UPDATE faculty_details SET subject_name='$subjectName', subject_code='$subjectCode' WHERE name='$facultyName' AND subject_name='$subjectName'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
