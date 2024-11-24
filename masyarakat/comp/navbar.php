<div class="navbar">
    <div class="left-section">
        <a href="index.php"><div class="logo"></div></a>
        <a href='laporan.php'>
            <img src='img/laporan.png' class='laporan'>
        </a>
    </div>
    <div class="right-section">
        <?php
        if (!isset($_SESSION['user'])) {
            echo "
            <a href='account.php?account=signup' class='signup'>
                <img src='img/daftar.png'>
            </a>
            <a href='account.php?account=login' class='login'>
                <img src='img/masuk_button.png'>
            </a>
            ";
        } else {
            $user = $_SESSION['user'];
            echo "
            <a href='account.php?account=history' class='history'><img src='img/history.png'></a>
            <a href='account.php?account=profile' class='profile'>
                <img src='img/user.png'>
                <div class='username'>"."$user"."</div>
            </a>
            ";
        }
        ?>
    </div>
</div>

<style>
    .navbar {
        top: 0;
        position: sticky;
        z-index: 1000;
        background-color: #080053;
        color: white;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* New container for logo and "TENTANG KAMI" */
    .navbar .left-section {
        display: flex;
        align-items: center;
    }

    .left-section img.about_me {
        width: 150px;
        height: auto;
    }

    .left-section img.laporan {
        width: 85px;
        height: auto;
    }

    /* Styling for logo */
    .navbar .logo {
        width: 50px;
        height: 50px;
        background-color: grey;
        border-radius: 8px;
        margin-right: 15px; /* Space between logo and "TENTANG KAMI" */
    }

    .navbar a {
        color: white;
        text-decoration: none;
        padding: 2px 10px;
        margin: 0 15px;
        font-weight: bold;
    }

    .navbar a.login {
        color: #0A0A46;
        background-color: white;
        border-radius: 20px;
    }

    .navbar .right-section {
        display: flex;
        align-items: center;
    }

    .right-section a.signup img {
        width: 80px;
        height: auto;
    }

    .right-section a.login img {
        width: 100px;
        height: auto;
    }

    .right-section a.history img {
        width: 25px;
        height: auto;
    }

    .right-section a.profile {
        display: flex;
        align-items: center;
        text-decoration: none;

    }

    .right-section a.profile img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: white;
        margin-right: 10px;
    }
</style>
