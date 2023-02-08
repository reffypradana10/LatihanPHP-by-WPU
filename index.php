<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'function.php';

$data = query("SELECT * FROM mahasiswa");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Mahasiswa - PHP</title>
    <style>
        html{
            font-family: monospace;

        }
    </style>
</head>
<body>
    <h1>Tabel Mahasiswa</h1>

    <form action="" method="POST">
        <input type="text" size="50" name="keyword" placeholder="Masukkan Pencarian ..." autofocus>
        <button type="submit" name="cari">Cari!</button>
    </form>
    <br>

    <a href="tambah.php">Tambah Data Mahasiswa</a><br>
    <a href="logout.php">Log out</a><br><br>

    <table border="1" cellpadding="20" cellspacing="0">
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Aksi</td>
            <td>Gambar</td>
            <td>Nrp</td>
            <td>Email</td>
            <td>Jurusan</td>
        </tr>

<?php $no = 1 ?>
<?php foreach($data as $mhs): ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $mhs['nama'] ?></td>
            <td><a href="ubah.php?id=<?= $mhs['id'] ?>">UBAH</a> | <a href="hapus.php?id=<?= $mhs['id'] ?>">HAPUS</a></td>
            <td><img src="gambar/<?= $mhs['gambar'] ?>" width="50"></td>
            <td><?= $mhs['nrp'] ?></td>
            <td><?= $mhs['email'] ?></td>
            <td><?= $mhs['jurusan'] ?></td>
        </tr>
<?php $no++?>
<?php endforeach;?>

    </table>
</body>
</html>