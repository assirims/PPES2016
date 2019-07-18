<form method="post" action="ins_ep.php">
	<table BORDER="2" BORDERCOLOR="#09C">
		<tr>
			<td>Presenter:</td>
			<td><input type="text" name="presenter" value="<?php echo $pr; ?>"></td>
		</tr>
		<tr>
			<td>Date:</td>
			<td><input type="text" name="date" value="<?php echo date("Y-m-d H:i:s");?>"></td>
		</tr>
		<tr>
			<td>Evaluator:</td>
			<td><input type="text" name="evaluator" value="<?php echo $ev;?>"></td>
		</tr>
	</table><br />
		   <center><input type="submit" name="terminate" class="del" value="Terminate Session"></center>

	<br />

	<table BORDER="2" BORDERCOLOR="#09C">
		<tr>
			<th width="90">Criteria    </th>
			<th width="90">Poor        </th>
			<th width="90">Needs Work</th>
			<th width="90">Satisfactory</th>
			<th width="90">Very Good   </th>
			<th width="90">Outstanding </th>
		</tr>
		<tr>
			<th>Organization</th>
			<td><input type="radio" name="organization" class="poor" value="Poor"></td>
			<td><input type="radio" name="organization" class="need" value="Needs Work"></td>
			<td><input type="radio" name="organization" class="sat" value="Satisfactory"></td>
			<td><input type="radio" name="organization" class="good" value="Very Good"></td>
			<td><input type="radio" name="organization" class="out" value="Outstanding"></td>
		</tr>
		<tr>
			<th>Presentation Materials</th>
			<td><input type="radio" name="materials" class="poor" value="Poor"></td>
			<td><input type="radio" name="materials" class="need" value="Needs Work"></td>
			<td><input type="radio" name="materials" class="sat" value="Satisfactory"></td>
			<td><input type="radio" name="materials" class="good" value="Very Good"></td>
			<td><input type="radio" name="materials" class="out" value="Outstanding"></td>
		</tr>
		<tr>
			<th>Presentation Ability</th>
			<td><input type="radio" name="ability" class="poor" value="Poor"></td>
			<td><input type="radio" name="ability" class="need" value="Needs Work"></td>
			<td><input type="radio" name="ability" class="sat" value="Satisfactory"></td>
			<td><input type="radio" name="ability" class="good" value="Very Good"></td>
			<td><input type="radio" name="ability" class="out" value="Outstanding"></td>
		</tr>
		<tr>
			<th>Discussion</th>
			<td><input type="radio" name="discussion" class="poor" value="Poor"></td>
			<td><input type="radio" name="discussion" class="need" value="Needs Work"></td>
			<td><input type="radio" name="discussion" class="sat" value="Satisfactory"></td>
			<td><input type="radio" name="discussion" class="good" value="Very Good"></td>
			<td><input type="radio" name="discussion" class="out" value="Outstanding"></td>
		</tr>
		<tr>
			<th>Knowledge</th>
			<td><input type="radio" name="knowledge" class="poor" value="Poor"></td>
			<td><input type="radio" name="knowledge" class="need" value="Needs Work"></td>
			<td><input type="radio" name="knowledge" class="sat" value="Satisfactory"></td>
			<td><input type="radio" name="knowledge" class="good" value="Very Good"></td>
			<td><input type="radio" name="knowledge" class="out" value="Outstanding"></td>
		</tr>
	</table><br />
   <center>Other comments:<textarea style='width: 100%;' name="comment" class="pe"></textarea>
	<br />

   <input type="submit" name="rev" value="Review"> 
	</center>
</form>
<br />
<input type="button" onclick="location.href='ins_pg.php';" value="Back"><br />