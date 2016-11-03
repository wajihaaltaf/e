<?php
require_once('config.php');
require_once('session2.php');
?>
<?php 
$id = $_GET['id'];
	mysql_query("UPDATE `stockorder` SET `order_approve` = '1' WHERE `stockorder`.`order_id` = '$id'")or die(mysql_error());
				?>
				<script>
alert('Accepted Succsessfully');
window.location = "stockrequest.php";
</script>

