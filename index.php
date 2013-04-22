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
	<div class="contentBody w400">
		<table border="1" class="contentTable">
			<tr class="tableHead">
				<td>Agent ID</td>
				<td>Total</td>
			</tr>
			<?php 
				$sub_total = 0;
				//form submitted
				if(isset($_POST['submit'])) {
					$record = new Record;

					$start_date = $_POST['startDate'];
					$end_date = $_POST['endDate'];
					if(!empty($start_date) AND !empty($end_date)) {
						
						$query = "flipswitch_callouts_agent '$start_date 12:00 AM','$end_date 11:59 PM'";
						$result = odbc_exec($record->conn, $query);
						
						while ($row = odbc_fetch_array($result)) {
							echo '<tr onmouseover="mouseOn(this)" onmouseout="mouseOut(this)">';
							echo '<td class="groupName">'. $row['agentid'] .'</td>';
							echo '<td>'. $row['total'] .'</td>';
							echo "</tr>";
							$sub_total += $row['total'];
						}
					} else {
						echo "<p style='margin-left: 160px; color: red; font-weight: bold;'>INVALID INPUTS</p>";
					}
				}
			?>
			<tr id="subtotal">
				<td class="groupName">Sub TOTAL</td>
				<td><?php echo $sub_total; ?></td>
			</tr>
		</table>
	</div>
<?php include "template-bottom.php"; ?>
