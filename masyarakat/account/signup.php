<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
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

        img.daftar {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
            margin-top: 50px;
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

        .terms {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
            color: #555;
        }

        .terms input[type="checkbox"] {
            margin-right: 10px;
        }

        .terms a {
            color: #3b82f6;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
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
    <img src="img/daftar.png" class="daftar">
    <div class="form-container">
        <form action="account/proc/signup.php" method="POST">
            <div class="form-group">
                <input type="text" name="nik" placeholder="NIK *" autocomplete="off" minlength="16" maxlength="16" required>
            </div>
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
            <div class="terms">
                <input type="checkbox" required>
                <label>Saya telah membaca dan menyetujui <a href="">Syarat dan Ketentuan Layanan</a></label>
            </div>
            <button type="submit" class="submit-btn">DAFTAR</button>
        </form>
    </div>
</body>
</html>
