<?php $page_title = "Announcement Control";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<fieldset style="width:650px;">
	<legend>Add New Announcement</legend><br />
		<form action="ins_ann_new.php" method="post">
			<table style="width:650px;">
				<tr>
					<td>Title: <input type="text" name="title"></td>
					<td>Date: <input type="text" name="date" value="<Timestamp>" disabled></td>
				</tr>
				<tr>
					<td colspan="2"><textarea style="width: 100%;" name="message"></textarea></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Save" name="save"></td>
				</tr>
			</table>
		</form>
		<br />
		<?php
			if(isset($_POST['save'])){
				ins_ann_new($_POST["title"], $_POST["message"]);
			}?>
		<br />
		<input type="button" onclick="location.href='ins_ann.php';" value="Back"></center>
		<br />
</fieldset>
<?php include("../includes/footer.php");?>