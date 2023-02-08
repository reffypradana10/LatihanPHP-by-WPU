<?php

$db = "localhost";
$user = "root";
$pass = "";
$table = "wpuphp";


// $conn = mysqli_connect("$db","$user","$pass","$table");
$conn = mysqli_connect("localhost","root","","wpuphp");

function query($data){
    global $conn;

    $result = mysqli_query($conn,$data);

    $raw = [];

    while($r = mysqli_fetch_assoc($result)){
        $raw[] = $r;
    }

    return $raw;
}

function tambah($data){

    global $conn;

    $nama = htmlspecialchars($_POST['nama']);
    $nrp = htmlspecialchars($_POST['nrp']);
    $email = htmlspecialchars($_POST['email']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $gambar = htmlspecialchars($_POST['gambar']);


    $query = "INSERT INTO mahasiswa VALUES ('',
                                            '$nama',
                                            '$nrp',
                                            '$email',
                                            '$jurusan',
                                            '$gambar')";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);


}

function ubah($data){
    global $conn;

    $id = $_POST['id'];
    $nama = htmlspecialchars($_POST['nama']);
    $nrp = htmlspecialchars($_POST['nrp']);
    $email = htmlspecialchars($_POST['email']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $gambarlama = htmlspecialchars($_POST['gambarlama']);

    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarlama;
    }else{
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET nama = '$nama',
                                    nrp = '$nrp',
                                    email = '$email',
                                    jurusan = '$jurusan',
                                    gambar = '$gambar'
                                    WHERE id = $id";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error === 4){
        echo "<script>
        alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    $eksgambarValid = ['jpg','jpeg','png'];
    $eksgambar = explode('.',$namaFile);
    $eksgambar = strtolower(end($eksgambar));
    if(!in_array($eksgambar,$eksgambarValid)){
        echo "<script>
        alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    if($ukuranFile > 100000){
        echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
    }

    $namafileBaru = uniqid();
    $namafileBaru .= '.';
    $namafileBaru .= $eksgambar;

    move_uploaded_file($tmpName, 'gambar/'.$namafileBaru);

    return $namafileBaru;
}

function hapus($data){
    global $conn;

    $query = "DELETE FROM mahasiswa WHERE id = $data";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function cari($data){
    global $conn;

    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$data%' OR
                                                nrp LIKE '%$data%'";

    return query($query);
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $pass = mysqli_real_escape_string($conn, $data["password"]);
    $pass2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
    }

    if ($pass !== $pass2){
        echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;

    }

        $pass = password_hash($pass, PASSWORD_DEFAULT);

        mysqli_query($conn,"INSERT INTO user VALUES('','$username','$pass')");

        return mysqli_affected_rows($conn);


}