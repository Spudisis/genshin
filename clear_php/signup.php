<?php
session_start();
require_once 'connect.php';

$nickname = $_POST['nickname'];
$Email = $_POST['Email'];
$pass = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$status = 1;
date_default_timezone_set("Russia/Moscow");
$date = (date("d-m-Y H:i:s"));
$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `nickname` = '$nickname' OR `Email` = '$Email'");
if (mysqli_num_rows($check_user) > 0) {
    $_SESSION['message'] = 'Такой логин или почта уже существует';
    header('Location: ../authorization.php');
} else {
    if ($pass === $password_confirm) {
        $password = password_hash($pass, PASSWORD_DEFAULT);
        $hash = md5($nickname . time());

        mysqli_query($connect, "INSERT INTO `users` (`password`, `nickname`,`Email`, `status`, `hash`, `email_confirmed`, `first_login`, `last_login`) VALUES ('$password', '$nickname','$Email', '$status', '$hash' , '1','$date','$date')");
        $_SESSION['message'] = 'Регистрация прошла успешно';
        header('Location: ../child_page/authorization.php');
    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../child_page/authorization.php');
    }
}
