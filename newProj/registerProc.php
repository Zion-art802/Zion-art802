<?php
session_start();
require_once "functions.php";

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] !== "POST") {
    redirect("signup.php");
}

$firstname = sanitize($_POST['firstname']);
$lastname = sanitize($_POST['lastname']);
$email = sanitize($_POST['email']);
$password = $_POST['password'];

if (!validate("firstname", "First name required") || !validate("lastname", "Last name required") || !validate("email", "Email required") || !validate("password", "Password required")) {
    redirect("signup.php");
}

$hashedPassword = hashPassword($password);

$sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $firstname, $lastname, $email, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION["message"] = "Signup successful! Please login.";
    redirect("login.php");
} else {
    $_SESSION["error"] = "Email already exists!";
    redirect("signup.php");
}
?>
