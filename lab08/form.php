<!DOCTYPE html>
<html>
<?php
	include_once "header.php";
	if(isset($_POST['submit'])){
		echo "<p>Thank You.</p>";
	}
?>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" name="myform">
				<fieldset><legend>Example Form</legend>
					<table>
						<tr>
							<th><label for="dateform">Date:</label></th>
							<td><input type="date" name="dateform" id="dateform" value="<?php if (isset($_POST['dateform'])){echo $_POST['dateform'];}?>" /></td>
						</tr>
						<tr>
							<th><label for="textbox">Text Box:</label></th>
							<td><input type="text" name="textbox" id="textbox" /></td>
						</tr>
						<tr>
							<th><label for="selectbox">Select Box:</label></th>
							<td><select name="selectbox" id="selectbox">
									<option value="<?php if(isset($_POST['selectbox']) && isset($_POST['selectbox'])==""){echo "selected";} ?>">SELECT ONE</option>

									<option value="1" selected>One</option>
									<option value="2">Two</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>Radio Button:</th>
							<td><input type="radio" name="radiobutton" id="radiobutton1" value="1" <?php if(isset($_POST['radiobutton']) && $POST['radiobutton'] ==1){echo "checked";} ?> /><label for="radiobutton1">One</label>

								<input type="radio" name="radiobutton" id="radiobutton2" value="2" /><label for="radiobutton2">Two</label>
							</td>
						</tr>
						<tr>
							<th><label for="textareabox">Text Area:</label></th>
							<td><textarea name="textareabox" id="textareabox"><?php if(isset($_POST['textareabox'])){echo $_POST['textareabox'];} ?></textarea></td>
						</tr>
						<tr>
							<th>Submit:</th>
							<td><input type="submit" name="mysubmit" value="submit" /></td>
						</tr>
					</table>
				</fieldset>
			</form>
			<?php  include_once "footer.php"; ?>



