<!-- Completed by Javaughn -->
<?php
	function table($result) {
		echo "<th></th>\n";
		echo "<th><a href = '?tableAction=sortByID'>ID</a></th>\n";
		echo "<th><a href = '?tableAction=sortByDate'>Date</a></th>\n";
		echo "<th><a href = '?tableAction=sortByName'>Parameter Name</a></th>\n";
		echo "<th>Readings</th>\n";
		echo "<th>Units</th>\n";
		while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != null)
		{
			$idNum = $row["id"];
			echo "<tr>";
			echo "<th><a href = 'PHP_and_SQL.php?tableAction=delete&id=$idNum'>D</a>&nbsp;&nbsp;&nbsp;<a href = 'PHP_and_SQL.php?tableAction=edit&id=$idNum'>E</a></th>"; //Point to appropriate location here
			foreach ($row as $data) {
				echo "<td>$data</td>";
			}
			echo "<tr>\n";
		}
	}
?>