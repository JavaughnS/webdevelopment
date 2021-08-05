<!DOCTYPE HTML>
<html lang=”en”>
<!-- Completed by Javaughn -->
<html>
	<head>
		<title>PHP Form</title>
		<!-- Embedded style sheet -->
		<style type="text/css">
			body	{font-family: Arial}
			label	{display: inline-block; padding-left: 10px}
			.space	{margin: 10px}
			table	{border: 2px solid black; font-size: 12px}
			table th{padding: 4px; background-color: black; color: white; border: 2px solid black}
			table td{padding: 4px; background-color: lightgray; text-align: center; font-weight: bold; border: 2px solid black}
			.low	{background-color: pink}
			.high	{background-color: lightblue}
			.blank	{background-color: white}
		</style>
	</head>
	
	<?php  // Load Pressure data into a 2D array - data supplied in hPa
		$pressure = array();
		$pressure[0] = array(1017,1016.8,1013.8,1009.7,1025,1009.2,1016,1010.1,1009,1014.7,995.5,1017.3);
		$pressure[1] = array(1020.5,1018.5,1015.6,1018.5,1026.3,1006.5,1018.2,1010.6,1007,1015.6,1007.8,1013.6);
		$pressure[2] = array(1019,1013.1,1014.3,1026,1023.9,1015.5,1019.6,1012.8,1011.6,1018.3,1028.2,1015.4);
		$pressure[3] = array(1015.6,1014.9,1017.9,1021.7,1022.8,1020.3,1019.7,1016.8,1015,1016.6,1035.1,1014.8);
		$pressure[4] = array(1022.4,1013.6,1018.5,1017.1,1020.6,1021.3,1018.5,1018.1,1021.1,1018.2,1029.1,1009.7);
		$pressure[5] = array(1015,1022.8,1019.2,1023.5,1018.8,1014.3,1018.4,1015.6,1023.2,1010.4,1015.7,1022.2);
		$pressure[6] = array(1025.8,1025.5,1024.3,1009.9,1017.9,1011.3,1014.8,1011.8,1014.8,1008,1015.3,1032);
		$pressure[7] = array(1024.2,1015.7,1029.5,1015.4,1015.6,1014.2,1015.7,1013.1,1017,1024.6,1021.2,1032.2);
		$pressure[8] = array(1020.5,1029.2,1027.7,1016.1,1012.9,1020.4,1014.1,1012.5,1017.8,1027.3,1015.4,1014.5);
		$pressure[9] = array(1033.3,1024.1,1017.1,1015.5,1009.6,1012.2,1008.2,1017.7,1012.9,1023.9,1014.9,1016.7);
		$pressure[10] = array(1017.1,1005.3,1008.4,1017,1007,1007.7,1014.3,1019,1014.2,1021.3,1018.6,1023.9);
		$pressure[11] = array(1013.7,1012.6,1009.2,1005.1,1009.9,1011,1020.1,1014.5,1009.7,1021.3,1028.4,1025.2);
		$pressure[12] = array(1009.2,1010.2,1012.7,1009.7,1018.5,1004.9,1022.9,1010.4,1014.4,1023.3,1027.3,1023.8);
		$pressure[13] = array(1024,1009.8,1019.7,1018.7,1018,1013.3,1024.5,1016.4,1019.8,1027,1017.5,1023.1);
		$pressure[14] = array(1028,1014.3,1011.9,1018.1,1005.5,1016,1024.4,1019.5,1019.2,1020.1,1017.6,1008.9);
		$pressure[15] = array(1013.5,1016.9,1012.9,1016.8,1010.1,1008.8,1023.7,1020.8,1023.8,1009.4,1019.6,1019.5);
		$pressure[16] = array(1019.7,1019.9,1023.1,1026.3,1021.3,1011.1,1020.8,1024.1,1029.5,1009.3,1004.6,1015.3);
		$pressure[17] = array(1025.8,1021.1,1017.1,1010.8,1022.5,1015.2,1016.1,1022,1022.4,1010.6,1003.9,1016.9);
		$pressure[18] = array(1010.2,1004.6,1006.5,999.6,1017.8,1020.6,1008.1,1018.2,1018.1,1008.6,1024.8,1014.8);
		$pressure[19] = array(1010.9,1015.2,1010.9,1017,1014,1023,1008.1,1018.7,1011.3,1012.3,1032.8,1011.5);
		$pressure[20] = array(1015.6,1026.3,1008.9,1036.5,1009.1,1022.8,1014.8,1018.4,1005.1,1010.9,1027.9,1010);
		$pressure[21] = array(1020.1,1021.8,1011.7,1031.3,1006,1017.3,1012.3,1014.3,1013.6,1010.1,1020.8,1008.1);
		$pressure[22] = array(1022.9,1012.8,1016.4,1020.9,1007.3,1015.7,1005.3,1019.5,1020.5,1009,1022.8,1020.5);
		$pressure[23] = array(1030.4,1015,1013.1,1008.8,1021.8,1014.5,1013.3,1026,1019.6,1013.1,1030.6,1028.4);
		$pressure[24] = array(1025.8,1022.8,1005.6,1021.9,1024.9,1010.4,1019.1,1023.9,1016.3,1021.6,1023.9,1030.1);
		$pressure[25] = array(1025,1016.8,1012,1030.3,1023.8,1008.6,1018.1,1015.9,1018.9,1011,1017.5,1021.6);
		$pressure[26] = array(1032.4,1003.4,1016.9,1026.8,1023,1006,1011.3,1012.4,1024,1015.4,1010.2,1024);
		$pressure[27] = array(1016.7,1003.7,1021.5,1018.6,1016.1,1000.5,1011.4,1011.8,1023.6,1024.4,1026.1,1016.6);
		$pressure[28] = array(1012.5,-1,1022.7,1014.7,1013.1,1001.5,1017,1016.2,1017.1,1030.4,1038,1008.1);
		$pressure[29] = array(991.6,-1,1020.9,1019,1017,1009.8,1021.4,1011.2,1014.7,1023.3,1030.2,1021);
		$pressure[30] = array(997,-1,1007.1,-1,1014.8,-1,1018,1007.9,-1,1006.2,-1,1020.8);
					if ($_POST != null)
						$unitsselected = $_POST['pressUnit'];
					else
						$unitsselected = "kPa";
	?>
	<body>
		<h1>PHP Form<br>Hamilton Pressure Data for 2013</h1>
		<form id = "lab6bform" name = "pressureData" method = "post" action = "<?=$_SERVER['PHP_SELF'] ?>">
			<label for = "kPa">kPa</label><input type = "radio" id = "kPa" name = "pressUnit" value = "kPa" <?php echo $unitsselected == "kPa" ? "checked": "";?>>
			<label for = "mmHg">mmHg</label><input type = "radio" id = "mmHg" name = "pressUnit" value = "mmHg" <?php echo $unitsselected == "mmHg" ? "checked": "";?>>
			<label for = "atm">atm.</label><input type = "radio" id = "atm" name = "pressUnit" value = "atm" <?php echo $unitsselected == "atm" ? "checked": "";?>>
			<label for = "psi">psi</label><input type = "radio" id = "psi" name = "pressUnit" value = "psi" <?php echo $unitsselected == "psi" ? "checked": "";?>>
			<input class = "space" type = "submit" value = "Update">
			<table>
			<?php
					date_default_timezone_set('America/Toronto');
					echo"<tr><th></th>";
					for ($month = 1; $month <= 12; $month++) {
						$monthName =  date("M", mktime(0, 0, 0, $month, 1, 2013));
						echo "<th>".$monthName."</th>";
					}
					/* Process unit selection */
					switch ($unitsselected) {
						case "mmHg":
							foreach ($pressure as $key => $day){
								$key += 1;
								echo "<tr><th>".$key."</th>";
								foreach ($day as $month){
									$pressOut = $month / 1013.25 * 760.0;
									if ($month < 1000.0 && $month >= 0)
										printf("<td class='low'>%.1f</td>", $pressOut);
									elseif ($month > 1030.0)
										printf("<td class='high'>%.1f</td>", $pressOut);
									elseif ($month == -1)
										echo "<td class='blank'></td>";
									else
										printf("<td>%.1f</td>", $pressOut);
								}
								echo "</tr>";
							}
							break;
						case "atm":
							foreach ($pressure as $key => $day){
								$key += 1;
								echo "<tr><th>".$key."</th>";
								foreach ($day as $month){
									$pressOut = $month / 1013.25;
									if ($month < 1000.0 && $month >= 0)
										printf("<td class='low'>%.4f</td>", $pressOut);
									elseif ($month > 1030.0)
										printf("<td class='high'>%.3f</td>", $pressOut);
									elseif ($month == -1)
										echo "<td class='blank'></td>";
									else
										printf("<td>%.3f</td>", $pressOut);
								}
								echo "</tr>";
							}
							break;
						case "psi":
							foreach ($pressure as $key => $day){
								$key += 1;
								echo "<tr><th>".$key."</th>";
								foreach ($day as $month){
									$pressOut = $month / 1013.25 * 14.70;
									if ($month < 1000.0 && $month >= 0)
										printf("<td class='low'>%.2f</td>", $pressOut);
									elseif ($month > 1030.0)
										printf("<td class='high'>%.2f</td>", $pressOut);
									elseif ($month == -1)
										echo "<td class='blank'></td>";
									else
										printf("<td>%.2f</td>", $pressOut);
								}
								echo "</tr>";
							}
							break;
						default:
							foreach ($pressure as $key => $day){
								$key += 1;
								echo "<tr><th>".$key."</th>";
								foreach ($day as $month){
									$pressOut = $month / 10;
									if ($month < 1000.0 && $month >= 0)
										printf("<td class='low'>%.2f</td>", $pressOut);
									elseif ($month > 1030.0)
										printf("<td class='high'>%.1f</td>", $pressOut);
									elseif ($month == -1)
										echo "<td class='blank'></td>";
									else
										printf("<td>%.1f</td>", $pressOut);
								}
								echo "</tr>";
							}
							break;
					}
				?>
			</table>
		</form>
		<footer><p>&copy; Solution by Javaughn </p></footer>
	</body>
</html>