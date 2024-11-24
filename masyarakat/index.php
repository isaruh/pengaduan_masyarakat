<?php
session_start();
include "conn/conn.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Pengaduan Masyarakat</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-image: url("img/bg.png");
            background-repeat: no-repeat;
            background-size: 100% auto;
        }

        .main-content {
            text-align: center;
            padding: 50px 0;
            margin: 80px 0 120px 0;
            color: white;
        }

        .main-content h1 {
            margin-bottom: 0;
        }

        .main-content p {
            margin-top: 10px;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            width: 60%;
            max-width: 600px;
            margin: auto;
            padding: 40px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px 15px; /* Updated padding for more space on both sides */
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box; /* Ensure padding doesn’t affect total width */
            margin: 0;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 200px;
        }

        .upload-section {
            padding: 10px;
            border: 1px dashed #ccc;
            border-radius: 5px;
            text-align: center;
            color: #777;
            font-size: 14px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .button-group a {
            text-decoration: none;
            color: blue;
        }

        .submit-btn {
            background-color: #3A64A3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        
        .submit-btn:hover {
            background-color: #080053;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php include "comp/navbar.php"; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Layanan Pengaduan Masyarakat</h1>
        <p>Buat pengaduan langsung secara online</p>
    </div>

    <!-- Form -->
    <div class="form-container">
        <form action="main_proc/submit.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="judul" placeholder="Judul Laporan *" autocomplete="off" required>
            </div>
            <div class="form-group">
                <textarea name="isi" placeholder="Isi Laporan *" autocomplete="off" required></textarea>
            </div>
            <div class="form-group">
                <input type="text" name="lokasi" placeholder="Lokasi *" autocomplete="off" required>
            </div>
            <div class="form-group">
                <input type="date" name="tanggal" placeholder="Tanggal Kejadian" required>
            </div>
            <!-- Updated Upload Section -->
            <div class="form-group upload-section">
                <label for="file-upload">UPLOAD LAMPIRAN (MAX 2MB)</label>
                <input type="file" id="file-upload" name="lampiran" accept=".jpg, .jpeg, .png, .pdf, .mp4, .avi, .mov" required>
                <p>Lampiran berupa foto atau video dengan ukuran maksimal 2MB. Foto berformat jpg, jpeg, png, pdf, atau video berformat mp4, avi, mov.</p>
            </div>
            <div class="button-group">
                <a href="">Panduan</a>
                <input type="submit" class="submit-btn" value="SUBMIT">
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?php include "comp/footer.php"; ?>

</body>
</html>
