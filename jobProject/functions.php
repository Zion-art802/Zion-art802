<?php

// require "db.php";



function string_verify($str){
    global $conn;

    $str = htmlspecialchars($str);

    $str = stripcslashes($str);

    return mysqli_real_escape_string($conn, $str);
}



function checkUserExists($email){
    global $conn;

    $sql = "SELECT * FROM `users` WHERE email = '$email' LIMIT 1";

    $query = mysqli_query($conn, $sql);

    if($query){

        if (mysqli_num_rows($query) > 0) {
            // User exists

            $user = mysqli_fetch_array($query, MYSQLI_ASSOC);

            return $user;

        }else{
            // User not exists

            return false;
        }

    }
}