<?php
include "../conn/conn.php";

$id_penanggap = $_POST['id_penanggap'];
$username_pengadu = $_POST['username_pengadu'];
$id_pengaduan = $_POST['id_pengaduan'];
$isi = $_POST['isi'];

$sql = "INSERT INTO tanggapan (id_penanggap, username_pengadu, id_pengaduan, isi) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssss", $id_penanggap, $username_pengadu, $id_pengaduan, $isi);
    if ($stmt->execute()) {
        header("Location: ../home.php");
    } else {
        echo "<script> alert('Gagal mengirim tanggapan');";
        echo "window.locaton.href = '../home.php'; </script>";
    }
} else {
    echo "Gagal meyiapkan sql.";
}

?>