<?php
session_start();
require_once 'connect.php';

$nickname = $_POST['nickname'];

$checkpass = mysqli_query($connect, "SELECT * FROM `users` WHERE `nickname` = '$nickname' OR `Email` = '$nickname'");
$user = mysqli_fetch_assoc($checkpass);
date_default_timezone_set("Russia/Moscow");
$date = (date("d-m-Y H:i:s"));
if (!empty($user)) {
    $hash = $user['password'];
    if ($password = password_verify($_POST['password'], $hash)) {
        mysqli_query($connect, "UPDATE `users` SET `last_login` = '$date' WHERE `nickname` = '$nickname' OR `Email` = '$nickname'");
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['nickname'] = $user['nickname'];
        $_SESSION['status'] = $user['status'];
        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = 'Неверный пароль или логин';
        header('Location: ../child_page/authorization.php');
    }
} else {
    $_SESSION['message'] = 'Неверный пароль или логин';
    header('Location: ../child_page/authorization.php');
}
