<?
require "Templates/header.php";
?>
    <h1 class="ta-c">Авторизация</h1>
    <?
if(!isset($_SESSION['auth'])) {
    if(empty($_POST)) {
        ?>
        <form action="#" method="post">
            <label>Введите Ваш Логин</label>
            <input type="text" name="auth_login" placeholder="Логин" required>
            <label>Введите Ваш пароль</label>
            <input type="password" name="auth_pass" placeholder="Пароль" required>

            <button class="form_auth_button" type="submit" name="form_auth_submit">Войти</button>
        </form>
        <?
    }
    else
    {
        require "DataBase/dataBase.php";
        $result = mysqli_query($link, 'SELECT * FROM `parents` WHERE `login`=\'' . $_POST['auth_login'].'\' AND `password`=\'' . $_POST['auth_pass'].'\'');
        if(mysqli_num_rows($result))
        {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['auth'] = $row['ID_parent'];
            ?>
            <span>
                Вы успешно авторизованы! 
            </span>
            <?
            echo "<script> setTimeout(()=>{document.location.href=\"index.php/\";}, 10) </script>";
            exit;
        }
        else
        {
            ?>
                <span>Вы ввели неверный логин или пароль!</span>
            <?
        }
        mysqli_close($link);
    }
} else {
    ?>
        <span>Вы уже авторизованы!</span>
    <?
}
require "Templates/footer.php";
?>
