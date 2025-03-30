<?php

session_start();

// session_destroy();
// print_r($_SESSION);

if (isset($_SESSION['user'])) {
    // echo "ok";

    header("location: ./index.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>LOGIN FORM</h1>

    <?php

    require_once "./loginProc.php";

    ?>

    <form action="" method="post">
        <input type="email" placeholder="Email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email']: "" ?>"><br>
        <input type="password" placeholder="Password" name="password"><br>
        <input type="reset" value="Reset">
        <input type="submit" value="Login" name="login"><br>
        Don't have an account? <a href="./register.php">Signup</a>
    </form>
</body>
</html>