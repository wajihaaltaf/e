<?php
require_once('config.php');
require_once('session2.php');
?>
<?php

session_destroy();
$id = $_SESSION['id'];
$qry="SELECT max(login_id) as log_id from `loghistory` WHERE emp_id = '$id' ";
	$qry=mysql_query($qry);
while($rec = mysql_fetch_array($qry)){
		$log_id = $rec['log_id'];}

$qry=mysql_query("UPDATE `loghistory` SET `logout_time` = now() WHERE `loghistory`.`login_id` = '$log_id'")or die(mysql_error());
header('location:index.php');
?>