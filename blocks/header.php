<header>
            <span><a href="index.php" class="logo">LibraryLib</a></span>
                <nav>
                    <?php if(!isset($_COOKIE['login'])):?>
                    <a href="index.php" class="btn">Главная</a>
                    <a href="register.php" class="btn">Регистрация</a>
                    <a href="enter.php" class="btn">Вход</a>
                    <?php else :?>
                    <a href="index.php" class="btn">Главная</a> 
                    <a href="books.php" class="btn">Моя Библиотека</a>
                    <a href="add-book.php" class="btn">Добавить Книгу</a>
                    <a href="contacts.php" class="btn">Контакты</a>
                    <a href="enter.php" class="btn">Кабинет пользователя</a>
                    <?php endif;?>
                </nav>
    </header>