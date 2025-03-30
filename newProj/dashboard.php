<?php
session_start();
require_once "db.php";
require_once "functions.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    redirect("login.php");
}

// Fetch user data
$user_id = $_SESSION["user_id"];
$sql = "SELECT firstname, lastname, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $email);
$stmt->fetch();
$stmt->close();

// Fetch available jobs
$jobSql = "SELECT id, title, location, salary FROM jobs";
$jobs = $conn->query($jobSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($firstname); ?>!</h2>
    <p>Email: <?php echo htmlspecialchars($email); ?></p>

    <h3>Available Jobs</h3>
    <ul>
        <?php while ($job = $jobs->fetch_assoc()) { ?>
            <li>
                <strong><?php echo htmlspecialchars($job['title']); ?></strong> - 
                <?php echo htmlspecialchars($job['location']); ?> | 
                Salary: $<?php echo number_format($job['salary'], 2); ?>
                <a href="apply.php?job_id=<?php echo $job['id']; ?>">Apply</a>
            </li>
        <?php } ?>
    </ul>

    <a href="logout.php" class="button">Logout</a>
</div>

</body>
</html>
