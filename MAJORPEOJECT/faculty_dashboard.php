<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}
$user_email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faculty Dashboard</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
    }

    .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #e6c7e5;
        padding-top: 20px;
    }

    .sidebar header {
        color: #fff;
        font-size: 22px;
        text-align: center;
        padding-bottom: 20px;
        position: relative;
        border-bottom: 2px solid #fff;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }

    .sidebar li {
        padding: 10px 20px;
    }

    .sidebar a {
        text-decoration: none;
        color: #fff;
        font-size: 18px;
    }

    .sidebar a:hover {
        background-color: #8b099c;
    }

    .content {
        margin-left: 250px;
        padding: 20px;
    }

    .tabcontent {
        display: none;
    }

    .user-email {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 18px;
        color: #000;
    }

</style>
</head>
<body>

<div class="sidebar">
    <header>Faculty Dashboard</header>
    <ul>
        <li><a href="view_subjects.php">View subjects</a></li>
        <li><a href="select_set_type.html">Create Paper</a></li>
        <li><a href="change_password.php">Change password</a></li>
        <li><a href="faculty_logout.php" onclick="logout()">Logout</a></li>
    </ul>
</div>

<div class="content">
    <div class="user-email">
        <?php echo htmlspecialchars($user_email); ?>
    </div>
    <div id="profile" class="tabcontent">
        <h2>Profile</h2>
        <!-- Profile content here -->
    </div>

    <div id="addCourses" class="tabcontent">
        <h2>Add Courses</h2>
        <!-- Add Courses content here -->
    </div>

    <div id="addFaculty" class="tabcontent">
        <h2>Add Faculty</h2>
        <!-- Add Faculty content here -->
    </div>
</div>

<script>
    function openTab(tabName) {
        var i, tabcontent;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        document.getElementById(tabName).style.display = "block";
    }

    function logout() {
        // Add your logout logic here, for example, redirect to the logout page
        alert("Logging out...");
    }
</script>
</body>
</html>
