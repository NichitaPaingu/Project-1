<?php
    $user='root';
    $password='';
    $port='3306';
    $host='localhost';
    $db='librarylib';

    $dsn="mysql:host=$host;dbname=$db;port=$port";
    $pdo = new PDO($dsn,$user,$password);