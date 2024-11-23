<div class="navbar">
    <div class="left-section">
        <a href="home.php"><div class="logo"></div></a>
        <a href="solved.php"><img src="img/solved_page.png" class="solved"></a>
        <a href="rejected.php"><img src="img/rejected_page.png" class="rejected"></a>
    </div>
    <div class="right-section">
    </div>
</div>

<style>
    .navbar {
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

    .left-section img.solved {
        width: 80px;
        height: auto;
    }

    .left-section img.rejected {
        width: 100px;
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
        background-color: #ccc;
        margin-right: 10px;
    }
</style>
