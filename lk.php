<?php
require "Template/header.php";
if(!isset($_SESSION['auth']))
{
    echo "<script>document.location.href=\"auth.php?ret=lk.php\";</script>";
    exit;
}
    require "DB/DB.php";
    $result = mysqli_query($link, "SELECT * FROM `visits` INNER JOIN `sessions` ON `visits`.`session_id`=`sessions`.`id` INNER JOIN `films` on `sessions`.`film_id`=`films`.`id` JOIN `halls`on `sessions`.`hall_id`=`halls`.`id` WHERE `visits`.`user_id`=". $_SESSION['auth']);
    $num_rows = mysqli_num_rows($result);
?>
    <h1>Личный кабинет</h1>
    <span> Куплено билетов: <?echo $num_rows;?></span>
<?
    if($num_rows) {
        echo '<table border="1" bordercolor="#444" class="data">';
        echo '<tr>
                <th>Фильм</th>      
                <th>Время</th>      
                <th>Цена</th>      
                <th>Зал</th>      
                <th>Место</th>      
              </tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>'.$row['Title'].'</td>';
            echo '<td>'.date_format(new DateTime($row['time']), 'd.m.y H:i').'</td>';
            echo '<td>'.$row['TicketPrice'].' руб</td>';
            echo '<td>'.$row['hall_num'].'</td>';
            echo '<td>'.$row['seat'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    mysqli_close($link);
require "Template/footer.php";
?>