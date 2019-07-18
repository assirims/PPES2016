<?php $page_title = "Announcement Control";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<fieldset style="width:650px;">
	<legend>Add New Paper</legend><br />
	<form action="ins_rlst_new.php" name="rlst_form" method="post">
			<table style="width:650px;">
				<tr>
					<td>ID:</td>
					<td colspan="3"><input name="id" style="width:100px;" type"text"></td>
				</tr>
				<tr>
					<td>Title</td>
					<td colspan="3"><input name="title" style="width:100%;" type"text"></td>
				</tr>
				<tr>
					<td>Link</td>
					<td colspan="3"><input name="link" style="width:100%;" type"text"></td>
				</tr>
			</table>
				<br />
				<input type="submit" value="Save" name="save">
				<br />
	</form>
		<?php
			if(isset($_POST['save'])){
				ins_rlst_new($_POST["id"],$_POST["title"],$_POST["link"]);
			}?>
		<input type="button" onclick="location.href='ins_rlst.php';" value="Back"></center>
		<br />
</fieldset>
<?php include("../includes/footer.php");?>