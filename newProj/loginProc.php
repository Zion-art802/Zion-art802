<?php
session_start();
require_once "functions.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirect("login.php");
}

$email = sanitize($_POST['email']);
$password = $_POST['password'];

$sql = "SELECT id, firstname, password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $firstname, $hashedPassword);
$stmt->fetch();

if ($stmt->num_rows > 0 && verifyPassword($password, $hashedPassword)) {
    $_SESSION["user_id"] = $id;
    $_SESSION["firstname"] = $firstname;
    redirect("dashboard.php");
} else {
    $_SESSION["error"] = "Invalid login credentials!";
    redirect("login.php");
}
?>
