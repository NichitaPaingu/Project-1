<aside>
<h2 id="ul">Здесь вы можете:</h2>
        <ul>
            <?php if(!isset($_COOKIE['login'])):?>
            <li>Зарегестрироваться</li>
            <li>Добавить свою новую книгу,которую прочитали</li>
            <li>Добавить книгу,которую желаете прочитать</li>
            <li>Оставить отзыв о прочитанной книге</li>
            <li>Оставить коментарий под публикацией о книге другого пользователя</li>
            <?php else:?>
            <li>Добавить свою новую книгу,которую прочитали</li>
            <li>Добавить книгу,которую желаете прочитать</li>
            <li>Оставить отзыв о прочитанной книге</li>
            <li>Оставить коментарий под публикацией о книге другого пользователя</li>
            <?php endif;?>
        </ul>
</aside>