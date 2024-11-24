<?php
include "../conn/conn.php";
session_start();

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$no_telp = $_POST['no_telp'];
$password = $_POST['password'];

$sql = "UPDATE administrator
        SET nik = ?, nama = ?, username = ?, no_telp = ?, password = ?
        WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $nik, $nama, $username, $no_telp, $password, $_SESSION['id_admin']);

if ($stmt->execute()) {
    $_SESSION['user'] = $username;
    echo "<script>alert('Data diperbarui.');";
    echo "window.location.href = '../account.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan: '" . $stmt->error . "')";
    echo "window.location.href = '../account.php';</script>";
}