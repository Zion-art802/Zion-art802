<?php
session_start();
require_once "db.php";
require_once "functions.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    redirect("login.php");
}

$user_id = $_SESSION["user_id"];

// Get job details (if user clicked apply from dashboard)
$job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;
$jobSql = "SELECT id, title FROM jobs WHERE id = ?";
$stmt = $conn->prepare($jobSql);
$stmt->bind_param("i", $job_id);
$stmt->execute();
$stmt->bind_result($job_id, $job_title);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply for a Job</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Apply for a Job</h2>

    <?php if (isset($_SESSION['error'])) { echo "<p class='error'>{$_SESSION['error']}</p>"; unset($_SESSION['error']); } ?>
    <?php if (isset($_SESSION['success'])) { echo "<p class='success'>{$_SESSION['success']}</p>"; unset($_SESSION['success']); } ?>

    <form action="applyProc.php" method="POST" enctype="multipart/form-data">
        <label>Job Title:</label>
        <input type="text" value="<?php echo htmlspecialchars($job_title); ?>" disabled>
        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">

        <label>Cover Letter:</label>
        <textarea name="cover_letter" placeholder="Write a brief cover letter" required></textarea>

        <label>Upload Resume:</label>
        <input type="file" name="resume" accept=".pdf,.doc,.docx" required>

        <button type="submit">Submit Application</button>
    </form>
</div>

</body>
</html>
