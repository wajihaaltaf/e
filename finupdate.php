<?php
require_once('config.php');
require_once('session2.php');
?>
<?php
if(isset($_GET['id']))
{
$emp_id=$_SESSION['id'];
	$user_query = mysql_query("select * from employee where emp_id=$emp_id")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$empname = $row['emp_name'];
													
												$gender = $row['emp_gender'];
											        $empnic = $row['emp_nic'];
													$empdob = $row['emp_DOB'];
													$empemail = $row['emp_email'];
													$empcuraddress = $row['emp_address'];
													$password = $row['emp_password'];
													
													}}
	if (isset($_POST['update'])){
		if (($_POST['emp_full_name'] == '')or ($_POST['emp_dob'] == '')  or ($_POST['emp_nic'] == '') or ($_POST['password'] == '')or ($_POST['emp_current_address'] == '') or ($_POST['emp_email'] == '') )
			{
			?> <script>
alert('Error Occured while updating');
window.location = "finupdate.php";
</script>
			<?php
			exit();
			}
	else{ 
		$firstname = addslashes("$_POST[emp_full_name]");
	   $dob = addslashes("$_POST[emp_dob]");
		$nic = addslashes("$_POST[emp_nic]");
		$passw = md5(addslashes("$_POST[password]"));
		$empcuraddress = addslashes("$_POST[emp_current_address]");
		$email= addslashes("$_POST[emp_email]");
		if($password == $passw) {
		mysql_query("UPDATE employee SET emp_name ='$firstname', emp_DOB ='$dob', emp_nic = '$nic',emp_email ='$email',emp_address='$empcuraddress' WHERE emp_id = '$emp_id'")or die(mysql_error()); 
		
?>
<script>
alert('Updated Successfully');
window.location = "financeprofile.php";
</script>
<?php
}
else {
?>
<script>
alert('Password doesnot match with eachother');
window.location = "financeprofile.php";
</script>
<?php }}}?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Finance | Profile</title><link rel="shortcut icon" href="assets/img/logocalc1.png"><script src="js/blockrightclick.js"></script>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper"> <header class="main-header">

    <!-- Logo --> <a href="#l" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->    <span class="logo-mini"><b>E</b>RP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E</b>RP</span>
    </a>

     <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
              <span class="label label-success"> <?php	
	                   $count=0;
	                   $count_client=mysql_query("select * from leavereq where leave_approve=1 and Leave_type='Loan'");
	                   $count = mysql_num_rows($count_client);
					   echo $count;?>	</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $count; ?> Requests</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <?php $image=$_SESSION['emp_image']; ?>
         
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Loan Requests												
                        <small><i class="fa fa-clock-o"></i></small>
                      </h4>
                      <!-- The message -->
                      <p></p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="loan.php">See All Requests</a></li>
            </ul>
          </li>
        
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">	<?php if(isset($_SESSION['emp_name']))
				{
				echo 
				"".$_SESSION['emp_name']." ";
				}?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" class="img-circle" alt="User Image">


                <p>
                <?php
				//Check to see if the user is logged in.
				
				if(isset($_SESSION['emp_email']))
				{ 
				echo 
				"".$_SESSION['emp_email']." ";
				}

				?>
                  <small><?php echo $_SESSION['position']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">  <a href="financeprofile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="session_logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
         
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
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
          <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" class="img-circle" alt="User Image" width="45px">
        </div>
        <div class="pull-left info">
          <p><?php if(isset($_SESSION['emp_name']))
				{
				echo 
				"".$_SESSION['emp_name']." ";
				}?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>

              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="header">
        </li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="finance.php"><i class="fa fa-link"></i> <span>Home</span></a></li>
       <li><a href="salary.php"><i class="fa fa-link"></i> <span>Salary</span></a></li>
        <li><a href="loan.php"><i class="fa fa-link"></i> <span>Loan</span></a></li><li><a href="stockrequests.php"><i class="fa fa-link"></i> <span>Stock Request</span></a></li>
        <li><a href="employeelogfinance.php"><i class="fa fa-link"></i> <span>Employee Log</span></a></li>
          <li><a href="aboutusfinance.php"><i class="fa fa-link"></i> <span>About Us</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
  </aside>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small><?php echo 
				"".$_SESSION['emp_email']." "; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="ceo.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
          <li class="active">Update Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Update Profile</h3>

            
                <!-- /.col -->
               
                <!-- Page Heading -->
  <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" method="post">
			<h3><center>Edit Information</center></h3>
			<br>									
			<div> 
					<div class="form-group">
							  <label class="col-md-5 control-label" for="rental">First Name:</label>
							  <div class="col-md-3">
					<input type="text" name="emp_full_name" id = "fname" class="form-control input-md" placeholder="please enter first name" pattern="[A-Za-z. ]{1,50}" value= "<?php echo $empname; ?>" required/> 
						</div>
						</div>
						
                 
                      
                <div class="form-group">
							  <label class="col-md-5 control-label">Email:</label>
							  <div class="col-md-3">
						<input type="text" name="emp_email" id = "email" class="form-control input-md"  placeholder="Email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" title="Incorrect Email" value="<?php echo $empemail; ?>"required/>
					</div>
				</div>
                 <div class="form-group">
							  <label class="col-md-5 control-label">NIC: [14Digit Number]</label>
							  <div class="col-md-3">
						<input type="text" name="emp_nic" id = "nic" class="form-control input-md"  placeholder="NIC" title="Numbers Only" value="<?php echo $empnic; ?>" required/>
					</div>
				</div>	
				<div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Date of birth:</label>
							  <div class="col-md-3">
						<input type="date" name="emp_dob" id = "bdate" title="click to choose a date" class="form-control input-md" placeholder="yyyy-mm-dd" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" title="YYYY-MM-DD" value = <?php echo $empdob; ?> required/>
					</div>
				</div>
               
                <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Address:</label>
							  <div class="col-md-3">
						<input type="text" name="emp_current_address" id = "address" class="form-control input-md" placeholder="Current Address" pattern="[A-Za-z0-9.#/\-_,' ]{6,50}"  value="<?php echo $empcuraddress; ?>" required/>
					</div>
				</div>
		
        		
 <div class="form-group">
							  <label class="col-md-5 control-label" for="rental">Password:</label>
							  <div class="col-md-3">
						<input type="password" name="password" id = "password" class="form-control input-md" placeholder="Password" title="Should be atleast six characters with atleast 1 special character"  required/>
					</div>
				</div>
               <div class="control-group">
				<div class="controls" align="center">
						           				 <button name="update" class="btn btn-success">Update</button>
												 <a button id="cancel" name="cancel" class="btn btn-danger" href="finance.php" >Cancel</button></a>
						           			 </div></div>
											 <br>
											 <br>
											 <br>
											 <br>
                                   
									</tr>
									</tbody>
						            </div>
									</center>
                                 </form>      
                                    
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.5
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="#">Techrisers</a>.</strong> All rights
    reserved.
  </footer>

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
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
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
