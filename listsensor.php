<!DOCTYPE html>
<?php session_start();
if($_SESSION['userTypeID'] != 1) {
	 header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/logout.php");
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View Sensors</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"></link>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation"  style="margin-top: 0 ; background-color:black">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-left" href="index.php" ><img style="width:150px;height:50px;" src="logo.gif"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
			
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['username'];?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

           <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                            <!-- /input-group -->
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                            <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Tools<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="addsensortype.php">Add Sensor Type</a>
                                </li>
								<li>
                                    <a href="sensorTypePage.php">Edit Status Details</a>
                                </li>
								<li>
                                    <a href="displayuser.php">Display Users</a>
                                </li>
                            </ul>
							<li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Manage Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="listroom.php">View Rooms</a>
                                </li>
								<li>
                                    <a href="listbranch.php">View Branches</a>
                                </li>
								<li>
                                    <a href="listrpi.php">View Raspberry Pis</a>
                                </li>
								<li>
                                    <a href="listsensor.php">View Sensors</a>
                                </li>
                            </ul>
							<li>
						<a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8">
								
								<h1>Sensor List <?php echo "<a href='addsensorform.php' class='btn btn-info' role='button'>+</a> "; ?> </h1>
								<?php
									require_once('mysteryDB_connect.php');

										$sql = "SELECT s.sensorID as sensorID, s.sensorName as sensorName, rpi.rpiName as rpiName, st.sensorType as sensorType
												 FROM sensors s join sensortypes st
														on s.sensorTypeID = st.sensorTypeID
																join rpi
														on rpi.rpiID = s.rpiID
														where s.status = 0
														 Group by sensorID";
												 
										$result = mysqli_query($dbc,$sql);
										
										echo 	
												'
												<table class="table table-stipend table-bordered table-hover" id="sensortable">
												<thead>
													<tr>
													
													<th class="text-center">Sensor Name</th>
													<th class="text-center">Sensor Type</th>
													<th class="text-center">Rpi</th>
													<th class="text-center"></th>
													
													</tr>
												</thead>
												<tbody>
												
												';
										
										while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
											$sensorID = $row['sensorID'];
											$sensorName = $row['sensorName'];
											$rpiName = $row['rpiName'];	
											$sensorType = $row['sensorType'];				
											// <tr class='clickable-row' data-href='url:index.php'>
											echo 
												'
												<tr>
													
													<td class="text-center"><a data-toggle="modal" data-target="#myModal'.$sensorID.'" >'.$sensorName.'</a></td>
													<td class="text-center">'.$sensorType.'</td>
													<td class="text-center">'.$rpiName.'</td>
											
													<td class="text-center"><a data-toggle="modal" data-target="#myModald'.$sensorID.'" >Delete</td>
												</tr>	
												';
										echo
													'
														<div class="modal fade" id="myModal'.$sensorID.'" role="dialog">
															<form action="'.$_SERVER['PHP_SELF'].'" method="post">
																<div class="modal-dialog modal-lg">
																  <div class="modal-content">
																	<div class="modal-header">
																	  <button type="button" class="close" data-dismiss="modal">&times;</button>
																	  <h4 class="modal-title">Edit Sensor</h4>
																	</div>
																	<div class="modal-body">
																	  <div class="form-group">
																		<input type="hidden" name="rpiID" value="<?php echo $rpiID; ?>" /> 
																			<input required name="newsensorName"class="form-control" placeholder="Edit Sensor Name" value="'.$sensorName.'"><br>
																			<input disabled  name="newbranchName"class="form-control" placeholder="Edit Sensor Type" value="'.$sensorType.'"><br>
																			<select name="rpi" class="form-control">';
																			
												
																				$query1= "select * from rpi where status = 0"; // Run your query
																				$result1=mysqli_query($dbc,$query1);
																				while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
																					$rpiName = $row['rpiName'];
																					$id = $row['rpiID'];
																				
																					echo "<option value=". $id .">".$rpiName."</option>";
																				}
																			
																		echo '</select>
																			<input   name="sensorID" class="form-control hidden" placeholder="Sensor ID" value="'.$sensorID.'">
																			<br>
																	</div>
																	<div class="modal-footer">
																	
																	  <button type="submit" class="btn btn-default btn-info" name="confirm" >Confirm</button>
																	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																	</div>
																  </div>
																</div>
															  </div>
															</form>
														</div>
													';
													echo
													'
														<div class="modal fade" id="myModald'.$sensorID.'" role="dialog">
															<form action="'.$_SERVER['PHP_SELF'].'" method="post">
																<div class="modal-dialog modal-lg">
																  <div class="modal-content">
																	<div class="modal-header">
																	  <button type="button" class="close" data-dismiss="modal">&times;</button>
																	  <h4 class="modal-title">Delete this sensor?</h4>
																	</div>
																	<div class="modal-body">
																	  <div class="form-group">
																		<input type="hidden" name="rpiID" value="<?php echo $rpiID; ?>" /> 
																			<input disabled name="newbranchName"class="form-control" placeholder="Delete Sensor Name" value="'.$sensorName.'"><br>
																			<input disabled name="newbranchName"class="form-control" placeholder="Delete Sensor Type" value="'.$sensorType.'"><br>
																			<input disabled name="newbranchName"class="form-control" placeholder="Delete Rpi Name" value="'.$rpiName.'"><br>
																			<input  name="sensorID" class="form-control hidden" placeholder="Sensor ID" value="'.$sensorID.'">
																			<br>
																	</div>
																	<div class="modal-footer">
																	
																	  <button type="submit" class="btn btn-default btn-info" name="delete" >Delete</button>
																	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																	</div>
																  </div>
																</div>
															  </div>
															</form>
														</div>
													';
										}
										echo '</tbody> </table>';
										
									//AFTER BUTTON PRESS 
										if (isset($_POST['confirm'])){
											
											$message=NULL;
											
												 
											 if (isset($_POST['sensorID'])){
												$sensorID = $_POST['sensorID'];
											}
											else{
												$branchID = -1;
											}
											
											$rpiID = $_POST['rpiID'];
											$newsensorName = $_POST['newsensorName'];
											
											$rpi = $_POST['rpi'];
							
											$query1="update sensors	
														set sensorName = '$newsensorName', rpiID = '$rpi'													
														where sensorID = $sensorID";
															
																  
												$result=mysqli_query($dbc,$query1);
												if ($result) {
															
														echo "<meta http-equiv='refresh' content='0'>"; //refresh page
													echo'<script>
															window.href = "listbranch.php";
														</script>
														';
													
													echo'
														<div class="alert alert-success">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Success!</strong> Success Editing '.$newsensorName.' branch.
														</div>
												
														';
														
												}
												else{
													echo'
														<div class="alert alert-danger">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Error!</strong> Did not change name to '.$newsensorName.' branch.
														</div>
														';
												}	
										}
										
										if(isset($_POST['delete'])){
											
											
											
											$sensorID = $_POST['sensorID'];
											
										
											$query1=" update sensors	
														set status = 1
														where sensorID = $sensorID";
																  
																  
												$result=mysqli_query($dbc,$query1);
												if ($result) {
													
													
															
														echo "<meta http-equiv='refresh' content='0'>"; //refresh page
													echo'<script>
															window.href = "listbranch.php";
														</script>
														';
													
													echo'
														<div class="alert alert-success">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Success!</strong> Sensor deleted.
														</div>
														
														
												
														';
														
												}
												else{
													echo'
														<div class="alert alert-danger">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Error!</strong> No change occured to sensor.
														</div>
														';
												}	
											
											
											
											
											
										}
										
										
										
								?>
									
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
	<script type="text/javascript">
		function showSuccessMessage(message) {
			var element = '<div class="alert alert-success">';
				element = element + '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				element = element + '<strong>Success!</strong> ' + message;
				element = element + '</div>';	
				$('#alert').html(element);

				$('#alert').fadeTo(4000, 500).slideUp(500, function(){
					$('#alert').slideUp(500);
				});
		}	
	</script>
	
	
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	
		<script> 
		$(document).ready(function(){
			$('#sensortable').DataTable();
		});
		</script>
		
		<style>
		.btn-info
		{
			background-color: black;
			color: white;
			border: black;
		
		}
		
		.btn-info:hover{
			color: white;
			background-color: gray; 
			border: gray;
			
		}
		
		
	</style>

</body>

</html>
