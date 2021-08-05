<!DOCTYPE html>
<html lang=”en”>
<!-- Completed by Javaughn Smith -->
<head>
	<meta http-equiv="cache-control" content="no-cache"/> 
	<meta http-equiv="refresh" content="5" />

	<title>Dynamic PHP Table</title>
	<!-- Embedded style sheet -->
	<style>
		body	{font-family: Arial}
		#cap	{font-weight: bold}
		.odd	{color: white; background-color: green}
		.even	{background-color:yellow}
		table	{width: 375px; border-collapse: collapse; border: 2px solid black; text-align: center}
		table td{border: 1px solid black; }
		footer	{color: grey}
	</style>
</head>

<body>
	<center>
		<h1>PHP Form</h1>
		<p><a href="<?= $_SERVER['PHP_SELF'] ?>">Refresh</a></p>
		<hr>
		<br>
		<p id = 'cap'>
			ODD starting number will be displayed in <span class = 'odd'>GREEN</span> rows<br>
			EVEN starting number will be displayed in <span class = 'even'>YELLOW</span> rows
		</p>
		<br>
		<table>
			<?php
				$randnumber = rand(1,100);
				if ($randnumber % 2 != 0){
					$rowColor = false;
					echo "<tr class = 'odd'>";
				}else{
					$rowColor = true;
					echo "<tr class = 'even'>";
				}
				
				for ($row = 0; $row < 20; $row++){
					for ($col = 0; $col < 5; $col++){
						echo "<td>".$randnumber."</td>";
						$randnumber++;
					}
					echo "</tr>\n";
					
					if ($row < 20){
						if ($rowColor == false){
							$rowColor = true;
							echo "<tr class = 'even'>";
						}else{
							$rowColor = false;
							echo "<tr class = 'odd'>";
						}
					}
				}
			?>
		</table>
		<br>
		<footer>&copy; Solution by Javaughn</footer>
	</center>
</body>

</html>