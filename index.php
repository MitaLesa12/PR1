<?php
    /**
     * Простой движок на PHP
     * @author ox2.ru 
     */
    include_once "class/AuthClass.php";
    //Вывод блока авторизации
    $auth = new AuthClass();
    if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода
        if ($_GET["is_exit"] == 1) {
            $auth->out(); //Выходим
            header('Location:?is_exit=0'); //Редирект после выхода
        }
    }
    include_once "class/Engine.php"; //Подключаем класс-движка
    echo '<nav class="menu">';
    include_once "class/TreeOX2.php"; //Подключаем класс меню
    echo '</nav>';
    $engine = new Engine(); //Создаем объект класса Engine 
    include_once "templates/header.php"; //Подключаем шапку сайта
    if ($engine->getError()) { //Если возникли ошибки, выводим сообщение на экран
        echo "<div style='border:1px solid red;padding:10px;margin: 10px auto; 
            width: 500px;'>" . $engine->getError() . "</div>";
    }
    echo $engine->getContentPage(); //Выводим страницы сайта
    include_once "templates/footer.php";//Подключаем подвал сайта
    if (isset($_POST["login"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
    if (!$auth->auth($_POST["login"], $_POST["password"])) { //Если логин и пароль введен не правильно
    echo '<h2 style="color:red;">Логин и пароль введен не правильно!</h2>';
    }
    }
    

    if ($auth->isAuth()) { // Если пользователь авторизован, приветствуем:
    echo "Здравствуйте, " . $auth->getLogin() ;
    echo "<br/><br/><a href='?is_exit=1'>Выйти</a>"; //Показываем кнопку выхода
    }
    else { //Если не авторизован, показываем форму ввода логина и пароля
    ?>
    <form method="post" action="">
    Логин: <input type="text" name="login"
    value="<?php echo (isset($_POST["login"])) ? $_POST["login"] : null; // Заполняем поле по умолчанию ?>" />
    <br/>
    Пароль: <input type="password" name="password" value="" /><br/>
    <input type="submit" value="Войти" />
    </form>
<? } ?>
    //Конец блока автоизации