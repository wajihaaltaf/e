<?php
require_once('config.php');
require_once('session2.php');
?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>HR | Dashboard</title>
<link rel="shortcut icon" href="assets/img/logocalc1.png">
<script src="js/blockrightclick.js"></script>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- jvectormap -->
<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'fd'],
<?php 
$select = "SELECT COUNT(*) as COUNTING,emp_gender FROM `employee` GROUP by emp_gender";
			//$result = mysql_fetch_array(mysql_query($select));
	$qry=mysql_query($select);
		while($rec = mysql_fetch_array($qry)){
		$uname = "$rec[COUNTING]";
		$gender = "$rec[emp_gender]";
		?>
          ['<?php echo $gender; ?>',    <?php echo $uname; ?>],
<?php } ?>
        ]);
        var options = {
          title: 'Male to Female Employees'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart.draw(data, options);
	  var data = google.visualization.arrayToDataTable([
          ['Position', 'fd'],
<?php 
$select = "SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(emp_DOB, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(emp_DOB, '00-%m-%d')) AS age FROM employee group by age";
			//$result = mysql_fetch_array(mysql_query($select));
	$qry=mysql_query($select);
		while($rec = mysql_fetch_array($qry)){
		$uname = "$rec[age]";
		?>
          ['<?php echo $uname; ?>',    <?php echo $uname; ?>],
<?php } ?>
        ]);
        var options = {
          title: 'Employees by Age'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart3'));

        chart.draw(data, options);
		var data = google.visualization.arrayToDataTable([
          ['Department', 'fd'],
<?php 
$select = "SELECT count(employee.emp_id) as COUNTING, employee.dept_id, department.dept_name as name FROM employee, department where employee.dept_id = department.dept_id group by employee.dept_id ";
			//$result = mysql_fetch_array(mysql_query($select));
	$qry=mysql_query($select);
		while($rec = mysql_fetch_array($qry)){
		$uname = "$rec[COUNTING]";
		$gender = "$rec[name]";
		?>
          ['<?php echo $gender; ?>',    <?php echo $uname; ?>],
<?php } ?>
        ]);
        var options = {
          title: 'Employees by Department'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
			  var data = google.visualization.arrayToDataTable([
          ['Position', 'fd'],
<?php 
$select = "SELECT COUNT(*) as COUNTING,emp_position FROM `employee` GROUP by emp_position";
			//$result = mysql_fetch_array(mysql_query($select));
	$qry=mysql_query($select);
		while($rec = mysql_fetch_array($qry)){
		$uname = "$rec[COUNTING]";
		$gender = "$rec[emp_position]";
		?>
          ['<?php echo $gender; ?>',    <?php echo $uname; ?>],
<?php } ?>
        ]);
        var options = {
          title: 'Employees by Position'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">
  <!-- Logo --> <a href="#l" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>E</b>RP</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>E</b>RP</span> </a>
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <span class="label label-success">
          <?php	
	                   $count_client=mysql_query("select * from interview where inter_status=1 ");
	                   $count = mysql_num_rows($count_client);
					    $count_client=mysql_query("select * from tempstore where temp_status=1");
	                   $counts = mysql_num_rows($count_client);
					     $count_client=mysql_query("select * from tempstore where temp_status=1  ");
	                   $countss= mysql_num_rows($count_client);
					   $count=$count+$counts+$countss;
					   echo $count;
                       ?>
          </span> </a>
          <ul class="dropdown-menu">
            <li class="header">You have <?php echo $count; ?> Notifications</li>
            <li>
              <!-- inner menu: contains the messages -->
              <ul class="menu">
                <li>
                  <!-- start message -->
                  <a href="#">
                  <div class="pull-left">
                    <!-- User Image -->
                    <?php $image=$_SESSION['emp_image']; ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" class="img-circle" alt="User Image"> </div>
                  <!-- Message title and timestamp -->
                  <h4> Recruitment <small><i class="fa fa-clock-o"></i> 5mints</small> </h4>
                  <!-- The message -->
                  <p></p>
                  </a> </li>
                <!-- end message -->
              </ul>
              <!-- /.menu -->
            </li>
            <li class="footer"><a href="interview.php">See All Recruitment Notifications</a></li>
          </ul>
        </li>
        <li class="dropdown notifications-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i> <span class="label label-success">
          <?php	
					  $count=0;
	                   $count_client=mysql_query("select * from leavereq where leave_approve=1 and Leave_type='Leave'");
	                   $count = mysql_num_rows($count_client);
					    $count_client=mysql_query("select * from leavereq where leave_approve=1 and Leave_type='Other'");
	                   $count = mysql_num_rows($count_client) + $count;
                     echo $count;  ?>
          </span> </a>
          <ul class="dropdown-menu">
            <li class="header">You have <?php echo $count; ?> Requests</li>
            <li>
              <!-- inner menu: contains the messages -->
              <ul class="menu">
                <li>
                  <!-- start message -->
                  <a href="#">
                  <div class="pull-left">
                    <!-- User Image -->
                  </div>
                  <!-- Message title and timestamp -->
                  <h4> Check Request <small><i class="fa fa-clock-o"></i> <?php echo $count; ?></small> </h4>
                  <!-- The message -->
                  <p></p>
                  </a> </li>
                <!-- end message -->
              </ul>
              <!-- /.menu -->
            </li>
            <li class="footer"><a href="reqinsert.php">See All Requests</a></li>
          </ul>
        </li>
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" class="user-image" alt="User Image">
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">
          <?php if(isset($_SESSION['emp_name']))
				{
				echo 
				"".$_SESSION['emp_name']." ";
				}?>
          </span> </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header"> <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" class="img-circle" alt="User Image">
              <p>
                <?php
				//Check to see if the user is logged in.
				
				if(isset($_SESSION['emp_email']))
				{ 
				echo 
				"".$_SESSION['emp_email']." ";
				}

				?>
                <small><?php echo $_SESSION['position']; ?></small> </p>
            </li>
            <!-- Menu Body -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left"> <a href="hrprofile.php" class="btn btn-default btn-flat">Profile</a> </div>
              <div class="pull-right"> <a href="session_logout.php" class="btn btn-default btn-flat">Sign out</a> </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li> <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php $image=$_SESSION['emp_image']; ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" class="img-circle" alt="User Image" width="45px"> </div>
      <div class="pull-left info">
        <p>
          <?php if(isset($_SESSION['emp_name']))
				{
				echo 
				"".$_SESSION['emp_name']." ";
				}?>
        </p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
    </div>
    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> </button>
        </span> </div>
    </form>
    <!-- /.search form -->
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header"> </li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="hr.php"><i class="fa fa-link"></i> <span>Home</span></a></li>
      <li class="treeview"> <a href="#"><i class="fa fa-link"></i> <span>Recruitment</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li><a href="test.php">Test</a></li>
          <li><a href="interview.php">Interview</a></li>
          <li><a href="managerapproved.php">Managers Approved</a></li>
          <li><a href="ceoapproved.php">CEO Approved</a></li>
        </ul>
      </li>
      <li class="treeview"> <a href="#"><i class="fa fa-link"></i> <span>Request</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li><a href="addrequest.php">Do Request</a></li><li><a href="reqinsert.php">Check Request</a></li>
          <li><a href="stockrequest.php">Stock Order Request</a></li>
          
        </ul>
      </li>
      <li><a href="employeelog.php"><i class="fa fa-link"></i> <span>Employee Log</span></a></li>
      <li><a href="aboutus.php"><i class="fa fa-link"></i> <span>About Us</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> Dashboard <small><?php echo 
				"".$_SESSION['emp_email']." "; ?></small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Info boxes -->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
      <div class="info-box-content"> <span class="info-box-text">Notifications</span> <span class="info-box-number">
        <?php 
	$count_client=mysql_query("select * from tempstore where temp_status=1 ");
	                   $count = mysql_num_rows($count_client);
					      $counts_client=mysql_query("select * from leavereq where leave_type='Loan' and leave_approve=0");
				 $count = mysql_num_rows($counts_client) + $count;

                       echo $count;?>
        </span> </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box"> <span class="info-box-icon bg-red"><i class="icon ion-android-person-add"></i></span>
      <div class="info-box-content"> <span class="info-box-text">Requests</span> <span class="info-box-number">
        <?php	
					  $count=0;
	                   $count_client=mysql_query("select * from tempstore where temp_status=1  ");
	                   $count = mysql_num_rows($count_client);
                      echo $count; ?>
        </span> </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box"> <span class="info-box-icon bg-green"><i class="icon ion-ios-bookmarks-outline"></i></span>
      <div class="info-box-content"> <span class="info-box-text">Projects</span> <span class="info-box-number">
        <?php 
	$select = "SELECT COUNT(*) as count FROM project";
			  $qry=mysql_query($select);
		$rec = mysql_fetch_array($qry);
		$count = "$rec[count]"; echo $count;?>
        </span> </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
      <div class="info-box-content"> <span class="info-box-text">Employees</span> <span class="info-box-number">
        <?php 
	$select = "SELECT COUNT(*) as count FROM employee";
			  $qry=mysql_query($select);
		$rec = mysql_fetch_array($qry);
		$count = "$rec[count]"; echo $count;?>
        </span> </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-md-16">
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Monthly Recap Report</h3>
    <div class="box-tools">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
     
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
       
      <div id="piechart3" style="width: 50%; height: 300px; float:left"></div>
     <div id="piechart1" style="width: 50%; height: 300px; float:left"></div>
     </div>
      <!-- /.col -->
      <div class="col-md-4">
     
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- ./box-body -->
  <div class="box-footer">
    <!-- /.row -->
    <!-- /.box -->
    <div class="row">
      <div class="col-md-6">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Recent Projects</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Project ID</th>
                    <th>Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
			$query=mysql_query("select * FROM project")or die(mysql_error());
						while($row=mysql_fetch_array($query)){
			?>
                  <tr>
                    <td><?php echo $row['proj_id']; ?></td>
                    <td><?php echo $row['proj_title']; } ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"> <a href="add_proj_hr.php" class="btn btn-sm btn-info btn-flat pull-left">Add New Project</a> </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-6">
        <!-- Info Boxes Style 2 -->
        <div class="box box-info">
        <div class="box-header"> <i class="fa fa-envelope"></i>
          <h3 class="box-title">Quick Email</h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
          </div>
          <!-- /. tools -->
        </div>
        <div class="box-body">
        <form action="sendemailhr.php" method="post">
          <div class="form-group">
            <input type="email" class="form-control" name="emailto" placeholder="Email to:" required />
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" placeholder="Subject" required />
          </div>
          <div>
            <textarea class="textarea" name="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required />
            </textarea>
          </div>
          </div>
          <div class="box-footer clearfix">
            <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
          </div>
          </div>
        </form>
        <!-- /.box -->
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <!-- /.box-header -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs"> <b>Version</b> 2.3.5 </div>
    <strong>Copyright &copy; 2014-2016 <a href="#">Techrisers</a>.</strong> All rights
    reserved. </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-birthday-cake bg-red"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
              <p>Will be 23 on April 24th</p>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-user bg-yellow"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
              <p>New phone +1(800)555-1234</p>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
              <p>nora@example.com</p>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-file-code-o bg-green"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
              <p>Execution time 5 seconds</p>
            </div>
            </a> </li>
        </ul>
        <!-- /.control-sidebar-menu -->
        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Custom Template Design <span class="label label-danger pull-right">70%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Update Resume <span class="label label-success pull-right">95%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Laravel Integration <span class="label label-warning pull-right">50%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Back End Framework <span class="label label-primary pull-right">68%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
            </div>
            </a> </li>
        </ul>
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading"> Report panel usage
            <input type="checkbox" class="pull-right" checked>
            </label>
            <p> Some information about this general settings option </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
            </label>
            <p> Other sets of options are available </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
            </label>
            <p> Allow the user to show his name in blog posts </p>
          </div>
          <!-- /.form-group -->
          <h3 class="control-sidebar-heading">Chat Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading"> Show me as online
            <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Turn off notifications
            <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Delete chat history <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a> </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
