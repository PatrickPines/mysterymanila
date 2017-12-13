<?php
	require_once('mysteryDB_connect.php');

		$sensorID = $_GET['sensorID'];
		
		$sql = "SELECT lsd.legendValue as legendValue, sd.value as value, sd.variableName as variableName, st.status as status, s.sensorType as sensorType
									  from sensors s join legendstatus ls
											on s.sensorTypeID = ls.sensorTypeID
													 join legendstatusdetails lsd
											on ls.legendStatusID = lsd.legendStatusID
													 join status st
											on s.sensorID = st.sensorID
													 join statusdetails sd
											on st.statusID = sd.statusID
									 where s.sensorID = '$sensorID'";
	
		$result1 = mysqli_query($dbc,$sql);
		
		echo 	
					'
					<table class="table table-stipend table-bordered table-hover" id="roomtable">
					<thead>
						<tr>
						<th class="text-center">Legend Value</th>
						</tr>
					</thead>
					<tbody>
					';
		
		while ($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
						
			$legendValue = $row['legendValue'];	
			echo'
				<tr>
						<th class="text-center">'.$legendValue.'</th>	
				</tr>
				';
		}	
			
		echo '</tbody> </table>';
	
?>