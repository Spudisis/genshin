<?php
session_start();

$host = "localhost";
$user = "root";
$password = "root";
$db_name = "genshin";
$db = new PDO("mysql:host=$host;dbname=$db_name", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="shortcut icon" href="../img/kusalochka.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>

    <div class="display" id="display">
        <header class="header">
            <!-- php код тут имеется -->
            <div class="header__left">
                <div>
                    <a href="#"><img src="img/kusalochka.png" alt="" class="left_kus"></a>
                </div>
                <div class="header__name_site">
                    <h1 class="head_name">ГКСЖ</h1>
                    <p class="head_name">Геншин как смысл жизни</p>
                </div>

            </div>

            <div class="header__authorization">
                <a href="" class="helping"><img src="/img/sokol.png" title="weapons" alt="weapons" class="header__authorization__img"></a>
                <a href="" class="helping"><img src="/img/lumine.png" title="heroes" alt="heroes" class="header__authorization__img "></a>
                <?php
                echo '<form action="/clear_php/unauth.php" method="POST">';
                echo "<input type='submit'>";
                echo '</form>';
                ?>
            </div>

            <div class="header__authorization_login">
                <?php

                if ($_SESSION['auth'] == false) {
                    echo '<a href="/child_page/authorization.php" class="helping"><img src="/img/login.png" title="login" alt="login" class="header__authorization__img "></a>';
                } else {
                    echo '<a href="/child_page/profile.php" class="helping"> <img src="/img/profile.png" title="login" alt="login" class="header__authorization__img profile"></a>';
                }
                ?>
            </div>
        </header>

        <main class="main">


        </main>
    </div>

    <footer class="footer">
        <div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe iure ab iste pariatur quidem est quisquam animi cupiditate omnis sed dolor quasi veniam iusto minus, totam delectus sit quae enim eum minima reprehenderit nostrum id nemo alias? Obcaecati, optio blanditiis?
        </div>
        <hr>
        <div class="cpr_src">
            <div>&copy;Все картинки спизжены</div>
            <div class="link_communication">
                <a href="https://vk.com/mbdiethisfw" target="_blank"><img class="bot_img" src="/img/vk_icon.png" alt=""></a>
                <a href="https://vk.com/genshin_hata" target="_blank"><img class="bot_img" src="/img/vk_icon.png" alt=""></a>
            </div>
        </div>
    </footer>
    </div>

    <script src="/scripts/scripts.js"></script>
</body>

</html>