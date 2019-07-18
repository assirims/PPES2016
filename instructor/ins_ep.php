<?php $page_title = "Presentation Evaluation (Instractor Page)";?>
<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<?php $p = find_pre($c)["pre_id"];	?>
<?php $pr = find_id_pass($p)["name"]?>
<?php $tr = find_id_pass($p)["student_id"];?>
<?php $ev = find_ins_pass($_SESSION['instructor_id'])["Name"];?>
<br />	
<fieldset  style="width:auto;">
	<legend>Presentation Evaluation (Instractor Page)</legend><br />	
<?php 
if (isset($_POST['approve'])){
	ins_ep_s_app($_POST["presenter"]);
}elseif (isset($_POST['terminate'])){
	ins_ep_t_app($tr);
}else{
	if (is_null(find_pre($c)["turn"])){	
		require_once("ins_ep_app.php");
	}else{
		if(isset($_POST['submit'])){
			 ins_ep_frm($pr, $ev, $_POST['organization2'], $_POST['materials2'], $_POST['ability2'], $_POST['discussion2'], $_POST['knowledge2'], $_POST['comment2']);
		}elseif(isset($_POST['rev'])){
			require_once("ins_ep_rev.php");
		}else{
			require_once("ins_ep_frm.php");
		}
	}
} ?>
</fieldset>
<br />
<?php include("../includes/footer.php");?>