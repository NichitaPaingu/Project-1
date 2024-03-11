<!DOCTYPE html>
    <html lang="en">
    <?php
    $Title="Моя Библиотека";
    require "blocks/head.php"?>
    <body>
        <div class="wrapper">
        <?php require "blocks/header.php"?>
        <div class="container">
        <main>
            
            <?php
                require_once 'db/db_connect.php';
                $sql_user_id="SELECT id FROM users WHERE login=?";
                $query_user_id=$pdo->prepare($sql_user_id);
                try{
                    $query_user_id->execute([$_COOKIE['login']]);
                    $user_id=$query_user_id->fetchColumn();

                    $sql="SELECT * FROM books WHERE user_id=? ORDER BY added_at DESC";
                    $query=$pdo->prepare($sql);
                    try{
                        $query->execute([$user_id]);
                        if($count=$query->rowCount()>0){
                        while($row=$query->fetchObject()){
                            echo "<div class='book-container'>
                                    <div class='book-image'>
                                        <img src='$row->image_url' alt='Book Image'>
                                    </div>
                                    <div class='book-info'>
                                        <h1>Время публикации:$row->added_at</h1>
                                        <h2>Название книги: $row->title</h2>
                                        <h2>Автор книги: $row->author</h2>
                                        <h2>Год написания книги: $row->publication_year</h2>
                                        <a href='posts.php?id=$row->id'title=$row->title>Прочитать коментарии</a>
                                    </div>
                                    <div class='comment'>
                                        <h1>Отзыв</h1>
                                        <p><em>$row->comment</em></p>
                                    </div>
                                </div>
                                <hr>";
                        }
                    }
                    else{
                        echo '
                            <form>
                                <a href="index.php"><button type="button">Главная</button></a>
                                <a href="add-book.php"><button type="button">Добавить книгу</button></a>
                                <a href="contacts.php"><button type="button">Контакты</button></a>
                            </form>';
                    }
                    }catch(PDOException $e){
                        echo "Ошибка SQL-запроса".$e->getMessage();
                    }
                }catch(PDOException $e){
                    echo "Ошибка SQL-запроса".$e->getMessage();
                }
            ?>
        </main>
        </div>
        <?php require "blocks/footer.php"?>
        </div>
    </body>
    </html>

