<?php include "template-top.php"; ?>
	<div class="contentBody w400">
		<div class="contentTitle">Callouts</div>
		<div class="clearFix"></div>
		<div class="midcontentBody">
			<form action="" method="POST">
			<table>
				<tr>
					<td>Start Date:</td>
					<td><input type="text" class="datepicker" name="startDate" value="<?php echo isset($_POST['startDate']) ? $_POST['startDate'] : '' ?>" /></td>
				</tr>
				<tr>
					<td>End Date:</td>
					<td><input type="text" class="datepicker" name="endDate" value="<?php echo isset($_POST['endDate']) ? $_POST['endDate'] : '' ?>" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Search" /></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
	
	<div class="contentBody" style="margin-top: 70px;">
		<table border="1" class="contentTable">
			<tr class="tableHead">
				<td>Agent ID</td>
				<td>12:00 pm - 12:59pm</td>
				<td>1:00 pm - 1:59pm</td>
				<td>2:00 pm - 2:59pm</td>
				<td>3:00 pm - 3:59pm</td>
				<td>4:00 pm - 4:59pm</td>
				<td>5:00 pm - 5:59pm</td>
				<td>6:00 pm - 6:59pm</td>
				<td>7:00 pm - 7:59pm</td>
				<td>8:00 pm - 8:59pm</td>
				<td>9:00 pm - 9:59pm</td>
				<td>10:00 pm - 10:59pm</td>
				<td>Calls per Agent</td>
			</tr>
			<?php 
				
				//variable for computing calls fo each columns
				$twelve_to_one = 0;
				$one_to_two = 0;
				$two_to_three = 0;
				$three_to_four = 0;
				$four_to_five = 0;
				$five_to_six = 0;
				$six_to_seven = 0;
				$seven_to_eight = 0;
				$eight_to_nine = 0;
				$nine_to_ten = 0;
				$ten_to_eleven = 0;


				//total agents currenty viewed
				$total_agents = 0;

				//overall total calls
				$total_calls = 0;


				//form submitted
				if(isset($_POST['submit'])) {


	

					//holder for last date_hour
					$date_hour_holder = 0;

					//holder for last agentid
					$last_agent = '';

					//variable for total of each agent
					$total_calls_per_agent = 0;

					$record = new Record;

					$start_date = $_POST['startDate'];
					$end_date = $_POST['endDate'];
					if(!empty($start_date) AND !empty($end_date)) {
						
						$query = "flipswitch_callouts_agent_hourly '$start_date 12:00 AM','$end_date 11:59 PM'";
						$result = odbc_exec($record->conn, $query);
						
						while ($row = odbc_fetch_array($result)) {
							
							//for computing the sub-total per column
							switch ($row['date_hour']) {
							   	case '12':
							        $twelve_to_one += $row['total'];
							        break;
							  	case '13':
							        $one_to_two += $row['total'];
							        break;
							  	case '14':
							        $two_to_three += $row['total'];
							        break;
							    case '15':
							        $three_to_four += $row['total'];
							        break;
							    case '16':
							        $four_to_five += $row['total'];
							        break;
							    case '17':
							        $five_to_six += $row['total'];
							        break;
							    case '18':
							        $six_to_seven += $row['total'];
							        break;
							    case '19':
							        $seven_to_eight += $row['total'];
							        break;
							    case '20':
							        $eight_to_nine += $row['total'];
							        break;
							    case '21':
							        $nine_to_ten += $row['total'];
							        break;
							    case '22':
							        $ten_to_eleven += $row['total'];
							        break;
							}

							//check if the agent still have another row to be displayed
							if($last_agent == $row['agentid']) {
								//print a colum with 0 number of calls if there is call made
								if($date_hour_holder+1 != $row['date_hour']) {
									$diff = $row['date_hour'] - $date_hour_holder;
									for($ctr = 1; $ctr < $diff; $ctr++) {
										echo '<td>0</td>';
									}
								}
								echo '<td>'. $row['total'] .'</td>';
								$total_calls_per_agent += $row['total'];
								$date_hour_holder = $row['date_hour'];	

								
							}else {
								//in this section starts populating the table
								if($last_agent == '') {
									$last_agent = $row['agentid'];
									echo '<tr onmouseover="mouseOn(this)" onmouseout="mouseOut(this)">';
									echo '<td class="groupName">'. $row['agentid'] .'</td>';
									
									//check when the agent started his/her shift 
									//if he/she started 1PM onwards this will print columns with 0 number of calls
									//else if he/she started 12:00PM - 12:59PM it will just print the total calls for that time
									if($row['date_hour'] > 12) {
										//holder for loop purpose
										$ctr = $row['date_hour'];
										while($ctr > 12) {
											echo '<td>0</td>';
											$ctr--;
										}
										echo '<td>'. $row['total'] .'</td>';
										$total_calls_per_agent += $row['total'];
										$date_hour_holder = $row['date_hour'];
									} else {
										echo '<td>'. ($row['date_hour'] == '12' ? $row['total'] : 0) .'</td>';
										$total_calls_per_agent += $row['total'];
										$date_hour_holder = $row['date_hour'];
									}
									$total_agents++;
									
								} else {

									
									//this will print columns from the last call he/she made till the end shift
									while($date_hour_holder < 22) {
										echo '<td>0</td>';
										$date_hour_holder++;
									}
									//closest the row for the next agent to be displayed
									$total_agents++;
									$total_calls += $total_calls_per_agent;
									echo '<td>'. $total_calls_per_agent .'</td>';
									echo '</tr>';
									$total_calls_per_agent = 0;
									//populates the next row for another agent
									$last_agent = $row['agentid'];
									echo '<tr onmouseover="mouseOn(this)" onmouseout="mouseOut(this)">';
									echo '<td class="groupName">'. $row['agentid'] .'</td>';
									
									//check when the agent started his/her shift 
									//if he/she started 1PM onwards this will print columns with 0 number of calls
									//else if he/she started 12:00PM - 12:59PM it will just print the total calls for that time
									
									if($row['date_hour'] > 12) {
										//holder for loop purpose
										$ctr = $row['date_hour'];
										while($ctr > 12) {
											echo '<td>0</td>';
											$ctr--;
										}
										echo '<td>'. $row['total'] .'</td>';
										$total_calls_per_agent += $row['total'];
										$date_hour_holder = $row['date_hour'];
									} else {
										echo '<td>'. ($row['date_hour'] == '12' ? $row['total'] : 0) .'</td>';
										$total_calls_per_agent += $row['total'];
										$date_hour_holder = $row['date_hour'];
									}
									
							
								}

								
							}

						}
						//check if we have fetch a row from the database or not
						if($date_hour_holder != 0) {
							//this will print columns from the last call he/she made till the end shift
							$col_ctr = $date_hour_holder;
							while($col_ctr < 22) {
								echo '<td>0</td>';
								$col_ctr++;
							}					
							$total_calls += $total_calls_per_agent;
							echo '<td>'. $total_calls_per_agent .'</td>';
							echo '</tr>';
						}
						
					} else {
						echo "<p style='margin-left: 160px; color: red; font-weight: bold;'>INVALID INPUTS</p>";
					}
				}
				
			?>

			<!-- Printing subtotal for each column -->
			<tr id="subtotal">
				<td class="groupName">Sub TOTAL</td>
				<td><?php echo $twelve_to_one; ?></td>
				<td><?php echo $one_to_two; ?></td>
				<td><?php echo $two_to_three; ?></td>
				<td><?php echo $three_to_four; ?></td>
				<td><?php echo $four_to_five; ?></td>
				<td><?php echo $five_to_six; ?></td>
				<td><?php echo $six_to_seven; ?></td>
				<td><?php echo $seven_to_eight; ?></td>
				<td><?php echo $eight_to_nine; ?></td>
				<td><?php echo $nine_to_ten; ?></td>
				<td><?php echo $ten_to_eleven; ?></td>
				<td><?php echo $total_calls ?></td>
			</tr>
		</table>
	</div>
	<div class="contentBody upperPart" style="position: absolute; top: 315px;">
		<table>
			<tr>
				<td class="groupName">Total Agents: </td>
				<td><?php echo isset($total_agents) ? $total_agents : 0 ?></td>
			</tr>
			<tr>
				<td class="groupName">Total Calls: </td>
				<td><?php echo isset($total_calls) ? $total_calls : 0 ?></td>
			</tr>
		</table>
	</div>

<?php include "template-bottom.php"; ?>
