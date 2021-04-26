
<?
require "Templates/header.php";
require "DataBase/dataBase.php";
?>
<h1 class="ta-c">Группы</h1>
<form action="#" method="post">
	<select name="ageGroup" size="1">
		<?
		$queryRezult = mysqli_query($link, 'SELECT * FROM `agegroup`');
		while ($result = mysqli_fetch_array($queryRezult, MYSQLI_ASSOC)) {
			echo '<option value="'. $result['Name_ag'] .'">'. $result['Name_ag'] .'</option>';
		}
		?>
	</select><br>
	<button class="form_auth_button" type="submit" name="form_auth_submit">Фильтр</button>
	<button class="form_auth_button" type="submit" name="form_auth_unset">Отмена</button>
</form>
<?
if(isset($_POST['form_auth_submit'])) {
	$queryRezult = mysqli_query($link, "SELECT * FROM `groups` INNER JOIN `agegroup` ON `groups`.`ID_AgeGroup`=`agegroup`.`ID_AgeGroup` INNER JOIN `employees` ON `groups`.`ID_employee`=`employees`.`ID_employee` WHERE`agegroup`.`Name_ag`='" . $_POST['ageGroup'] . "'");
} else {
	$queryRezult = mysqli_query($link, "SELECT * FROM `groups` INNER JOIN `agegroup` ON `groups`.`ID_AgeGroup`=`agegroup`.`ID_AgeGroup` INNER JOIN `employees` ON `groups`.`ID_employee`=`employees`.`ID_employee`");
}
	echo '<table border="0" bordercolor="#444" class="data" align="center">';
	echo '
		<tr>
			<th>
				Название группы
			</th>
			<th>
				Описание
			</th>
			<th>
				Возрастная группа
			</th>
			<th>
				Имя воспитателя
			</th>
			<th>
				Фото воспитателя
			</th>
		</tr>
	';
	while ($result = mysqli_fetch_array($queryRezult, MYSQLI_ASSOC)){
		echo "<tr><td>";
		echo $result['Name_gr']."</td>";
		echo "<td>" .$result['Description_gr']."</td>";
		echo "<td>" .$result['Name_ag']."</td>";
		echo "<td>" .$result['Name']."</td>";		
		//ВЫвод изображения 
		echo '<td>';
		$image = imagecreatefromstring($result['Photo']); 

		ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
		imagejpeg($image, null, 80);
		$data = ob_get_contents();
		ob_end_clean();
		
		echo '<img src="data:image/jpg;base64,' .  base64_encode($data)  . '" width="50" height="50" alt="image"  />';
		
		echo "</td></tr>" ;

	}
	
	echo "</table>";
require "Templates/footer.php";
?>