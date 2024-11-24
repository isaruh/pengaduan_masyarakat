<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
}

include "conn/conn.php";

$sql = "SELECT * FROM petugas";
$result_petugas = $conn->query($sql);
if (!$result_petugas) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            height: 100vh; /* Pastikan kontainer menutupi seluruh tinggi layar */
        }

        .content {
            flex: 1; /* Konten mengambil sisa ruang */
            padding: 0 20px 20px;
            overflow-y: auto;
        }

        .search-container {
            padding: 30px 40px 30px;
            top: 0;
            position: sticky;
            z-index: 999;
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-box {
            display: flex;
            align-items: center;
            width: 60%;
            background-color: white;
            border: 1px solid #333;
            border-radius: 25px;
            padding: 15px;
            gap: 10px;
        }

        .search-box input[type="text"] {
            width: 100%;
            border: none;
            outline: none;
            font-size: 15px;
        }

        .search-box img {
            width: 20px;
            height: 20px;
        }

        .tambah-petugas a {
            color: white;
            background-color: #333;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 15px;
        }

        .tambah-petugas a:hover {
            background-color: #777;
        }

        .petugas-list {
            margin: 10px 40px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .petugas-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .petugas-item {
            background-color: white;
            padding: 15px 30px;
            border: 1px solid #333;
            border-radius: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex: 1;
        }

        .petugas-item .status {
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: bold;
            color: white;
            align-items: center;
        }

        .status img {
            width: 100px;
            height: auto;
        }

        .petugas-item .petugas-info {
            display: flex;
            flex-direction: column;
            color: #333;
        }

        .petugas-item .petugas-info .username {
            font-weight: bold;
            font-size: 18px;
        }

        .delete-item {
            margin-left: 15px;
        }

        .delete-item a {
            border: none;
            background-color: white;
        }

        .petugas-list .no-petugas h2 {
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            margin-top: 50px;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: white;
            margin: 8% auto 12px auto;
            padding: 50px 40px;
            border-radius: 20px;
            width: 80%;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
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
            <div class="search-container">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari...">
                    <img src="img/search.png" alt="Search Icon">
                </div>
                <div class="tambah-petugas">
                    <a href="tambah_petugas.php">Tambah</a>
                </div>
            </div>

            <div class="petugas-list">
                <?php
                if ($result_petugas->num_rows > 0) {
                    while ($row = $result_petugas->fetch_assoc()) {
                        echo "
                        <div class='petugas-row'>
                            <div class='petugas-item'
                            data-id='".$row['id']."' 
                            data-nama='".$row['nama']."' 
                            data-password='".$row['password']."' 
                            data-no_telp='".$row['no_telp']."'>
                                <div class='petugas-info'>
                                    <div class='username'>".$row['username']."</div>
                                </div>
                            </div>
                            <div class='delete-item'>
                                <a href='proc/delete_petugas.php?id=".$row['id']."' onclick='return confirm(`Apakah Anda yakin ingin menghapus?`);'><img src='img/delete.png'></a>
                            </div>
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='no-petugas'>
                        <h2>Tidak ada petugas.</h2>
                    </div>
                    ";
                }
                ?>
            </div>

            <div id="petugasModal" class="modal">
                <div class="modal-content">
                    <div class="modal-form">
                        <form action="proc/edit_petugas.php" method="post">
                            <input type="hidden" name="id" value="">
                            <div class="form-group">
                                <input type="text" name="nama" placeholder="Nama Lengkap *" value="" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username *" value="" autocomplete="off" minlength="3" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" name="no_telp" placeholder="No. Telp *" value="" autocomplete="off" minlength="12" maxlength="13" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password *" value="" autocomplete="off" minlength="10" maxlength="20" required>
                                <small>Minimal 10 karakter, maksimal 20 karakter, dan diawali huruf kapital. Kombinasi angka, huruf, dan karakter khusus (!@#$%&*).</small>
                            </div>
                            <button type="submit" class="submit-btn">EDIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            const modal = document.getElementById("petugasModal");
            const petugasRows = document.querySelectorAll(".petugas-row");

            function showModal(data) {
                const form = document.querySelector("form");
                form.querySelector("input[name='id']").value = data.id;
                form.querySelector("input[name='nama']").value = data.nama;
                form.querySelector("input[name='username']").value = data.username;
                form.querySelector("input[name='no_telp']").value = data.no_telp;
                form.querySelector("input[name='password']").value = data.password;

                modal.style.display = "block";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            document.querySelectorAll(".petugas-item").forEach(function(item) {
                item.addEventListener("click", function() {
                    const data = {
                        id: this.getAttribute("data-id"),
                        nama: this.getAttribute("data-nama"),
                        username: this.querySelector(".username").textContent,
                        no_telp: this.getAttribute("data-no_telp"),
                        password: this.getAttribute("data-password")
                    };
                    showModal(data);
                });
            });

            // Fungsi untuk mencari laporan
            searchInput.addEventListener("keyup", function() {
                const filter = searchInput.value.toLowerCase();
                petugasRows.forEach(function(item) {
                    const username = item.querySelector(".username").textContent.toLowerCase();
                    if (username.includes(filter)) {
                        item.style.display = ""; // Tampilkan item
                    } else {
                        item.style.display = "none"; // Sembunyikan item
                    }
                });
            });
        });
    </script>
</body>
</html>