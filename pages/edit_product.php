<?php
//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);
try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');

	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}

$session_id='1'; // User session id
$path = "../../product-images/";

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
	$name = $_FILES['file']['name'];
	$size = $_FILES['file']['size'];

		$pi = pathinfo($name);
		$txt = $pi['filename'];
		$ext = $pi['extension'];
		$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg");

		if(in_array($ext,$valid_formats))
		{

			if($size<(2024*2024)) // Image size max 1 MB
			{
				$actual_image_name = time().$session_id.".".$ext;
				$tmp = $_FILES['file']['tmp_name'];

				if(move_uploaded_file($tmp, $path.$actual_image_name))
				{

					$id = $_POST['id'];
					$carrier = $_POST['carrier'];
					$mobile = $_POST['mobile'];
					$model = $_POST['model'];
					$price = $_POST['price'];
					$description = $_POST['description'];
					$published = $_POST['published'];
					$picture = "http://valfrimobil.se/".$path.$actual_image_name;
					$delivery = $_POST['delivery'];
					$codeco = $_POST['codeco'];
					$supplier = $_POST['supplier_id'];
					$language = $_POST['language'];

// query
					$sqls = "UPDATE v_products_2 
					        SET carrier=?,
					        mobile=?,
					        model=?,
					        price=?,
					        delivery=?,
					        description=?,
					        published=?,
					        picture=?,
					        code=?,
					        phone_picture=?,
					        supplier_id=?,
					        language=?
					   		WHERE product_id=?";
					$qs = $objDb->prepare($sqls);
					$qs->execute(array($carrier,$mobile,$model,$price,$delivery,$description,$published,$picture,$codeco,$picture,$supplier,$language,$id));



					echo "gött!";
					
				} else {
					echo "fail...";
				}

		} else {
			echo "max 1mb!!"; 
		}
		
	} else {
		echo "Uppdaterat!";
	
		$id = $_POST['id'];
		$carrier = $_POST['carrier'];
		$mobile = $_POST['mobile'];
		$model = $_POST['model'];
		$description = $_POST['description'];
		$published = $_POST['published'];
		$picture = "http://valfrimobil.se/new/admin/".$path.$actual_image_name;
		$delivery = $_POST['delivery'];
		$price = $_POST['price'];
		$codeco = $_POST['codeco'];
		$supplier = $_POST['supplier_id'];
		$language = $_POST['language'];

		// query
		$sql = "UPDATE v_products_2 
		        SET carrier=?,
		        mobile=?,
		        model=?,
		        price=?,
		        delivery=?,
		        description=?,
		        published=?,
		        code=?,
		        supplier_id=?,
		        language=?
		   		WHERE product_id=?";
		$q = $objDb->prepare($sql);
		$q->execute(array($carrier,$mobile,$model,$price,$delivery,$description,$published,$codeco,$supplier,$language,$id));
		
		
	}


} else {
	echo "nos";
	exit;
}
?>