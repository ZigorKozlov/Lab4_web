
<?
require "Templates/header.php";
require "DataBase/dataBase.php";
?>
<h1 class="ta-c">Сотрудники</h1>
<form action="#" method="post">
	<select name="surname" size="1">
		<?
		$queryRezult = mysqli_query($link, 'SELECT * FROM `employees` ORDER BY `Salary` ');
		while ($result = mysqli_fetch_array($queryRezult, MYSQLI_ASSOC)) {
			echo '<option value="'. $result['Surname'] .'">'. $result['Surname'] .'</option>';
		}
		?>
	</select><br>
	<button class="form_auth_button" type="submit" name="form_auth_submit">Фильтр</button>
	<button class="form_auth_button" type="submit" name="form_auth_unset">Отмена</button>
</form>
<?
if(isset($_POST['form_auth_submit'])){
	$queryRezult = mysqli_query($link, "SELECT * FROM `employees` WHERE `Surname`='" . $_POST['surname'] . "' ORDER BY `Salary` ");
} else {
	$queryRezult = mysqli_query($link, 'SELECT * FROM `employees` ORDER BY `Salary` ');
}
	echo '<table align="center">';
	echo '
		<tr>
			<th>
				Фамилия
			</th>
			<th>
				Имя
			</th>
			<th>
				Отчество
			</th>
			<th>
				Должность
			</th>
			
			<th>
				Фото
			</th>
		</tr>
	';
	while ($result = mysqli_fetch_array($queryRezult, MYSQLI_ASSOC)){
		echo "<tr><td>";
		echo $result['Surname']."</td>";
		echo "<td>" .$result['Name']."</td>";
		echo "<td>" .$result['Patronymic']."</td>";
		echo "<td>" .$result['Position']."</td>";
		

		
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