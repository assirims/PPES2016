<?php $page_title = "Reading List";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<fieldset style="width:650px;">
	<legend>Reading List</legend><br />
			<center>
				<a href="ins_rlst_new.php" target="_self">Add a new paper</a>
				<br />
				<br />
			</center>
				<table>
					  <tr>
					    <th>Paper ID</th>
					    <th>Title</th>
					    <th>Link</th>
						 <th>Edit</th>
						 <th>Delete</th>
					  </tr>
					<?php ins_rlst(); ?>
				</table>
		<br />
			<input type="button" onclick="location.href='ins_pg.php';" value="Back"></center>
	<br />
</fieldset>
<?php include("../includes/footer.php");?>