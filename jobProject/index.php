<?php
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Portal</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <h1>Welcome to the Job Portal</h1>
    <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php">Logout</a>
            <?php if ($_SESSION['role'] == 'employer'): ?>
                <a href="employer.php">Employer Dashboard</a>
            <?php else: ?>
                <a href="dashboard.php">Job Seeker Dashboard</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="login.php">Login</a> | <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
    <h2>Available Jobs</h2>
    <?php
    $result = $conn->query("SELECT * FROM jobs");
    while ($row = $result->fetch_assoc()) {
        echo "<div><h3>{$row['title']}</h3><p>{$row['description']}</p>
        <p>Location: {$row['location']}</p><p>Salary: {$row['salary']}</p>
        <a href='apply.php?job_id={$row['id']}'>Apply</a></div>";
    }
    ?>
</body>
</html>
