<?php


require "db.php";



if (isset($_POST['signup']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    // $error = 0;

    if (isset($_POST['firstname']) && $firstname != "") {
        
        $firstname = string_verify($firstname);


        if (isset($_POST['lastname']) && $lastname != "") {
            $lastname = string_verify($lastname);


            if (isset($_POST['username']) && $username != '') {
                # code...
                $username = string_verify($username);

                if (isset($_POST['email']) && $email != "") {
                
                    
                    

                    if(!checkUserExists($email)){

                        
                        if (isset($_POST['password']) && $password != "") {
                            # code...

                            $password = string_verify($password);

                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            if ($password === $confirm) {
                                // go on...
                                $sql = "INSERT INTO users (firstname, lastname, email, username, password) VALUES ('$firstname', '$lastname', '$email', '$username', '$hashed_password')";

                                $query = mysqli_query($conn, $sql);

                                if ($query) {
                                    // header("location: login.php");
                                }
                            }else{
                                echo "Confirm password is incorrect";
                            }
                        }else{
                            echo "Enter your Password";
                            $error = 1;
                        }

                    }else{
                    // User already exists
                    echo "User already exists";
                    $error = 1;
                    }
                    

                }else{
                    echo "Enter a valid email";
                    $error = 1;
                }
            }


        }else{

            echo "Enter your lastname";
            $error = 1;

        }# code...

    }else{
        echo "Enter your firstname";
        $error = 1;
    }



}