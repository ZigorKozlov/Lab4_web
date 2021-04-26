<?php session_start()?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Детский сад 45 Малыш</title>
    <link rel="stylesheet" href="/css_file/style.css?version=0.13">
</head>
<body>
<header>
    <div class="text">
        <img src="http://lab4/resources/logo.jpg" width="100" height="100" alt="image">
        <span class="title">Малыш</span>
        <div id="pages">
            <a href="/index.php">Главная</a>
            <a href="/reviews.php">Сотрудники</a>
            <a href="/contact.php">Контакты</a>
            <a href="/news.php">Новости</a>
        </div>
        <div class="right">
            <?
            if(isset($_SESSION['auth']))
            {
                require "DataBase/dataBase.php";
                $result = mysqli_query($link, 'SELECT * FROM `parents` WHERE `ID_parent`=' . $_SESSION['auth']);
                $login = mysqli_fetch_assoc($result)['Login'];
                ?>
                <a class="auth login" href="/logout.php"><?echo "Выход";?></a>
                <a class="auth login" href="/lk.php"><?echo $login;?></a>
                <?
                mysqli_close($link);
            }
            else
            {
                ?>
                <a class="auth" href="/reg.php">Регистрация</a>
                <a class="auth" href="/auth.php">Авторизация</a>
                <?
            }?>
        </div>
    </div>
    <?
    //echo $actual_link;
    ?>
</header>
<div class="container">
