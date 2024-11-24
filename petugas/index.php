<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
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

        img.masuk {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
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
            background-color: #333;
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
            background-color: #777;
        }
    </style>
</head>
<body>
    <img src="img/masuk.png" class="masuk">
    <div class="form-container">
        <form action="proc/login.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username *" autocomplete="off" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password *" maxlength="20" required>
            </div>
            <button type="submit" class="submit-btn"><img src="img/masuk.png"></button>
        </form>
    </div>
</body>
</html>
