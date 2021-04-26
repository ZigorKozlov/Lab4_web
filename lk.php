<?php
require "Templates/header.php";
if(!isset($_SESSION['auth']))
{
    echo "<script>document.location.href=\"auth.php?ret=lk.php\";</script>";
    exit;
}

require "DataBase/dataBase.php";
$queryRezult = mysqli_query($link, "SELECT * FROM `parents` WHERE `ID_parent`='" . $_SESSION['auth'] . "'");
$result = mysqli_fetch_array($queryRezult, MYSQLI_ASSOC);

echo '<h1 class="ta-c">Личный кабинет: ' . $result['Surname'] . '  ' . $result['Name'] . '</h1>';
?>
<div class="lk">
    <a class="lk b" href="/groups.php"><?echo "Группы";?></a><br>
    <a class="lk b" href="/lessons.php"><?echo "Занятия";?></a><br/>
    <a class="lk b" href="/app.php"><?echo "Подать заявку на поступление в детский сад";?></a><br>
    <a class="lk b " href="/myApp.php"><?echo "Мои заявки";?></a>
</div>
<?
require "Templates/footer.php";
?>