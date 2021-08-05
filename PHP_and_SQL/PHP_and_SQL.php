<!DOCTYPE html>
<html lang=”en”>
<!-- Completed by Javaughn -->
<html>
	<head>

		<title>PHP and SQL</title>
		<link href="PHP_and_SQL.css" rel="stylesheet" type="text/css" />

	</head>
	<body>

		<div id="container">

			<?php
				$debuglev = 1;

				// Script that now processes the page - single page application 

				require "credentials.php"; //add the appropriate information to credentials file
				require "tabulate.php";

				//connect to database else display error
				$connection = @mysqli_connect($host, $username, $password, $databasename) ;
				if (! $connection) 
				{
				  $status = 'Error ' . mysqli_connect_errno() . ': Could not connect to database. ' . mysqli_connect_error();
				  echo $status;
				  die();
				}

				//process form interaction 
				if ($_GET != null) {
					$tableAction = $_GET['tableAction'];
					switch ($tableAction){
						case "sortByID":
							$basequery = 'SELECT db_data.id, t, name, reading, units FROM db_data INNER JOIN db_parm ON db_data.parameterid = db_parm.id ORDER BY db_data.id';
							break;
						case "sortByDate":
							$basequery = 'SELECT db_data.id, t, name, reading, units FROM db_data INNER JOIN db_parm ON db_data.parameterid = db_parm.id ORDER BY t DESC';
							break;
						case "sortByName":
							$basequery = 'SELECT db_data.id, t, name, reading, units FROM db_data INNER JOIN db_parm ON db_data.parameterid = db_parm.id ORDER BY parameterid DESC';
							break;
						case "delete":
							$basequery = 'SELECT db_data.id, t, name, reading, units FROM db_data INNER JOIN db_parm ON db_data.parameterid = db_parm.id';
							if (isset($_GET['confirmed']))
								$confirm = $_GET['confirmed'];
							else
								$confirm = 2;
							$id = $_GET['id'];
							if ($confirm == 2) {
								echo "<div class = 'status'><a href = '".$_SERVER['PHP_SELF']."?tableAction=delete&id=$id&confirmed=0'>CLICK HERE</a> to confirm deletion of record with ID = " . $id .", or <a href = '".$_SERVER['PHP_SELF']."?tableAction=delete&id=$id&confirmed=1'>Cancel</a>.</div>";
								break;
							} elseif ($confirm == 1) {
								echo "<div class = 'status'>Deletion canceled.</div>";
								break;
							} else {
								$deletion = 'DELETE FROM db_data WHERE id = ' . $id;
								mysqli_query($connection, $deletion)or die('Deletion failed: ' . mysqli_error($connection));
								if (mysqli_affected_rows($connection) == 1) {
									echo "<div class = 'status'>Record with ID# " . $id . " successfully deleted.</div>";
									$correction = 'ALTER TABLE db_data AUTO_INCREMENT = 0';
									mysqli_query($connection, $correction)or die('Failed to reset incrementer: ' . mysqli_error($connection));
									break;
								}
							}
							echo "Uh-oh spaghetti-o";
							break;
						default:
							$basequery = 'SELECT db_data.id, t, name, reading, units FROM db_data INNER JOIN db_parm ON db_data.parameterid = db_parm.id';
							break;
					}
				} else
					$basequery = 'SELECT db_data.id, t, name, reading, units FROM db_data INNER JOIN db_parm ON db_data.parameterid = db_parm.id';
				
				if ($_POST != null){
					$date = $_POST['t'];
					$channel = $_POST['parameterid'];
					$reading = $_POST['reading'];
					$chanName;
					$units;
					
					switch ($channel){
						case "FLOWE":
							$chanName = "Water Flow Location EAST Channel";
							$units = "m3/day";
							break;
						case "FLOWW":
							$chanName = "Water Flow Location WEST Channel";
							$units = "m3/day";
							break;
						case "FLOWB":
							$chanName = "Water Flow Location EAST ByPass";
							$units = "m3/day";
							break;
						case "TEMP":
							$chanName = "Temperature";
							$units = "deg C";
							break;
						default:
							echo "An error has occurred. It seems there is missing information, please try again.";
							break;
					}
						
					//Build DML query for db_data table and send it
					if (isset($_POST['submit'])) {
						$insertion = 'INSERT INTO db_data(t, parameterid, reading) VALUES(?, ?, ?)';
						$stmt = mysqli_prepare($connection, $insertion);
						mysqli_stmt_bind_param($stmt, 'ssd', $date, $channel, $reading);
						@mysqli_stmt_execute($stmt) or die('Failed to update "db_data": ' . mysqli_error($connection));
					} elseif (isset($_POST['update'])) {
						$id = $_POST['affectedID'];
						$update = 'UPDATE db_data SET t = ?, parameterid = ?, reading = ? WHERE id = ?';
						$stmt = mysqli_prepare($connection, $update);
						mysqli_stmt_bind_param($stmt, 'ssdi', $date, $channel, $reading, $id);
						@mysqli_stmt_execute($stmt) or die('Failed to update "db_data": ' . mysqli_error($connection));
					} else
						echo "error";
				}
				$result = @mysqli_query($connection, $basequery) or die('Query failed: ' . mysqli_error($connection));

				$num = mysqli_num_rows($result); 

				echo "<h2>Water Readings Database</h2>" . 
					 "<h3>$num readings in data table</h3>" ;
				 
			?>

			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

				<fieldset id="display">
					<legend>Add/Update Water Data</legend>
					<label for="datefield">Date</label> 
					<input type="date" id="datefield" name="t" required value=""><br />
					<label for="channel">Reading Type</label>
					<select name='parameterid' id='channel'>
								 <option value='FLOWE'>FLOWE</option>
								 <option value='FLOWW'>FLOWW</option>
								 <option value='FLOWB'>FLOWB</option>
								 <option value='TEMP'>TEMP</option>
							   </select><br/>
					<label for="result">Reading</label>
					<input type="number" id="result" name="reading" step=0.01 maxlength="15" required value=""><br />

					<?php
						if ($_GET != null && $_GET['tableAction'] == "edit") {
							$id = $_GET['id'];
							echo "<label for='entryID'>ID</label>\n" .
								 "<input type='text' id='entryID' name='affectedID' value='$id' readonly><br/>\n" .
								 "<input name='update' type='submit' value='Update Listing'>&nbsp&nbsp<a href = '".$_SERVER['PHP_SELF']."'>Cancel Update</a><br/>";
						} else
							echo "<input name='submit' type='submit' value='Add New Reading'><br />";
					?>

				</fieldset>
			</form>

			<?php
				echo "<table class='members'>\n";
					table($result);
				echo "</table>\n";
			?>
			<p></p>
			<h3>&copy; Javaughn </h3>
		</div>
	</body>
</html>
