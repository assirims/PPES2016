		<form method="post" action="ins_ep.php">
		<br />
		<table BORDER="2" BORDERCOLOR="#09C">
			<tr>
				<td>Presenter:</td>
				<td><input type="hidden" name="presenter2" value="<?php echo $_POST["presenter"];?>"><?php echo $pr; ?></td>
			</tr>
			<tr>
				<td>Date and Time:</td>
				<td><?php echo date("Y-m-d H:i:s");?> (Will be calculated!)</td>
			</tr>
			<tr>
				<td>Evaluator:</td>
				<td><input type="hidden" name="evaluator2" value="<?php echo $_POST["evaluator"];?>"><?php echo $ev;?></td>
			</tr>
			<tr>
				<th colspan="2">Criteria</th>
			</tr>
			<tr>
				<td>Organization</td>
				<td><input type="hidden" name="organization2" value="<?php echo $_POST["organization"];?>"><?php echo $_POST["organization"]; ?></td>
			</tr>
			<tr>
				<td>Presentation Materials</td>
				<td><input type="hidden" name="materials2" value="<?php echo $_POST["materials"];?>"><?php echo $_POST["materials"]; ?></td>
			</tr>
			<tr>
				<td>Presentation Ability</td>
				<td><input type="hidden" name="ability2" value="<?php echo $_POST["ability"];?>"><?php echo $_POST["ability"]; ?></td>
			</tr>
			<tr>
				<td>Discussion</td>
				<td><input type="hidden" name="discussion2" value="<?php echo $_POST["discussion"];?>"><?php echo $_POST["discussion"]; ?></td>
			</tr>
			<tr>
				<td>Knowledge</td>
				<td><input type="hidden" name="knowledge2" value="<?php  echo $_POST["knowledge"];?>"><?php echo $_POST["knowledge"]; ?></td>
			</tr>
			<tr>
				<td>Other comments:</td>
				<td style="white-space: normal; width:300px;"><input type="hidden" name="comment2" value="<?php echo htmlentities($_POST["comment"]);?>"><?php echo htmlentities($_POST["comment"]); ?></td>
			</tr>
		</table>
		<br />
		<center>
	   	<input type="submit" name="submit" value="Submit" onClick="return confirm('Is ALL information correct ?')"> 
			<br />
			<input type="button" onclick="location.href='ins_ep.php';" class="del" value="Back">
		</center>
		<br />
	</form>
