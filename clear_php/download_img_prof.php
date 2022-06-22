<?php
session_start();
require_once 'connect.php';

$path = 'img_profile/' . time() . $_FILES['avatar']['name'];
//&& ($_FILES[' picture ']['type'] = 'jpeg' or 'jpg' or 'png') - не работает нихуя - найти как сделать
if (($_FILES['avatar']['size'] < 10 * 1024 * 1024 * 8)) {
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
        $id = $_SESSION['id'];
        // $path_old = mysqli_query($connect, "SELECT `avatar` FROM `users` WHERE `id` = '$id'");
        // $row = mysqli_fetch_array($path_old);
        // if ($row['avatar'] != null) {
        //     unlink($row['avatar']);
        // }
        mysqli_query($connect, "UPDATE  `users` SET `avatar` = '$path'  WHERE `id` = '$id'");
    }
} else {
    //сообщение, что файл превышает допустимый размер
}


header('Location: ../index.php');
