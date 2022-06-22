<?php
session_start();
require_once('clear_php/connect.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="shortcut icon" href="/img/kusalochka.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
    <!-- сброс стилей -->
    <link rel="stylesheet" href="style/normalize.css">
    <!-- новый шрифт -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="display">
        <header class="header">
            <!-- название сайта + кусалочка -->
            <div class="header__left">
                <div>
                    <a href="#"><img src="img/kusalochka.png" alt="" class="left_kus"></a>
                </div>
                <div class="header__left__name_site">
                    <h1 class="header__left__name_site__part">ГКСЖ</h1>
                    <p class="header__left__name_site__part">Геншин как смысл жизни</p>
                </div>
            </div>

            <div class="header__href">
                <a href="" class="header__href__helping" id="helpingWeap">
                    <h2 class="header__href__name_href" id="name_href_weap">Weapons</h2>
                    <img src="/img/sokol.png" title="weapons" alt="weapons" class="header__href__img" id="img_weap">
                </a>

                <a href="" class="header__href__helping" id="helpingHeroes">
                    <h2 class="header__href__name_href" id="name_href_heroes">Heroes</h2>
                    <img src="/img/lumine.png" title="heroes" alt="heroes" class="header__href__img ">
                </a>
                <!-- потом удалить -->
                <?php
                echo '<form action="/clear_php/unauth.php" method="POST">';
                echo "<input type='submit'>";
                echo '</form>';
                ?>

            </div>
            <div class="header__href__helping">
                <?php
                if ($_SESSION['auth'] == false) {
                    echo '<a href="/child_page/authorization.php"><img src="/img/login.png" title="login" alt="login" class="header__href__img"></a>';
                } else {
                    echo '<a href="/child_page/profile.php"> <img src="/img/profile.png" title="login" alt="login" class="header__href__img"></a>';
                }
                ?>
            </div>
        </header>

        <main class="main">
            <div class="message_page">
                <?php
                // отправка сообщений
                if ($_SESSION['auth'] == true) {
                    echo '<form method="POST" action="/clear_php/send_message.php">';
                    echo '<div class="cl_send_msg">';
                    echo '<textarea contenteditable name="message" placeholder="Сообщение" id="send_message" cols="30" rows="10" value=""></textarea>';
                    echo '<input type="submit" value="" id="nullit">';
                    echo '</div></form>';
                }
                ?>
                <div class="message_page__old">
                    <?php
                    $messages = "SELECT * FROM messages ORDER BY ID DESC LIMIT 15";
                    $users = "SELECT * FROM users ORDER BY ID";

                    $statement_message = $db->prepare($messages);
                    $statement_users = $db->prepare($users);

                    $statement_message->execute();
                    $statement_users->execute();

                    $result_array = $statement_message->fetchAll();
                    $result_array2 = $statement_users->fetchAll();

                    echo "<form action='/clear_php/delete.php' method='POST'>";
                    foreach ($result_array as $result_row) {
                        foreach ($result_array2 as $result_row2) {
                            if ($result_row2['nickname'] == $result_row['nickname']) {
                                if ($result_row2['avatar'] == NULL) {
                                    $avatar = 'img/lumine.png';
                                } else {
                                    $avatar = $result_row2['avatar'];
                                }
                            }
                        }
                        $text = mb_ereg_replace('(((f|ht){1}(tp|tps){1}://)[-a-zA-Z0-9@:%_\+.~#?(&amp;)//=]+)', '<a href="\\1" target="_blank">\\1</a>', $result_row["message"]);
                        echo "<div class='message'>";
                        echo "<div class='message_nick_time'>";
                        echo "<img src='$avatar' alt=''  class='message_img_profile'>";
                        echo "<p class='message_nick'>" .  $result_row["nickname"] . "</p>";
                        echo "<p class='message_time'>" .  "&nbsp;&nbsp;" . $result_row["time"] . "</p>";
                        echo "</div>";
                        echo "<p class='message_text'>" . "&nbsp;&nbsp;" . $text . "</p>";
                        echo "</div>";
                    }
                    echo "</form>"
                    ?>
                </div>
            </div>

            <nav class="banners_page">
                <div class="checkList">

                </div>
                <div class="checkList">
                    <div class="timer">
                        <div id="counter" class="timer__counter">
                            <span>
                                <p id="day" class="test_input"></p>
                            </span>
                            <span>
                                <p id="hour" class="test_input"></p>
                            </span>
                            <span>
                                <p id="min" class="test_input"></p>
                            </span>
                            <span>
                                <p id="sec" class="test_input"></p>
                            </span>

                        </div>
                        <script src="/scripts/timer.js"></script>
                    </div>
                </div>
            </nav>
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