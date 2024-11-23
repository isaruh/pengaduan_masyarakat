<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
}

include "conn/conn.php";

$sql = "SELECT * FROM pengaduan WHERE status = 'pending' ORDER BY created_at DESC";
$result_pengaduan = $conn->query($sql);

$sql = "SELECT * FROM subjek";
$result_subjek = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending</title>
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

        .filter-btn {
            background-color: white;
            border-radius: 10px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .filter-btn img {
            width: 30px;
            height: auto;
        }

        .report-list {
            margin: 10px 40px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .report-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .report-item {
            background-color: white;
            padding: 15px 30px;
            border: 1px solid #333;
            border-radius: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex: 1;
        }

        .report-item .status {
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

        .report-item .report-info {
            display: flex;
            flex-direction: column;
            color: #333;
        }

        .report-item .report-info .title {
            font-weight: bold;
            font-size: 18px;
        }

        .report-item .report-info .username {
            color: #777;
            font-size: 14px;
        }

        .delete-item {
            margin-left: 15px;
        }

        .delete-item a {
            border: none;
            background-color: white;
        }

        .report-list .no-report h2 {
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            margin-top: 50px;
        }

        /* modal */
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
            margin: 8% auto;
            padding: 20px 40px;
            border-radius: 20px;
            width: 80%;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .modal-header {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .modal-header h2 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .modal-header p {
            font-size: 14px;
            color: #777;
        }

        .modal-body {
            display: flex;
            justify-content: space-between;
            margin-bottom: 100px;
        }

        .modal-body p {
            font-size: 16px;
            max-width: 500px;
            word-wrap: break-word;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .modal-footer .footer-right a.reject {
            color: black;
            text-decoration: none;
            font-weight: bold;
            margin-right: 15px;
        }

        .modal-footer .footer-right a.processed {
            color: white;
            background-color: #080053;
            padding: 5px 25px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .thumbnail-container {
            width: 150px;  /* Atur lebar thumbnail */
            height: 150px; /* Atur tinggi thumbnail */
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        .thumbnail-container img {
            width: 300px;  /* Atur lebar gambar thumbnail */
            height: auto; /* Atur tinggi gambar thumbnail */
            object-fit: cover; /* Memastikan gambar terpotong dengan baik */
        }

        .modal-content .fullViewContent {
            display: flex;
            justify-content: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Gaya untuk popup filter */
        .filter-popup {
            position: absolute;
            top: 90px; /* Sesuaikan dengan tinggi navbar jika ada */
            right: 100px; /* Jarak dari kanan */
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            z-index: 1000; /* Pastikan popup muncul di atas elemen lain */
            width: 200px; /* Lebar popup */
        }

        /* Gaya untuk judul popup */
        .filter-popup h3 {
            margin: 0 0 10px;
            font-size: 18px;
        }

        /* Gaya untuk daftar kategori */
        .filter-popup ul {
            list-style-type: none; /* Menghilangkan bullet */
            padding: 0;
            margin: 0;
        }

        /* Gaya untuk item kategori */
        .filter-popup li {
            padding: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Gaya saat hover pada item kategori */
        .filter-popup li:hover {
            background-color: #f0f0f0; /* Warna latar belakang saat hover */
        }

        /* Gaya untuk item kategori yang dipilih */
        .filter-popup li.selected {
            border: 2px solid #007bff;
            border-radius: 5px;
        }

        /* Gaya untuk tombol tutup */
        #closeFilter {
            background-color: #007bff; /* Warna latar belakang tombol */
            color: white; /* Warna teks tombol */
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%; /* Lebar penuh */
        }

        /* Gaya saat hover pada tombol tutup */
        #closeFilter:hover {
            background-color: #0056b3; /* Warna latar belakang saat hover */
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
                <div class="filter-btn" id="filterBtn">
                    <img src="img/filter.png">
                </div>
            </div>

            <div id="filterPopup" class="filter-popup" style="display: none;">
                <h3>Fasilitas</h3>
                <ul>
                    <li data-category='all'>Semua</li>
                    <?php
                    if ($result_subjek->num_rows > 0) {
                        while ($row = $result_subjek->fetch_assoc()) {
                            echo "
                            <li data-category='".$row['fasilitas']."'>".$row['fasilitas']."</li>
                            ";
                        }
                    }
                    ?>
                </ul>
                <button id="closeFilter">Tutup</button>
            </div>

            <div class="report-list">
                <?php
                if ($result_pengaduan->num_rows > 0) {
                    while ($row = $result_pengaduan->fetch_assoc()) {
                        $status = $row['status'] == "accepted" ? '' : "<img src='img/".$row['status'].".png'>";

                        // Menambahkan prefix MIME secara manual berdasarkan tipe file
                        $mimeType = $row['mime_lampiran'];  // Ambil tipe MIME dari kolom `mime_type`
                        $fileData = base64_encode($row['file_lampiran']);
                        $lampiran = "data:$mimeType;base64,$fileData";

                        echo "
                        <div class='report-row'
                        data-id='".$row['id']."' 
                        data-lokasi='".$row['lokasi']."' 
                        data-subjek='".$row['subjek']."' 
                        data-tanggal='".$row['tanggal']."' 
                        data-isi='".$row['isi']."' 
                        data-lampiran='".$lampiran."'>
                            <div class='report-item'
                            data-id='".$row['id']."' 
                            data-lokasi='".$row['lokasi']."' 
                            data-subjek='".$row['subjek']."' 
                            data-tanggal='".$row['tanggal']."' 
                            data-isi='".$row['isi']."' 
                            data-lampiran='".$lampiran."'>
                                <div class='report-info'>
                                    <div class='title'>".$row['judul']."</div>
                                    <div class='username'>".$row['user']."</div>
                                </div>
                                <div class='status'>".$status."</div>
                            </div>
                            <div class='delete-item'>
                                <a href='proc/delete_pengaduan.php?id=".$row['id']."&page=pending' onclick='return confirm(`Apakah Anda yakin ingin menghapus?`);'><img src='img/delete.png'></a>
                            </div>
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='no-report'>
                        <h2>Tidak ada pengaduan.</h2>
                    </div>
                    ";
                }
                ?>
            </div>

            <div id="reportModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="modalJudul">Judul Laporan</h2>
                        <p id="modalUsername">Username</p>
                        <hr style="border: 1px solid #333; width: 100%; margin: 15px auto 5px;">
                        <p id="modalLokasi">Jl. Lorem Ipsum</p>
                        <p id="modalTanggal">DD-MM-YYYY</p>
                    </div>
                    <div class="modal-body">
                        <p id="modalIsi">
                            Deskripsi laporan akan ditampilkan di sini.
                        </p>
                        <div id="modalLampiran" class="modal-lampiran">
                            <div id="lampiranThumbnail" class="thumbnail-container"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="footer-left">
                        </div>
                        <div class="footer-right">
                            <a href="" class="reject" id="rejectLink">reject</a>
                            <a href="" class="processed" id="processedLink">solved</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="fullViewModal" class="modal">
                <div class="modal-content full-view">
                    <span class="close" onclick="document.getElementById('fullViewModal').style.display='none'"></span>
                    <div id="fullViewContent" class="fullViewContent"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("reportModal");
            const closeBtn = document.querySelector(".close");
            const modalLampiran = document.getElementById("lampiranThumbnail");
            const fullViewModal = document.getElementById("fullViewModal");
            const fullViewContent = document.getElementById("fullViewContent");
            const searchInput = document.getElementById("searchInput");
            const reportItems = document.querySelectorAll(".report-item");
            const reportRows = document.querySelectorAll(".report-row");
            const filterPopup = document.getElementById("filterPopup");
            const closeFilterBtn = document.getElementById("closeFilter");

            // Fungsi untuk menampilkan modal dengan data laporan
            function showModal(data) {
                document.getElementById("modalJudul").textContent = data.judul;
                document.getElementById("modalUsername").textContent = data.user;
                document.getElementById("modalTanggal").textContent = data.tanggal;
                document.getElementById("modalLokasi").textContent = data.lokasi;
                document.getElementById("modalIsi").textContent = data.isi;
                document.getElementById("rejectLink").href = "proc/change_status.php?page=pending&status=rejected&id=" + data.id;
                document.getElementById("processedLink").href = "proc/change_status.php?page=pending&status=solved&id=" + data.id;

                modalLampiran.innerHTML = ""; // Reset thumbnail

                // Buat thumbnail
                const thumbnail = document.createElement("div");
                thumbnail.className = "thumbnail-container";
                thumbnail.onclick = function() {
                    showFullView(data.lampiran); // Tampilkan lampiran ukuran penuh saat diklik
                };

                if (data.lampiran.startsWith("data:image")) {
                    const img = document.createElement("img");
                    img.src = data.lampiran;
                    img.alt = "Report Image";
                    thumbnail.appendChild(img);
                } else if (data.lampiran.startsWith("data:application/pdf")) {
                    const pdfIcon = document.createElement("img");
                    pdfIcon.src = "img/pdf.png"; // Ganti dengan path ikon PDF Anda
                    pdfIcon.alt = "PDF Icon";
                    pdfIcon.style.width = "100%"; // Atur lebar ikon PDF
                    thumbnail.appendChild(pdfIcon);
                } else if (data.lampiran.startsWith("data:video")) {
                    const videoIcon = document.createElement("img");
                    videoIcon.src = "img/video.png"; // Ganti dengan path ikon Video Anda
                    videoIcon.alt = "Video Icon";
                    videoIcon.style.width = "100%"; // Atur lebar ikon Video
                    thumbnail.appendChild(videoIcon);
                }

                modalLampiran.appendChild(thumbnail);
                modal.style.display = "block";
            }

            // Fungsi untuk menampilkan lampiran dalam ukuran penuh
            function showFullView(lampiran) {
                fullViewContent.innerHTML = ""; // Reset konten

                if (lampiran.startsWith("data:image")) {
                    const img = document.createElement("img");
                    img.src = lampiran;
                    img.alt = "Full View Image";
                    img.style.maxWidth = "90%"; // Atur lebar maksimal
                    img.style.maxHeight = "90%"; // Atur tinggi maksimal
                    fullViewContent.appendChild(img);
                } else if (lampiran.startsWith("data:application/pdf")) {
                    const iframe = document.createElement("iframe");
                    iframe.src = lampiran;
                    iframe.width = "100%";
                    iframe.height = "500px";
                    fullViewContent.appendChild(iframe);
                } else if (lampiran.startsWith("data:video")) {
                    const video = document.createElement("video");
                    video.src = lampiran;
                    video.controls = true;
                    fullViewContent.appendChild(video);
                } else {
                    fullViewContent.textContent = "Lampiran tidak dapat ditampilkan.";
                }

                fullViewModal.style.display = "block"; // Tampilkan modal ukuran penuh
            }

            // Tutup modal ketika area luar modal ditekan
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                } else if (event.target == fullViewModal) {
                    fullViewModal.style.display = "none";
                } else if (event.target == filterPopup) {
                    filterPopup.style.display = "none";
                }
            }

            // Tambahkan event listener ke setiap report-item
            document.querySelectorAll(".report-item").forEach(function(item) {
                item.addEventListener("click", function() {
                    const data = {
                        judul: this.querySelector(".title").textContent,
                        user: this.querySelector(".username").textContent,
                        tanggal: this.getAttribute("data-tanggal"),
                        lokasi: this.getAttribute("data-lokasi"),
                        isi: this.getAttribute("data-isi"),
                        lampiran: this.getAttribute("data-lampiran"),
                        id: this.getAttribute("data-id")
                    };
                    showModal(data);
                });
            });

            // Fungsi untuk mencari laporan
            searchInput.addEventListener("keyup", function() {
                const filter = searchInput.value.toLowerCase();
                reportRows.forEach(function(item) {
                    const title = item.querySelector(".title").textContent.toLowerCase();
                    const username = item.querySelector(".username").textContent.toLowerCase();
                    if (title.includes(filter) || username.includes(filter)) {
                        item.style.display = ""; // Tampilkan item
                    } else {
                        item.style.display = "none"; // Sembunyikan item
                    }
                });
            });

            // Tampilkan popup filter saat tombol filter ditekan
            filterBtn.addEventListener("click", function() {
                filterPopup.style.display = filterPopup.style.display === "none" ? "block" : "none";
            });


            // Tutup popup filter saat tombol tutup ditekan
            closeFilterBtn.addEventListener("click", function() {
                filterPopup.style.display = "none";
            });


            // Tambahkan event listener untuk kategori
            filterPopup.querySelectorAll("li").forEach(function(item) {
                item.addEventListener("click", function() {
                    const selectedCategory = this.getAttribute("data-category");

                    // Reset semua kategori untuk menghapus penandaan
                    filterPopup.querySelectorAll("li").forEach(li => {
                        li.classList.remove("selected");
                    });

                    // Tandai kategori yang dipilih
                    this.classList.add("selected");

                    reportRows.forEach(function(report) {
                        const reportCategory = report.getAttribute("data-subjek");
                        if (selectedCategory === 'all' || reportCategory === selectedCategory) {
                            report.style.display = ""; // Tampilkan item
                        } else {
                            report.style.display = "none"; // Sembunyikan item
                        }
                    });
                    filterPopup.style.display = "none"; // Tutup popup setelah memilih kategori
                });
            });
        });
    </script>
</body>
</html>