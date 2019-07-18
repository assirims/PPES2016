<?php $page_title = "Students Grades";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<br />
<fieldset style="width:650px;">
	<legend>Students Grades</legend><br />
	As a demo, the results have been limited to 15 records.
	<br />
	<table BORDER="2" BORDERCOLOR="#09C">
		<tr>
			<th>Student Name</th>
			<th>Presentation</th>
			<th>Review 1</th>
			<th>Review 2</th>
			<th>Review 3</th>
			<th>Total</th>
		</tr>
		<?php ins_cg(); ?>
	</table>
	<br />
	<input type="button" onclick="location.href='ins_pg.php';" value="Back"></center>
	<br />
</fieldset>
<br />
<?php include("../includes/footer.php");?>