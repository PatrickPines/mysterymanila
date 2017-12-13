<!DOCTYPE html>
<html lang="en">
<?php session_start();
if($_SESSION['userTypeID'] != 1) {
	 header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/logout.php");
}
require_once('mysteryDB_connect.php'); 
if (isset($_POST['submit'])){
		$message=NULL;
										
		if(empty($_POST['username'])){
			 $username=FALSE;
		}else{
			$query= "select * from users where username = '{$_POST['username']}' "; // Run your query
			$result=mysqli_query($dbc,$query);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if(empty($row)){
				$username = $_POST['username'];
			}else {
				$message .= '<p>UserName already Exists';
			}
		}
		
		if(empty($_POST['userType'])){
			 $message .= '<p>Empty user Type';
			 $userTypeID=FALSE;
		}else $userTypeID = $_POST['userType'];

		if(empty($_POST['branch'])){
			 $message .= '<p>Empty branch';
			 $branchID=FALSE;
		}else $branchID = $_POST['branch'];

		$password = $_POST['password'];
		
		if(!isset($message)){
			
			$query1="insert into users(username,password,userTypeID,branchID) values ('$username ',password('$password'),'$userTypeID','$branchID')";
			$result=mysqli_query($dbc,$query1);
											
		}

		if(isset($message)){
			echo '<font color="green">'.$message.'</font>';
		}

	}/*End of main Submit conditional*/
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add User</title>

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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['username'];?></a>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">

							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                        <div class="form-group">
											<a href='displayuser.php'class='btn btn-info' role='button'>Back</a>
											<br><br>
                                            <input required name="username" class="form-control" placeholder="Username">
                                        </div>
										<div class="form-group">
                                            <input type="password" required name="password" class="form-control" placeholder="Password">
                                        </div>
										<div class="form-group">
										<label>User Type</label>
                                            <select name= "userType" class="form-control">
											<?php
												
												$query1= "select * from usertype;"; // Run your query
												$result1=mysqli_query($dbc,$query1);
												echo "<option value='default'> -Select- </option>"; 
												while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
												$userType = $row['userType'];
												$id = $row['userTypeID'];
												echo "<option value=". $id .">".$userType."</option>";
												}
											?>
                                            </select>
                                        </div>
										<div class="form-group">
										<label>Branch</label>
                                            <select name="branch" class="form-control">
                                             <?php
												
												$query1= "select * from branches;"; // Run your query
												$result1=mysqli_query($dbc,$query1);
												echo "<option value='default'> -Select- </option>"; 
												while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
												$branchName = $row['branchname'];
												$id = $row['branchID'];
												echo "<option value=". $id .">".$branchName."</option>";
												}
											?>
                                            </select>
                                        </div>
										<br>
											<div align="center"><input type="submit" name="submit" value="Confirm" class="btn btn-info" role="button"/></div>	

										
							</form>
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
