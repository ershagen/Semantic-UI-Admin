<?php

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
	
	$product_sql = "SELECT * FROM `v_products_2` WHERE product_id = '{$_GET['id']}'";
	$product_state = $objDb->query($product_sql);
	$products = $product_state->fetchAll(PDO::FETCH_ASSOC);
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}

require_once('../vendor/autoload.php');

?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properities -->
  <title>Valfrimobil.se | Lås upp din iPhone eller Samsung snabbt och billigt</title>

  <link rel="stylesheet" type="text/css" href="../Semantic/dist/semantic.css">
  <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <link href="http://jennywall.se/animate.css" rel="stylesheet" type="text/css"/>

  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
  <script src="../Semantic/dist/semantic.js"></script>
  <script src="//unslider.com/unslider.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/style-admin.css">
  <script src="http://patrickgawron.com/wp/wp-content/uploads/2013/11/jquery.address.js"></script>
  <script src="http://semantic-ui.com/modules/javascript/library/sinon.js"></script>


  <link href="http://valfrimobil.se/new/admin/charts/assets/css/xcharts.min.css" rel="stylesheet">

  <link href="http://valfrimobil.se/new/admin/charts/assets/css/daterangepicker.css" rel="stylesheet">
 
  <script>
  	$(function() {
		$('.ui.dropdown')
			.dropdown()
		;
	});
  </script>
  
  <script src="http://valfrimobil.se/new/admin/data-tables/media/js/jquery.dataTables.js"></script>
  <link href="http://valfrimobil.se/new/admin/data-tables/media/css/jquery.dataTables.css" rel="stylesheet">
      	
      	
      	<script>
		 $(document).ready(function() {
		    $('#products-table').dataTable({
		        "pagingType": "full_numbers",
				"order": [[ 0, "desc" ]],
			        "language": {
			            "lengthMenu": "Visa _MENU_ st per sida",
			            "zeroRecords": "Inget hittades, tyvärr!",
			            "info": "Visar sida _PAGE_ av _PAGES_",
			            "infoEmpty": "Inget hittades",
			            "infoFiltered": "(sökning mellan totalt _MAX_ beställningar)",
			            "sSearch": "Sök:",
			            "oPaginate": {
			            	"sFirst": "Första",
			            	"sPrevious": "Föregående",
			            	"sNext": "Nästa",
			            	"sLast": "Sista"
			            }
			        }
   
		    });
		});
		</script>
		
		
		
      	<script>
		 $(document).ready(function() {
		    $('#orders-table').dataTable({
		        "pagingType": "full_numbers",
				"order": [[ 2, "desc" ]],
			        "language": {
			            "lengthMenu": "Visa _MENU_ st per sida",
			            "zeroRecords": "Inget hittades, tyvärr!",
			            "info": "Visar sida _PAGE_ av _PAGES_",
			            "infoEmpty": "Inget hittades",
			            "infoFiltered": "(sökning mellan totalt _MAX_ beställningar)",
			            "sSearch": "Sök:",
			            "oPaginate": {
			            	"sFirst": "Första",
			            	"sPrevious": "Föregående",
			            	"sNext": "Nästa",
			            	"sLast": "Sista"
			            }
			        }
   
		    });
		});
		</script>

</head>
<body>

