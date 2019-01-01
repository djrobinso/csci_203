<?php
	$pagetitle = "Entries";
	include_once "header.php";

	try
	{
		$sql = "SELECT * FROM djrobinso";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll();


		echo "<table><tr><th>Options</th><th>ID</th><th>Text Box</th></tr>";
		foreach($results as $row)
		{
			echo "<tr><td><a href='selectone.php?ID=".$row['ID']."'>VIEW</a></td><td>".$row['ID']."</td><td>". $row['textbox']. "</td></tr>";
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
