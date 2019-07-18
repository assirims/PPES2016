<?php $page_title = "Announcement Control";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php $id = urldecode($_GET["id"]);?>
<?php $body = strip_tags(find_ann($id)["body"]); ?>
<fieldset style="width:650px;">
	<legend><?php echo "Edit: " . find_ann($id)["title"]; ?></legend><br />
		<form method="post">
			<table style="width:650px;">
				<tr>
					<td>Title: <input type="text" name="title" value="<?php echo find_ann($id)["title"]; ?>"></td>
					<td>Date: <input type="text" name="date" value="<?php echo find_ann($id)["Date"]; ?>" disabled></td>
				</tr>
				<tr>
					<td colspan="2"><textarea style="width: 100%;" name="message"><?php echo $body;?></textarea></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Save/Edit" name="save"></td>
				</tr>
			</table>
		</form>
		<br />
		<?php
			if(isset($_POST['save'])){
				$id = urldecode($_GET["id"]);
				ins_ann_edit($id,$_POST["title"],$_POST["message"]);				
			}?>
		<br />
		<center><input type="submit" onClick="window.close();" value="Close"></center>
		<br />
</fieldset>
<?php include("../includes/footer.php");?>