<?php $page_title = "Registration";?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<fieldset>
	<legend>Registration Form</legend>
<?php 	
		if (isset($_POST['rgistr'])){
			check_emails_matches($_POST["password"], $_POST["password_confirmation"]);
			check_email_array(array("email_address"));
			check_numeric_array(array("student_ID"));
			check_required_array(array("full_name", "password", "password_confirmation"));
			check_length_array(array("full_name" => 10));
			check_short_array(array("full_name" => 4));	
		if(empty($validations)){
			if (find_id($_POST['student_ID']) || find_email($_POST['email_address'])){
				$err_msg .= "<br /><div class=\"validation\">";
				if (find_id($_POST['student_ID'])){
					$err_msg .=  "<li>Student ID is already registered.</li>"; 
				}
				if (find_email($_POST['email_address'])){
					$err_msg .=  "<li>Email address is already used.</li>"; 
				}
				$err_msg .= "</div>";
				echo $err_msg;
			}else{
				if(insert_student($_POST["student_ID"],$_POST["full_name"],$_POST["email_address"],$_POST["password"])){
					echo "<div class=\"success\">Account was created successfully, and it will be approved by the instructor soon.</div>";
				}else{
					echo "<div class=\"error\">Error has occurred, please contact the instructor.</div>";
				}
			}							
		}else{
			echo check_validations($validations);
		}
	}
?>
	<br />
	<form method="post" action"std_rgt_frm.php">
		Full naem:		<input type="text" name="full_name" placeholder="Please Enter Your Full Name" 
		value=<?php echo $code = isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : "";?>><br />
		Student ID:<input type="text" name="student_ID" placeholder="Please Enter Your Student Number" 
		value=<?php echo $code = isset($_POST['student_ID']) ? htmlspecialchars($_POST['student_ID']) : "";?>><br />
		Email address:	<input type="email" name="email_address" placeholder="Please Enter Your Email Address" 
		value=<?php echo $code = isset($_POST['email_address']) ? htmlspecialchars($_POST['email_address']) : "";?>><br />
		Password:		<input type="password" name="password" placeholder="Please Enter Your Password"><br />
		Password confirmation:<input type="password" name="password_confirmation" placeholder="Please Re-Enter Your Password"><br />
		<input type="submit" name="rgistr" value="Submit"><br />
	</form>
</fieldset>
<?php include("../includes/footer.php");?>