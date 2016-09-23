<?php
try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}



/* Database connection start */
$servername = "mysql08.citynetwork.se";
$username = "111335-ve72158";
$password = "Sommar11";
$dbname = "111335-valfrimobil";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
mysqli_set_charset($conn,"utf8");

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'order_id', 
	1 => 'order_id',
	2 => 'product_id',
	3 => 'model',
	4 => 'date',
	5 => 'email',
	6 => 'imei_number',
	7 => 'price',
	8 => 'status'
);




// getting total number records without any search
$sql = "SELECT order_id";
$sql.=" FROM v_orders WHERE status = '1' ";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


//$sql = "SELECT order_id, name, code, model, product_id, date, price, email, imei_number, status";
//$sql.=" FROM v_orders WHERE 1=1 AND status = '1' ";

$sql = "SELECT B.order_id, B.name, B.code, B.model, B.product_id, B.date, B.price, B.email, B.imei_number, B.status, A.carrier
FROM v_products_2 A
   Join v_orders B 
      on B.product_id = A.product_id
WHERE 1=1 AND B.status = '1'
";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( B.name LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR B.email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR B.order_id LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR A.carrier LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR A.mobile LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR B.date LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR B.price LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR B.imei_number LIKE '".$requestData['search']['value']."%' ) ";
}


$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
	

$data = array();
$i=1+$requestData['start'];

	
	
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
$productid_sql = "SELECT * FROM `v_products_2` WHERE product_id = '{$row['product_id']}'";
$productid_state = $objDb->query($productid_sql);
$productid = $productid_state->fetchAll(PDO::FETCH_ASSOC);

	$nestedData=array(); 

	$nestedData[] = "<input type='checkbox'  class='deleteRow_processing' value='".$row['order_id']."'  />";

	$nestedData[] = $row["order_id"];
	
    foreach($productid as $produ) {
	
	$nestedData[] = $produ['carrier']." ".$produ['mobile'];
    
   	$nestedData[] = $row["model"];
   	$nestedData[] = $row["date"];
	$nestedData[] = $row["email"];
	$nestedData[] = $row["imei_number"];
	$nestedData[] = $row["price"];
	$nestedData[] = '
	
    '.(($produ['code']=='1')?'
      
			<form class="code-form-latest_processing" id="'.$row['order_id'].'" method="post">
									<div class="ui form" style="position: relative;">
									
										<input type="text" style="width: 100px; margin-bottom: 5px;" placeholder="Kod (Sparas)" value="'.$row['code'].'" class="code_code_processing'.$row['order_id'].'" name="code_code">
									
										<div style="position: absolute; right: 10px; top: 10px;" class="form-status-holder_processing'.$row['order_id'].'"></div>
					
					
									</div>
									
				</form>
	':"").'
		 
			<select name="status" class="selectshit_processing ui dropdown" id="'.$row['order_id'].'">

				<option value="1" '.(($row['status']=='1')?'selected="selected"':"").'>Mottagen</option>
				<option value="2" '.(($row['status']=='2')?'selected="selected"':"").'>Bearbetas</option>
				<option value="3" '.(($row['status']=='3')?'selected="selected"':"").'>Nekades</option>
				<option value="4" '.(($row['status']=='4')?'selected="selected"':"").'>Klar</option>
				<option value="5"'.(($row['status']=='5')?'selected="selected"':"").'>Klar/Betald</option>

			</select>
	';
	}
	
	$data[] = $nestedData;
	$i++;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
