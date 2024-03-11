<?php
    $title=trim(filter_var($_POST['title'],FILTER_SANITIZE_SPECIAL_CHARS));
    $author=trim(filter_var($_POST['author'],FILTER_SANITIZE_SPECIAL_CHARS));
    $publication_year=trim(filter_var($_POST['publication_year'],FILTER_SANITIZE_SPECIAL_CHARS));
    $img_url=trim(filter_var($_POST['img_url'],FILTER_SANITIZE_SPECIAL_CHARS));
    $comment=trim(filter_var($_POST['comment'],FILTER_SANITIZE_SPECIAL_CHARS));
    

    $error='';
    if(isset($title)&&strlen($title)<4){
        $error="Слишком маленькое название книги";
        echo $error;
        exit();
    }else if(isset($author)&&strlen($author)<6){
        $error="Слишком короткое имя автора";
        echo $error;
        exit();
    }else if(isset($full_text)){
        $error="Вы не оставили никакого отзыва о книге";
        echo $error;
        exit();
    }else if(strtotime($publication_year)===false){
        $error="Неправильный ввод даты издания";
        echo $error;
        exit();
    }else if(@getimagesize($img_url)===false){
        $error="Неправильный ввод адреса картинки";
        echo $error;
        exit();
    }

    require_once '../db/db_connect.php';
    $sql_user_id="SELECT id FROM users WHERE login=?";
    $query_user_id=$pdo->prepare($sql_user_id);
    
    try{
        $query_user_id->execute([$_COOKIE['login']]);
        $user_id=$query_user_id->fetchColumn();

        $sql="INSERT INTO books(title,author,publication_year,user_id,image_url,comment,avtor_publication) VALUES(?,?,?,?,?,?,?)";
        $query=$pdo->prepare($sql);
        try{
            $query->execute([$title,$author,$publication_year,$user_id,$img_url,$comment,$_COOKIE['login']]);
            echo "Done";
        }catch(PDOException $e){
            echo "Ошибка выполнения SQL-Запроса " .$e->getMessage();
        }
    }catch(PDOException $e){
        echo "Ошибка выполнения SQL-Запроса " .$e->getMessage();
    }