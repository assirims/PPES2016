<?php $page_title = "Announcement Control";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<fieldset style="width:650px;">
	<legend>Announcement Control</legend><br />
		<center>
			<a href="ins_ann_new.php" target="_self">Add a new announcement</a>
			<br />
			<br />
		</center>
			<table>
				  <tr>
				    <th>Id</th>
				    <th>Title</th>
				    <th>Date</th>
					 <th>View</th>
					 <th>Edit</th>
					 <th>Delete</th>
				  </tr>
				<?php ins_list_ann(); ?>	
				</table>
	<br />
		<input type="button" onclick="location.href='ins_pg.php';" value="Back"></center>
<br />
</fieldset>
<?php include("../includes/footer.php");?>