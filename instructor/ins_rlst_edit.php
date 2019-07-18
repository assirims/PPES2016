<?php $page_title = "Announcement Control";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php	$id = ins_rlst_edit_list(urldecode($_GET["id"])); ?>
<fieldset style="width:650px;">
	<legend>Edit Paper</legend><br />
		<form name="rlst_form" method="post">
				<table style="width:650px;">
					<tr>
						<td>ID:</td>
						<td colspan="3"><input name="id" style="width:100px;" type"text" value="<?php echo $id["num"]; ?>"></td>
					</tr>
					<tr>
						<td>Title</td>
						<td colspan="3"><input name="title" style="width:100%;" type"text" value="<?php echo $id["title"]; ?>"></td>
					</tr>
					<tr>
						<td>Link</td>
						<td colspan="3"><input name="link" style="width:100%;" type"text" value="<?php echo htmlentities($id["link"]); ?>"></td>
					</tr>
				</table>
					<br />
					<input type="submit" value="Edit" name="edit">
					<br />
		</form>
		<?php
			if(isset($_POST['edit'])){
				ins_rlst_edit_upd($_POST["title"],$_POST["link"],$_POST["id"],$id["num"]);
			}?>
		<center><input type="submit" onClick="window.close();" value="Close"></center>
		<br />
</fieldset>
<?php include("../includes/footer.php");?>