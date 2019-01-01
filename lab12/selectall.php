<?php
	$pagetitle = "Select All Entries";
	include_once "header.php";
	try
	{
		$sql = "SELECT * FROM lab12";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo "<table><tr><th>Options</th><th>ID</th><th>Username</th></tr>";
		foreach ($result as $row)
		{
			echo "<tr>
					<td><a href='selectone.php?ID=" . $row['ID'] . "'>VIEW</a> | <a href='update.php?ID=" . $row['ID'] . "'>UPDATE</a></td>
					<td>" . $row['ID'] . "</td>
			        <td>" . $row['uname'] . "</td>
			      </tr>";
		}
		echo "</table>";

	}//try
	catch (PDOException $e)
	{
		echo 'Error fetching users: <br />ERROR MESSAGE:<br />' .$e->getMessage();
		exit();
	}
	include_once "footer.php";
?>
