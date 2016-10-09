<?php
require_once('config.php');
?>
<?php
$r =1; 
$s=1;

//Start session
session_start();
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
		//Sanitize the POST values
    $email = clean($_POST['email']);
    $password = clean(md5($_POST['password']));
	//Create query
$qry="SELECT * from `employee` WHERE (employee.emp_email = '$email' or employee.emp_username='$email') and employee.emp_password= '$password' and employee.emp_isapprove = 1 and employee.emp_isactive =1 ";
	$result=mysqli_query($con,$qry);
	$qry1="SELECT * FROM `customer` WHERE (customer.cust_email='' or customer.cust_username='') and customer.cust_password='' and customer.cust_isvalid=1";
	$row=mysqli_query($con,$qry1);
if($result) { 
			if(mysqli_num_rows($result) > 0 ) {
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['emp_username'] = $member['emp_username'];
			$_SESSION['emp_id'] = $member['emp_id'];
			$id = $member['emp_id'];
			$_SESSION['emp_name']=$member['emp_name'];
			$_SESSION['emp_password'] = $member['emp_password'];
			$_SESSION['emp_email'] = $member['emp_email'];
			$_SESSION['emp_image'] = $member['emp_image'];
			$position = $member['emp_position']; 
			$_SESSION['emp_position'] = $member['emp_position'];
			$select = "SELECT HOST FROM information_schema.processlist where id = connection_id()";
$qry=mysqli_query($con,$select);
		while($rec = mysqli_fetch_array($qry)){
		$host = "$rec[HOST]";}
			mysqli_query($con,"INSERT INTO `loghistory` (`login_id`,`emp_id`, `login_time`,`login_ipaddress`, `logout_time`) VALUES ('','$id', NOW(), '$host', '')")or die(mysqli_error($con));
			$qry="SELECT max(login_id) as log_id from `loghistory` WHERE emp_id = '$id' ";
	$qry=mysqli_query($con,$qry);
while($rec = mysqli_fetch_array($qry)){
		$_SESSION['log_id'] = $rec['log_id'];}
		mysqli_commit($con);
		mysqli_close($con);
			session_write_close();
			if($position == "HR")
			{header("location: hr.php?");
			exit();}
			else if($position == "Manager")
			{header("location: manager.php?");
			exit();}
			else if($position == "CEO")
			{header("location: ceo.php?");
			exit();}
			}
			else {$r =0;}
		}
		if($row)
			{ 
			if(mysqli_num_rows($row) > 0 ) {
			session_regenerate_id();
			while($rec = mysqli_fetch_assoc($row)){
			$_SESSION['id'] = $rec['cust_id'];
			$_SESSION['email'] = $rec['cust_email'];
			$_SESSION['username'] = $member['cust_username'];
			$_SESSION['password'] = $member['cust_password'];
		    header("location: customer.php?"); 
			exit();
			}
			}
			else { $s=0;  }
			}
		if($s==0 && $r==0) {
		
		$user_query = mysqli_query($con,"select emp_isactive from employee where (emp_email = '$email' or emp_username = '$email')")or die(mysql_ereror());
													while($row = mysqli_fetch_array($user_query)){
													$isactive = $row['emp_isactive'];
													}
													if(mysqli_num_rows($user_query)>0){
											if($isactive ==0) {header("location: login_errors.php"); exit(); }
												else {header("location: login_error.php"); exit();} }
												else {header("location: login_error.php"); exit();} 
		} 
	
?>
