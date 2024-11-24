<?php
include "../conn/conn.php";

$id = $_GET['id'];
$page = $_GET['page'];

$sql = "DELETE FROM pengaduan WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $stmt = $conn->prepare("DELETE FROM tanggapan WHERE id_pengaduan = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo '<script>alert("Berhasil dihapus.");';
        echo 'window.location.href = "../'.$page.'.php";</script>';
    } else {
        echo '<script>alert("Berhasil dihapus.");';
        echo 'window.location.href = "../'.$page.'.php";</script>';
    }
}