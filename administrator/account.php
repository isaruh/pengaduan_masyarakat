<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
}

include "conn/conn.php";

$admin = $_SESSION['admin'];
$sql = "SELECT * FROM administrator WHERE username='$admin'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Anda</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .content {
            flex: 1; /* Konten mengambil sisa ruang */
            padding: 60px 60px;
            overflow-y: auto;
        }

        .form-box {
            margin-right: 100px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group p {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="tel"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input[type="text"]::placeholder,
        .form-group input[type="password"]::placeholder,
        .form-group input[type="tel"]::placeholder {
            color: #aaa;
        }

        .form-group label {
            font-size: 14px;
            color: #555;
        }

        .form-group small {
            display: block;
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }

        .submit-btn {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include "comp/sidebar.php"; ?>

        <div class="content">
            <div class="form-box">
                <form action="proc/edit_account.php" method="POST">
                    <div class="form-group">
                        <p>NIK</p>
                        <input type="text" name="nik" placeholder="NIK *" value="<?= $row['nik']; ?>" autocomplete="off" minlength="16" maxlength="16" required>
                    </div>
                    <div class="form-group">
                        <p>Nama</p>
                        <input type="text" name="nama" placeholder="Nama Lengkap *" value="<?= $row['nama']; ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <p>Username</p>
                        <input type="text" name="username" placeholder="Username *" value="<?= $row['username']; ?>" autocomplete="off" minlength="3" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <p>No. Telp</p>
                        <input type="tel" name="no_telp" placeholder="No. Telp *" value="<?= $row['no_telp']; ?>" autocomplete="off" minlength="12" maxlength="13" required>
                    </div>
                    <div class="form-group">
                        <p>Password</p>
                        <input type="password" name="password" placeholder="Password *" value="<?= $row['password']; ?>" minlength="10" maxlength="20" required>
                        <small>Minimal 10 karakter, maksimal 20 karakter, dan diawali huruf kapital. Kombinasi angka, huruf, dan karakter khusus (!@#$%&*).</small>
                    </div>
                    <button type="submit" class="submit-btn">EDIT</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>