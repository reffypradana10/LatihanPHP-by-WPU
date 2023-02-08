<?php

require "function.php";

if(isset($_POST['tambah'])){
    if(registrasi($_POST)>0){
        echo "<script>
                alert('user baru berhasil ditambahkan!');
            </script>";
    }else{
        echo "<script>
                alert('user baru gagal ditambahkan!');
            </script>";
    };
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - PHP</title>
    <style>
        html{
            font-family: monospace;
        }
    </style>
</head>
<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="usernameID">Username : </label>
                <input type="text" name="username" id="usernameID">
            </li>
            <br>
            <li>
                <label for="passwordID">Password : </label>
                <input type="password" name="password" id="passwordID">
            </li>
            <br>
            <li>
                <label for="passwordID2">Re Password : </label>
                <input type="password" name="password2" id="passwordID2">
            </li>
            <br>
            <button type="submit" name="tambah">Tambah User</button>
        </ul>
    </form>

    <a href="login.php">Log in</a>
</body>
</html>