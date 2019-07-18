<form method="post" action="ins_ep.php">
 	<div class="error">Currently, there is no available session.</div>
	<br />
	<table>
		<tr>
			<td>Presenter:</td>
			<td>
	 	  	 	<select name="presenter">
					<option vlaue="non">Please Select A Presenter</option>
					<?php ins_ep_app(); ?>
	 	  		</select>
			</td>
		</tr>
	</table>
	<br />
	<center>
   	<input type="submit" name="approve" value="Approve"> 
		<br />
		<input type="button" onclick="location.href='ins_pg.php';" value="Back">
	</center>
	<br />
</form>