<?php

include '../conn/conn.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Baca data JSON dari body permintaan
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id']; // Ambil ID dari data JSON

    if (isset($id)) {
        // Siapkan query DELETE menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("DELETE FROM pengaduan WHERE id = ?");
        $stmt->bind_param("i", $id); // Bind parameter ID sebagai integer

        // Eksekusi query dan periksa hasil
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal menghapus data."]);
        }

        // Tutup prepared statement
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "ID tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode tidak diizinkan."]);
}

// Tutup koneksi MySQL
$conn->close();
?>
