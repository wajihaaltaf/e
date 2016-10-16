<?php
require_once('config.php');
require_once('session2.php');
?>
<?php 
$id = $_GET['id'];
//echo "Delete from tempstore where temp_id = $id";
	mysql_query("Delete from tempstore where temp_id = $id")or die(mysql_error());
				?>
				<script>
alert('Declined Succsessfully');
window.location = "addemp.php";
</script>

