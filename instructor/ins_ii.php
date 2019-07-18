<?php $page_title = "Account Information";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php $id = $_SESSION['instructor_id'];?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php $id = find_ins_pass($id); ?>
<?php $code = find_course_code($course); ?>
	 <br />
<fieldset>
	<legend>Account Information</legend><br />
	<?php
			if (isset($_POST['change_code'])){
				$course = 'Software Design';
				if(change_code($_POST["code"], $course)){
					echo "<script type=\"text/javascript\">alert(\"Password was updated successfully.\");</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=ins_ii.php">';
				}else{
					echo "<div class=\"error\">Error has occurred <br />or Password was not changed.</div>";
				}
			}
			echo "<br />";
	?>
	<form name="acc_form" method="post">
		<table>
			<tr>
				<td>Course Code:</td>
				<td><input type="text" name="code" style="width:200px" value="<?php echo $code["password"]; ?>"></td>
				<td><input type="submit" name="change_code" value="Change" class="del" style="width:100%"></td>
			</tr>
		</table>
	</form>
		<br />
		<br />
		Change Password
		<?php 	if (isset($_POST['change_pass'])){
							echo "<br />";
							if (!password_verify($_POST["oldp"], $id["pass"])) {
							   echo  "<div class=\"error\">Current password does not match your record.</div>";
							} else {
								if ($_POST["newp"] !== $_POST["nepc"] || !(check_required($_POST["nepc"]))){
									echo "<div class=\"error\">New password is required and must match password confirmation.</div>";
								}else{
									if(update_ins_pwd($id["id"], $_POST["newp"])){
										echo "<div class=\"success\">Password was updated successfully.</div>";
									}else{
										echo "<div class=\"error\">Error has occurred.</div>";
										echo "<br />" . $_POST["newp"];
									}
									
								}
							}	
						}
					 ?>
					 <br />
		<form id="pass_form" name="pass_form" method="post">
		<table>
			<tr>
				<td>Current password</td>
				<td><input type="text" name="oldp"></td>
			</tr>
			<tr>
				<td>New Password:</td>
				<td><input type="text" name="newp"></td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td><input type="text" name="nepc"></td>
			</tr>
		</table>
		<br />
		<center><input type="submit" name="change_pass" value="Change" class="del" style="width:100%"></center>
		<br />
		<input type="button" onclick="location.href='ins_pg.php';" value="Back" style="width:100%"></center>
		<br />
	</form>
</fieldset>
<?php include("../includes/footer.php");?>