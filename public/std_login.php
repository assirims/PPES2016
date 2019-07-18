<?php $page_title = "Welcome!";?>
<?php $theme = (isset($_GET['theme'])) ? $_GET['theme'] : "css.css"; ?>
<?php session_start(); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/header.php"); ?>

<fieldset>
	<legend>Login</legend>
	<?php 	if (isset($_POST['login'])){
					$required_fields = array("password");
					$numeric_fields = array("student_ID");
					check_numeric_array($numeric_fields);
					check_required_array($required_fields);
					if(empty($validations)){
						if (check_login($_POST["student_ID"], $_POST["password"])){
							$_SESSION["student_id"] = $_POST["student_ID"];
							echo '<META HTTP-EQUIV="Refresh" Content="0; URL=std_pg.php">';
						} else {
						    echo  "<div class=\"error\">Student ID or Password does not match.</div>";
						}
					}else{
						echo check_validations($validations);
					}
				}
				 ?>
	<br />
	
		<form name="login_form" method="post" action"std_login.php">
			Student ID:<input type="text" placeholder="Please enter your student ID" name="student_ID" value=<?php echo $code = isset($_POST['student_ID']) ? htmlspecialchars($_POST['student_ID']) : "";?>><br />
    		Password:<input type="password" placeholder="Please enter your password" name="password"><br />
  			<input type="submit" name="login" value="Login"><br />
			<input type="button" name="forgetpassword" onclick="window.location.href='#fgt'" value="Forget Password?"><br />
			<input type="button" name="register" onclick="window.location.href='#rst'" value="Register"><br />
	 	</form>
		
		<hr>
		
		<br />
		
		<center>
			
		<form method="get" name="themes"> 
		<select style="width:150px;" name="theme" onChange="document.forms['themes'].submit()"> 
		<option selected>Select Theme</option> 
		<option value="css.css">winter</option> 
		<option value="fall.css">fall</option> 
		<option value="summer">summer</option> 
		</select> 
		</form>
		
		<br />
		
		<select style="width:150px;"> 
		<option selected>Select Language</option> 
		<option>English</option> 
		</select> 
		
		<br />
		
		</center>
		
</fieldset>

<div id="fgt" class="overlay">
	<div class="popup">
		<h2>Forget Password</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<?php 	if (isset($_POST['fp_submit'])){
							$email_fields = array("email_address");
							check_email_array($email_fields);
							
							if(empty($validations)){
								if(find_email($_POST["email_address"])){
									echo "<div class=\"success\">Email was sent successfully.</div>";
								}else{
									echo "<div class=\"error\">Email was not found.</div>";
								}
							}else{
								echo check_validations($validations,1);
							}
						} ?>
			<br />
			<form action="#fgt" name="fp_form" method="post">
				Email address:<input type="email" name="email_address" placeholder="Please enter your email address"
				 value=<?php echo $email = isset($_POST['email_address']) ? htmlspecialchars($_POST['email_address']) : "";?>><br />
				<input type="submit" name="fp_submit" value="Send Email"><br />
			</form>
		</div>
	</div>
</div>

<div id="rst" class="overlay">
	<div class="popup">
		<h2>Registeration</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<?php 	if (isset($_POST['r_submit'])){
							$code_fields = array("coures_code");
							check_required_array($code_fields);
				
							if(empty($validations)){
								$course = "Software Design";
								if(find_course_code($_POST["coures_code"])["password"] === $_POST["coures_code"]){
									echo "<div class=\"info\">You will be redirected to the registration form <br /> in 3 seconds.</div>";
						         echo '<META HTTP-EQUIV="Refresh" Content="3; URL=std_rgt_frm.php">';
								}else{
									echo "<div class=\"error\">Course Code is incorrect.</div>";
								}
							}else{
								echo check_validations($validations,1);
							}
						} ?>
			<br />
			<form action="#rst" name="r_form" method="post">
				Course Code:<input type="text" name="coures_code" placeholder="Please enter the course code"
				value=<?php echo $code = isset($_POST['coures_code']) ? htmlspecialchars($_POST['coures_code']) : "";?>><br />
				<input name="r_submit" type="submit" value="Register"><br />
			</form>
		</div>
	</div>
</div>

<?php include("../includes/footer.php");?>