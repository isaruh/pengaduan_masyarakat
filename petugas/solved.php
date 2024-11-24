<?php
session_start();
if (!isset($_SESSION['petugas'])) {
    header('Location: index.php');
}

include "conn/conn.php";

$sql = "SELECT * FROM pengaduan WHERE status = 'solved' ORDER BY created_at DESC";
$result_pengaduan = $conn->query($sql);

$sql = "SELECT id_pengaduan, isi FROM tanggapan ORDER BY created_at DESC";
$result_tanggapan = $conn->query($sql);

$list_tanggapan = [];
if ($result_tanggapan->num_rows > 0) {
    while ($row = $result_tanggapan->fetch_assoc()) {
        $list_tanggapan[] = [
            "id_pengaduan" => $row['id_pengaduan'],
            "isi_pengaduan" => $row['isi']
        ];
    }
} else {
    $list_tanggapan[] = [
        "id_pengaduan" => null,
        "isi_pengaduan" => "Tidak ada tanggapan."
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsolved</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url("img/bg2.png");
            background-repeat: no-repeat;
            background-size: 100% auto;
            background-attachment: fixed;
        }

        .search-container {
            padding: 20px 40px 30px;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            z-index: 999;
            background-image: url("img/bg2.png");
            background-repeat: no-repeat;
            background-size: 100% auto;
            display: flex;
            justify-content: space-between;
        }

        .search-box {
            display: flex;
            align-items: center;
            width: 60%;
            background-color: white;
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

        .report-list {
            margin: 100px 40px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .report-item {
            background-color: white;
            padding: 15px 30px;
            border-radius: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

        .report-list .no-report h2 {
            color: white;
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
            margin: 8% auto 12px auto;
            padding: 20px 40px;
            border-radius: 20px;
            width: 80%;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .modal-content.tanggapan {
            margin-top: 10px;
            margin-bottom: 8%;
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
        }

        .modal-footer .footer-left img {
            width: 70px;
            height: auto;
        }

        .modal-footer .footer-right a.reject {
            color: black;
            text-decoration: none;
            font-weight: bold;
            margin-right: 15px;
        }

        .modal-footer .footer-right a.send {
            color: white;
            background-color: #080053;
            padding: 5px 25px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .modal-content.tanggapan {
            margin-top: 10px;
            margin-bottom: 8%;
        }

        .modal-content.tanggapan #modalTanggapan p {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
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
    </style>
</head>
<body>
    <?php include "comp/navbar.php"; ?>

    <div class="search-container">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari...">
            <img src="img/search.png" alt="Search Icon">
        </div>
    </div>

    <div class="report-list">
        <?php
        if ($result_pengaduan->num_rows > 0) {
            while ($row = $result_pengaduan->fetch_assoc()) {
                $status = $row['status'] == "n" ? '' : "<img src='img/".$row['status'].".png'>";

                // Menambahkan prefix MIME secara manual berdasarkan tipe file
                $mimeType = $row['mime_lampiran'];  // Ambil tipe MIME dari kolom `mime_type`
                $fileData = base64_encode($row['file_lampiran']);
                $lampiran = "data:$mimeType;base64,$fileData";

                $tanggapan = [];
                foreach ($list_tanggapan as $tanggapan_item) {
                    if (isset($tanggapan_item['id_pengaduan']) && $tanggapan_item['id_pengaduan'] === $row['id']) {
                        $tanggapan[] = $tanggapan_item['isi_pengaduan'];
                    }
                }

                echo "
                <div class='report-item'
                    data-id='".$row['id']."' 
                    data-lokasi='".$row['lokasi']."' 
                    data-tanggal='".$row['tanggal']."' 
                    data-isi='".$row['isi']."' 
                    data-lampiran='".$lampiran."' 
                    data-tanggapan='".json_encode($tanggapan, JSON_HEX_APOS)."'>
                    <div class='report-info'>
                        <div class='title'>".$row['judul']."</div>
                        <div class='username'>".$row['user']."</div>
                    </div>
                    <div class='status'>".$status."</div>
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
        </div>
        <div class="modal-content tanggapan">
            <h3>Tanggapan</h3>
            <p id="modalTanggapan">
                Isi tanggapan.
            </p>
        </div>
    </div>

    <div id="fullViewModal" class="modal">
        <div class="modal-content full-view">
            <span class="close" onclick="document.getElementById('fullViewModal').style.display='none'"></span>
            <div id="fullViewContent" class="fullViewContent"></div>
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

            // Fungsi untuk menampilkan modal dengan data laporan
            function showModal(data) {
                document.getElementById("modalJudul").textContent = data.judul;
                document.getElementById("modalUsername").textContent = data.user;
                document.getElementById("modalTanggal").textContent = data.tanggal;
                document.getElementById("modalLokasi").textContent = data.lokasi;
                document.getElementById("modalIsi").textContent = data.isi;

                // Reset dan tampilkan tanggapan
                const modalTanggapan = document.getElementById("modalTanggapan");
                modalTanggapan.innerHTML = ""; // Reset konten tanggapan
                if (data.tanggapan && data.tanggapan.length > 0) {
                    data.tanggapan.forEach(function(tanggapan) {
                        const p = document.createElement("p");
                        p.textContent = tanggapan;
                        modalTanggapan.appendChild(p);
                    });
                } else {
                    modalTanggapan.textContent = "Tidak ada tanggapan.";
                }

                modalLampiran.innerHTML = ""; // Reset thumbnail
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
                        id: this.getAttribute("data-id"),
                        tanggapan: JSON.parse(this.getAttribute("data-tanggapan"))
                    };
                    showModal(data);
                });
            });

            // Fungsi untuk mencari laporan
            searchInput.addEventListener("keyup", function() {
                const filter = searchInput.value.toLowerCase();
                reportItems.forEach(function(item) {
                    const title = item.querySelector(".title").textContent.toLowerCase();
                    const username = item.querySelector(".username").textContent.toLowerCase();
                    if (title.includes(filter) || username.includes(filter)) {
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