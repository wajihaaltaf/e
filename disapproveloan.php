<?php
require_once('config.php');
require_once('session2.php');
?>
<?php 
$id = $_GET['id'];
	mysql_query("UPDATE `leavereq` SET `leave_approve` = '-1' WHERE `leavereq`.`leave_id` = $id;")or die(mysql_error());
				?>
				<script>
alert('Declined Succsessfully');
window.location = "requestreport.php";
</script>

