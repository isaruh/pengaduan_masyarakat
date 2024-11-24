<?php
session_start();
// koneksi
include "../conn/conn.php";

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$no_telp = $_POST['no_telp'];
$password = $_POST['password'];

$sql = "INSERT INTO administrator (nik, nama, username, no_telp, password)
        VALUES (?, ?, ?, ?, ?)";
$proc = $conn->prepare($sql);

if ($proc) {
        $proc->bind_param("sssss", $nik, $nama, $username, $no_telp, $password);
        if ($proc->execute()) {
                $_SESSION['id_admin'] = $row['id'];
                $_SESSION['admin'] = $username;
                echo '<script>alert("Berhasil mendaftar.");';
                echo 'window.location.href = "../unprocessed.php";</script>';
        } else {
                echo '<script>alert("Gagal.");';
                echo 'window.location.href = "../signup.php";</script>';
        }
} else {
        echo "Gagal menyiapkan sql.";
}