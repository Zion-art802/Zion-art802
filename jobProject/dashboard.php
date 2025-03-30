<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'job_seeker') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Seeker Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome, Job Seeker!</h1><p>HI</p>
    <a href="index.php">Home</a> | <a href="logout.php">Logout</a>
    <h2>Your Job Applications</h2>
    <?php
    $result = $conn->query("SELECT jobs.title FROM applications JOIN jobs ON applications.job_id = jobs.id WHERE applications.job_seeker_id = $user_id");
    while ($row = $result->fetch_assoc()) {
        echo "<p>{$row['title']}</p>";
    }
    ?>
</body>
</html>
