<?php
include "../../conn/conn.php";
session_start();

$nama = $_POST['nama'];
$username = $_POST['username'];
$nik = $_POST['nik'];
$no_telp = $_POST['no_telp'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];

$sql = "UPDATE warga
        SET nama = ?, username = ?, nik = ?, no_telp = ?, tanggal_lahir = ?, alamat = ? 
        WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $nama, $username, $nik, $no_telp, $tanggal_lahir, $alamat, $_SESSION['user_id']);

if ($stmt->execute()) {
    echo "<script>alert('Data diperbarui disetujui.');";
    echo "window.location.href = '../../account.php?account=profile';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan: '" . $stmt->error . "')";
    echo "window.location.href = '../../account.php?account=profile';</script>";
}