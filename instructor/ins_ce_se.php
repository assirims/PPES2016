<form method="post" action="ins_ce.php">
 	<br />
	<table>
		<tr>
			<td>Presenter:</td>
			<td>
	 	  	 	<select name="presenter">
					<option vlaue="non">Please Select A Presenter</option>
					<?php ins_ce_se(); ?>
	 	  		</select>
			</td>
		</tr>
	</table>
	<br />
	<center>
   	<input type="submit" name="show" value="Show"> 
		<br />
		<input type="button" onclick="location.href='ins_pg.php';" value="Back">
	</center>
	<br />
</form>