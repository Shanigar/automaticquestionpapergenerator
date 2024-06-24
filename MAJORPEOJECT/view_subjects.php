<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

$user_email = $_SESSION['user_email'];

// Fetch faculty name and subject names and codes from the database based on the user's email
$faculty_name = '';
$subjects = [];
$query = "SELECT name, subject_code, subject_name FROM faculty WHERE email = '$user_email'";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        if (empty($faculty_name)) {
            $faculty_name = $row['name'];
        }
        $subjects[] = $row;
    }
} else {
    die('Query failed: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Subjects</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .user-info {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 18px;
        color: #000;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .subject-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .subject-table th, .subject-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .subject-table th {
        background-color: #4CAF50;
        color: white;
    }

    .subject-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .subject-table tr:hover {
        background-color: #ddd;
    }

    .subject-item {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .back-button {
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .back-button:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<div class="user-info">
    <?php echo htmlspecialchars($faculty_name); ?>
</div>

<div class="container">
    <h1>Subjects for <?php echo htmlspecialchars($user_email); ?></h1>

    <table class="subject-table">
        <thead>
            <tr>
                <th>Subject Code</th>
                <th>Subject Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($subjects)) {
                foreach ($subjects as $subject) {
                    echo "<tr><td>" . htmlspecialchars($subject['subject_code']) . "</td><td>" . htmlspecialchars($subject['subject_name']) . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No subjects found for this faculty member.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="faculty_dashboard.php" class="back-button">Back to Dashboard</a>
</div>

</body>
</html>
