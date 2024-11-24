<?php

$host_conn = "localhost";
$user_conn = "root";
$password_conn = "";
$database_conn = "pengaduan_masyarakat";

$conn = new mysqli($host_conn, $user_conn, $password_conn, $database_conn);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
} else {
    // echo "Koneksi Berhasil.";
}