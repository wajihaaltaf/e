<?php
mysql_select_db('erp',mysql_connect('localhost','root',''))or die(mysql_error());
?>
<?php
require_once('session2.php');
?>
<?php 
$id = $_GET['id'];
	mysql_query("Delete from tempstore where temp_id = $id")or die(mysql_error());
				?>
				<script>
alert('Declined Succsessfully');
window.location = "addemp.php";
</script>

