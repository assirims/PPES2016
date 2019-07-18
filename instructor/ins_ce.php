<?php $page_title = "Approve Presentations Evaluations";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php $p = find_pre($c)["pre_id"];	?>
<br />
<fieldset style="width:auto;">
	<legend>Approve Presentations Evaluations</legend><br />		
<?php 
if($_POST['approve']){
	ins_ce_app($_POST['rrow']);
}elseif($_POST['del']){
	ins_ce_del($_POST['rrow']);
}elseif($_POST['grd']){
	ins_ce_grd($_SESSION["presenter"], $_POST['grade'], $_POST['ins_cmn']);
}elseif($_POST['bck']){
	unset($_SESSION["presenter"]);
	echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=ins_ce.php\">";
}elseif($_POST['show'] || isset($_SESSION["presenter"])){
	require_once("ins_ce_shw.php");
}else{
	require_once("ins_ce_se.php");
}
?>
	<br />
</fieldset>
<br /><br />
<?php include("../includes/footer.php");?>