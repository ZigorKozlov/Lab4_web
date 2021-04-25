<?
require "Templates/header.php";
?>
<h1 class="ta-c">Регистрация</h1>
<?
if(!isset($_SESSION['auth'])) {
    if(empty($_POST)) {
        ?>
        <form action="#" method="post">
            <label>Введите Ваш Логин</label>
            <input type="text" name="reg_login" placeholder="Логин" required>
            <label>Введите Ваш пароль</label>
            <input type="password" name="reg_pass" placeholder="Пароль" required>
            <label>Введите Вашу фамилию</label>
            <input type="text" name="reg_surname" placeholder="Фамилия" required>
            <label>Введите Ваше имя</label>
            <input type="text" name="reg_name" placeholder="Имя" required>
            <label>Введите Ваше отчество</label>
            <input type="text" name="reg_patr" placeholder="Отчество" required>
            <label>Введите Ваш телефон</label>
            <input type="text" name="reg_phone" placeholder="Фамилия" required>
            <label>Введите Ваш email</label>
            <input type="email" name="reg_email" placeholder="Email" required>
            
            <button class="form_auth_button" type="submit" name="form_auth_submit">Зарегистрироваться</button>
        </form>
        <?
    }
    else
    {
        require "DataBase/dataBase.php";
        $result = mysqli_query($link,"INSERT INTO `parents` (`Surname`, `Name`, `Patronymic`, `Phone`, `Mail`, `Login`, `Password`) VALUES ('" . $_POST["reg_surname"]. "','" . $_POST["reg_name"]. "', '" . $_POST["reg_patr"]. "','" . $_POST["reg_phone"]. "','" . $_POST["reg_email"]. "','" . $_POST["reg_login"]. "','" . $_POST["reg_pass"]. "')");
        if($result)
        {
            $result = mysqli_query($link,"SELECT * FROM `parents` WHERE `Login`='". $_POST["reg_login"]."'");
            if(mysqli_num_rows($result))
            {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['auth'] = $row['ID_parent'];
                ?>
                <span>
                    Вы успешно зарегистрированы!
                </span>
                <?
                echo "<script>setTimeout(()=>{document.location.href=\"index.php/\";}, 10)</script>";
                exit;
            }
            else
            {
                ?>
                <span>Вы ввели неверный логин или пароль!</span>
                <?
            }
        }
        else
        {
            ?>
            <span>Пользователь с данным Логином уже существует!</span>
            <?
        }
        mysqli_close($link);
    }
} else {
    ?>
    <span>Вы уже авторизованы!</span>
    <?
}
?>
