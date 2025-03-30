<?php
ob_start(); // Start output buffering
require_once "db.php";

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function validate($field, $message) {
    if (empty($_POST[$field])) {
        $_SESSION['error'] = $message;
        return false;
    }
    return true;
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}
ob_end_flush(); // End output buffering
?>
