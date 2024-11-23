<?php
session_start();

include '../conn/conn.php';

$nik = $_POST['nik'];
$password = $_POST['password'];

$user = "SELECT * FROM admin WHERE nik='$nik'";
$user_result = $conn->query($user);
if ($user_result->num_rows > 0) {
    $row = $user_result->fetch_assoc();
    if ($password === $row['password']) {
        $_SESSION['admin'] = $row['nik'];
        echo '<script>alert("Berhasil masuk.");';
        echo 'window.location.href = "../solved.php";</script>';
    } else {
        echo '<script>alert("Password salah. Silakan coba lagi.");';
        echo 'window.location.href = "../";</script>';
    }
} else {
    echo '<script>alert("NIK tidak ditemukan. Silakan coba lagi.");';
    echo 'window.location.href = "../";</script>';
}
?>