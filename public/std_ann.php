<?php $page_title = "Class Announcements!";?>
<?php session_start(); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/header.php"); ?>

<fieldset style="width: auto;">
	<legend>Class Announcements</legend><br />
	<table>
	  <tr>
	    <th>Id</th>
	    <th>Title</th>
	    <th>Date</th>
		 <th>Read</th>
	  </tr>
	<?php list_ann(); ?>
	</table>
	<br />
	<input type="button" onclick="location.href='std_pg.php';" value="Back">	
	<br />
</fieldset>
<?php include("../includes/footer.php");?>