<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Petugas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #333;
            padding: 20px;
            flex-direction: column;
        }

        h1 {
            color: white;
            margin-bottom: 30px;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
            max-width: 550px;
            width: 100%;
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
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #777;
        }

        a {
            color: #333;
            margin-top: 10px;
            font-size: 15px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>TAMBAH PETUGAS</h1>
    <div class="form-container">
        <form action="proc/tambah_petugas.php" method="POST">
            <div class="form-group">
                <input type="text" name="nama" placeholder="Nama Lengkap *" autocomplete="off" required>
            </div>
            <div class="form-group">
                <input type="text" name="username" placeholder="Username *" autocomplete="off" minlength="3" maxlength="20" required>
            </div>
            <div class="form-group">
                <input type="tel" name="no_telp" placeholder="No. Telp *" autocomplete="off" minlength="12" maxlength="13" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password *" minlength="10" maxlength="20" required>
                <small>Minimal 10 karakter, maksimal 20 karakter, dan diawali huruf kapital. Kombinasi angka, huruf, dan karakter khusus (!@#$%&*).</small>
            </div>
            <button type="submit" class="submit-btn">TAMBAH</button>
        </form>
        <a href="javascript:history.back()">kembali</a>
    </div>
</body>
</html>