<div id="holepage">

    <script>
	    $(function() {
		    $("#minimize").click(function() {
			    $("#menu a.item .text").hide();
			    $("#logo img").hide();
			    $("#logo .ion-navicon").css('float', 'left');
			    $("#left-menu").css('width','60px');
			    $("#image-profile h3").hide();
			    $("#image-profile span").hide();
		    });
		    
		    $('#menu .item')
			  .tab({
				  history: true,
				  auto: true,
				  historyType: 'state',
				  path: '/new/admin'
			  })
			;
			
			$('.tab-item')
			  .tab({
				  history: true,
				  context: $("#menu")
			  })
			;
	    });
    </script>
    
  <div id="left-menu">
  		
  		<div id="logo">
				<img src="http://valfrimobil.se/new/valfri_logo_white.png" width="90" />
				<a href="javascript:void();" id="minimize"><i class="ion-navicon" style="float: right; margin-top: 0px; font-size: 30px; color: white;"></i></a>
		</div>
		
		
		<div style="padding: 0px;">

	      <div class="ui menu" id="menu">
	      <a class="active item" data-tab="dashboard">
	        <i class="left home icon"></i>
	        <div class="text">Dashboard</div>
	      </a>
	      <a class="item" data-tab="orders">
	        <i class="archive icon"></i>
	        <div class="text">Beställningar</div>
	      </a>
	      <a class="item" data-tab="customers">
	        <i class="users icon"></i>
	        <div class="text">Kunder</div>
	      </a>
	      <a class="item" data-tab="products">
	        <i class="archive icon"></i>
	        <div class="text">Produkter</div>
	      </a>
	      <a class="item" data-tab="coupons">
	        <i class="archive icon"></i>
	        <div class="text">Kuponger</div>
	      </a>
	      <a class="item" data-tab="admins">
	        <i class="calendar icon"></i>
	        <div class="text">Admin</div>
	      </a>
	      <a class="item" data-tab="settings">
	        <i class="calendar icon"></i>
	        <div class="text">Inställningar</div>
	      </a>
	      </div>
		 
		</div>
      
    </div>
    
    <div id="right">
    
	    <div id="top">
			<div class="ui top right pointing dropdown" style="float: right; margin-right: 2%; color: #333;">
			    <div class="text"><img src="https://scontent-ams.xx.fbcdn.net/hphotos-xap1/v/t1.0-9/10882107_10205841151658916_6524536534380068553_n.jpg?oh=9f393963e6204e9c41ed7dd373c7a294&oe=55D17766" style="border-radius: 10em;" /> Hampus <i class="dropdown icon"></i></div>
			    <div class="menu">
			      <div class="header">Konto</div>
			      <div class="item">Ändra profil</div>
			      <div class="item">Logga ut</div>
			    </div>
			 </div>
			 
			 	<div class="ui top right pointing dropdown" style="float: right; margin-right: 2%; color: #333;">
			    <div class="text" style="padding: 26px; font-size: 16px; padding-left: 20px; padding-right: 10px;"><i class="alarm icon"></i></div>
			    <div class="menu">
			      <table class="ui table" style="border: none; box-shadow: none;">
			      	<thead><th colspan="3">12 nya händelser</th></thead>
			      	<td><i  class="archive icon"></i></td><td>Ny beställning</td><td><div class="ui label">3 minuter sedan</div></td>
			      </table>
			    </div>
			 </div>

	    </div>
			 
		<div id="padding-right">

		<div class="ui tab" data-tab="dashboard">
	   
	      <h2>Dashboard</h2>
				<div class="ui doubling four column grid">
					    <div class="column">
						    <div class="views">
								 <div class="icon-order"><i class="ion-eye"></i></div>
								 <div class="detail"><h3>214</h3>Visningar</div>
							</div>
					    </div>
					    <div class="column">
						    <div class="orders">
								 <div class="icon-order"><i class="archive icon"></i></div>
								 <div class="detail"><h3>214</h3>Beställningar</div>
							</div>
					    </div>
					    <div class="column">
						    <div class="new_orders">
								 <div class="icon-order"><i class="archive icon"></i></div>
								 <div class="detail"><h3>2144</h3>Nya beställningar</div>
							</div>
					    </div>
					     <div class="column">
						    <div class="total">
								 <div class="icon-order"><i class="ion-stats-bars"></i></div>
								 <div class="detail"><h3>21114</h3>Total vinst i SEK</div>
							</div>
					    </div>
				</div>
				
				<div class="ui doubling two column grid">
				
		
			
					<div class="column">
					
					<div class="ui segment" style="box-shadow: none;">
					
						<h3>Översikt</h3>
						<div class="ui divider"></div>
						
						<script>
						$(function() {
						$('.overview.menu .item').tab();
						});
						</script>
						
						<div class="ui overview secondary pointing menu" style="border-width: 1px;">
						  <a class="green item" data-tab="most-sold">
						   Mest sålda
						  </a>
						  <a class="green item" data-tab="most-views">
						     Mest visningar
						  </a>
						  <a class="item active green" data-tab="latest">
						    Senaste
						  </a>
						</div>
						
						<div class="ui tab" data-tab="most-sold">
						Hej
						</div>

						<div class="ui tab" data-tab="most-views">
						Hej
						</div>
						
						<div class="ui tab active" data-tab="latest">
						
						<table class="ui table" style="border-radius: 0px;">
						
						<tr>
						<thead><th>Status</th><th>Order.nr</th><th>Datum</th><th>Pris</th></thead>
						
						
							<?php if(!empty($orders)) { ?>
							<?php foreach($orders as $ord) {?>
						
						<td>
							<script>
							$(function() {
							
								$('#selecter<?php echo $ord['order_id']; ?>').change(function(){
									var option = $(this).find('option:selected').val();
								    alert(option);
								});
								
							});
							</script>
							<select name="status" class="ui compact dropdown" id="selecter<?php echo $ord['order_id']; ?>">
							  <option value="4">Behandlas</option>
							  <option value="3">Skickat</option>
							  <option value="2">Bearbetas</option>
							  <option value="1">Ej godkänd</option>
							</select>
						</td>
						
						<td><?php echo $ord['order_id']; ?></td><td><?php echo $ord['date']; ?></td><td>435 SEK</td></tr>
						<?php }} ?>
						
						
						
						</table>
						
					</div>
					
					
					
					
					</div>
					
					</div>
					
						<div class="column">
					
						<div class="ui segment" style="box-shadow: none;">

		
							<div style="float: left;">
							<h3>Statistik</h3>
							</div>
							
								<form class="ui form" style="float: right;">
						        <div class="input-prepend">
						          <div class="ui icon input">
							       	   <i class="calendar icon"></i>
										<input type="text" name="range" id="range">
							      </div>
						        </div>
							</form>
			
							<div style="clear: both;"></div>
							
								
								<div id="placeholder">

								<div id="chart" style="height: 300px; width: 100%; margin: 0; padding: 0;"></div>
								</div>
							</div>

					</div>

					
					<div class="column">
					<h3>Senaste händelserna</h3>
					</div>

					<div class="column">
					<h3>Anteckningsblock</h3>
						<div class="ui segment" style="box-shadow: none;">
							<div class="ui form">
								<div class="field">
								<textarea></textarea>
								</div>
								<div class="field">
								<input type="submit" class="ui button green" />
								</div>
							</div>
						</div>
					</div>
					
				</div>			
		</div>
	      
      	<div class="ui tab" data-tab="orders"> <!--  beställningar -->
	      
		<h2>Beställningar</h2>
		<div class="ui segment" style="box-shadow: none;">
			<div class="ui breadcrumb">
			  <a href="#" class="section">Hem</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">Beställningar</a>
			</div>
		</div>

		<div class="ui segment" style="box-shadow: none;">
				
		<h3>Lista på beställningar</h3>
		<div class="ui divider"></div>
		
	  <table id="orders-table" class="ui table stripe"  style="border-radius: 0px;" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Order #</th>
            <th>Produkt</th>
            <th>Datum</th>
            <th>E-post</th>
            <th>IMEI</th>
            <th>Betalningsmetod</th>
            <th>Pris</th>
            <th>Status</th>
        </tr>
    </thead>
 
    <tbody>        
        <?php if(!empty($orders)) { ?>
		<?php foreach($orders as $ord) {?>
		<tr>
						
						<td><?php echo $ord['order_id']; ?></td><td>Produkt</td><td><?php echo $ord['date']; ?></td><td><?php echo $ord['email']; ?></td><td><?php echo $ord['imei_number']; ?></td><td><?php echo $ord['method']; ?></td><td><?php echo $ord['price']; ?> <?php echo $ord['currency']; ?></td>
						
						<td>
							<script>
							$(function() {
								$('#select<?php echo $ord['order_id']; ?>').change(function(){
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $ord['order_id']; ?>";
									var dataString = 'id='+ id + '&option='+ option;
									
								    $.ajax({
										type: "POST",
										url: "update_status.php",
										data: dataString,
										cache: false,
										success: function(html){

										}
									});


								});
								
							});
							</script>
							<select name="status" class="ui compact dropdown" id="select<?php echo $ord['order_id']; ?>">
							  <option value="1" <?php if($ord['status'] == '1') echo "selected" ?>>Behandlas</option>
							  <option value="2" <?php if($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
							  <option value="3" <?php if($ord['status'] == '3') echo "selected" ?>>Nekades</option>

							  <option value="4" <?php if($ord['status'] == '4') echo "selected" ?>>Klar</option>
							</select>
						</td></tr>


	
	
	
	<?php }} ?>


    </tbody>
</table>

		</div>
					
					
					<div class="ui segment" style="box-shadow: none;">
					<h3>Lägg till</h3>
					<div class="ui divider"></div>
						<form action="#" method="post">
							<div class="ui form">
								
								<div class="field">
									<label>E-post</label>
									<input type="text">
								</div>
								
								<div class="field">
									<label>IMEI</label>
									<input type="text">
								</div>
								
								<div class="field">
									<label>Status</label>
										<select class="ui dropdown">
										<option>Behandlas</option>
										<option>Påbörjad</option>
										<option>Kebab</option>
									</select>
								</div>
								
								<div class="field">
									<label>Produkt</label>
									<select class="ui dropdown">
										<option>Telia iPhone 4S</option>
									</select>
								</div>
								
								<input type="submit" value="Lägg till" class="ui button">
															
							</div>
						</form>
					
					</div>	
	      </div> <!-- Avslut beställningar -->
	    
	    <div class="ui tab" data-tab="customers"> <!-- Kunder -->
	      Hejsan
	    </div> <!-- Avslut kunder -->
	    
	    <div class="ui tab" data-tab="products"> <!-- produkter -->
	      
	      <h2>Produkter</h2>
		<div class="ui segment" style="box-shadow: none;">
			<div class="ui breadcrumb">
			  <a href="#" class="section">Hem</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">Produkter</a>
			</div>
		</div>

		<div class="ui segment" style="box-shadow: none;">
				
		<h3>Lista på produkter</h3>
		<div class="ui divider"></div>

		
	  <table id="products-table" class="ui table stripe"  style="border-radius: 0px;" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produktnamn</th>
            <th>Pris</th>
            <th>Datum</th>
            <th>Status</th>
            <th>Åtgärder</th>
        </tr>
    </thead>
 
    <tbody>        
        <?php if(!empty($products)) { ?>
		<?php foreach($products as $pro) {?>
		<tr>
						
						<td><?php echo $pro['product_id']; ?></td><td>Produkt</td><td><?php echo $pro['price']; ?> <?php echo $pro['currency']; ?></td><td><?php echo $pro['date']; ?></td>
						
						<td>
							<script>
							$(function() {
								$('#product<?php echo $pro['product_id']; ?>').change(function(){
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $pro['product_id']; ?>";
									var dataString = 'id='+ id + '&option='+ option;
									
								    $.ajax({
										type: "POST",
										url: "update_status_product.php",
										data: dataString,
										cache: false,
										success: function(html){

										}
									});


								});
								
							});
							</script>
							<select name="status" class="ui compact dropdown" id="product<?php echo $pro['product_id']; ?>">
							  <option value="1" <?php if($pro['published'] == '1') echo "selected" ?>>Publicerad</option>
							  <option value="2" <?php if($pro['published'] == '0') echo "selected" ?>>Inte publicerad</option>
				     </select>
						</td>
						
						<td><div class="ui label green"><i class="edit icon"></i> Ändra</div> <div class="ui label"><i class="trash icon"></i> Radera</div></td>
						</tr>


	
	
	
	<?php }} ?>


    </tbody>
</table>

		</div>
					
					
					<div class="ui segment" style="box-shadow: none;">
			
			       <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
			       <script src="http://malsup.github.io/min/jquery.form.min.js"></script>
				   <script src="jquery.mockjax.js"></script>
				   <script src="additional-methods.js"></script>


						
					<script>
							jQuery(document).ready(function($) {
								$.validator.setDefaults({
									errorClass: 'errorField',
									errorElement: 'div',
									errorPlacement: function(error, element) {
										error.addClass("ui red pointing above ui label error").appendTo( element.closest('div.field') );
									}, 
									highlight: function(element, errorClass, validClass) {
										$(element).closest("div.field").addClass("error").removeClass("success");
									},
									unhighlight: function(element, errorClass, validClass){
										$(element).closest(".error").removeClass("error").addClass("success");
									}
									
								});		
									
								   $('#validateMe').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-product").fadeIn(300).html("Produkten lades till!");
									            }
									        });
									　}
									});

							});
					</script>
						
					<h3>Lägg till</h3>
					

					<div class="ui divider"></div>
					
						<form class="ui form" id="validateMe" enctype="multipart/form-data" action="add_product.php" method="post">
							
								<div id="result" class="ui error message"></div>
								<div id="success-product" class="ui success message"></div>

								<div class="field required">
									 <label>Produktbild</label>
									 <label for="file" class="ui button" style="margin-bottom: -20px;">Ladda upp</label>
								    <input type="file" title="Du måste ladda upp en bild" class="required" style="visibility: hidden;" accept="image/*" id="file" name="file"><br />
								</div>
								
								<div class="field">
									<label>Operatör</label>
									<input id="carrier" name="carrier" type="text">

								</div>
								<div class="field required">
									<label>Mobil</label>
									<input id="mobile" title="Fyll i en mobil" name="mobile" type="text" required>

								</div>
								
								<div class="field required">
									<label>Modell (Om flera - markera ut andra genom ett kommatecken)</label>
									<input id="model" title="Fyll i en modell" name="model" type="text" required>

								</div>
								
								<div class="field required">
									<label>Status</label>
									<select name="published" class="ui dropdown">
										<option value="1">Publicerad</option>
										<option value="0">Inte publicerad</option>
									</select>
								</div>
								
								
								<div class="field required">
									<label>Pris</label>
									<input id="price" title="Skriv in ett pris i siffror" name="price" type="text" required>
									<div class="error"></div>
								</div>
								

								<input type="submit" value="Lägg till" class="ui button">
															
						</form>
					
					</div>	

	      
	      
	    </div><!-- Avslut produkter -->
	    
	    
	    <div class="ui active tab" data-tab="admins"> <!-- admins -->
	      Hejsan
	    </div> <!-- Avslut admins -->
	   
	    <div class="ui tab" data-tab="settings"> <!-- Inställningar -->
	    
	    <h2>Inställningar</h2>
	    
	     <div class="ui doubling two column grid">
			
				<div class="column">
						    
					<div class="ui segment" style="box-shadow: none;">
			     
							<h3>Maintenance</h3>
							<div class="ui divider"></div>
							<div class="ui form">
							
							<div class="field">
								<label>Meddelande</label>
								<textarea></textarea>
							</div>
							
							<div class="field">
								<input type="submit" class="ui button" />
							</div>
							
							</div>
							
					</div>
				
				</div>
				
				<div class="column">
					
					<div class="ui segment" style="box-shadow: none;">


					</div>
									
				</div>
			
	     </div>
	     
	    </div> <!-- Avslut inställningar -->

        <?php if(!empty($products)) { ?>
		<?php foreach($products as $ord) {?>
		
	    <div class="ui tab" data-tab="products/<?php echo $_GET['id']; ?>">
	      <?php echo $_GET['id']; ?>sd
	    </div>
	    
	    <?php }} ?>
	    
		</div>
			
			    
    </div>
    
</div>    
    
     
		<!-- xcharts includes -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/d3/2.10.0/d3.v2.js"></script>
		<script src="http://valfrimobil.se/new/admin/charts/assets/js/xcharts.min.js"></script>

		<!-- The daterange picker bootstrap plugin -->
		<script src="http://valfrimobil.se/new/admin/charts/assets/js/sugar.min.js"></script>
		<script src="http://valfrimobil.se/new/admin/charts/assets/js/daterangepicker.js"></script>

		<!-- Our main script file -->
		<script src="http://valfrimobil.se/new/admin/charts/assets/js/script.js"></script>

  
  
</body>
</html>