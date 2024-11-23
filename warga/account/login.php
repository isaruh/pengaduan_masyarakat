<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
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
            background-image: url("img/bg2.png");
            background-repeat: no-repeat;
            background-size: 100% auto;
            padding: 20px;
            flex-direction: column;
        }

        img.masuk {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input[type="text"]::placeholder,
        .form-group input[type="password"]::placeholder {
            color: #aaa;
        }

        .submit-btn {
            width: 100%;
            background-color: #1d1d79;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-btn img {
            width: 60px;
            height: auto;
        }

        .submit-btn:hover {
            background-color: #2e2e9e;
        }

        p {
            color: #1d1d79;
            margin-top: 10px;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <img src="img/masuk.png" class="masuk">
    <div class="form-container">
        <form action="account/proc/login.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username *" autocomplete="off" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password *" required>
            </div>
            <button type="submit" class="submit-btn"><img src="img/masuk.png"></button>
        </form>
        <p>Belum punya akun? <a href="account.php?account=signup">Daftar</a></p>
    </div>
</body>
</html>
