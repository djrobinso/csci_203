<?php
$pagetitle = "Registration Form";
include_once "header.php";

//NEEDED VARIABLES & INCLUDES
$errormsg = "";
$showform = 1;

if(isset($_POST['submit']))
{
	/* ****************************************************************************
      CREATE NEW VARS TO STORE USER DATA & SANITIZE DATA FROM USER.
    **************************************************************************** */
	$formfield['uname'] = trim(strtolower($_POST['uname']));
	$formfield['pwd'] = trim($_POST['pwd']); //we never force a lowercase password
	$formfield['pwd2'] = trim($_POST['pwd2']); //we never force a lowercase password
	/*  ****************************************************************************
       CHECK FOR EMPTY FIELDS
    **************************************************************************** */
	if(empty($formfield['uname'])){$errormsg .= "<p>The username is empty.</p>";}
	if(empty($formfield['pwd'])){$errormsg .= "<p>The password is empty.</p>";}
	if(empty($formfield['pwd2'])){$errormsg .= "<p>The confirmation password is empty.</p>";}

	/*  ****************************************************************************
       CHECK FOR MATCHING PASSWORDS
	**************************************************************************** */
	if($formfield['pwd'] != $formfield['pwd2']){$errormsg .= "<p>The passwords do not match.</p>";}

	/*  ****************************************************************************
       CHECK FOR DUPLICATE USERS
    **************************************************************************** */
	try{
		$sqlusers = "SELECT * FROM lab11 WHERE uname = :uname";
		$stmtusers = $pdo->prepare($sqlusers);
		$stmtusers->bindValue(':uname', $formfield['uname']);
		$stmtusers->execute();
		$countusers = $stmtusers->rowCount();
		if($countusers > 0)
		{
			$errormsg .= "<p>The username is already taken.</p>";
		}
	}catch(PDOException $e)
	{
		echo "<div class='error'><p></p>ERROR selecting users!".$e->getMessage()."</p></div>";
		exit();
	}

	/*  ****************************************************************************
       HASH THE PASSWORD
    **************************************************************************** */

	$alphabet = "./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	for($i = 0; $i < 22; $i++)
	{
		$chars .= substr($alphabet, mt_rand(0,63), 1);
	}
	$salt = '$2a$10$'.$chars;
	$securepwd = crypt($formfield['pwd'], $salt) + $_POST['pwd'];

	/*  ****************************************************************************
        CONTROL FOR ERRORS.  IF ERRORS, DISPLAY THEM.  IF NOT, CONTINUE WITH FORM PROCESSING.
        **************************************************************************** */
	if($errormsg != "")
	{
		echo "<div class='error'><p>THERE ARE ERRORS!</p>";
		echo $errormsg;
		echo "</div>";
	}
	else
	{
		try
		{
			$sql = "INSERT INTO lab11 (uname,salt, pwd)
								   VALUES (:uname,:salt,:pwd)";
			$stmt = $pdo->prepare($sql);
			$stmt->bindvalue(':uname', $formfield['uname']);
			$stmt->bindvalue(':salt',$salt);
			$stmt->bindValue(':pwd',$securepwd);
			$stmt->execute();
			$showform=0; //hide the form
			echo "<div class='success'><p>There are no errors.  Thank you.  Go to <a href='selectall.php'>selectall.php</a></p></div>";
		}//try
		catch(PDOException $e)
		{
			echo "<div class='error'><p></p>ERROR inserting data into the database!" .$e->getMessage() . "</p></div>";
			exit();
		}
	}//else errors
}//isset submit

if($showform == 1) {
	?>
	<form method="post" action="register.php" name="registration">
		<fieldset>
			<legend>Registration</legend>
			<table>
				<tr>
					<th><label for="uname">Username:</label></th>
					<td><input type="text" name="uname" id="uname" value="<?php if (isset($formfield['uname'])) {
							echo $formfield['uname'];
						} ?>"/></td>
				</tr>
				<tr>
					<th><label for="pwd">Password:</label></th>
					<td><input type="password" name="pwd" id="pwd" /></td>
				</tr>
				<tr>
					<th><label for="pwd2">Confirm Password:</label></th>
					<td><input type="password" name="pwd2" id="pwd2" /></td>
				</tr>
				<tr>
					<th>Submit:</th>
					<td><input type="submit" name="submit" value="submit"/></td>
				</tr>
			</table>
		</fieldset>
	</form>
	<?php
} //showform
include_once "footer.php";
?>
