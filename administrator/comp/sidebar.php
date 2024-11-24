<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
    <ul>
        <li><a href="solved.php" class="<?= $current_page == 'solved.php' ? 'active' : '' ?>">Solved</a></li>
        <li><a href="pending.php" class="<?= $current_page == 'pending.php' ? 'active' : '' ?>">Pending</a></li>
        <li><a href="rejected.php" class="<?= $current_page == 'rejected.php' ? 'active' : '' ?>">Rejected</a></li>
        <li><a href="unprocessed.php" class="<?= $current_page == 'unprocessed.php' ? 'active' : '' ?>">Unprocessed</a></li>
        <li><a href="petugas.php" class="<?= $current_page == 'petugas.php' ? 'active' : '' ?>">Petugas</a></li>
        <li><a href="account.php" class="<?= $current_page == 'account.php' ? 'active' : '' ?>"><img src="img/user.png"></a></li>
    </ul>
</div>

<style>
    .sidebar {
        flex: 0 0 200px; /* Sidebar memiliki lebar tetap */
        border-right: 1px solid #333;
        padding: 20px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .sidebar li {
        margin-bottom: 10px;
    }

    .sidebar li:nth-child(4) {
        margin-bottom: 30px;
    }

    .sidebar li:last-child {
        margin-top: auto;
    }

    .sidebar a {
        text-decoration: none;
        color: #333;
        display: block;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .sidebar a:hover {
        background-color: #eee;
    }

    .sidebar a.active {
        border: 1px solid #000;
        font-weight: bold;
    }

    .sidebar a img {
        width: 30px;
        height: auto;
    }
</style>