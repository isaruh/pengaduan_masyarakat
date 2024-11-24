<?php
include "../conn/conn.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$no_telp = $_POST['no_telp'];
$password = $_POST['password'];

$sql = "UPDATE petugas
        SET nama = ?, username = ?, no_telp = ?, password = ?
        WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nama, $username, $no_telp, $password, $id);

if ($stmt->execute()) {
    echo "<script>alert('Data diperbarui.');";
    echo "window.location.href = '../petugas.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan: '" . $stmt->error . "')";
    echo "window.location.href = '../petugas.php';</script>";
}