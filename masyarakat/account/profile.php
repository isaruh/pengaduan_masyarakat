<?php
session_start();
include "conn/conn.php";

$user = $_SESSION['user'];
$sql = "SELECT * FROM users WHERE username='$user'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            color: #333;
        }

        .navbar {
            background-color: #1d1d79;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }

        .profile-header {
            background-image: url("img/bg2.png");
            background-repeat: no-repeat;
            background-size: 100% auto;
            padding: 100px 30px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            position: relative;
        }

        .profile-header .profile-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 40px;
        }

        .profile-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: white;
        }

        .profile-header .username {
            font-size: 24px;
            font-weight: bold;
        }

        .profile-header .logout-button {
            background-color: #fff;
            color: #3A64A3;
            padding: 8px 30px;
            margin-right: 40px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        .container {
            margin: 20px 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        h1 {
            margin-bottom: 50px;
            color: #333;
        }

        form {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-item {
            margin-bottom: 30px;
        }

        .form-item label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-item input[type="text"],
        .form-item input[type="date"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-item button {
            width: calc(100% - 20px);
            padding: 15px;
        }

        .btn-save {
            background-color: #3A64A3;
            padding: 15px 20px;
            border: 2px solid #3A64A3;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-save img {
            width: 70px;
            height: auto;
        }

        .btn-save:hover {
            background-color: #080053;
            border: 2px solid #080053;
        }

        .btn-cancel {
            background-color: white;
            padding: 10px 20px;
            border: 2px solid #898989;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-cancel img {
            width: 60px;
            height: auto;
        }

        .btn-cancel:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <?php include "comp/navbar.php"; ?>

    <div class="profile-header">
        <div class="profile-info">
            <img src="img/user.png">
            <div class="username"><?= $_SESSION['user'] ?></div>
        </div>
        <button class="logout-button" onclick="confirmLogout()">keluar</button>
    </div>

    <div class="container">
        <h1>Edit Profil</h1>
        <form id="profile-form" action="account/proc/edit.php" method="post">
            <div class="form-group">
                <div class="form-item">
                    <label for="nama">Nama Lengkap *</label>
                    <input type="text" name="nama" value="<?= $row['nama']; ?>" autocomplete="off" id="nama">
                </div>
                <div class="form-item">
                    <label for="username">Username *</label>
                    <input type="text" name="username" value="<?= $row['username']; ?>" autocomplete="off" id="username">
                </div>
                <div class="form-item">
                    <label for="nik">NIK *</label>
                    <input type="text" name="nik" value="<?= $row['nik']; ?>" autocomplete="off" id="nik">
                </div>
                <div class="form-item">
                    <label for="telp">No. Telp *</label>
                    <input type="text" name="no_telp" value="<?= $row['no_telp']; ?>" autocomplete="off" id="telp">
                </div>
                <div class="form-item">
                    <label for="tgl_lahir">Tanggal Lahir *</label>
                    <input type="date" name="tanggal_lahir" value="<?= $row['tanggal_lahir']; ?>" id="tgl_lahir">
                </div>
                <div class="form-item">
                    <label for="alamat">Alamat *</label>
                    <input type="text" name="alamat" value="<?= $row['alamat']; ?>" autocomplete="off" id="alamat">
                </div>
            </div>
            <div class="form-group">
                <div class="form-item">
                    <button type="submit" class="btn-save"><img src="img/simpan.png" alt=""></button>
                </div>
                <div class="form-item">
                    <button type="button" class="btn-cancel" onclick="resetForm()"><img src="img/batal.png" alt=""></button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('profile-form');
        const initialValues = {};

        Array.from(form.elements).forEach(input => {
            if (input.name) {
                initialValues[input.name] = input.value;
            }
        });

        function resetForm() {
            Array.from(form.elements).forEach(input => {
                if (input.name && initialValues[input.name] !== undefined) {
                    input.value = initialValues[input.name];
                }
            });
        }

        function confirmLogout() {
            if (confirm("Apakah Anda yakin ingin keluar?")) {
                window.location.href = "account/proc/logout.php";
            }
        }
    </script>
</body>
</html>
