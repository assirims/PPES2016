<?php $page_title = "Reviews Reports";?>
<?php require_once("../includes/sessions.php"); ?>
<?php $id = $_SESSION['student_id'];?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php $id = find_id_pass($id); ?>
<br />
<fieldset style="width:auto;">
	<legend>Reviews Reports</legend><br />

<?php if(isset($_POST['view'])){?>
		<form method="post" action="std_rr.php">
		<br />
		<?php

				//$student_id = $id["student_id"];
				$p_id = $_POST['papers'];
				// echo $p_id;
				// exit;
				$counting  = "SELECT * FROM reviews WHERE Paper = '{$p_id}' LIMIT 1";
				$result = mysqli_query($connection, $counting);
				confirm_query($result);

				$c = mysqli_fetch_assoc($result);
		?>
		<table BORDER="2" BORDERCOLOR="#09C">
			<tr>
				<th colspan="2">Your Grade</th>
			</tr>
			<tr>
				<td style="width:20%;">Grade:</td>
				<td><?php echo $c["ins_grd"]; ?></td>
			</tr>
			<tr>
				<td>Comments:</td>
				<td style="white-space: normal; width:300px;"><?php echo $c["ins_cmn"]; ?></td>
			</tr>
		</table>
		<br />
		<table BORDER="2" BORDERCOLOR="#09C">
			<tr>
				<th colspan="2">Your Review</th>
			</tr>
			<tr>
				<td>Date and Time:</td>
				<td><?php echo $c["date_time"];?></td>
			</tr>
			<tr>
				<td>Paper:</td>
				<td><?php echo $c["Paper"]; ?></td>
			</tr>
			<tr>
				<td>Technical Correctness</td>
				<td><?php echo $c["technical"]; ?></td>
			</tr>
			<tr>
				<td>Originality</td>
				<td><?php echo $c["originality"]; ?></td>
			</tr>
			<tr>
				<td>Technical Depth</td>
				<td><?php echo $c["depth"]; ?></td>
			</tr>
			<tr>
				<td>Impact/Significance</td>
				<td><?php echo $c["impact"]; ?></td>
			</tr>
			<tr>
				<td>Presentation</td>
				<td><?php echo $c["presentation"]; ?></td>
			</tr>
			<tr>
				<td>Ovarall Rating</td>
				<td><?php echo $c["overall"]; ?></td>
			</tr>
			<tr>
				<td>Summary:</td>
				<td style="white-space: normal; width:300px;"><?php echo htmlentities($c["summary"]); ?></td>
			</tr>
			<tr>
				<td>Strengths</td>
				<td style="white-space: normal; width:300px;"><?php echo htmlentities($c["strengths"]); ?></td>
			</tr>
			<tr>
				<td>Weaknesses</td>
				<td style="white-space: normal; width:300px;"><?php echo htmlentities($c["weaknesses"]); ?></td>
			</tr>
		</table>
		<br />
		<center>
			<br />
			<input type="button" onclick="location.href='std_pg.php';" value="Back">
		</center>
		<br />
	</form>
	<?php	}else{?>
	<form method="post" action="std_rr.php">
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
		<input type="submit" name="view" value="View">
		<br />
	</form>
	<input type="button" onclick="location.href='std_pg.php';" value="Back"></center>
	
	<?php }?>
	<br />
</fieldset>
<br /><br />
<?php include("../includes/footer.php");?>