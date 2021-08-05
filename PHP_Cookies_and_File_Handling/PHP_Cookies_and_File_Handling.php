<!DOCTYPE html>
<html lang=”en”>
<!-- Completed by Javaughn -->
<?php
	//Create an empty cookie with a lifespan of one day
	$cookie_lifespan = 60 * 60 * 24;
	$expires = time() + $cookie_lifespan;
	setcookie("User", null, $expires, "/");
?>
<html>
	<head>
		<title>Cookies and File Handling</title>
		<!-- Embedded style sheet -->
		<style>
			body  {
				font-family:arial;
				font-size:11pt; 
				width:800px;
				margin-left:auto;
				margin-right:auto
			}
			h1 {text-align:center;}

			table {
				border:1px solid black; 
				border-collapse:collapse;
				margin:0px;}

			table th {
				padding:3px;
				border:1px solid lightgray; 
				color:white; 
				background-color:black
			}

			table td {
				padding:3px;
				border:1px solid lightgray; 
				font-weight:bold; 
				text-align:center
			}

			.note {
				padding:5px; 
				border:1px solid black; 
				background-color:green; 
				color:white; 
				font-weight:bold;
			}

			.err{
				padding:5px; 
				background-color:red; 
				color:white; 
				font-weight:bold;
			}

			.on	{background-color:green; color:white;}
			.off{background-color:darkgray; color:white;}

			.vertical {width:120px;display:inline;}

			.horizmenu {display:block; background-color:gray; width:100%; padding:10px; text-align:center;}
			.horizmenu li {display:inline; background-color:gray; color:black; padding:5px 10px}
			.horizmenu li a {background-color:gray; color:black; font-weight:bold;text-decoration:none;padding:5px 10px}
			.horizmenu li a:hover {background-color:black; color:white;}

			input,label,legend {font-weight:bold;font-size:14pt;}
			
			switchBox{width:10px}
		</style>
	</head>
	<body>

		<h1>Switch Tracker</h1>
		<ul class="horizmenu">
		<li><a href="<?= $_SERVER['PHP_SELF']?>?option=reset">Clear Data File Contents</a></li>
		<li><a href="switchlog.txt" target="_blank">Display Data File Contents</a></li>
		<li><a href="<?= $_SERVER['PHP_SELF']?>?option=fullOn&userid=<?php echo isset($_POST['userid']) ? $_POST['userid']: "";?>">All switches ON</a></li>
		<li><a href="<?= $_SERVER['PHP_SELF']?>?option=fullOff&userid=<?php echo isset($_POST['userid']) ? $_POST['userid']: "";?>">All switches OFF</a></li>
		</ul>
		<?php 
			date_default_timezone_set('America/Toronto');
			$FILENAME = "switchlog.txt";
			if (!file_exists($FILENAME)) {
					$fp = fopen($FILENAME, "w");
					fclose($fp);
				}
		/* Process POST */	
			if ($_POST != null) {
				$switchState = $_POST['switchState'];
				
				$cookie_user = $_POST['userid'];
				$_COOKIE['User'] = $cookie_user;
						
				$timestamp = date("M j Y h:i:s a");
				$dataLog = array("", "", "", "", "", "");
						
				$dataLog[0] = $timestamp;
				$dataLog[6] = $cookie_user;
				for ($key = 0; $key <= 4; $key++){
					$dataLog[$key+1] = $switchState[$key];
				}
						
				$fp = fopen($FILENAME, "a+");
				
				fputcsv($fp, $dataLog, ",");
				fclose($fp);
				echo "<div class = 'note'>Changes successfully logged $timestamp.</div>";
				
			}else {
				setcookie("User", null, time() - 3600, "/");
				$switchState = array("OFF", "OFF", "OFF", "OFF", "OFF");
			}
			
		/* Process menu items */
			if (isset($_GET['option'])){
				$option = $_GET['option'];
				
				switch ($option){
					case "reset":
						$fp = fopen($FILENAME, "w");
						fclose($fp);
						setcookie("User", null, time() - 3600, "/");
						
						echo "<div class = 'note'>Data file cleared successfully. Cookie cleared successfully.</div><br/>";
						break;
					case "fullOn":
						isset($_GET['userid']) ? $_COOKIE['User'] = $_GET['userid']: "";
						$switchState = array("ON", "ON", "ON", "ON", "ON");
						break;
					case "fullOff":
						isset($_GET['userid']) ? $_COOKIE['User'] = $_GET['userid']: "";
						$switchState = array("OFF", "OFF", "OFF", "OFF", "OFF");
						break;
					default:
						echo "<p class='err'>An error has occured. Please check your submission and try again.</p>";
						break;
				}
			}
		?>

		<table style="width:100%">
			<tr>
				<th colspan="7">Switch ID</th>
			</tr>
			<tr>
				<th>Time Stamp</th>
				<th>1</th>
				<th>2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>Notes</th>
			</tr>

			<?php
			/* Read the data file here and place items into table */
				if (($fp = fopen($FILENAME, "r")) !== false){
					$fileContents = array();
					$log = -1;
					while ($data = fgetcsv($fp, 1000, ",")) {
						$log++;
						$fileContents[$log] = $data;
					}
					fclose($fp);
					
					foreach($fileContents as $line) {
						echo "<tr>";
						foreach ($line as $element)
							echo "<td>$element</td>\n";
						echo "</tr>\n";
					}
				}
			?>
		</table>
		<!-- Handle form elements -->
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" >
			<fieldset style="width:100%;margin-top:20px">
				<legend>Current Switch State</legend>
				
				<label for="userid">Employee Name </label> <input type="text" name = "userid" value="<?php echo isset($_COOKIE['User']) ? $_COOKIE['User']: "";?>" size=30 required>&nbsp;&nbsp;&nbsp;
				<input type="submit" value="Update on Server" /> <br />

				<fieldset class = "switchBox">
					<legend>1</legend>
					<label for = "on1">ON</label><input type = "radio" id = "on1" name = "switchState[0]" value = "ON" <?php echo $switchState[0] == "ON" ? "checked": "";?>>
					<label for = "on1">OFF</label><input type = "radio" id = "off1" name = "switchState[0]" value = "OFF" <?php echo $switchState[0] == "OFF" ? "checked": "";?>>
				</fieldset>
				<fieldset class = "switchBox">
					<legend>2</legend>
					<label for = "on2">ON</label><input type = "radio" id = "on2" name = "switchState[1]" value = "ON" <?php echo $switchState[1] == "ON" ? "checked": "";?>>
					<label for = "off2">OFF</label><input type = "radio" id = "off2" name = "switchState[1]" value = "OFF" <?php echo $switchState[1] == "OFF" ? "checked": "";?>>
				</fieldset>
				<fieldset class = "switchBox">
					<legend>3</legend>
					<label for = "on3">ON</label><input type = "radio" id = "on3" name = "switchState[2]" value = "ON" <?php echo $switchState[2] == "ON" ? "checked": "";?>>
					<label for = "off3">OFF</label><input type = "radio" id = "off3" name = "switchState[2]" value = "OFF" <?php echo $switchState[2] == "OFF" ? "checked": "";?>>
				</fieldset>
				<fieldset class = "switchBox">
					<legend>4</legend>
					<label for = "on4">ON</label><input type = "radio" id = "on4" name = "switchState[3]" value = "ON" <?php echo $switchState[3] == "ON" ? "checked": "";?>>
					<label for = "off4">OFF</label><input type = "radio" id = "off4" name = "switchState[3]" value = "OFF" <?php echo $switchState[3] == "OFF" ? "checked": "";?>>
				</fieldset>
				<fieldset class = "switchBox">
					<legend>5</legend>
					<label for = "on5">ON</label><input type = "radio" id = "on5" name = "switchState[4]" value = "ON" <?php echo $switchState[4] == "ON" ? "checked": "";?>>
					<label for = "off5">OFF</label><input type = "radio" id = "off5" name = "switchState[4]" value = "OFF" <?php echo $switchState[4] == "OFF" ? "checked": "";?>>
				</fieldset>
			</fieldset>
		</form>
		<footer><center><p>&copy; Javaughn</p></center></footer>
	</body>
</html>