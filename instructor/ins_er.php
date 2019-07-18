<?php $page_title = "Reviews Evaluation";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<br />
<fieldset style="width:650px;">
	<legend>Reviews Evaluation</legend><br />
			<table BORDER="2" BORDERCOLOR="#09C">
				<tr>
					<th>#</th>
					<th>Paper Title</th>
					<th>Reviewer</th>
					<th>Date</th>
					<th>Evaluate</th>
				</tr>
					<?php ins_er(); ?>
			</table>
	<br />
	<input type="button" onclick="location.href='ins_pg.php';" value="Back"></center>
<br />	
</fieldset>
<br />
<?php include("../includes/footer.php");?>