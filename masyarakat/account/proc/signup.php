<?php
session_start();
// koneksi
include "../../conn/conn.php";

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$password = $_POST['password'];

$sql = "INSERT INTO users (nik, nama, username, jenis_kelamin,tanggal_lahir, alamat, no_telp, password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$proc = $conn->prepare($sql);

if ($proc) {
        $proc->bind_param("ssssssss", $nik, $nama, $username, $jenis_kelamin, $tanggal_lahir, $alamat, $no_telp, $password);
        if ($proc->execute()) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user'] = $username;
                echo '<script>alert("Berhasil masuk.");';
                echo 'window.location.href = "../../account.php?account=profile";</script>';
        } else {
                echo '<script>alert("Gagal.");';
                echo 'window.location.href = "../../account.php?account=signup";</script>';
        }
} else {
        echo "Gagal menyiapkan sql.";
}