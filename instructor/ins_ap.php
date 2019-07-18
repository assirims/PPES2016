<?php $page_title = "Paper Assignment";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<br />
<fieldset style="width:650px;">
	<legend>Paper Assignment</legend><br />
	<?php if(isset($_GET['presenter'])){ 
				ins_ap_sel($_GET['presenter'],$_GET['paper']); 
			} 
	?>
		<br />
		<center>
			Please, select one of the reviewers to present the paper <br />
			through the drop list in Presenter column.
		</center>
		<br />
		<table BORDER="2" BORDERCOLOR="#09C" style="width:650px;">
			<tr>
				<th>#</th>
				<th width="40%">Title</th>
				<th width="30%">Presenter</th>
				<!-- <th width="30%" style="box-shadow: 0px 0px 14px #99CCFF; ">Presenter</th> -->
				<th width="30%">Reviewers</th>
			</tr>
			<?php ins_ap_list(); ?>
		</table><br />
	<br />
	<input type="button" onclick="location.href='ins_pg.php';" value="Back"></center>
	<br />
</fieldset>
<br />
<?php include("../includes/footer.php");?>