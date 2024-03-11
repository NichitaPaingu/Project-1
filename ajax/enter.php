<?php
    $login=trim(filter_var($_POST['login'],FILTER_SANITIZE_SPECIAL_CHARS));
    $password=trim(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));

    $error='';
   
    if(isset($login)&&strlen($login)<8){
        $error='Неправильный login';
    }else if(isset($pass)&&strlen($pass)<8){
        $error='Неправильный пароль';
    }
    
    if($error!=''){
        echo $error;
        exit();
    }

    require_once '../db/db_connect.php';
    $password=password_hash($password,PASSWORD_DEFAULT);
    $sql="SELECT COUNT(id) FROM users WHERE login=? AND password=?";
    $query=$pdo->prepare($sql);
    $query->execute([$login,$password]);
    if($query->rowCount()==0){
        $error="Такого пользователя не существует";
        echo $error;
        exit();
    }else{
        setcookie('login',$login,time()+3600*24*30,"/GitProjects/project1");
        setcookie('email',$email,time()+3600*24*30,"/GitProjects/project1");
        echo "Done";
    }