<?php
session_start();

include '../conn/conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

$user = "SELECT * FROM petugas WHERE username='$username'";
$user_result = $conn->query($user);
if ($user_result->num_rows > 0) {
    $row = $user_result->fetch_assoc();
    if ($password === $row['password']) {
        $_SESSION['id_petugas'] = $row['id'];
        $_SESSION['petugas'] = $row['username'];
        echo '<script>alert("Berhasil masuk.");';
        echo 'window.location.href = "../home.php";</script>';
    } else {
        echo '<script>alert("Password salah. Silakan coba lagi.");';
        echo 'window.location.href = "../";</script>';
    }
} else {
    echo '<script>alert("Username tidak ditemukan. Silakan coba lagi.");';
    echo 'window.location.href = "../";</script>';
}
?>