<?php
session_start();
require 'function.php';



if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    
    // var_dump(mysqli_num_rows($result) === 0);
    // exit;

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            $_SESSION["login"] = true;

            header("Location: index.php");
            exit;
        }
        
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PHP</title>
    <style>
        html{
            font-family: monospace;
        }
    </style>
</head>
<body>
    <h1>Halaman Login</h1>
    
    <form action="" method="post">
        <ul>
            <li>
                <label for="usernameID">Username</label>
                <input type="text" name="username" id="usernameID">
            </li>
            <br>
            <li>
                <label for="passwordID">Password</label>
                <input type="password" name="password" id="passwordID">
            </li>
            <br>
            <button type="submit" name="login">Login</button>
        </ul>
    </form>

    <a href="registrasi.php">Sign Up</a>
</body>
</html>