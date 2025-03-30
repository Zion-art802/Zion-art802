<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employer') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $employer_id = $_SESSION['user_id'];

    $sql = "INSERT INTO jobs (employer_id, title, description, location, salary) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $employer_id, $title, $description, $location, $salary);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employer Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Employer Dashboard</h1>
    <a href="index.php">Home</a> | <a href="logout.php">Logout</a>
    <h2>Post a Job</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Job Title" required><br>
        <textarea name="description" placeholder="Job Description" required></textarea><br>
        <input type="text" name="location" placeholder="Location" required><br>
        <input type="text" name="salary" placeholder="Salary" required><br>
        <button type="submit">Post Job</button>
    </form>
</body>
</html>
