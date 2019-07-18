<?php $page_title = "Account Information";?>
<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php $id = find_id_pass($_SESSION['student_id']);?>
<fieldset>
	<legend>Account Information</legend><br />
	<form id="acc_form" name="acc_form" method="get">
		<table>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" value="<?php echo $id["student_id"]; ?>" style="width:100%" disabled></td>
			</tr>
			<tr>
				<td>Student ID:</td>
				<td><input type="text" name="num" value="<?php echo $id["name"]; ?>" style="width:100%" disabled></td>
			</tr>
			<tr>
				<td>Email Address:</td>
				<td><input type="text" name="email" value="<?php echo $id["email"]; ?>" style="width:100%" disabled></td>
			</tr>
		</table>
	</form>
		<br />
		Change Password <br />
		<?php
					if (isset($_POST['change'])){
						if (check_login($id["student_id"], $_POST["oldp"])){
							if ($_POST["newp"] !== $_POST["nepc"] || !(check_required($_POST["nepc"]))){
								echo "<div class=\"error\">New password is required and must match password confirmation.</div>";
							}else{
								if(update_passwrd($id["student_id"], $_POST["newp"])){
									echo "<div class=\"success\">Password was updated successfully.</div>";
								}else{
									echo "<div class=\"error\">Error has occurred, please contact the instructor.</div>";
								}
							}
						} else {
						    echo  "<div class=\"error\">Current password does not match your record.</div>";
						}
					}
			 ?>
					 <br />
		
		<form id="pass_form" name="pass_form" method="post">
		<table>
			<tr>
				<td>Current password</td>
				<td><input type="password" name="oldp" style="width:100%"></td>
			</tr>
			<tr>
				<td>New Password:</td>
				<td><input type="password" name="newp" style="width:100%"></td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td><input type="password" name="nepc" style="width:100%"></td>
			</tr>
		</table>
		<br />
		<center><input type="submit" name="change" value="Change" class="del" style="width:100%">
		<br />
		<input type="button" onclick="location.href='std_pg.php';" value="Back" style="width:100%"></center>
		<br />
	</form>
</fieldset>
<?php include("../includes/footer.php");?>