<?php
	require_once('mysteryDB_connect.php');

		$roomID = $_GET['roomID'];
		
			
			$sql = "SELECT MAX(sn.sensorID) as sensorIDL, MAX(sn.sensorName) as sensorNameL, MAX(st.status) as statusL, MAX(st.timestamp) as timestampL, MAX(sn.sensorTypeID) as sensorTypeIDL, MAX(st.statusID) as statusIDL, MAX(ls.legendStatusID) as legendStatusIDL, MAX(sts.sensorType) as sensorTypeL
						  from rooms r join rpi rpi
								on r.roomID = rpi.roomID
									   join sensors sn
								on rpi.rpiID = sn.rpiID
									   join sensortypes sts
								on sn.sensorTypeID = sts.sensorTypeID
									   join status st
								on sn.sensorID = st.sensorID
									   join legendstatus ls
								on sts.sensorTypeID = ls.sensorTypeID
						  where r.roomID = '$roomID' and status = 0";

			$result = mysqli_query($dbc,$sql);
				
				echo 	
							'
							<table class="table table-stipend table-bordered table-hover" id="roomtable">
							<thead>
								<tr>
				
								<th class="text-center">Sensor Name</th>
								<th class="text-center">Status</th>
								<th class="text-center">Timestamp</th>
								
								</tr>
							</thead>
							<tbody>
							
							';
				while ($row1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					
					$sensorIDL = $row1['sensorIDL'];
					$sensorNameL = $row1['sensorNameL'];
					$statusL = $row1['statusL'];	
					$timestampL = $row1['timestampL'];
					$statusIDL = $row1['statusIDL'];	
					$legendStatusIDL = $row1['legendStatusIDL'];	
					$sensorTypeL = $row1['sensorTypeL'];	
							
					// <tr class='clickable-row' data-href='url:index.php'>
					echo 
						'
						<tr>
							
							<td class="text-center">'.$sensorNameL.'</td>
							<td class="text-center">'.$statusL.'</td>
							<td class="text-center">'.$timestampL.'</td>
						</tr>
							
						';
					
				}	
				
					echo '</tbody> </table>';
				// <tr class='clickable-row' data-href='url:index.php'>
				
			
			

?>