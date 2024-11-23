<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
}

include "conn/conn.php";

$sql = "SELECT * FROM petugas ORDER BY created_at DESC";
$result_users = $conn->query($sql);
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

        .users-list {
            margin: 10px 40px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .user-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-item {
            background-color: white;
            padding: 15px 30px;
            border: 1px solid #333;
            border-radius: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex: 1;
        }

        .user-item .status {
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

        .user-item .user-info {
            display: flex;
            flex-direction: column;
            color: #333;
        }

        .user-item .user-info .username {
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

        .users-list .no-user h2 {
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            margin-top: 50px;
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
            </div>

            <div class="users-list">
                <?php
                if ($result_users->num_rows > 0) {
                    while ($row = $result_users->fetch_assoc()) {
                        echo "
                        <div class='user-row'>
                            <div class='user-item'>
                                <div class='user-info'>
                                    <div class='username'>".$row['username']."</div>
                                </div>
                            </div>
                            <div class='delete-item'>
                                <a href='proc/delete_user.php?id=".$row['id']."' onclick='return confirm(`Apakah Anda yakin ingin menghapus?`);'><img src='img/delete.png'></a>
                            </div>
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='no-user'>
                        <h2>Tidak ada user.</h2>
                    </div>
                    ";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            const userRows = document.querySelectorAll(".user-row");

            // Fungsi untuk mencari laporan
            searchInput.addEventListener("keyup", function() {
                const filter = searchInput.value.toLowerCase();
                userRows.forEach(function(item) {
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