<?php
	$pagetitle = "Select All Entries";
	include_once "header.php";
	try
	{
		$sql = "SELECT * FROM lab11";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo "<table><tr><th>ID</th><th>Username</th><th>Salt</th><th>Password</th></tr>";
		foreach ($result as $row)
		{
			echo "<tr>
					<td>" . $row['ID'] . "</td>
			        <td>" . $row['uname'] . "</td>
			        <td>" . $row['salt'] . "</td>
			        <td>" . $row['pwd'] . "</td>
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
