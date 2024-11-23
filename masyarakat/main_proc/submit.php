<?php
session_start();
include "../conn/conn.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../account.php?account=login");
    exit();
}

$user = $_SESSION['user'];
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$lokasi = $_POST['lokasi'];
$tanggal = $_POST['tanggal'];
$subjek = $_POST['subjek'];

if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
    $nama_lampiran = $_FILES['lampiran']['name'];
    $fileTmp = $_FILES['lampiran']['tmp_name'];
    $fileSize = $_FILES['lampiran']['size'];

    // Periksa ukuran file (2MB)
    if ($fileSize > 2 * 1024 * 1024) {
        die("File terlalu besar. Maksimal 2MB.");
    }

    // Membaca file sebagai binary
    $file_lampiran = file_get_contents($fileTmp);
    $mime_lampiran = mime_content_type($fileTmp);

    // Menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO pengaduan (user, judul, lokasi, subjek, tanggal, isi, nama_lampiran, file_lampiran, mime_lampiran) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sssssssss", $user,  $judul, $lokasi, $subjek, $tanggal, $isi, $nama_lampiran, $file_lampiran, $mime_lampiran);

    if ($stmt->execute()) {
        echo '<script>alert("Laporan Berhasil.");';
        echo 'window.location.href = "../account.php?account=history";</script>';
    } else {
        echo "Gagal menyimpan laporan: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
}


?>
