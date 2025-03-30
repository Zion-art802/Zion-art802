<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'job_seeker') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['resume'])) {
    $job_id = $_POST['job_id'];
    $job_seeker_id = $_SESSION['user_id'];
    $resume = "uploads/" . basename($_FILES['resume']['name']);
    move_uploaded_file($_FILES['resume']['tmp_name'], $resume);

    $sql = "INSERT INTO applications (job_id, job_seeker_id, resume) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $job_id, $job_seeker_id, $resume);
    $stmt->execute();
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="job_id" value="<?php echo $_GET['job_id']; ?>">
    <input type="file" name="resume" required>
    <button type="submit">Apply</button>
</form>
