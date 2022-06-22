<?php
session_start();

require_once('../clear_php/connect.php')
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="shortcut icon" href="../img/kusalochka.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>

    <div class="display" id="display">
        <header class="header">
            <!-- название сайта + кусалочка -->
            <div class="header__left">
                <div>
                    <a href="../index.php"><img src="../img/kusalochka.png" alt="" class="left_kus"></a>
                </div>
                <div class="header__left__name_site">
                    <h1 class="header__left__name_site__part">ГКСЖ</h1>
                    <p class="header__left__name_site__part">Геншин как смысл жизни</p>
                </div>
            </div>

            <div class="header__href">
                <a href="/child_page/weapons.php" class="header__href__helping" id="helpingWeap">
                    <h2 class="header__href__name_href" id="name_href_weap">Weapons</h2>
                    <img src="/img/sokol.png" title="weapons" alt="weapons" class="header__href__img" id="img_weap">
                </a>

                <a href="" class="header__href__helping" id="helpingHeroes">
                    <h2 class="header__href__name_href" id="name_href_heroes">Heroes</h2>
                    <img src="/img/lumine.png" title="heroes" alt="heroes" class="header__href__img ">
                </a>

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

        <main class="main_profile_disp">
            <?php
            if ($_SESSION['auth'] == true and $_SESSION['status'] == 10) {
                echo '<div class="tables_admin">';
                echo '<form method="POST" action="" class="main_profile">';
                echo '<nav class="table">';
                $statement = $db->query('SHOW TABLES from genshin');

                $statement->execute();

                $result_array = $statement->fetchAll();
                foreach ($result_array as $key => $value) {
                    foreach ($value as $table_name) {
                        echo '<button type="submit" name="type[' . $table_name . ']" class="table_button">' . $table_name . '</button>';
                    }
                }
                echo '<button type="submit" name="type[profile]" class="table_button">profile</button>';
                if (isset($_POST["type"]["messages"])) {
                    $_SESSION['table'] = 1;
                } else if (isset($_POST["type"]["users"])) {
                    $_SESSION['table'] = 2;
                }


                echo '</nav>';
                echo "</form>";

                if ($_SESSION['table'] === 1) {
                    echo '<div class="name_table">';
                    $sql = "SELECT * FROM messages ORDER BY ID DESC";
                    $statement = $db->prepare($sql);

                    $statement->execute();

                    $result_array = $statement->fetchAll();
                    echo "<form action='../clear_php/delete_message.php' method='POST'>";
                    echo "<table class='table_inf'><tr><td class='table_name_column'>id</td><td class='table_name_column'>nickname</td><td class='table_name_column'>time</td><td class='table_name_column'>message</td><td class='table_name_column'>delete</td></tr>";
                    foreach ($result_array as $result_row) {
                        $text = mb_ereg_replace('(((f|ht){1}(tp|tps){1}://)[-a-zA-Z0-9@:%_\+.~#?(&amp;)//=]+)', '<a href="\\1" target="_blank">\\1</a>', $result_row["message"]);
                        echo "<tr class='table_row'>";
                        echo "<td>" .  $result_row["id"] . "</td>";
                        echo "<td>" .  $result_row["nickname"] . "</td>";
                        echo "<td class='table_time_out'>" .  $result_row["time"] . "</td>";
                        echo "<td class='broken_word'>" .  $text . "</td>";
                        echo "<td><button type='submit' name='delete_row' value='" . $result_row["id"] . "'><img src='../img/delete.png' alt='' class='table_img'></button></td>";
                        echo "</tr>";
                    }
                    echo "</table></form></div>";
                }

                if ($_SESSION['table'] === 2) {
                    echo '<div class="name_table">';
                    $sql = "SELECT * FROM users ORDER BY ID";
                    $statement = $db->prepare($sql);
                    $statement->execute();
                    $result_array = $statement->fetchAll();

                    echo "<form action='../clear_php/delete_user.php' method='POST'>";
                    echo "<table class='table_inf'><tr class='table_row'><td class='table_name_column'>id</td>";
                    echo "<td class='table_name_column'>nickname</td><td class='table_name_column'>Email</td>";
                    echo "<td class='table_name_column'>avatar</td>";
                    echo "<td class='table_name_column'>status</td><td class='table_name_column'>first_login</td>";
                    echo "<td class='table_name_column'>last_login</td><td class='table_name_column'>delete</td></tr>";

                    foreach ($result_array as $result_row) {
                        echo "<tr class='table_row ' id='table_row'>";
                        echo "<td>" .  $result_row["id"] . "</td>";
                        echo "<td>" .  $result_row["nickname"] . "</td>";
                        echo "<td>" .  $result_row["Email"] . "</td>";
                        echo "<td class='broken_word'>" .  $result_row["avatar"] . "</td>";
                        echo "<td>" .  $result_row["status"] . "</td>";
                        echo "<td>" .  $result_row["first_login"] . "</td>";
                        echo "<td>" .  $result_row["last_login"] . "</td>";
                        echo "<td><button type='submit' name='delete_row' value='" . $result_row["id"] . "'><img src='../img/delete.png' alt='' class='table_img'></button></td>";
                        echo "</tr>";
                    }
                    echo "</table></div></form>";
                }
                echo '</div>';
            }
            if ($_SESSION['auth'] == true) {
                echo "<form method='POST' action='../clear_php/download_img_prof.php' enctype='multipart/form-data'>";
                echo "<input type='file' name='avatar'>";
                echo '<button>' . $_SESSION["nickname"] . '</button>';
                echo '<button type="submit">download</button>';
            }
            ?>

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
</body>

</html>