<?php
session_start();
// koneksi
include "../conn/conn.php";

$nama = $_POST['nama'];
$username = $_POST['username'];
$no_telp = $_POST['no_telp'];
$password = $_POST['password'];

$sql = "INSERT INTO petugas (nama, username, no_telp, password)
        VALUES (?, ?, ?, ?)";
$proc = $conn->prepare($sql);

if ($proc) {
        $proc->bind_param("ssss", $nama, $username, $no_telp, $password);
        if ($proc->execute()) {
                echo '<script>alert("Berhasil ditambahkan.");';
                echo 'window.location.href = "../petugas.php";</script>';
        } else {
                echo '<script>alert("Gagal, silahkan coba lagi.");';
                echo 'window.location.href = "../tambah_petugas.php";</script>';
        }
} else {
        echo "Gagal menyiapkan sql.";
}