<?php
mysql_select_db('erp',mysql_connect('localhost','root',''))or die(mysql_error());
?>
<?php
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
    $username = clean($_POST['email']);
	$password = clean($_POST['password']);
$password=md5($password);
		//Create query
	$qry="SELECT * from `employee` WHERE (emp_username = '$username' or emp_email = '$username') and emp_password = '$password' and emp_isapprove=1 and emp_status=1";
	
	$result=mysql_query($qry);
	
if($result) {
		if(mysql_num_rows($result) > 0 ) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['username'] = $member['emp_username'];
			$_SESSION['password'] = $member['emp_password'];
			$_SESSION['position'] = $member['emp_position'];
			$_SESSION['emp_email'] = $member['emp_email'];
			$_SESSION['id'] = $member['emp_id'];
			$_SESSION['emp_image'] = $member['emp_image'];
			$id = $member['emp_id'];
			$select = "SELECT HOST FROM information_schema.processlist where id = connection_id()";
$qry=mysql_query($select);
		while($rec = mysql_fetch_array($qry)){
		$host = "$rec[HOST]";}
			mysql_query("INSERT INTO `loghistory` (`login_id`,`emp_id`, `login_time`,`login_ipaddress`, `logout_time`) VALUES ('','$id', NOW(), '$host', '')")or die(mysqli_error());
			
			session_write_close();
			$position = $member['emp_position'];
			if($position == "Manager")
			header("location: manager.php?");
			else if($position == "Admin")
			header("location: hr.php?");
			else if($position == "CEO")
			header("location: ceo.php?");
			else if($position == "Finance")
			header("location: finance.php?");
			else if($position == "Sales")
			header("location: sales.php?");
			exit();
			}
		
		else {
			//Login failed
			header("location: login_error.php");
			exit();
		}
		}
	else {
		die("Query failed");
	}	
	

?>