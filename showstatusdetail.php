
<!DOCTYPE html>
<?php session_start();?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Show Status Details</title>

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
                      <?php
							if($_SESSION['userTypeID'] == 1) {
	
								echo "
								<li>
									<a href=\"index.php\"><i class=\"fa fa-dashboard fa-fw\"></i> Home</a>
								</li>
									<li>
									<a href=\"#\"><i class=\"fa fa-sitemap fa-fw\"></i> Tools<span class=\"fa arrow\"></span></a>
									<ul class=\"nav nav-second-level\">
									   <li>
											<a href=\"addsensortype.php\">Add Sensor Type</a>
										</li>
										<li>
											<a href=\"sensorTypePage.php\">Edit Status Details</a>
										</li>
										<li>
											<a href=\"displayuser.php\">Display Users</a>
										</li>
									</ul>
								
									<!-- /.nav-second-level -->
								</li>
								
								<li>
									<a href=\"#\"><i class=\"fa fa-sitemap fa-fw\"></i> Manage Data<span class=\"fa arrow\"></span></a>
									<ul class=\"nav nav-second-level\">
                               <li>
                                    <a href=\"listroom.php\">View Rooms</a>
                                </li>
								<li>
                                    <a href=\"listbranch.php\">View Branches</a>
                                </li>
								<li>
                                    <a href=\"listrpi.php\">View Raspberry Pis</a>
                                </li>
								<li>
                                    <a href=\"listsensor.php\">View Sensors</a>
                                </li>
                            </ul>
							<li>
								
								
								
								";
								
							}
								
						?>
							<li>
						<a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
                            <!-- /.nav-second-level -->
							</li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" >
					<h1 class="page-header"><?php echo $_GET['sensorName'] ?>'s status:<?php 
															echo $_GET['statusID'];?> Details</h1>
					<div id="qwert"></div>
					
					<?php
						require_once('mysteryDB_connect.php');

							$statusID = $_GET['statusID'];
							
							$sql = "SELECT st.status as status, std.variableName as variableName, std.value as value 
														  from status st join statusdetails std
																on st.statusID = std.statusID
														 where st.statusID = '$statusID'";
						
							$result1 = mysqli_query($dbc,$sql);
							
							echo 	
										'
										<table class="table table-stipend table-bordered table-hover" id="roomtable">
										<thead>
											<tr>
											<th class="text-center">Status</th>
											<th class="text-center">Variable Name</th>
											<th class="text-center">Value</th>
											</tr>
										</thead>
										<tbody>
										';
							
							while ($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
											
								$status = $row['status'];	
								$variableName = $row['variableName'];	
								$value = $row['value'];	
								echo'
									<tr>
											<th class="text-center">'.$status.'</th>
											<th class="text-center">'.$variableName.'</th>
											<th class="text-center">'.$value.'</th>	
									</tr>
									';
							}	
								
							echo '</tbody> </table>';
						
					?>
				
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

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
	
	<script>
	

</body>

</html>
