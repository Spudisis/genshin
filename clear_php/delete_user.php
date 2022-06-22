<?php
require_once 'connect.php';
try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['delete_row'];

    $sql = "DELETE FROM users WHERE id = $id";
    $statement = $db->prepare($sql);

    $statement->execute();
} catch (PDOException $e) {
}
header("Location: " . $_SERVER['HTTP_REFERER']);
$db = null;
