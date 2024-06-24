<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "user_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch subjects and corresponding faculty information based on department, year, and semester
$department = $_GET['department'];
$year = $_GET['year'];
$semester = $_GET['semester'];

$sql = "SELECT s.sub_name, s.sub_code, s.year, s.semester, f.name AS faculty_name 
        FROM Subject s 
        LEFT JOIN Faculty f ON s.sub_code = f.subject_code AND s.sub_name = f.subject_name
        WHERE s.department='$department' AND s.year=$year AND s.semester=$semester";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Faculty Name</th>
                </tr>
            </thead>
            <tbody>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["sub_name"] . "</td>
                <td>" . $row["sub_code"] . "</td>
                <td>" . $row["year"] . "</td>
                <td>" . $row["semester"] . "</td>
                <td>" . $row["faculty_name"] . "</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "0 results";
}
$conn->close();
?>
