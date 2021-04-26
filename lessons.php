
<?
require "Templates/header.php";
require "DataBase/dataBase.php";
?>
<h1 class="ta-c">Занятия моих детей</h1>
<form action="#" method="post">
	<select name="name_ch" size="1">
		<?
		$sql = "SELECT * FROM `children` INNER JOIN `parenttype` ON `children`.`ID_child`=`parenttype`.`ID_child` LEFT JOIN `parents` ON `parents`.`ID_parent`=`parenttype`.`ID_parent` WHERE `parents`.`ID_parent`='" . $_SESSION['auth'] . "'";
		
		$queryRezult = mysqli_query($link, $sql);
		while ($result = mysqli_fetch_array($queryRezult, MYSQLI_ASSOC)) {
			echo '<option value="'. $result['Name_ch'] .'">'. $result['Name_ch'] .'</option>';
		}
		?>
	</select><br>
	<button class="form_auth_button" type="submit" name="form_auth_submit">Фильтр</button>
	<button class="form_auth_button" type="submit" name="form_auth_unset">Отмена</button>
</form>
<?
if(isset($_POST['form_auth_submit'])) {

	$sql1 = "SELECT * FROM `progress` LEFT JOIN `children` ON `progress`.`ID_child`=`children`.`ID_child`
	INNER JOIN `parenttype` ON `parenttype`.`ID_child`=`progress`.`ID_child`
	LEFT JOIN `lesson` ON `lesson`.`ID_lesson`=`progress`.`ID_lesson`
	LEFT JOIN `employees` ON `lesson`.`ID_employee`=`employees`.`ID_employee`
	WHERE `children`.`Name_ch`='" . $_POST['name_ch'] . "'";

	$queryRezult = mysqli_query($link, $sql1);
} else {
	$sql1 = "SELECT * FROM `progress` LEFT JOIN `children` ON `progress`.`ID_child`=`children`.`ID_child`
	INNER JOIN `parenttype` ON `parenttype`.`ID_child`=`progress`.`ID_child`
	LEFT JOIN `lesson` ON `lesson`.`ID_lesson`=`progress`.`ID_lesson`
	LEFT JOIN `employees` ON `lesson`.`ID_employee`=`employees`.`ID_employee`
	WHERE `parenttype`.`ID_parent`='" . $_SESSION['auth'] . "'";

	$queryRezult = mysqli_query($link, $sql1);
}
	echo '<table border="0" bordercolor="#444" class="data" align="center">';
	echo '
		<tr>
			<th>
				Название занятия
			</th>
			<th>
				Описание
			</th>
			<th>
				Сложность
			</th>
			<th>
				Дата
			</th>
			<th>
				Имя ребёнка
			</th>
			<th>
				Фамилия преподавателя
			</th>
			<th>
				Имя преподавателя
			</th>
			<th>
				Отчество преподавателя
			</th>
			<th>
				Фото преподавателя
			</th>
		</tr>
	';
	while ($result = mysqli_fetch_array($queryRezult, MYSQLI_ASSOC)){
		echo "<tr><td>";
		echo $result['Name_less']."</td>";
		echo "<td>" .$result['Description']."</td>";
		echo "<td>" .$result['Difficulty']."</td>";
		echo "<td>" .$result['Date']."</td>";		
		echo "<td>" .$result['Name_ch']."</td>";
		echo "<td>" .$result['Surname']."</td>";
		echo "<td>" .$result['Name']."</td>";		
		echo "<td>" .$result['Patronymic']."</td>";
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
?>