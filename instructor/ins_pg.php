<?php $page_title = "Instructor Page";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/header.php"); ?>
<br /><br /><br />
<fieldset>
	<legend>Instructor Page</legend><br />
	<table>
		<tr class="non">
			<td><input style="width:200px; height:40px;" type="button" onclick="location.href='ins_ann.php';" value="Announcement Control"></td>
			<td></td>
			<td><input style="width:200px; height:40px;" type="button" onclick="location.href='ins_reg.php';" value="Registration Approval"></td>
		</tr>
		<tr>
			<td><input style="width:200px; height:40px;" type="button" onclick="location.href='ins_rlst.php';" value="Reading List"></td>
			<td></td>
			<td><input style="width:200px; height:40px;" type="button" onclick="location.href='ins_ap.php';" value="Paper Assignment"></td>
		</tr>
		<tr>
			<td><input style="width:200px; height:40px;" type="button" onclick="location.href='ins_ep.php';" value="Presentation Evaluation"></td>
			<td></td>
			<td><input style="width:200px; height:40px;" type="button" onclick="location.href='ins_ce.php';" value="Present. (Grades/Classmates)"></td>
		</tr>
		<tr>
			<td><input style="width:200px; height:40px;" type="button" onclick="location.href='ins_er.php';" value="Reviews Evaluation"></td>
			<td></td>
			<td><input style="width:200px; height:40px;" type="button" onclick="location.href='ins_cg.php';" value="Students Grades"></td>
		</tr>
	</table>
	<br /><hr>
	<center>
		<input style="width:200px; height:40px;" type="button" onclick="location.href='ins_ii.php';" value="Account Information">
		<br />
		<input style="width:200px; height:40px;" class="del" type="button" onclick="location.href='ins_logout.php';" value="Logout">
	</center>
</fieldset>
<br /><br /><br />
<?php include("../includes/footer.php");?>