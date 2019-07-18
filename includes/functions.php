<?php
{////////////////////////	non-categorized functions	//////////////////////////////

	function redirect_to($link){
		header("Location: " . $link);
		exit;
		//die("<script>location.href = '{$link}'</script>");
	}
}
{////////////////////////	Validation functions		/////////////////////////////////
	
	$validations = array();
	
	function imporve_input_name($name){
		return ucfirst(str_replace("_", " ", $name));
	} 
	
	function check_required($input){
		return isset($input) && $input !== "";
	}
	
	function check_required_array($inputs_array){
		global $validations;
		foreach($inputs_array as $input_name){
			$input_value = trim($_POST[$input_name]);
			if(!check_required($input_value)){
				$validations[$input_name] = imporve_input_name($input_name) . " is required.";
			}
		}
	}
		
	function check_email($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	
	function emails_matches($email1, $email2){
		return ($email1 === $email2);
	}
	
	function check_email_array($inputs_array){
		global $validations;
		check_required_array($inputs_array);
		if (!empty($validations)){
			check_required_array($inputs_array);
		}else{
			foreach($inputs_array as $input_name){
				$input_value = trim($_POST[$input_name]);
				if(!check_email($input_value)){
					$validations[$input_name] = imporve_input_name($input_name) . " is invalid.";
				}
			}
		}
	}
		
	function check_emails_matches($e1,$e2){
		global $validations;
		if(!emails_matches($e1,$e2)){
				$validations[$input_name] = "Password does not match with Password confirmation.";
			}
	}
	
	function check_numeric($input){
		return is_numeric($input);
	}
	
	function check_numeric_array($inputs_array){
		global $validations;
		check_required_array($inputs_array);
		if (!empty($validations)){
			check_required_array($inputs_array);
		}else{
			foreach($inputs_array as $input_name){
			$input_value = trim($_POST[$input_name]);
			if(!check_numeric($input_value)){
				$validations[$input_name] = imporve_input_name($input_name) . " must be numeric.";
				}
			}
		}
	}

	function check_short($input, $long){
		return $long >= strlen((string)$input);
	}
	
	function check_short_array($inputs_array){
		global $validations;
		foreach($inputs_array as $input_name => $long){
			$input_value = trim($_POST[$input_name]);
			if (check_short($input_value, $long)){
				$validations[$input_name] = imporve_input_name($input_name) . " is too short.";
			}
		}
	}
	
	function check_length($input, $long){
		return strlen((string)$input) <= $long;
	}
	
	function check_length_array($inputs_array){
		global $validations;
		foreach($inputs_array as $input_name => $long){
			$input_value = trim($_POST[$input_name]);
			if (!check_length($input_value, $long)){
				$validations[$input_name] = imporve_input_name($input_name) . " is too long.";
			}
		}
	}
	
	function check_validations($validations=array(), $q=0){
		$err_msg="";
		
		if(!empty($validations)) {
			$err_msg .= "<br /><div class=\"validation\">";
			if ($q == 1){
				$err_msg .= "Sorry, ";
				foreach ($validations as $name => $error){
					$err_msg .= "{$error}";
				}
				$err_msg .= "</div>";
			}else{
				$err_msg .= "Please fix the following:";
				$err_msg .= "<ul>";
				foreach ($validations as $name => $error){
					$err_msg .= "<li>{$error}</li>";
				}
				$err_msg .= "</ul>";
			}
			$err_msg .= "</div>";
		}
		
		return $err_msg;
	}
}
{////////////////////////	DB functions	//////////////////////////////////////////

	function confirm_query($result){
		if (!$result){
			die("Database query failed.");
		}
	}

	function find_email($email){
		global $connection;
		$email = mysqli_real_escape_string($connection, $email);
		$query  = "SELECT * FROM students WHERE email = '{$email}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($email = mysqli_fetch_assoc($result)){
			return true;
		}else{
			return false;
		}
	}
	
	function find_id($id){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$query  = "SELECT * FROM students WHERE student_id = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($id = mysqli_fetch_assoc($result)){
			return true;
		}else{
			return false;
		}
	}
	
	function insert_eval($pr,$ev,$org,$mat,$abi,$dis,$kno,$com){
		global $connection;
		$query  = "INSERT INTO presentations (id, presenter, date, evaluator, org, mat, abi, dis, kno, com) VALUES ('', '{$pr}', CURRENT_TIMESTAMP ,'{$ev}', '{$org}', '{$mat}', '{$abi}', '{$dis}', '{$kno}', '{$com}')";
			$result = mysqli_query($connection, $query);
			if ($result){
				echo "<script type=\"text/javascript\">alert(\"Your evaluation was sumitted successfully.\");</script>";
				echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=std_ep.php\">";
			}else{
				echo "<script type=\"text/javascript\">alert(\"There was a problem, please try again.\");</script>";
			}
	}
	
	function get_eval($id){
		global $connection;
		$counting  = "SELECT * FROM students WHERE name = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $counting);
		confirm_query($result);
		return mysqli_fetch_assoc($result);
	}
	
	function list_eval($id){
		global $connection;
		echo "<table BORDER=\"2\" BORDERCOLOR=\"#09C\" style=\"width:650px;\">";
		echo "<tr>";
		echo "<th colspan=\"7\">Classmates' Viewpoints</th>";
		echo "</tr>";
		echo "<tr>";
		echo "<tr>";
		echo "<th style=\"width:150px;\">Evaluator</th>";
		echo "<th colspan=\"5\">Criteria</th>";
		echo "<th style=\"width:100px;\">Comments</th>";
		echo "</tr>";
		echo "</table>";
		$query  = "SELECT * FROM presentations WHERE presenter = '{$id}'";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		$count;
		while($row = mysqli_fetch_assoc($result)){
			echo "<table BORDER=\"2\" BORDERCOLOR=\"#09C\" style=\"width:650px;\">";
			echo "<tr>";
			echo "<td style=\"width:150px;\">Classmate (" . $count++ . ")</td>";
			echo "<td>" . $row["org"] . "</td>";
			echo "<td>" . $row["mat"] . "</td>";
			echo "<td>" . $row["abi"] . "</td>";
			echo "<td>" . $row["dis"] . "</td>";
			echo "<td>" . $row["kno"] . "</td>";
			echo "<td style=\"width:100px;\"><input type=\"button\" onclick=\"location.href='#cmn-" . $count . "';\" value=\"&#9781;\" style=\"width:30px;\"></td>";
			echo "</tr>";
			echo "</table>";
			echo "<div id=\"cmn-" . $count . "\">";
			echo "<table BORDER=\"2\" BORDERCOLOR=\"#09C\" style=\"width:650px;\">";
			echo "<tr>";
			echo "<td colspan=\"9\">" . $row["com"] . "</td>";
			echo "</tr>";
			echo "</table>";
			echo "</div>";
			echo "</form>";
		}
		mysqli_free_result($result);
	}
	
	function list_ann(){
		global $connection;
		$query  = "SELECT * FROM instractions ORDER BY id ASC";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		//return $result;
		while($row = mysqli_fetch_assoc($result)){
			//output data from each row
			echo "<tr>";
			echo "<td>" . $row["id"] . "</td>";
			echo "<td>" . $row["title"] . "</td>";
			echo "<td>" . $row["Date"] . "</td>";
			echo "<td><input type=\"button\" onclick=\"window.open('help.php?id={$row["id"]}'); return false;\" value=\"Read\"></td>"; 
			echo "</tr>";
		}
		mysqli_free_result($result);
	}
	
	function find_ann($id){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$query  = "SELECT * FROM instractions WHERE id = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($id = mysqli_fetch_assoc($result)){
			return $id;
		}else{
			return null;
			//die("An error has occurred.");
		}
	}
	
	function find_course_code($course){
		global $connection;
		$course = mysqli_real_escape_string($connection, $course);
		$query  = "SELECT * FROM courses WHERE id = 1 LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($code = mysqli_fetch_assoc($result)){
			return $code;
		}else{
			return null;
		}
	}
	
	function change_code($code, $course){
		global $connection;
		$code = mysqli_real_escape_string($connection, $code);
		$query  = "UPDATE courses SET password = '{$code}' WHERE name = '{$course}'";
		$result = mysqli_query($connection, $query);
		if ($result && mysqli_affected_rows($connection) == 1){
			return true;
		}else{
			return false;
		}	
	}

	function find_id_pass($id){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$query  = "SELECT * FROM students WHERE student_id = '{$id}' AND state = '1' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($id = mysqli_fetch_assoc($result)){
			return $id;
		}else{
			return null;
		}
	}
	
	function check_password($givin, $real){
		return password_verify($giving, $real);
	}
	
	function check_login($id, $giving_pass){
		$id = find_id_pass($id);
		$orgnl_pass = $id["pass"];
		if (password_verify($giving_pass, $orgnl_pass)) {
			return true;
		} else {
			return false;
		}
	}
	
	function insert_student($id,$name,$email,$pass){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$name = mysqli_real_escape_string($connection, $name);
		$email = mysqli_real_escape_string($connection, $email);
		$pass = mysqli_real_escape_string($connection, $pass);
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$query  = "INSERT INTO students (student_id, name, email, pass, state) VALUES ('{$id}', '{$name}', '{$email}', '{$pass}', '0')";
		$result = mysqli_query($connection, $query);
		if ($result){
			return true;
		}else{
			return false;
		}
	}
	
	function update_passwrd($id, $pass){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$pass = mysqli_real_escape_string($connection, $pass);
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$query  = "UPDATE students SET pass = '{$pass}' WHERE student_id = {$id}";
		$result = mysqli_query($connection, $query);
		if ($result && mysqli_affected_rows($connection) == 1){
			return true;
		}else{
			return false;
		}	
	}
	
	function update_ins_pwd($id, $pass){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$pass = mysqli_real_escape_string($connection, $pass);
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$query  = "UPDATE instructor SET pass = '{$pass}' WHERE id = '{$id}'";
		$result = mysqli_query($connection, $query);
		if ($result && mysqli_affected_rows($connection) == 1){
			return true;
		}else{
			return false;
		}
	}
	
	function find_pre($c){
		global $connection;
		$ava  = "SELECT * FROM reading_list WHERE turn = 'Y' LIMIT 1";
		$result = mysqli_query($connection, $ava);
		confirm_query($result);
		if ($c = mysqli_fetch_assoc($result)){
			return $c;
		}else{
			return null;
		}
	}
}
{////////////////////////	DB Instructor ///////////////////////////////////////////
	
	
	function ins_login($id, $giving_pass){
		$id = find_ins_pass($id);
		$orgnl_pass = $id["pass"];
		if (password_verify($giving_pass, $orgnl_pass)) {
			return true;
		} else {
			return false;
		}
	}
	
	function find_ins_pass($id){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$query  = "SELECT * FROM instructor WHERE id = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($id = mysqli_fetch_assoc($result)){
			return $id;
		}else{
			return null;
		}
	}
	
	function ins_ann_del($id){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$query = "DELETE FROM instractions WHERE id = {$id} LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Deleted successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ann.php\">";
		}else{
			echo "<script type=\"text/javascript\">alert(\"Error has occured.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ann.php\">";
		}	
	}
	
	function ins_ann_edit($id,$new_title,$new_txt){
		global $connection;
		$new_title = mysqli_real_escape_string($connection, $new_title);
		$new_txt = mysqli_real_escape_string($connection, $new_txt);
		$query  = "UPDATE instractions SET title = '{$new_title}', body = '{$new_txt}' WHERE id = {$id} LIMIT 1";
		$result = mysqli_query($connection, $query);

		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Edited successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ann_edit.php?id=" . $id ."\">";
		}else{
			 echo  "<div class=\"error\">There is a problem with the DB.</div>";
		}	
	}
	
	function ins_ann_new($new_title,$new_txt){
		global $connection;
		$new_title = mysqli_real_escape_string($connection, $new_title);
		$new_txt = mysqli_real_escape_string($connection, $new_txt);
		$query  = "INSERT INTO instractions (id, title, body, Date) VALUES ('', '{$new_title}', '{$new_txt}', CURRENT_TIMESTAMP)";
		$result =  mysqli_query($connection, $query);
		if ($result){
			echo "<script type=\"text/javascript\">alert(\"Announcement was posted successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ann.php\">";
		}else{
			 echo  "<div class=\"error\">There was a problem with the DB.</div>";
		}	
	}
	
	function ins_list_ann(){
		global $connection;
		$query  = "SELECT * FROM instractions ORDER BY id ASC";
		$result = mysqli_query($connection, $query);
		confirm_query($result);	
		while($row = mysqli_fetch_assoc($result)){
			echo "<form>";
			echo "<tr>";
			echo "<td>" . $row["id"] . "</td>";
			echo "<td>" . $row["title"] . "</td>";
			echo "<td>" . $row["Date"] . "</td>";
			echo "<td>" . "<a href=\"ins_ann_view.php?id=" . $row["id"] . "\" target=\"_blank\">View</a></td>";
			echo "<td>" . "<a href=\"ins_ann_edit.php?id=" . $row["id"] . "\" target=\"_blank\">edit</a></td>";
			echo "<td>" . "<a href=\"ins_ann_del.php?id=" . $row["id"] . "\" onclick=\"return confirm('Confirm Deleting ?');\">delete</a></td>";
			echo "</tr>";
			echo "</form>";
		}
		mysqli_free_result($result);
	}
	
	function ins_ap_sel($p, $i){
		global $connection;
		$query = "UPDATE reading_list SET pre_id = '{$p}' WHERE num = '{$i}'";
		$result = mysqli_query($connection, $query);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Selected successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ap.php\">";
		}else{
			 echo  "<div class=\"error\">There is a problem with the DB.</div>";
			 echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ap.php\">";
		 }
		
	}
	
	function ins_ap_list(){
		global $connection;		
		$query  = "SELECT * FROM reading_list ORDER BY all_rev DESC";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		$n = 1;
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>" . $n++ . "</td>";
			echo "<td>" . $row["title"] . "</td>";
			echo "<td>";
			echo "<form method=\"get\" name=\"reply\">";
			echo "<select style=\"width:160px;\" name=\"presenter\" onchange=\"this.form.submit();\" ";
			echo (is_null($row["re1_id"]) ? "disabled" : "");
			echo ">";
			echo "<option selected=\"selected\">";
			echo (!is_null($row["re1_id"]) ? "Select Presenter" : "NONE");
			echo "</option>";							
			if (!is_null($row["re1_id"])){
				echo "<option value=\"" . $row["re1_id"] . "\"";
				echo ($row["re1_id"] == $row["pre_id"] ? 'selected="selected"' : '' );
				echo ">" . find_id_pass($row["re1_id"])["name"] . "</option>";
			}
			if (!is_null($row["re2_id"])){
				echo "<option name=\"p_id\" value=\"" . $row["re2_id"] . "\"";
				echo ($row["re2_id"] == $row["pre_id"] ? 'selected="selected"' : '' );
				echo ">" . find_id_pass($row["re2_id"])["name"] . "</option>";
			}
			if (!is_null($row["re3_id"])){
				echo "<option name=\"p_id\" value=\"" . $row["re3_id"] . "\"";
				echo ($row["re1_id"] == $row["pre_id"] ? 'selected="selected"' : '' );
				echo ">" . find_id_pass($row["re3_id"])["name"] . "</option>";
			}
			echo "<option value=\"NULL\">cancel this selection</option>";
			echo "</select>";
			echo "<input type='hidden' name='paper' value='{$row['num']}'>";
			echo "</form>";
         echo "</td>";
			echo "<td>";
			if (!is_null($row["re1_id"])){
				echo find_id_pass($row["re1_id"])["name"] . "<br />";
			}
			if (!is_null($row["re2_id"])){
				echo find_id_pass($row["re2_id"])["name"] . "<br />";
			}
			if (!is_null($row["re3_id"])){
				echo find_id_pass($row["re3_id"])["name"] . "<br />";
			}
			echo "</td>";
			echo "</tr>";
		}
		mysqli_free_result($result);
	}
	
	function ins_ce_app($id){
		global $connection;
		$query  = "UPDATE presentations SET app = 'Y' WHERE id = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
	
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Approved successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ce.php\">";
		}else{
			echo "<script type=\"text/javascript\">alert(\"Error has occured.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ce.php\">";
		}	
	}
	
	function ins_ce_del($id){
		global $connection;
		$query = "DELETE FROM presentations WHERE id = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Deleted successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ce.php\">";
		}else{
			echo "<script type=\"text/javascript\">alert(\"Error has occured.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ce.php\">";
		}	
	}
	
	function ins_ce_grd($id, $gr, $gc){
		global $connection;
		$query  = "UPDATE students SET pre_grd = {$gr}, pre_cmn = '{$gc}' WHERE name = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
	
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Completed successfully.\");</script>";
			unset($_SESSION["presenter"]); 
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ce.php\">";
		}else{
			echo "<script type=\"text/javascript\">alert(\"Error has occured.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ce.php\">";
		}		
	}
	
	function ins_ce_se(){
		global $connection;
		
		$counting  = "SELECT * FROM reading_list WHERE cmp  IS NOT NULL AND pre_id IS NOT NULL";
		$result = mysqli_query($connection, $counting);
		confirm_query($result);

		while($c = mysqli_fetch_assoc($result)){
			echo "<option value=\"" . $c["pre_id"] . "\">" . find_id_pass($c["pre_id"])["name"] . "</option>";
		}
	}
	
	function ins_ce_shw(){
		global $connection;
		echo "<table BORDER=\"2\" BORDERCOLOR=\"#09C\" style=\"width:650px;\">";
		echo "<tr>";
		echo "<th style=\"width:150px;\">Evaluator</th>";
		echo "<th colspan=\"5\">Criteria</th>";
		echo "<th style=\"width:10%;\">Comments</th>";
		echo "<th style=\"width:10%;\">Approve</th>";
		echo "<th style=\"width:10%;\">Delete</th>";
		echo "</tr>";
		echo "</table>";
		global $pp;
		$query  = "SELECT * FROM presentations WHERE presenter = '{$pp}'";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		$count = 0;
		$ave_org = 0;
		$ave_mat = 0;
		$ave_abi = 0;
		$ave_dis = 0;
		$ave_kno = 0;
		while($row = mysqli_fetch_assoc($result)){
			echo "<form method=\"post\" action=\"ins_ce.php\">";
			echo "<table BORDER=\"2\" BORDERCOLOR=\"#09C\" style=\"width:650px;\">";
			echo "<tr>";
			echo "<td style=\"width:150px;\">" . $row["evaluator"] . " (" . $row["id"] .  ")</td>";
			echo "<input type=\"hidden\" name=\"rrow\" value=\"" . $row["id"] . "\">";
			$count++;
			echo "<td>" . $row["org"] . "</td>";
			$ave_org += $row["org"];
			echo "<td>" . $row["mat"] . "</td>";
			$ave_mat += $row["mat"];
			echo "<td>" . $row["abi"] . "</td>";
			$ave_abi += $row["abi"];
			echo "<td>" . $row["dis"] . "</td>";
			$ave_dis += $row["dis"];
			echo "<td>" . $row["kno"] . "</td>";
			$ave_kno += $row["kno"];
			echo "<td style=\"width:5%;\"><input type=\"button\" onclick=\"location.href='#cmn-" . $count . "';\" value=\"&#9781;\" style=\"width:30px;\"></td>";
			echo "<input type=\"hidden\" name=\"presenter\" value=\"" . $row["presenter"] . "\">";
			if(is_null($row["app"])){
				echo "<td style=\"width:10%;\"><input type=\"submit\" value=\"&#10003;\" name=\"approve\" style=\"width:30px;\"></td>";
			}else{
				echo "<td style=\"width:10%;\"><div style=\"text-shadow: 0 0 3px green, 0 0 5px #0000FF;\">&#10003;</div></td>"; 
			}
			echo "<td style=\"width:10%;\"><input type=\"submit\" value=\"&#10008;\" class=\"del\" name=\"del\" style=\"width:30px;\"></td>";
			echo "</tr>";
			echo "</table>";
			echo "<div id=\"cmn-" . $count . "\">";
			echo "<table BORDER=\"2\" BORDERCOLOR=\"#09C\" style=\"width:650px;\">";
			echo "<tr>";
			echo "<td colspan=\"9\">" . $row["com"] . "</td>";
			echo "</tr>";
			echo "</table>";
			echo "</div>";
			echo "</form>";
		}
		mysqli_free_result($result);
	}
	
	function ins_cg(){
		global $connection;
		$query  = "SELECT * FROM students ORDER BY student_id ASC LIMIT 15";
		$result = mysqli_query($connection, $query);
		confirm_query($result);	
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>" . $row["name"] . "</td>";
			$p = rand(20,30);
			echo "<td>" . $p . "</td>";
			$r1 = rand(5,10);
			echo "<td>" . $r1 . "</td>";
			$r2 = rand(5,10);
			echo "<td>" . $r2 . "</td>";
			$r3 = rand(5,10);
			echo "<td>" . $r3 . "</td>";
			echo "<td>" . ($p+$r1+$r2+$r3) . "</td>";
			echo "</tr>";
		}
		mysqli_free_result($result);
	}
	
	function ins_ep_app(){
		global $connection;
		$counting  = "SELECT * FROM reading_list WHERE turn IS NULL AND pre_id IS NOT NULL";
		$result = mysqli_query($connection, $counting);
		confirm_query($result);
		while($c = mysqli_fetch_assoc($result)){
			echo "<option value=\"" . $c["pre_id"] . "\">" . find_id_pass($c["pre_id"])["name"] . "</option>";
		}
	}

	function ins_ep_frm($pre, $eva, $org, $mat, $abi, $dis, $kno, $com){
		global $connection;
		$query  = "INSERT INTO presentations (id, presenter, date, evaluator, org, mat, abi, dis, kno, com) VALUES ('', '{$pre}', CURRENT_TIMESTAMP ,'{$eva}', '{$org}', '{$mat}', '{$abi}', '{$dis}', '{$kno}', '{$com}')";
		$result = mysqli_query($connection, $query);

		if (!$result){
			echo "<script type=\"text/javascript\">alert(\"There was a problem with DB.\");</script>";
		}
		echo "<script type=\"text/javascript\">alert(\"Your evaluation was sumitted successfully.\");</script>";
		echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ep.php\">";
	}

	function ins_ep_s_app($prs){
		global $connection;
		$query  = "UPDATE reading_list SET turn = 'Y' WHERE pre_id = '{$prs}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Prsenter has approved, and evaluation session has started .\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ep.php\">";
		}else{
			echo "<script type=\"text/javascript\">alert(\"There was a problem with your request.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ep.php\">";
		}	
	}

	function ins_ep_t_app($tr){
		global $connection;
		$query  = "UPDATE reading_list SET turn = NULL, cmp = 'C' WHERE pre_id = '{$tr}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Evaluation session has been terminated .\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ep.php\">";
		}else{
			//echo $query;
			//exit;
			echo "<script type=\"text/javascript\">alert(\"There was a problem with your request.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ep.php\">";
		}	
	}

	function ins_er(){
		global $connection;
		$query  = "SELECT * FROM reviews ORDER BY id ASC";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		$n = 1;
		while($row = mysqli_fetch_assoc($result)){
			echo "<form>";
			echo "<tr>";
			echo "<td>" . $n++ . "</td>";
			echo "<td>" . $row["Paper"] . "</td>";
			echo "<td>" . $row["reviewer"] . "</td>";
			echo "<td>" . $row["date_time"] . "</td>";
			echo "<td>" . "<a href=\"ins_er_eval.php?id=" . $row["id"] . "\" target=\"_blank\">evaluate</a></td>";
			echo "</tr>";
			echo "</form>";
		}
		mysqli_free_result($result);
	}

	function ins_er_evl_list($id){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$query  = "SELECT * FROM reviews WHERE id = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($id = mysqli_fetch_assoc($result)){
			mysqli_free_result($result);
			return $id;
		}else{
			die("An error has occurred.");
		}
	}

	function ins_er_grd($comments,$grade,$id){
		global $connection;
		$comments = mysqli_real_escape_string($connection, $comments);
		$grade = mysqli_real_escape_string($connection, $grade);
		$query  = "UPDATE reviews SET ins_grd = '{$grade}', ins_cmn = '{$comments}' WHERE id = {$id} LIMIT 1";
		$result = mysqli_query($connection, $query);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Evaluated successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_er_eval.php?id=" . $id ."\">";
		}else{
			 echo  "<div class=\"error\">There is a problem with the DB.</div>";
		}	
	}

	function ins_rlst(){
		global $connection;
		$query  = "SELECT * FROM reading_list ORDER BY num ASC";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>" . $row["num"] . "</td>";
			echo "<td>" . $row["title"] . "</td>";
			echo "<td>" . "<a href=\"http://" . $row["link"] . "\" target=\"_blank\">view</a></td>";
			echo "<td>" . "<a href=\"ins_rlst_edit.php?id=" . $row["num"] . "\" target=\"_blank\">edit</a></td>";
			echo "<td>" . "<a href=\"ins_rlst_del.php?id=" . $row["num"] . "\" onclick=\"return confirm('Confirm Deleting ?');\">delete</a></td>";
			echo "</tr>";
		}
		mysqli_free_result($result);
	}

	function ins_rlst_del($id){
		global $connection;
		$query = "DELETE FROM reading_list WHERE num = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Deleted successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_rlst.php\">";
		}else{
			echo $query;
			exit;
			echo "<script type=\"text/javascript\">alert(\"Error has occured.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_rlst.php\">";
		}
	}

	function ins_rlst_edit_list($id){
		global $connection;
		$query  = "SELECT * FROM reading_list WHERE num = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($id = mysqli_fetch_assoc($result)){
			mysqli_free_result($result);
			return $id;
		}else{
			die("An error has occurred.");
		}
	}

	function ins_rlst_edit_upd($new_title,$new_link,$new_id,$old_id){
		global $connection;
		$new_title = mysqli_real_escape_string($connection, $new_title);
		$new_link = mysqli_real_escape_string($connection, $new_link);
		$new_id = mysqli_real_escape_string($connection, $new_id);
		$query = "UPDATE reading_list SET num = '{$new_id}', title = '{$new_title}', link = '{$new_link}' WHERE num = '{$old_id}'";
		$result = mysqli_query($connection, $query);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Updated successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_rlst_edit.php?id=" . $new_id ."\">";
		}else{
			 echo  "<div class=\"error\">Either the data are the same <br /> ore there is a problem with the DB.</div>";
		}	
	}

	function ins_rlst_new($id,$title,$link){
		global $connection;
		$id = mysqli_real_escape_string($connection, $id);
		$title = mysqli_real_escape_string($connection, $title);
		$link = mysqli_real_escape_string($connection, $link);
		$query  = "INSERT INTO reading_list (num, title, link) VALUES ('{$id}', '{$title}', '{$link}')";
		$result = mysqli_query($connection, $query);
		if ($result){
			echo "<script type=\"text/javascript\">alert(\"Paper was added successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_rlst.php\">";
		}else{
			 echo  "<div class=\"error\">There was a problem with the DB.</div>";
		}			
	}

	function ins_reg(){
		global $connection;
		$query  = "SELECT * FROM students ORDER BY student_id ASC";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>" . $row["student_id"] . "</td>";
			echo "<td>" . $row["name"] . "</td>";
			echo "<td>" . $row["email"] . "</td>";
			if ($row["state"] == 0){
				echo "<td>" . "<a href=\"ins_reg_app.php?id=" . $row["student_id"] . "\">Approve</a></td>";
			}else{
				echo "<td>Apporved</td>";
			}
			echo "<td>" . "<a href=\"ins_reg_del.php?id=" . $row["student_id"] . "\" onclick=\"return confirm('Confirm Deleting ?');\">delete</a></td>";
			echo "</tr>";
		}
		mysqli_free_result($result);
	}

	function ins_reg_app($id){
		global $connection;
		$query  = "UPDATE students SET state = 1 WHERE student_id = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Approved successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_reg.php\">";
		}else{
			echo "<script type=\"text/javascript\">alert(\"Error has occured.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_reg.php\">";
		}	
	}

	function ins_reg_del($id){
		global $connection;
		$query = "DELETE FROM students WHERE student_id = '{$id}' LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if ($result && mysqli_affected_rows($connection) == 1){
			echo "<script type=\"text/javascript\">alert(\"Deleted successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_reg.php\">";
		}else{
			echo "<script type=\"text/javascript\">alert(\"Error has occured.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_reg.php\">";
		}	
	}


}
?>