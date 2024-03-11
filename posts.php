<!DOCTYPE html>
    <html lang="en">
    <?php
    require_once 'db/db_connect.php';
    $sql = 'SELECT * FROM books WHERE id = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$_GET['id']]);
    $article = $query->fetch(PDO::FETCH_OBJ);
    $Title=$article->title;
    require "blocks/head.php";
    ?>
    <body>
        <div class="wrapper">
        <?php require "blocks/header.php"?>
        <div class="container">
        <main>
            <?php
                echo "<div class='book-container'>
                        <div class='book-image'>
                            <img src='$article->image_url' alt='Book Image'>
                        </div>
                        <div class='book-info'>
                            <h1>Автор публикации:$article->avtor_publication</h1>
                            <h1>Время публикации:$article->added_at</h1>
                            <h2>Название книги: $article->title</h2>
                            <h2>Автор книги: $article->author</h2>
                            <h2>Год написания книги: $article->publication_year</h2>
                        </div>
                        <div class='comment'>
                            <h1>Отзыв о книге</h1>
                            <p><em>$article->comment</em></p>
                        </div>
                    </div>
                <hr>";
            ?>

            <h3>Коментарии</h3>
            <?php if (isset($_COOKIE['login'])) : ?>
            <form>
            
            <label for="mess">Сообщения</label>
            <textarea name="mess" id="mess"></textarea>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="mess_send">Добавить комментарий</button>
        </form>
        <?php else:?>
            <a href="register.php" class="posts">Регистрация</a>
            <a href="enter.php" class="posts">Вход</a>
        <?php endif;?>
        <div class="comments">
            <?php
            $sql = 'SELECT * FROM comments WHERE article_id = ? ORDER BY id DESC';
            $query = $pdo->prepare($sql);
            $query->execute([$_GET['id']]);
            $comments = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($comments as $el) {
                echo "<div class='coment'>
                    <h2>Пользователь:" . $el->name . "</h2>
                    <p>Время:" . $el->added_at . "</p>
                    <p>" . $el->message . "</p>
                </div>";
            }
            ?>
        </main>
        </div>
        <?php require "blocks/footer.php"?>
        </div>
        <script>
            $('#mess_send').click(function(){
                let mess=$('#mess').val();
                let id=<?php echo (int)$_GET['id'];?>;
                $.ajax({
                    url:'ajax/add_comment.php',
                    type:'POST',
                    cache:false,
                    data:{'mess':mess,'id':id},
                    dataType:'html',
                    success:function(data){
                        if (data === "Done") {
                        $(".comments").prepend(`<div class='coment'>   
                            <h2><?php echo $_COOKIE['login'];?></h2>
                            <p>${mess}</p>
                        </div>`);
                        $("#mess_send").text("Все готово");
                        $("#error-block").hide();
                        $('#mess').val("");
                    } else {
                        $("#error-block").show();
                        $("#error-block").text(data);
                    }
                    }
                })
            })
        </script>
    </body>
    </html>