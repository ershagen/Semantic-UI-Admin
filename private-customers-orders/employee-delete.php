<?php
/* Database connection start */
$servername = "mysql08.citynetwork.se";
$username = "111335-ve72158";
$password = "Sommar11";
$dbname = "111335-valfrimobil";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


$data_ids = $_REQUEST['data_ids'];
$data_id_array = explode(",", $data_ids); 
if(!empty($data_id_array)) {
	foreach($data_id_array as $id) {
		$sql = "DELETE FROM v_orders_2 ";
		$sql.=" WHERE order_id = '".$id."'";
		$query=mysqli_query($conn, $sql) or die("employee-delete.php: delete employees");
	}
}
?>