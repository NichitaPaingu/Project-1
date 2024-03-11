<!DOCTYPE html>
<html lang="en">
<?php
$Title="Вход";
require "blocks/head.php"?>
<body>
    <div class="wrapper">
    <?php require "blocks/header.php"?>
    <div class="container">
    <main>
        <?php if(!isset($_COOKIE['login'])):?>
            <h1>Авторизация</h1>
        <form>
            <label for="login">Напишите login, чтобы войти в аккаунт</label>
            <input type="text" name="login" id="login" placeholder="Введите ваш login">

            <label for="password">Напишите пароль</label>
            <input type="password" name="password" id="password" placeholder="Введите ваш пароль">
            
            <div class="error-mess" id="error-block"></div>

            <button type="button" id="enter_user">Войти</button>
        </form>
        <?php else :?>
            <h1><?=$_COOKIE['login']?></h1>
            <form>
                <a href="index.php"><button type="button">Главная</button></a>
                <a href="books.php"><button type="button">Моя Библиотека</button></a>
                <a href="contacts.php"><button type="button">Контакты</button></a>
                <button type="button" id="exit_user">Выйти</button>
            </form>
        <?php endif;?>
    </main>
    
    <?php require "blocks/aside.php"?>
    </div>
    <?php require "blocks/footer.php"?>
    </div>
    <script>
        $("#enter_user").click(function(){
            let login=$("#login").val();
            let password=$("#password").val();

        $.ajax({
            url:'ajax/enter.php',
            type:'POST',
            cache:false,
            data:{'login':login,'password':password},
            dataType:'html',
            success:function(data){
                console.log("Response:",data);
                if(data==="Done"){
                    $('#enter_user').text('Вы вошли в аккаунт');
                    $('#error-block').hide();
                    document.location.reload(true);//перезагрузка страницы
                }
                else{
                    $('#error-block').show();
                    $('#error-block').text(data);
                }
            }
        });
        });
        $("#exit_user").click(function(){
            $.ajax({
                url:'ajax/exit.php',
                type:'POST',
                cache:false,
                data:{},
                dataType:'html',
                success:function(data){
                    document.location.reload(true);
                }
            })
        })
    </script>
</body>
</html>