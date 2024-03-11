<!DOCTYPE html>
<html lang="ru">
<head>
<?php 
$Title="Контакты";
require "blocks/head.php";?>
</head>
<body>
    <?php 
    require "blocks/header.php";
    ?>

    <main>
        <h1>Контакты</h1>
        <form>
            <label for="email">Email</label>
            <textarea name="email" id="email"></textarea>

            <label for="mess">Сообщение</label>
            <textarea name="mess" id="mess"></textarea>
            
            <div class="error-mess" id="error-block"></div>

            <button type="button" id="mess_send">Отправить сообщение</button><!--type="button" не происходит перезагрузки странички-->
        </form>
    </main>


    <?php 
    require "blocks/footer.php";
    ?>
    <script>
       $('#mess_send').click(function(){
            let username="<?php echo $_COOKIE['login']; ?>";
            let email=$('#email').val();
            let mess=$('#mess').val();
            
            $.ajax({
                url:'ajax/mail.php',
                type:'POST',
                cache:false,
                data:{'username':username,'email':email,'mess':mess},
                dataType:'html',
                success:function(data){
                    if(data==="Done"){
                        $('#error-block').hide();
                        $('#mess_send').text("Отправленно");
                        $('#email').val('');
                        $('#mess').val('');
                    }else{
                        $('#error-block').show();
                        $('#error-block').text(data);
                    }
                }
            })

       })
        //$ специальный символ в jquery 
        //Благодаря ему мы можем получить доступ к различным элементам 
    </script>

</body>
</html>