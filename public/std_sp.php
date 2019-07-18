<?php $page_title = "Paper Selection";?>
<?php require_once("../includes/sessions.php"); ?>
<?php $id = $_SESSION['student_id'];?>
<?php require_once("../includes/db.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/header.php"); ?>
<fieldset style="width:650px;">
	<legend>Paper Selection</legend><br />
			<center>
				<input type="submit" class="del" value="Instructions" onclick="window.open('help.php?id=8'); return false;">
				<br />
				<?php
							global $id;
							$counting  = "SELECT * FROM reading_list WHERE re1_id = '{$id}' OR re2_id = '{$id}' OR re3_id = '{$id}'";
							$result = mysqli_query($connection, $counting);
							confirm_query($result);
							global $count;
							while($c = mysqli_fetch_assoc($result)){
								$count++;
							}
				?>
				<?php
							
							function check($pos,$spt){
								global $connection;
								$doubl_check  = "SELECT * FROM reading_list WHERE num = '{$pos}' AND {$spt} = NULL LIMIT 1";
								$result = mysqli_query($connection, $doubl_check);
								confirm_query($result);
								
								if ($pos = mysqli_fetch_assoc($result)){
									return $pos;
								}else{
									return null;
								}
							}
							
							function check_ava($pos,$spt){
								global $connection;
								global $id;
								
								$doubl_check  = "SELECT * FROM reading_list WHERE num = '{$pos}' LIMIT 1";
								$result = mysqli_query($connection, $doubl_check);
								confirm_query($result);
								$i = mysqli_fetch_assoc($result);
								if (is_null($i["$spt"])){
									//available
									$query  = "UPDATE reading_list SET {$spt} = '{$id}', all_rev = all_rev + 1 WHERE num = '{$pos}'";
									$result = mysqli_query($connection, $query);
									if ($result && mysqli_affected_rows($connection) == 1){
										return true;
									}else{
										return false;
									}
									
								}else{
									return false;
								}
								
							}
							
							if (isset($_GET['select'])){
								if ($count < 3){
									//echo ">= TRUE"; exit;
									if (check_ava($_GET['id'], $_GET['spt'])){
							      	//echo "true";
										echo "<script type=\"text/javascript\">alert(\"Your selection was recorded successfully.\");</script>";
										echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=std_sp.php\">";
									}else{
										echo "<script type=\"text/javascript\">alert(\"There was a problem, please try again.\");</script>";
										echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=std_sp.php\">";
									}
								}else{
									echo "<script type=\"text/javascript\">alert(\"There was a problem, please try again.\");</script>";
									echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=std_sp.php\">";
								}
							}
							// }else{
							// 		//echo "false";
							// 		echo "<script type=\"text/javascript\">alert(\"There was a problem, please try again.\");</script>";
							// 		echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=std_sp.php\">";
							// 						      }
							
			
			
							function uncheck_ava($pos,$spt){
								global $connection;
								$query  = "UPDATE reading_list SET {$spt} = NULL, all_rev = all_rev - 1 WHERE num = '{$pos}'";
								$result = mysqli_query($connection, $query);
								if ($result && mysqli_affected_rows($connection) == 1){
									return true;
								}else{
									return false;
								}
							}
			
							if (isset($_GET['unselect'])){
							      if (uncheck_ava($_GET['id'], $_GET['spt'])){
							      	//echo "true";
										echo "<script type=\"text/javascript\">alert(\"Your selection was removed successfully.\");</script>";
										echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=std_sp.php\">";
							      }else{
										//echo "false";
										echo "<script type=\"text/javascript\">alert(\"There was a problem, please try again.\");</script>";
										echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=std_sp.php\">";
							      }
							}
				?>
				<br />
				<br />
					<?php if ($count >= 3){
						echo "<div class=\"success\">";
					}else{
						echo "<div class=\"validation\">";
					} ?>
					You have selected <?php echo $count; ?> of 3 allowed paper(s)
				</div>
					<br />
			</center>
				<table>
					  <tr>
					    <th>Title</th>
					    <th>Link</th>
						 <th>Select/Unselect</th>
					  </tr>
					<?php
								$query1  = "SELECT * FROM reading_list ORDER BY num ASC";
								$result = mysqli_query($connection, $query1);
								confirm_query($result);
								//$count = 0;
								while($row = mysqli_fetch_assoc($result)){
									echo "<tr>";
									echo "<td style=\"width:60%;\">" . $row["title"] . "</td>";
									echo "<td style=\"width:10%;\">" . "<a href=\"http://" . $row["link"] . "\" target=\"_blank\">view</a></td>";
									// echo "<td>";
									if ($row["re1_id"] === $id ){
										// echo "Unselect";
										echo "<td class=\"success\"><a href=\"?unselect&id=" . $row["num"] . "&spt=re1_id\">UNSELECT</a></td>";
									}else{
										if (is_null($row["re1_id"])){
											// echo "Select";
											if ($count >= 3){
												echo "<td>Selection completed</td>";
											}else{
												echo "<td><a href=\"?select&id=" . $row["num"] . "&spt=re1_id\">SELECT</a></td>";
											}
										}else{
											if ($row["re2_id"] == $id ){
												// echo "Unselect";
												echo "<td class=\"success\"><a href=\"?unselect&id=" . $row["num"] . "&spt=re2_id\">UNSELECT</a></td>";
											}else{
												if (is_null($row["re2_id"])){
													// echo "Select";
													if ($count >= 3){
														echo "<td>Selection completed</td>";
													}else{
														echo "<td><a href=\"?select&id=" . $row["num"] . "&spt=re2_id\">SELECT</a></td>";
													}
												}else{
													if ($row["re3_id"] == $id ){
														// echo "Unslecte3";
														echo "<td class=\"success\"><a href=\"?unselect&id=" . $row["num"] . "&spt=re3_id\">UNSELECT</a></td>";
													}else{
														if(is_null($row["re3_id"])){
															// echo "Select";
															if ($count >= 3){
																echo "<td>Selection completed</td>";
															}else{
																echo "<td><a href=\"?select&id=" . $row["num"] . "&spt=re3_id\">SELECT</a></td>";
															}
														}else{
															echo "<td>Full</td>";
														}
													}
												}
											}
										}
									}
									// echo "</td>";
									echo "</tr>";
								}
								mysqli_free_result($result);
					?>
					</table>
					
		<br />
		<br />
			<input type="button" onclick="location.href='std_pg.php';" value="Back"></center>
	<br />
</fieldset>
<?php include("../includes/footer.php");?>