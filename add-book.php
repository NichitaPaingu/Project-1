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
        <label for="title">Название книги</label>
            <input type="text" name="title" id="title" placeholder="Напишите название книги">

            <label for="author">Автор</label>
            <input type="text" name="author" id="author" placeholder="Напишите автора книги">

            <label for="publication_year">Год издания</label>
            <input type="text" name="publication_year" id="publication_year" placeholder="1889">

            <label for="img_url">Вставьте адрес фотографии книги с интернета</label>
            <input type="text" name="img_url" id="img_url" placeholder="https://static-cse.canva.com/blob/191106/00_verzosa_winterlandscapes_jakob-owens-tb-2640x1485.jpg">
            
            <label for="comment">Отзыв о книге</label>
            <textarea name="comment" id="comment"></textarea>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="add_book">Добавить книгу</button>

            <a href="add-book.php"><button type="button" id="add_book_new">Добавить еще одну книгу</button></a>
            
        </form>
    </main>
    </div>
    <?php require "blocks/footer.php"?>
    </div>
    <script>
        $("#add_book").click(function(){
            let title=$("#title").val();
            let author=$("#author").val();
            let publication_year=$("#publication_year").val();
            let img_url=$("#img_url").val();
            let comment=$("#comment").val();

        $.ajax({
            url:'ajax/add_book.php',
            type:'POST',
            cache:false,
            data:{'title':title,'author':author,'publication_year':publication_year,'img_url':img_url,'comment':comment},
            dataType:'html',
            success:function(data){
                if(data==="Done"){
                    $('#add_book').text('Книга добавлена');
                    $('#add_book').prop('disabled', true);
                    $('#add_book_new').show();
                    $('#error-block').hide();
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