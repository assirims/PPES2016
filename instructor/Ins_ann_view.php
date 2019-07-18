<?php $page_title = "Instructions";?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php	$id = urldecode($_GET["id"]); ?>
<?php $body = strip_tags(find_ann($id)["body"]); ?>
<fieldset style="width:650px;">
	<legend><?php echo (find_ann($id)["title"]) ? find_ann($id)["title"] : "Not found"; ?></legend><br />
	<?php echo ($body) ? $body : "Announcement ID is invalid"; ?>
		<br />
		<br />
		<center><input type="submit" onClick="window.close();" value="Close"></center>
		<br />
</fieldset>
<?php include("../includes/footer.php");?>