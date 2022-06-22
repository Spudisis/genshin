<?php
session_start();
require_once 'connect.php';

if (isset($_POST['message'])) {
    $message = trim($_POST['message']);
    $db_table = "messages";
    $nick = $_SESSION['nickname'];
    $nickname = $nick;
    date_default_timezone_set("Russia/Moscow");
    $date = (date("d-m-Y H:i:s"));
    if ($message != null) {
        try {
            mysqli_query($connect, "UPDATE `users` SET `last_login` = '$date' WHERE `nickname` = '$nickname' OR `Email` = '$nickname'");
            $db->exec('set names utf8');
            $data = array('message' => $message, 'nickname' => $nickname);
            $query = $db->prepare("INSERT INTO $db_table (message, nickname) values (:message, :nickname)");
            $query->execute($data);
            $result = true;
        } catch (PDOException $e) {
            print "wrong!: " . $e->getMessage() . "<br/>";
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
