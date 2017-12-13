<?php
	require_once('mysteryDB_connect.php');

		$roomID = $_GET['roomID'];
	
				  
		$sqld ="SELECT distinct rpiID, rpiName FROM rpi where roomID = '$roomID'";
		
		
		
		$result1 = mysqli_query($dbc,$sqld);
		
		while ($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
						
					$rpiName = $row['rpiName'];		
			echo 	
							'
							<h2>'.$rpiName.'</h2>
							<table class="table table-stipend table-bordered table-hover" id="roomtable">
							<thead>
								<tr>
								<th class="text-center">Sensor ID</th>
								<th class="text-center">Sensor Name</th>
								<th class="text-center">Status</th>
								<th class="text-center">Timestamp</th>
								
								</tr>
							</thead>
							<tbody>
							
							';
		
					$rpiID = $row['rpiID'];
					
						$sql = "SELECT sn.sensorID as sensorID, sn.sensorName as sensorName, st.status as status, st.timestamp as timestamp, st.statusID as statusID
									  from rooms r join rpi rpi
											on r.roomID = rpi.roomID
												   join sensors sn
											on rpi.rpiID = sn.rpiID
												   join sensortypes sts
											on sn.sensorTypeID = sts.sensorTypeID
												   join status st
											on sn.sensorID = st.sensorID
								  where (r.roomID = '$roomID') and (rpi.rpiID = '$rpiID')";

					$result = mysqli_query($dbc,$sql);
						
						
						while ($row1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {	
							$sensorID = $row1['sensorID'];
							$sensorName = $row1['sensorName'];
							$status = $row1['status'];	
							$timestamp = $row1['timestamp'];	
							$statusID = $row1['statusID'];
							
							
							
											
							// <tr class='clickable-row' data-href='url:index.php'>
							echo 
								'
								<tr>
									<td class="text-center">'.$sensorID.'</td>
									<td class="text-center">'.$sensorName.'</td>
									<td class="text-center"><a href="view_showstatusdetail.php?statusID='.$statusID.'">'.$status.'</td>
									<td class="text-center">'.$timestamp.'</td>
								</tr>
									
								';
							
							
						}
								echo '</tbody> </table>';
						// <tr class='clickable-row' data-href='url:index.php'>
						
					
					
	}
?>