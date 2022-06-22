<?php
$host = "localhost";
$user = "root";
$password = "root";
$db_name = "genshin";
$charset = 'utf8';
$dsn = "mysql:host=$host; dbname=$db_name; charset=$charset";

$connect = mysqli_connect($host, $user, $password, $db_name);
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$db = new PDO($dsn, $user, $password, $opt);
