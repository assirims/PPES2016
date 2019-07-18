<?php $page_title = "Instructor Login";?>
<?php session_start(); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/header.php"); ?>

<fieldset>
	<legend>Instructor Login</legend>
	<?php 	if (isset($_POST['login'])){
					$required_fields = array("password", "instructor_ID");
					check_required_array($required_fields);
					if(empty($validations)){
						if (ins_login($_POST["instructor_ID"], $_POST["password"])){
							//echo "<div class=\"success\">You will be redirected to the registration form <br /> in 3 seconds.</div>";
							$_SESSION["instructor_id"] = $_POST["instructor_ID"];
							echo '<META HTTP-EQUIV="Refresh" Content="0; URL=ins_pg.php">';
						} else {
						    echo  "<div class=\"error\">Instructor ID or Password does not match.</div>";
						}
					}else{
						echo check_validations($validations);
					}
				}
				 ?>

	<br />
		<form name="login_ins" method="post" action"ins_login.php">
			Instructor ID:<input type="text" placeholder="Please enter your ID" name="instructor_ID" value=<?php echo $code = isset($_POST['instructor_ID']) ? htmlspecialchars($_POST['instructor_ID']) : "";?>><br />
    		Password:<input type="password" placeholder="Please enter your password" name="password"><br />
  			<input type="submit" name="login" value="Login"><br />
	 	</form>
</fieldset>

<?php include("../includes/footer.php");?>