<?php
session_start();

include '../../conn/conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

$user = "SELECT * FROM warga WHERE username='$username'";
$user_result = $conn->query($user);
if ($user_result->num_rows > 0) {
    $row = $user_result->fetch_assoc();
    if ($password === $row['password']) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user'] = $row['username'];
        echo '<script>alert("Berhasil masuk.");';
        echo 'window.location.href = "../../account.php?account=profile";</script>';
    } else {
        echo '<script>alert("Password salah. Silakan coba lagi.");';
        echo 'window.location.href = "../../account.php?account=login";</script>';
    }
} else {
    echo '<script>alert("Username tidak ditemukan. Silakan coba lagi.");';
    echo 'window.location.href = "../../account.php?account=login";</script>';
}
?>