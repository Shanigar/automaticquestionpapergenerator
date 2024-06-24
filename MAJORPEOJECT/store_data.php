<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["pdf"]["name"]);
    move_uploaded_file($_FILES["pdf"]["tmp_name"], $targetFile);

    // Store data in the database
    $examType = $_POST['examType'];
    $subjectName = $_POST['subjectName'];
    $subjectCode = $_POST['subjectCode'];

    // Your database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement to insert data into the appropriate table based on exam type
    switch ($examType) {
        case 'mid-1':
            $tableName = "mid1";
            break;
        case 'mid-2':
            $tableName = "mid2";
            break;
        case 'sem':
            $tableName = "sem";
            break;
        default:
            echo "Invalid exam type.";
            exit;
    }

    $sql = "INSERT INTO $tableName (exam_type, subject_name, subject_code, pdf_path) VALUES ('$examType', '$subjectName', '$subjectCode', '$targetFile')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["pdf"]["name"]);
    move_uploaded_file($_FILES["pdf"]["tmp_name"], $targetFile);

    // Store data in the database
    $examType = $_POST['examType'];
    $subjectName = $_POST['subjectName'];
    $subjectCode = $_POST['subjectCode'];

    // Your database connection code
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement to insert data into the appropriate table based on exam type
    switch ($examType) {
        case 'mid-1':
            $tableName = "mid1";
            break;
        case 'mid-2':
            $tableName = "mid2";
            break;
        case 'sem':
            $tableName = "sem";
            break;
        default:
            echo "Invalid exam type.";
            exit;
    }

    $sql = "INSERT INTO $tableName (exam_type, subject_name, subject_code, pdf_path) VALUES ('$examType', '$subjectName', '$subjectCode', '$targetFile')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
