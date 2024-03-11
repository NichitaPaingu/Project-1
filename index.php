
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
                    $sql="SELECT * FROM books ORDER BY added_at DESC";
                    $query=$pdo->prepare($sql);
                    try{
                        $query->execute();
                        while($row=$query->fetchObject()){
                            echo "<div class='book-container'>
                                    <div class='book-image'>
                                        <img src='$row->image_url' alt='Book Image'>
                                    </div>
                                    <div class='book-info'>
                                        <h1>Автор публикации:$row->avtor_publication</h1>
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