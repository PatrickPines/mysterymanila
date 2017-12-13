<!DOCTYPE html>
<html lang="en">
<?phpsession_start();?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Raspberry Pi</title>

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
                <a class="navbar-left" href="index.html" ><img style="width:150px;height:50px;" src="logo.gif"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
			
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="view_index.php"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> List<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li>
                                    <a href="view_listbranch.php">Branch List</a>
                                </li>
								<li>
                                    <a href="view_listroom.php">Room List</a>
                                </li>
								<li>
                                    <a href="view_listrpi.php">Raspberry Pi List</a>
                                </li>
                                <li>
                                    <a href="view_listsensor.php">Sensor List</a>
                                </li>
                            </ul>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
								
								<h1>Branch List</h1>
									<?php
										require_once('mysteryDB_connect.php');


										$sql = "SELECT branchID, branchname
												  from branches";
											
										$result = mysqli_query($dbc,$sql);
										
										echo 	
												'
												<table class="table table-stipend table-bordered table-hover" id="roomtable">
												<thead>
													<tr>
													<th class="text-center">Branch ID</th>
													<th class="text-center">Branch Name</th>
													
													</tr>
												</thead>
												<tbody>
												
												';
										
										while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
											$branchID = $row['branchID'];
											$branchname = $row['branchname'];			
											
											echo 
												'
												<tr>
													<td class="text-center">'.$branchID.'</a></td>
													<td class="text-center">'.$branchname.'</a></td>
													
												</tr>
												';
												
										}
										
										echo '</tbody> </table>';										
									?>
									
									<?php
										
										require_once('mysteryDB_connect.php');
									
										if (isset($_POST['submit'])){
											
											$message=NULL;
											 if(empty($_POST['newbranchName'])){
												 $message .= '<p>Empty branch';
												 $branch=FALSE;
											 }else 
												 
											 if (isset($_POST['branchID'])){
												$branchID = $_POST['branchID'];
												echo $branchID;
											}
											else{
												$branchID = -1;
											}$newbranchName = $_POST['newbranchName'];
											 
											if(!isset($message)){
														$query1="update branches	
																	set branchname = $newbranchName 
																  where branchID = $branchID;";
																  
																  
												$result=mysqli_query($dbc,$query1);
												echo $result;
												if ($result) {
													echo'
														<div class="alert alert-success">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Success!</strong> Success Editing '.$newbranchName.' branch.
														</div>
														';
												}
												else{
													echo'
														<div class="alert alert-danger">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Error!</strong> Did not change name to '.$newbranchName.' branch.
														</div>
														';
												}											}
											if(isset($message)){
												echo'
													<div class="alert alert-danger">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Error!</strong> '.$message.'
													</div>
													';
											}
										}
									?>
									
									
									<!-- Modal -->
										  
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

</body>

</html>
