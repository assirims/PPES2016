<?php $page_title = "Reviews Evaluation";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php	$id = ins_er_evl_list(urldecode($_GET["id"])); ?>
<br />
<fieldset style="width:650px;">
	<legend>Reviews Evaluation</legend><br />
		<form method="post">
			<table style="width:650px;" BORDER="2" BORDERCOLOR="#09C">
				<tr>
					<td>Date and Time:</td>
					<td><?php echo $id["date_time"];?></td>
				</tr>
				<tr>
					<td>Reviewer:</td>
					<td><?php echo $id["reviewer"]; ?></td>
				</tr>
				<tr>
					<td>Paper:</td>
					<td><?php echo $id["Paper"]; ?></td>
				</tr>
				<tr>
					<td>Technical Correctness</td>
					<td><?php echo $id["technical"]; ?></td>
				</tr>
				<tr>
					<td>Originality</td>
					<td><?php echo $id["originality"]; ?></td>
				</tr>
				<tr>
					<td>Technical Depth</td>
					<td><?php echo $id["depth"]; ?></td>
				</tr>
				<tr>
					<td>Impact/Significance</td>
					<td><?php echo $id["impact"]; ?></td>
				</tr>
				<tr>
					<td>Presentation</td>
					<td><?php echo $id["presentation"]; ?></td>
				</tr>
				<tr>
					<td>Ovarall Rating</td>
					<td><?php echo $id["overall"]; ?></td>
				</tr>
				<tr>
					<td>Summary:</td>
					<td style="white-space: normal; width:300px;"><?php echo htmlentities($id["summary"]); ?></td>
				</tr>
				<tr>
					<td>Strengths</td>
					<td style="white-space: normal; width:300px;"><?php echo htmlentities($id["strengths"]); ?></td>
				</tr>
				<tr>
					<td>Weaknesses</td>
					<td style="white-space: normal; width:300px;"><?php echo htmlentities($id["weaknesses"]); ?></td>
				</tr>
			</table>
			<br />
			<center>
				Comments:
		<textarea style='width: 100%;' name="ins_cmn" class="pe"><?php echo htmlentities($id["ins_cmn"]); ?></textarea>
		<br />
		<table>
			<tr>
				<td>Grade:</td>
				<td><input type="text" name="grade" value="<?php echo $id["ins_grd"];?>"></td>
			</tr>
		</table>
		<br />
		   	<input type="submit" name="grd" value="Grade" onClick="return confirm('Submitted ?')"> 
			</center>
			<br />
		</form>
	<br />
	<?php
		if(isset($_POST['grd'])){
			ins_er_grd($_POST["ins_cmn"],$_POST["grade"],urldecode($_GET["id"]));
		}?>
	<br />
	<center><input type="submit" onClick="window.close();" value="Close"></center>
	<br />
</fieldset>
<br /><br />
<?php include("../includes/footer.php");?>