<?php
    $name=trim(filter_var($_POST["name"],FILTER_SANITIZE_SPECIAL_CHARS));
    $surname=trim(filter_var($_POST["surname"],FILTER_SANITIZE_SPECIAL_CHARS));
    $login=trim(filter_var($_POST["login"],FILTER_SANITIZE_SPECIAL_CHARS));
    $email=trim(filter_var($_POST["email"],FILTER_SANITIZE_SPECIAL_CHARS));
    $password=trim(filter_var($_POST["password"],FILTER_SANITIZE_SPECIAL_CHARS));

$error='';  
if(isset($name) && strlen($name)<2){
    $error="Введите имя от двух букв и более";
} 
else if(isset($surname) && strlen($surname)<2){
    $error="Введите фамилию от двух букв и более";
} 
else if(isset($login) && strlen($login)<8){
    $error="Введите login от 8 букв и более";
} 
else if(isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error="Введите коректный email вместе с @";
} 
else if(isset($password) && strlen($password)<10){
    $error="Введите пароль от 10 символов и более";
}

if ($error!=''){
    echo $error;
    exit();
}

require_once '../db/db_connect.php';
$sql_check_login="SELECT COUNT(*) FROM users WHERE login=?";
$query_check_login=$pdo->prepare($sql_check_login);
$query_check_login->execute([$login]);
$count_login=$query_check_login->fetchColumn();
if($count_login>0){
    $error="Пользователь с таким логином уже существует";
    echo $error;
    exit();
}

$sql_check_email="SELECT COUNT(*) FROM users WHERE email=?";
$query_check_email=$pdo->prepare($sql_check_email);
$query_check_email->execute([$email]);
$count_email=$query_check_email->fetchColumn();
if($count_email>0){
    $error="Пользователь с таким email уже существует";
    echo $error;
    exit();
}
    
$password=password_hash($password,PASSWORD_DEFAULT);

$sql="INSERT INTO users(name,surname,login,email,password) VALUES(?,?,?,?,?)";
$query=$pdo->prepare($sql);
$query->execute([$name,$surname,$login,$email,$password]);

echo "Done";