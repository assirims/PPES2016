<?php $page_title = "Registration Approval";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<fieldset style="width:650px;">
	<legend>Registration Approval</legend><br />	
				<table>
					  <tr>
					    <th>Student Id</th>
					    <th>Student Name</th>
					    <th>Email</th>
						 <th>Aprove Registration</th>
						 <th>Delete</th>
					  </tr>
					<?php ins_reg(); ?>
				</table>
		<br />
			<input type="button" onclick="location.href='ins_pg.php';" value="Back"></center>
	<br />
</fieldset>
<?php include("../includes/footer.php");?>