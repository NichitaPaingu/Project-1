<!DOCTYPE html>
<html lang="en">
<?php
$Title="Регистрация";
require "blocks/head.php"?>
<body>
    <div class="wrapper">
    <?php require "blocks/header.php"?>
    <div class="container">
    <main>
        <form>
            <label for="name">Как вас зовут</label>
            <input type="text" name="name" id="name" placeholder="Введите ваше имя">

            <label for="surname">Какая у вас фамилия</label>
            <input type="text" name="surname" id="surname" placeholder="Введите вашу фамилию">

            <label for="login">Напишите login, который вы желаете использовать в будущем</label>
            <input type="text" name="login" id="login" placeholder="Введите ваш login">

            <label for="email">Напишите существующий email</label>
            <input type="text" name="email" id="email" placeholder="Введите ваш email">

            <label for="password">Напишите пароль для использования</label>
            <input type="password" name="password" id="password" placeholder="Введите ваш пароль">
            
            <div class="error-mess" id="error-block"></div>

            <button type="button" id="reg_user">Зарегестрироваться</button>
            <a href="enter.php"><button type="button" id="enter">Войти</button></a>
        </form>
    </main>
    
    <?php require "blocks/aside.php"?>
    </div>
    <?php require "blocks/footer.php"?>
    </div>
    <script>
        $("#reg_user").click(function(){
            let name=$("#name").val();
            let surname=$("#surname").val();
            let login=$("#login").val();
            let email=$("#email").val();
            let password=$("#password").val();

        $.ajax({
            url:'ajax/register.php',
            type:'POST',
            cache:false,
            data:{'name':name,'surname':surname,'login':login,'email':email,'password':password},
            dataType:'html',
            success:function(data){
                if(data==="Done"){
                    $('#reg_user').text('Вы зарегестрировались');
                    $('#enter').show();
                    $('#error-block').hide();
                    // $('#error-block').hide();
                }
                else{
                    $('#error-block').show();
                    $('#error-block').text(data);
                }
            }
        })
        })
    </script>
</body>
</html>