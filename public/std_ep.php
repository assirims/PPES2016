<?php $page_title = "Presentation Evaluation";?>
<?php require_once("../includes/sessions.php"); ?>
<?php $ev = $_SESSION['student_id'];?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php $pr = find_pre($c)["pre_id"];	?>
<?php $pr = find_id_pass($pr)["name"]?>
<?php $ev = find_id_pass($ev)["name"]; ?>
<br />
<fieldset style="width:auto;">
	<legend>Presentation Evaluation</legend><br />
	<?php if (is_null(find_pre($c)["turn"])){
	echo "<br /><h1>(╯︵╰)</h1><br />";
 	echo  "<div class=\"error\">This function is currently locked by the instractor.</div>";
	echo "<br /><br />";
	exit;
}else{
	
	if(isset($_POST['submit'])){
		
		insert_eval($pr,$ev,$_POST['organization2'],$_POST['materials2'],$_POST['ability2'],$_POST['discussion2'],$_POST['knowledge2'],$_POST['comment2']);
		
	}elseif(isset($_POST['rev'])){ ?>
	<form method="post" action="std_ep.php">
	<br />
	<table BORDER="2" BORDERCOLOR="#09C">
		<tr>
			<td>Presenter:</td>
			<td><input type="hidden" name="presenter2" value="<?php echo $_POST["presenter"];?>"><?php echo $pr; ?></td>
		</tr>
		<tr>
			<td>Date and Time:</td>
			<td><?php echo date("Y-m-d H:i:s");?> (Will be calculated!)</td>
		</tr>
		<tr>
			<td>Evaluator:</td>
			<td><input type="hidden" name="evaluator2" value="<?php echo $_POST["evaluator"];?>"><?php echo $ev;?></td>
		</tr>
		<tr>
			<th colspan="2">Criteria</th>
		</tr>
		<tr>
			<td>Organization</td>
			<td><input type="hidden" name="organization2" value="<?php echo $_POST["organization"];?>"><?php echo $_POST["organization"]; ?></td>
		</tr>
		<tr>
			<td>Presentation Materials</td>
			<td><input type="hidden" name="materials2" value="<?php echo $_POST["materials"];?>"><?php echo $_POST["materials"]; ?></td>
		</tr>
		<tr>
			<td>Presentation Ability</td>
			<td><input type="hidden" name="ability2" value="<?php echo $_POST["ability"];?>"><?php echo $_POST["ability"]; ?></td>
		</tr>
		<tr>
			<td>Discussion</td>
			<td><input type="hidden" name="discussion2" value="<?php echo $_POST["discussion"];?>"><?php echo $_POST["discussion"]; ?></td>
		</tr>
		<tr>
			<td>Knowledge</td>
			<td><input type="hidden" name="knowledge2" value="<?php  echo $_POST["knowledge"];?>"><?php echo $_POST["knowledge"]; ?></td>
		</tr>
		<tr>
			<td>Other comments:</td>
			<td style="white-space: normal; width:300px;"><input type="hidden" name="comment2" value="<?php echo htmlentities($_POST["comment"]);?>"><?php echo htmlentities($_POST["comment"]); ?></td>
		</tr>
	</table>
	<br />
	<center>
   	<input type="submit" name="submit" value="Submit" onClick="return confirm('Is ALL information correct ?')"> 
		<br />
		<input type="button" onclick="location.href='std_ep.php';" class="del" value="Back">
	</center>
	<br />
	</form>
	<?php	}else{ ?>
	<form method="post" action="std_ep.php">
		<table BORDER="2" BORDERCOLOR="#09C">
			<tr>
				<td>Presenter:</td>
				<td><input type="text" name="presenter" value="<?php echo $pr; ?>"  disabled></td>
			</tr>
			<tr>
				<td>Date:</td>
				<td><input type="text" name="date" value="<?php echo date("Y-m-d H:i:s");?>" disabled></td>
			</tr>
			<tr>
				<td>Evaluator:</td>
				<td><input type="text" name="evaluator" value="<?php echo $ev;?>"  disabled></td>
			</tr>
		</table><br />
	   <center><input type="submit" class="del" value="Criteria For Evaluation" onclick="window.open('help.php?id=7'); return false;"></center>
		<br />
		<table BORDER="2" BORDERCOLOR="#09C">
			<tr>
				<th width="90">Criteria    </th>
				<th width="90">Poor        </th>
				<th width="90">Needs Work</th>
				<th width="90">Satisfactory</th>
				<th width="90">Very Good   </th>
				<th width="90">Outstanding </th>
			</tr>
			<tr>
				<th>Organization</th>
				<td><input type="radio" name="organization" class="poor" value="Poor"></td>
				<td><input type="radio" name="organization" class="need" value="Needs Work"></td>
				<td><input type="radio" name="organization" class="sat" value="Satisfactory"></td>
				<td><input type="radio" name="organization" class="good" value="Very Good"></td>
				<td><input type="radio" name="organization" class="out" value="Outstanding"></td>
			</tr>
			<tr>
				<th>Presentation Materials</th>
				<td><input type="radio" name="materials" class="poor" value="Poor"></td>
				<td><input type="radio" name="materials" class="need" value="Needs Work"></td>
				<td><input type="radio" name="materials" class="sat" value="Satisfactory"></td>
				<td><input type="radio" name="materials" class="good" value="Very Good"></td>
				<td><input type="radio" name="materials" class="out" value="Outstanding"></td>
			</tr>
			<tr>
				<th>Presentation Ability</th>
				<td><input type="radio" name="ability" class="poor" value="Poor"></td>
				<td><input type="radio" name="ability" class="need" value="Needs Work"></td>
				<td><input type="radio" name="ability" class="sat" value="Satisfactory"></td>
				<td><input type="radio" name="ability" class="good" value="Very Good"></td>
				<td><input type="radio" name="ability" class="out" value="Outstanding"></td>
			</tr>
			<tr>
				<th>Discussion</th>
				<td><input type="radio" name="discussion" class="poor" value="Poor"></td>
				<td><input type="radio" name="discussion" class="need" value="Needs Work"></td>
				<td><input type="radio" name="discussion" class="sat" value="Satisfactory"></td>
				<td><input type="radio" name="discussion" class="good" value="Very Good"></td>
				<td><input type="radio" name="discussion" class="out" value="Outstanding"></td>
			</tr>
			<tr>
				<th>Knowledge</th>
				<td><input type="radio" name="knowledge" class="poor" value="Poor"></td>
				<td><input type="radio" name="knowledge" class="need" value="Needs Work"></td>
				<td><input type="radio" name="knowledge" class="sat" value="Satisfactory"></td>
				<td><input type="radio" name="knowledge" class="good" value="Very Good"></td>
				<td><input type="radio" name="knowledge" class="out" value="Outstanding"></td>
			</tr>
		</table><br />
	   <center>Other comments:<textarea style='width: 100%;' name="comment" class="pe"></textarea>
		<br />
	   <input type="submit" name="rev" value="Review"> 
		</center>
	</form>
<?php }}?>
	<br />
	<input type="button" onclick="location.href='std_pg.php';" value="Back"><br />
</fieldset>
<br />
<?php include("../includes/footer.php");?>