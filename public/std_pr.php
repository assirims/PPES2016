<?php $page_title = "Presentation Report";?>
<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php $id = find_id_pass($_SESSION['student_id'])["name"]; ?>
<?php	$c = get_eval($id); ?>
<br />
<fieldset>
	<legend>Presentation Report</legend><br />	
		<table BORDER="2" BORDERCOLOR="#09C">
			<tr>
				<th colspan="2">Your Grade</th>
			</tr>
			<tr>
				<td style="width:20%;">Grade:</td>
				<td><?php echo $c["pre_grd"]; ?></td>
			</tr>
			<tr>
				<td>Comments:</td>
				<td style="white-space: normal; width:300px;"><?php echo $c["pre_cmn"]; ?></td>
			</tr>
		</table>
		<br />
		<?php	list_eval($id);?>	
		<br />
		<input type="button" onclick="location.href='std_pg.php';" value="Back"></center>
		<br />
</fieldset>
<br />
<?php include("../includes/footer.php");?>