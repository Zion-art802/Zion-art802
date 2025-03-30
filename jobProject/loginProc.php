<?php

require_once './db.php';



if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == "POST") {


    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    if (isset($_POST['email']) && $email != "") {

        $checkUser = checkUserExists($email);

        if (!$checkUser) {
            // The user not exists...


            echo "User not found";

        } else {
            // The user exists...

            // print_r($checkUser);

            $hashed_password = $checkUser['password'];

            // echo $hashed_password;

            $passwordVerify = password_verify($password, $hashed_password);

            if ($passwordVerify) {
                // The password is correct...

                $user = [
                    'id' => $checkUser['id'],
                    'fristname' => $checkUser['firstname'],
                    'lastname' => $checkUser['lastname'],
                    'email' => $checkUser['email'],
                    'date_created' => $checkUser['date_created']
                ];

                // print_r($user);

                session_start();
                $_SESSION['user'] = $user;

                // print_r($_SESSION);

                header("location: ./index.php");

            } else {
                // The password is incorrect...
                echo "Incorrect Password!";
            }
            
        }
        

    }}