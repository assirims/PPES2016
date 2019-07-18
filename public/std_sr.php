<?php $page_title = "Reviews Submission";?>
<?php require_once("../includes/sessions.php"); ?>
<?php $id = $_SESSION['student_id'];?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php $id = find_id_pass($id); ?>
<br />
<fieldset style="width:auto;">
	<legend>Reviews Submission</legend><br />
	
	<?php if(isset($_POST['submit'])){
		
		$reviewer = mysqli_real_escape_string($connection, $_POST['name2']);
		$Paper = mysqli_real_escape_string($connection, $_POST['papers2']);
		$technical = mysqli_real_escape_string($connection, $_POST['correctness2']);
		$originality = mysqli_real_escape_string($connection, $_POST['originality2']);
		$depth = mysqli_real_escape_string($connection, $_POST['depth2']);
		$impact = mysqli_real_escape_string($connection, $_POST['impact2']);
		$presentation = mysqli_real_escape_string($connection, $_POST['presentation2']);
		$overall = mysqli_real_escape_string($connection, $_POST['rating2']);
		$summary = mysqli_real_escape_string($connection, $_POST['comment2']);
		$strengths = mysqli_real_escape_string($connection, $_POST['strengths2']);
		$weaknesses = mysqli_real_escape_string($connection, $_POST['weaknesses2']);

		
		$query  = "INSERT INTO reviews ";
		$query .= "(id, reviewer, date_time, Paper, technical, originality, depth, impact, presentation, overall, summary, strengths, weaknesses";
		$query .= ") VALUES (";
		$query .= "'', '{$reviewer}', CURRENT_TIMESTAMP ,'{$Paper}', '{$technical}', '{$originality}', '{$depth}', '{$impact}', '{$presentation}', '{$overall}', '{$summary}', '{$strengths}', '{$weaknesses}'";
		$query .= ")";
		$result = mysqli_query($connection, $query);

		if ($result){
			echo "<script type=\"text/javascript\">alert(\"Your review was sumitted successfully.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=std_sr.php\">";
		}else{
			echo "<script type=\"text/javascript\">alert(\"There was a problem, please try again.\");</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=std_sr.php\">";
		}

	?>
	<?php }elseif(isset($_POST['review'])){?>
		<form method="post" action="std_sr.php">
		<br />
		<table BORDER="2" BORDERCOLOR="#09C">
			<tr>
				<td>Date and Time:</td>
				<td><?php echo date("Y-m-d H:i:s");?> (Will be calculated!)</td>
			</tr>
			<tr>
				<td>Reviewer:</td>
				<td><input type="hidden" name="name2" value="<?php echo $id["name"];?>"><?php echo $id["name"];?></td>
			</tr>
			<tr>
				<td>Paper:</td>
				<td><input type="hidden" name="papers2" value="<?php echo $_POST["papers"];?>"><?php echo $_POST["papers"]; ?></td>
			</tr>
			<tr>
				<td>Technical Correctness</td>
				<td><input type="hidden" name="correctness2" value="<?php $_POST["correctness"];?>"><?php echo $_POST["correctness"]; ?></td>
			</tr>
			<tr>
				<td>Originality</td>
				<td><input type="hidden" name="originality2" value="<?php echo $_POST["originality"];?>"><?php echo $_POST["originality"]; ?></td>
			</tr>
			<tr>
				<td>Technical Depth</td>
				<td><input type="hidden" name="depth2" value="<?php echo $_POST["depth"];?>"><?php echo $_POST["depth"]; ?></td>
			</tr>
			<tr>
				<td>Impact/Significance</td>
				<td><input type="hidden" name="impact2" value="<?php  $_POST["impact"];?>"><?php echo $_POST["impact"]; ?></td>
			</tr>
			<tr>
				<td>Presentation</td>
				<td><input type="hidden" name="presentation2" value="<?php echo $_POST["presentation"];?>"><?php echo $_POST["presentation"]; ?></td>
			</tr>
			<tr>
				<td>Ovarall Rating</td>
				<td><input type="hidden" name="rating2" value="<?php echo $_POST["rating"];?>"><?php echo $_POST["rating"]; ?></td>
			</tr>
			<tr>
				<td>Summary:</td>
				<td style="white-space: normal; width:300px;"><input type="hidden" name="comment2" value="<?php echo htmlentities($_POST["comment"]);?>"><?php echo htmlentities($_POST["comment"]); ?></td>
			</tr>
			<tr>
				<td>Strengths</td>
				<td style="white-space: normal; width:300px;"><input type="hidden" name="strengths2" value="<?php echo htmlentities($_POST["strengths"]);?>"><?php echo htmlentities($_POST["strengths"]); ?></td>
			</tr>
			<tr>
				<td>Weaknesses</td>
				<td style="white-space: normal; width:300px;"><input type="hidden" name="weaknesses2" value="<?php echo htmlentities($_POST["weaknesses"]);?>"><?php echo htmlentities($_POST["weaknesses"]); ?></td>
			</tr>
		</table>
		<br />
		<center>
	   	<input type="submit" name="submit" value="Submit" onClick="return confirm('Is ALL information correct ?')"> 
			<br />
			<input type="button" onclick="location.href='std_sr.php';" class="del" value="Back">
		</center>
		<br />
	</form>
	<?php	}else{?>
	<form method="post" action="std_sr.php">
		<table>
			<tr>
				<td>Reviewer :</td>
				<td><input type="text" name="reviewer" value="<?php echo $id["name"];?>"  disabled></td>
			</tr>
			<tr>
				<td>Paper:</td>
				<td>
		 	  	 	<select name="papers">
						<option vlaue="non">Please Select Paper</option>
						<?php
	
								$student_id = $id["student_id"];
								$counting  = "SELECT * FROM reading_list WHERE re1_id = '{$student_id}' OR re2_id = '{$student_id}' OR re3_id = '{$student_id}'";
								$result = mysqli_query($connection, $counting);
								confirm_query($result);
		
								while($c = mysqli_fetch_assoc($result)){
									echo "<option value=\"" . $c["title"] . "\">" . $c["title"] . "</option>";
								}
	
						?>
		 	  		</select>
				</td>
			</tr>
		</table><br />
		
		
		<center><input type="submit" class="del" value="Instructions" onclick="window.open('help.php?id=2'); return false;"></center>
		<br />

		<table BORDER="2" BORDERCOLOR="#09C">
			<tr>
				<th>Technical Correctness</th>
				<td><input type="radio" name="correctness" class="rev" value="Yes">Yes</td>
				<td><input type="radio" name="correctness" class="rev" value="Mostly">Mostly</td>
				<td><input type="radio" name="correctness" class="rev" value="Little">Little</td>
				<td><input type="radio" name="correctness" class="rev" value="No">No</td>
			</tr>
			<tr>
				<th>Originality</th>
				<td><input type="radio" name="originality" class="rev" value="Very Good">Very Good</td>
				<td><input type="radio" name="originality" class="rev" value="Good">Good</td>
				<td><input type="radio" name="originality" class="rev" value="Marginal">Marginal</td>
				<td><input type="radio" name="originality" class="rev" value="Poor">Poor</td>
			</tr>
			<tr>
				<th>Technical Depth</th>
				<td><input type="radio" name="depth" class="rev" value="Very Good">Very Good</td>
				<td><input type="radio" name="depth" class="rev" value="Good">Good</td>
				<td><input type="radio" name="depth" class="rev" value="Marginal Depth">Marginal Depth</td>
				<td><input type="radio" name="depth" class="rev" value="Little">Little</td>
			</tr>
			<tr>
				<th>Impact/Significance</th>
				<td><input type="radio" name="impact" class="rev" value="Very Significant">Very Significant</td>
				<td><input type="radio" name="impact" class="rev" value="Significant">Significant</td>
				<td><input type="radio" name="impact" class="rev" value="Marginal Significance">Marginal Significance</td>
				<td><input type="radio" name="impact" class="rev" value="Little">Little</td>
			</tr>
			<tr>
				<th>Presentation</th>
				<td><input type="radio" name="presentation" class="rev" value="Very well Written">Very well Written</td>
				<td><input type="radio" name="presentation" class="rev" value="Readable">Readable</td>
				<td><input type="radio" name="presentation" class="rev" value="Needs Considerable Work">Needs Considerable Work</td>
				<td><input type="radio" name="presentation" class="rev" value="Unacceptably Bad">Unacceptably Bad</td>	
			</tr>
			<tr>
				<th>Overall Rating</th>
				<td><input type="radio" name="rating" class="rev" value="Strong Accept">Strong Accept</td>
				<td><input type="radio" name="rating" class="rev" value="Accept">Accept</td>
				<td><input type="radio" name="rating" class="rev" value="Weak Accept">Weak Accept</td>
				<td><input type="radio" name="rating" class="rev" value="Weak Reject">Weak Reject</td>
			</tr>												
		</table><br />
	   <center>
			Summary of the paper's main contribution and rationale for your recommendation.
			<textarea style='width: 100%;' name="comment" class="pe"></textarea>
			<br />
	   	List 1-3 strengths of the paper.
			<textarea style='width: 100%;' name="strengths" class="pe"></textarea>
			<br />
	   	List 1-3 weaknesses of the paper.
			<textarea style='width: 100%;' name="weaknesses" class="pe"></textarea>
			<br />
		<input type="submit" name="review" value="Review"> 
		<br />
		<input type="button" onclick="location.href='std_pg.php';" class="del" value="Back"></center>
		</center>
	</form>
	<?php }?>
	<br />
</fieldset>
<br /><br />
<?php include("../includes/footer.php");?>