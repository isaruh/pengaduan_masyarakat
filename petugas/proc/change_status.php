<?php
include "../conn/conn.php";

$status = $_GET['status'];
$id = $_GET['id'];

$sql = "UPDATE pengaduan SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    echo "<script>alert('Pengaduan disetujui.');";
    echo "window.location.href = '../home.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan: '" . $stmt->error . "')";
    echo "window.location.href = '../home.php';</script>";
}