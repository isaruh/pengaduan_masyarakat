<?php
include "../conn/conn.php";

$id = $_GET['id'];

$sql = "DELETE FROM petugas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo '<script> alert("Berhasil dihapus.");';
    echo 'window.location.href = "../users.php";</script>';
}