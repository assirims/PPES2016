<?php require_once("../includes/ins_session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db.php"); ?>
<?php if(!isset($_SESSION["presenter"])){
			$pp = $_POST["presenter"];
			$pp = find_id_pass($pp)["name"];
			$_SESSION["presenter"] = $pp;
		}else{
			$pp = $_SESSION["presenter"];
		}
?>

<?php ins_ce_shw();?>
<br />
<table BORDER="2" BORDERCOLOR="#09C" style="width:650px;">
<tr>
  <td rowspan="2">Presenter</td>
  <td colspan="5">Criteria (Ave.)</td>
</tr>
<tr>
	<th>Organization</th>
	<th>Materials</th>
	<th>Ability</th>
	<th>Discussion</th>
	<th>Knowledge</th>
</tr>
<tr>
	<td><?php echo $pp;?></td>
	<?php if($count == 0){ $count = 1; }?>
	<td><?php echo round($ave_org/$count);?></td>
	<td><?php echo round($ave_mat/$count);?></td>
	<td><?php echo round($ave_abi/$count);?></td>
	<td><?php echo round($ave_dis/$count);?></td>
	<td><?php echo round($ave_kno/$count);?></td>
</tr>
</table>
<br />
<form method="post" action="ins_ce.php">
<table style="width:650px;">
	<tr>
		<td style="width:20%;"></td>
		<td>Grade:</td>
		<td><input type="text" name="grade"></td>
		<td style="width:20%;"></td>
		<td><input type="button" onclick="location.href='#cmn-ins';" value="Write Comments ?"></td>
	</tr>
</table>
<div id="cmn-ins">
	<table style="width:650px;">
		<tr>
			<td><textarea style='width: 100%;' name="ins_cmn" class="pe"></textarea></td>
		</tr>
	</table>
</div>
<br />
   	<input type="submit" name="grd" value="Grade" onClick="return confirm('Submitted ?')"> <br />
	</center>
</form>
<form method="post" action="ins_ce.php">
	<center>
		<input type="submit" name="bck" value="Back">
	</center>
</form>