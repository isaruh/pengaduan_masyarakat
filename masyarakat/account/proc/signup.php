<?php
session_start();
// koneksi
include "../../conn/conn.php";

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$no_telp = $_POST['no_telp'];
$password = $_POST['password'];

$sql = "INSERT INTO masyarakat (nik, nama, username, no_telp, password)
        VALUES (?, ?, ?, ?, ?)";
$proc = $conn->prepare($sql);

if ($proc) {
        $proc->bind_param("sssss", $nik, $nama, $username, $no_telp, $password);
        if ($proc->execute()) {
                $_SESSION['user_nik'] = $nik;
                $_SESSION['user'] = $username;
                echo '<script>alert("Berhasil masuk.");';
                echo 'window.location.href = "../../account.php?account=profile";</script>';
        } else {
                echo '<script>alert("Gagal, coba lagi.");';
                echo 'window.location.href = "../../account.php?account=signup";</script>';
        }
} else {
        echo "Gagal menyiapkan sql.";
}