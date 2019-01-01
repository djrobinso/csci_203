<?php
	$pagetitle = "Update";
	include_once "header.php";
	//only allowing authenticated users
	if(!isset($_SESSION['ID']))
	{
		echo '<p>This page requires authentication.';
		include_once "footer.php";
		exit();
	}

	//NEEDED VARIABLES & INCLUDES
	$errormsg = "";
	$showform = 1;
	if(isset($_POST['submit']))
	{
		$_GET['ID'] = $_POST['ID'];
		/* ****************************************************************************
		  SANITIZE DATA FROM USER.
		**************************************************************************** */
		$formfield['fname'] = trim($_POST['fname']);
		$formfield['lname'] = trim($_POST['lname']);
		$formfield['email'] = trim(strtolower($_POST['email']));
		$formfield['uname'] = trim(strtolower($_POST['uname']));
		$formfield['bio'] = trim($_POST['bio']);

		/*  ****************************************************************************
     	  CHECK FOR EMPTY FIELDS
    	**************************************************************************** */

		if(empty($formfield['fname'])){$errormsg .= "<p>The first nam is empty.</p>";}
		if(empty($formfield['lname'])){$errormsg .= "<p>The last name is empty.</p>";}
		if(empty($formfield['email'])){$errormsg .= "<p>The email is empty.</p>";}
		if(empty($formfield['uname'])){$errormsg .= "<p>The username is empty.</p>";}
		if(empty($formfield['bio'])){$errormsg .= "<p>The biography is empty.</p>";}

		/* ****************************************************************************
   		   CHECK FOR DUPLICATE USERS
		   ************************************************************************* */


			try {

				$sqlusers = "SELECT * FROM lab12 WHERE uname = :uname";
				$stmtusers = $pdo->prepare($sqlusers);
				$stmtusers->bindValue(':uname', $formfield['uname']);
				$stmtusers->execute();
				$countusers = $stmtusers->rowCount();
				if ($countusers > 0) {
					$errormsg .= "<p>The username is already taken.</p>";
				}
			}
			catch (PDOException $e) {
				echo "<div class='error'><p></p>ERROR selecting users!" . $e->getMessage() . "</p></div>";
				exit();
			}

				/* ****************************************************************************
                      CHECK FOR DUPLICATE EMAILS
           ************************************************************************* */
		if($formfield['uname'] != $_POST['ouname']){
			try {

				$sqlemail = "SELECT * FROM lab12 WHERE email = :email";
				$sqlemail = $pdo->prepare($sqlemail);
				$sqlemail->bindValue(':email', $formfield['email']);
				$sqlemail->execute();
				$countemails = $sqlemail->rowCount();
				if ($countemails > 0) {
					$errormsg .= "<p>The email is already taken.</p>";
				}
			} catch (PDOException $e) {
				echo "<div class='error'><p></p>ERROR selecting users!" . $e->getMessage() . "</p></div>";
				exit();
			}
		} //if username not original
		/*  ****************************************************************************
            CONTROL FOR ERRORS.  IF ERRORS, DISPLAY THEM.  IF NOT, CONTINUE WITH FORM PROCESSING.
            **************************************************************************** */
		if($errormsg != "")
		{
			echo "<div class='error'><p>THERE ARE ERRORS! CHECK YOUR ENTRIES AND SUBMIT AGAIN.</p>";
			echo $errormsg;
			echo "</div>";
		}
		else
		{
			try
			{
				 /* ****************************************************************************
					UPDATE DATA IN THE DATABASE
            		**************************************************************************** */
				$sql = "UPDATE lab12 SET
						fname = :fname, lname = :lname, email = :email, uname = :uname, bio = :bio
						WHERE ID = :ID";
				$stmt = $pdo->prepare($sql);
				$stmt->bindvalue(':fname', $formfield['fname']);
				$stmt->bindvalue(':lname', $formfield['lname']);
				$stmt->bindvalue(':email', $formfield['email']);
				$stmt->bindvalue(':uname', $formfield['uname']);
				$stmt->bindvalue(':bio', $formfield['bio']);
				$stmt->bindvalue(':ID', $_POST['ID']);
				$stmt->execute();
				//hide the form
				$showform=0;
				echo "<div class='success'><p>There are no errors. Thank you.</p></div>";

			}//try
			catch(PDOException $e)
			{
				echo "<div class='error'><p></p>ERROR updating data into the database!" .$e->getMessage() . "</p></div>";
				exit();
			}
		}//else errors
	}//isset submit

if($showform == 1) {
	$sql = 'SELECT * FROM lab12 WHERE ID = :ID';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':ID', $_GET['ID']);
	$stmt->execute();
	$row = $stmt->fetch();
	?>
	<form method="post" action="update.php" name="myform">
		<fieldset>
			<legend>Update Form</legend>
			<table>
				<tr>
					<th><label for="fname">User Name:</label></th>
					<td><input type="text" name="fname" id="textbox" value="<?php if(isset($formfield['fname'])
							&& !empty($formfield['fname'])) {echo $formfield['fname'];}else {echo $row['fname'];}?>"/></td>
				</tr>
				<tr>
					<th><label for="lname">Last Name:</label></th>
					<td><input type="text" name="lname" id="textbox" value="<?php if(isset($formfield['lname'])
							&& !empty($formfield['lname'])) {echo $formfield['lname'];}else {echo $row['lname'];}?>"/></td>
				</tr>
				<tr>
					<th><label for="email">Email:</label></th>
					<td><input type="email" name="email" id="email" value="<?php if(isset($formfield['email'])
							&& !empty($formfield['email'])) {echo $formfield['email'];}else {echo $row['email'];}?>"/></td>
				</tr>
				<tr>
					<th><label for="uname">Username:</label></th>
					<td><input type="text" name="uname" id="textbox" value="<?php if(isset($formfield['uname'])
							&& !empty($formfield['uname'])) {echo $formfield['uname'];}else {echo $row['uname'];}?>"/></td>
				</tr>
				<tr>
					<th><label for="bio">Biography:</label></th>
					<td><textarea name="bio" id="bio"><?php if(isset($formfield['bio'])&& !empty($formfield['uname'])){echo $formfield['bio'];}else {echo $row['bio'];}?></textarea></td>
				</tr>
				<tr>
					<th>Submit:</th>
					<td><input type="hidden" name="ID" id="ID" value="<?php echo $row['ID'];?>" />
						<input type="hidden" name="ouname" id="ouname" value="<?php echo $row['uname']; ?>"/>
						<input type="hidden" name="oemail" id="oemail" value="<?php echo $row['email']; ?>" />
						<input type="submit" name="submit" value="UPDATE"/></td>
				</tr>
			</table>
		</fieldset>
	</form>
	<?php
} //showform
	include_once "footer.php";
?>
