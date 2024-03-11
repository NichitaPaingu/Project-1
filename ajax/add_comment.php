<?php
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));
$id = $_POST['id'];

$error = '';
if(strlen($mess) < 5)
    $error = 'Введите сообщение';

if ($error != '') {
    echo $error;
    exit();
}

require_once "../db/db_connect.php";

$sql = 'INSERT INTO comments(article_id,name, message) VALUES(?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$id,$_COOKIE['login'], $mess]);

echo "Done";
