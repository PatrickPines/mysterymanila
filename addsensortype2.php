<!DOCTYPE html>
<html lang="en">
<?php session_start();
if($_SESSION['userTypeID'] != 1) {
	 header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/logout.php");
}
require_once('mysteryDB_connect.php');

$flag=0;
if (isset($_POST['submit'])){
	$message=NULL;
	
	 
	$sensorTypeName=$_SESSION['sensorTypeName'];
	$numberVariableName=$_SESSION['numberVariableName'];
	$status=$_SESSION['status']; 
			$query1="insert into sensortypes(sensorType) values ('$sensorTypeName')";
			$result=mysqli_query($dbc,$query1);
			
		$field = $_POST['field'];
		$value = $_POST['value'];
		
		$query2="select * from sensortypes order by sensorTypeID desc limit 1";
		$result2=mysqli_query($dbc,$query2);
		$row = mysqli_fetch_array($result2, MYSQLI_ASSOC);
		$sensorTypeID = $row['sensorTypeID'];
		//count for value
		$valcount = 0;
		foreach($status as $stat){
			
			$query1="insert into legendstatus(legendStatus,sensorTypeID) values ('$stat','$sensorTypeID')";
			$result=mysqli_query($dbc,$query1);
			
			$query="select * from legendstatus order by legendStatusID desc limit 1";
			$result=mysqli_query($dbc,$query);
			$row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$legendStatusID = $row1['legendStatusID'];
			$count =0;
			while($numberVariableName > $count){
				$query="insert into legendstatusdetails(legendStatusID,legendVariableName,legendValue) values ('$legendStatusID','$field[$count]','$value[$valcount]')";
				$result=mysqli_query($dbc,$query);
				$count++;
				$valcount++;
			}
			
			//while for field and value  -- count is numberVariableName
		}
	//status 
	//field 
	//value
	

	
		
			
			
		

}/*End of main Submit conditional*/



?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Sensor Type</title>

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


									  
	<form name="daform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<a href='addsensortype.php'class='btn btn-info' role='button'>Back</a>
	<br><br>
    <input disabled type="text" value="<?php echo isset($_SESSION['sensorTypeName']) ? $_SESSION['sensorTypeName'] : ''; ?>" name="sensorTypeName" class="form-control" placeholder="Sensor Type Name" />

						  
    <input disabled type="number" value="<?php echo isset($_SESSION['numberVariableName']) ? $_SESSION['numberVariableName'] : ''; ?>" name="numberVariableName" class="form-control" placeholder="Number of Variables" />

<div>

										
										<table id="dataTable" class='pure-table pure-table-horizontal table-width-order table-margin-left'>
										<?php
											echo "<tr>";
											$status = $_SESSION['status'];
											foreach($status as $s){
												echo "<td><input disabled type=\"text\" min=\"0\" name=\"status[]\" class=\"form-control\" placeholder=\"$s\"</td>";
												$num = $_SESSION['numberVariableName'];
												$count = 0;
												while($num > $count){
													if($s == $status[0]){
													echo "<td><input required type=\"text\" min=\"0\" name=\"field[]\" id=\"field\" class=\"form-control\" placeholder=\"Field\" onkeyup=\"document.daform.field2.value = this.value\" </td>";
													echo "<td><input required type=\"number\" min=\"0\" name=\"value[]\" class=\"form-control\" placeholder=\"Value\"</td></tr>";
													}else{
														echo "<td><input disabled type=\"text\" min=\"0\" name=\"field2[]\" id=\"field2\" class=\"form-control\" placeholder=\"Field\" </td>";
														echo "<td><input required type=\"number\" min=\"0\" name=\"value[]\" class=\"form-control\" placeholder=\"Value\"</td></tr>";	
													}
													$b = $num-1;
													if($count != $b){
														echo "<td><input disabled type=\"text\" min=\"0\"class=\"form-control\"</td>";
													}
												
													$count++;
		
												}
											}
										?>
										</table>
										<br>
											<div align="center"><input type="submit" name="submit" value="Confirm" class="btn btn-info" role="button"/></div>	
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
	
			<script language="javascript">
			function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[0].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[0].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "newrow":
							newcell.childNodes[0].value = rowCount + 2 ;
							break;
					case "text":
							newcell.childNodes[0].value = "";
							break;
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 0;
							break;
				}
			}
			</script>
			<script language="javascript">
			
			function sync(textbox){
				var arr1 = document.getElementById(field);
				var arr2 = arr1.slice();
				
				document.theform.getElementById('input1').value = textbox.value;
				var rowCount = table.rows.length;
		
				// for(var i=0; i<rowCount; i++{
					table2.value = table.value;
				// }
			}
		}

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
