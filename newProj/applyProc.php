<?php
session_start();
require_once "db.php";
require_once "functions.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirect("apply.php");
}

// Get form data
$user_id = $_SESSION["user_id"];
$job_id = intval($_POST["job_id"]);
$cover_letter = sanitize($_POST["cover_letter"]);

// Validate input
if (empty($job_id) || empty($cover_letter)) {
    $_SESSION["error"] = "All fields are required!";
    redirect("apply.php?job_id=$job_id");
}

// Handle resume upload
if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] === 0) {
    $allowedTypes = ["pdf", "doc", "docx"];
    $fileExt = pathinfo($_FILES["resume"]["name"], PATHINFO_EXTENSION);

    if (!in_array($fileExt, $allowedTypes)) {
        $_SESSION["error"] = "Invalid file type. Upload a PDF, DOC, or DOCX.";
        redirect("apply.php?job_id=$job_id");
    }

    $resumePath = "uploads/" . time() . "_" . $_FILES["resume"]["name"];
    move_uploaded_file($_FILES["resume"]["tmp_name"], $resumePath);
} else {
    $_SESSION["error"] = "Resume upload failed.";
    redirect("apply.php?job_id=$job_id");
}

// Save application to database
$sql = "INSERT INTO applications (job_id, user_id, cover_letter, resume) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $job_id, $user_id, $cover_letter, $resumePath);

if ($stmt->execute()) {
    $_SESSION["success"] = "Application submitted successfully!";
} else {
    $_SESSION["error"] = "Error submitting application.";
}

redirect("dashboard.php");
?>
