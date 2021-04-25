<?
require "Templates/header.php";
require "DataBase/dataBase.php";
?>
<h1 class="ta-c">Новости</h1>
<?
	$sqlQuery = "SELECT * FROM `news` INNER JOIN `employees` ON `news`.`ID_employee` = `employees`.`ID_employee`";

	$sqlResult = mysqli_query($link, $sqlQuery);
	
	echo '<table border="1", align="center">';
		echo '
			<tr>
				<th>
					ФИО сотрудника-публикатора
				</th>
				<th>
					Заголовок новости
				</th>
				<th>
					Тело новости
				</th>
			</tr>
		';
		while ($result = mysqli_fetch_array($sqlResult, MYSQLI_ASSOC)){
			echo "<tr><td>";
			echo $result['Surname'] . ' ' . $result['Name']. ' ' .$result['Patronymic']."</td>";
			echo "<td>" .$result['Head']."</td>";
			echo "<td>" .$result['Statement']."</td></tr>";
		}

		echo "</table>";
require "Templates/footer.php";
?>