<?php
include "../../conn/conn.php";
session_start();

$nama = $_POST['nama'];
$username = $_POST['username'];
$nik = $_POST['nik'];
$no_telp = $_POST['no_telp'];

$sql = "UPDATE masyarakat
        SET nama = ?, username = ?, nik = ?, no_telp = ?
        WHERE nik = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nama, $username, $nik, $no_telp, $_SESSION['user_nik']);

if ($stmt->execute()) {
    $_SESSION['user'] = $username;
    $_SESSION['user_nik'] = $nik;
    echo "<script>alert('Data diperbarui.');";
    echo "window.location.href = '../../account.php?account=profile';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan: '" . $stmt->error . "')";
    echo "window.location.href = '../../account.php?account=profile';</script>";
}