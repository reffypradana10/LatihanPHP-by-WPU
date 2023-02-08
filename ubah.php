<?php

session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require "function.php";

$data = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $data")[0];

if(isset($_POST['submit'])>0){
    if(ubah($_POST)){
        echo "<script>
        alert('data berhasil diubah');
        document.location.href = 'index.php';
        </script>";
    }else{
        echo "<script>
        alert('data gagal diubah');
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
    <title>Ubah Data Mahasiswa - PHP</title>
    <style>
        html{
            font-family: monospace;
        }
    </style>
</head>
<body>
    <h1>Ubah Data Mahasiswa</h1>

    <a href="index.php">Kembali</a>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]?>">
        <input type="hidden" name="gambarlama" value="<?= $mhs["gambar"]?>">
        <ul>
            <img src="gambar/<?= $mhs['gambar'] ?>" width="50">
        </ul>
        <ul>
            <input type="hidden" name="id" value="<?= $mhs['id'] ?>">
            <li>
                <label for="IDNama">Nama : </label>
                <input type="text" name="nama" id="IDNama" value="<?= $mhs['nama'] ?>">
            </li>
            <li>
                <label for="IDNrp">Nrp : </label>
                <input type="text" name="nrp" id="IDNrp" value="<?= $mhs['nrp'] ?>:">
            </li>
            <li>
                <label for="IDEmail">Email : </label>
                <input type="text" name="email" id="IDEmail" value="<?= $mhs['email'] ?>">
            </li>
            <li>
                <label for="IDJurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="IDJurusan" value="<?= $mhs['jurusan'] ?>">
            </li>
            <li>
                <label for="IDGambar">Gambar : </label>
                <input type="file" name="gambar" id="IDGambar" >
            </li>
            <button name="submit" type="submit">Tambah Data</button>
        </ul>
    </form>
</body>
</html>