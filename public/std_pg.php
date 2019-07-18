<?php $page_title = "Student Page";?>
<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/header.php"); ?>

<fieldset>
<legend>Student Page</legend><br />
	<input style="width:200px; height:40px;" type="button" onclick="location.href='std_ann.php';" value="Class Announcements" >
	<hr /><hr />
	<input style="width:200px; height:40px;" type="button" onclick="location.href='std_sp.php';" value="Select Papers">
	<hr /><hr />
	<input style="width:200px; height:40px;" type="button" onclick="location.href='std_ep.php';" value="Evaluate A Presentation"><br />
	<input style="width:200px; height:40px;" type="button" onclick="location.href='std_pr.php';" value="Your Presentation Report">
	<hr /><hr />
	<input style="width:200px; height:40px;" type="button" onclick="location.href='std_sr.php';" value="Submit A Review"><br />
	<input style="width:200px; height:40px;" type="button" onclick="location.href='std_rr.php';" value="Your Reviews Reports">
	<hr /><hr />
	<input style="width:200px; height:40px;" type="button" onclick="alert('This feature is not completed yet :|');" value="Grades"><br />
	<input style="width:200px; height:40px;" type="button" onclick="location.href='std_ai.php';" value="Account Information">
	<hr /><hr />
	<input style="width:200px; height:40px;" class="del" type="button" onclick="location.href='std_logout.php';" value="Logout"><br />
</fieldset>
<?php include("../includes/footer.php");?>