<?php

session_start();
if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require "function.php";

if(isset($_POST['submit'])>0){
    if(tambah($_POST)){
        echo "<script>
        alert('data berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }else{
        echo "<script>
        alert('data gagal ditambahkan');
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa - PHP</title>
    <style>
        html{
            font-family: monospace;
        }
    </style>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>

        <a href="index.php">Kembali</a>

    <form action="" method="POST">
        <ul>
            <li>
                <label for="IDNama">Nama : </label>
                <input type="text" name="nama" id="IDNama">
            </li>
            <li>
                <label for="IDNrp">Nrp : </label>
                <input type="text" name="nrp" id="IDNrp">
            </li>
            <li>
                <label for="IDEmail">Email : </label>
                <input type="text" name="email" id="IDEmail">
            </li>
            <li>
                <label for="IDJurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="IDJurusan">
            </li>
            <li>
                <label for="IDGambar">Gambar : </label>
                <input type="text" name="gambar" id="IDGambar">
            </li><br>
            <button name="submit" type="submit">Tambah Data</button>
        </ul>
    </form>
</body>
</html>