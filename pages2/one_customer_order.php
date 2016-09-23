<?php
session_start();
require_once '../login/dbconfig.php';

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}



$id = substr($_GET['id'], strrpos($_GET['id'], '/') + 1);

$customer = $user->getOneCustomerOrder($id);

$imei = $customer[0]->imei_number;
$price = $customer[0]->price;
$status = $customer[0]->status;
$product_id = $customer[0]->product_id;
?>

	      
	       <h2>Beställningar</h2>
	      
			<div class="ui segment" style="box-shadow: none;">
				<div class="ui breadcrumb">
				  <a href="#" class="section tab-item">Hem</a>
				  <i class="right chevron icon divider"></i>
				  <a data-tab="customer-orders2" class="section tab-itemer">Beställningar</a>
				  <i class="right chevron icon divider"></i>
				  <a class="active section">Order.nr <?php echo $id; ?></a>
				</div>
			</div>
	    


			<script>
			$(function() {
			$('.overviews.menu .item')
			  .tab()
			;
			});
			</script>

	    	    

	    <div class="ui segment" style="box-shadow: none;">

						
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
									
								   $('#orderedit').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-orderedit").fadeIn(300).html(resp);
									            }
									        });
									　}
									});

							});
					</script>
						
					<h3>Ändra</h3>
					
					<div class="ui divider"></div>
					
					<div id="result" style="display: none;" class="ui error message"></div>
					<div id="success-orderedit" style="display: none;" class="ui success message"></div>
								
								
								
	
					<form action="http://valfrimobil.se/edit_customer_order.php" method="post" id="orderedit" class="ui form">
							
<input id="order_id" name="order_id" type="hidden" value="<?php echo $id; ?>">

								
								<div class="field required">
									<label>IMEI</label>
									<input placeholder="" title="Fyll i ett imei" id="imei" name="imei" type="text" value="<?php echo $imei; ?>" required>

								</div>
							
									<div class="field required">
									<label>Pris</label>
									<input placeholder="" value="<?php echo $price; ?>" id="price" title="Fyll i ett postnummer" name="price" type="text" required>

								</div>
								
								
								<div class="field required">
									<label>Status (Skickas inget mail)</label>
									
									<?php
										echo '<select name="status" class="select_status">

									<option value="1" '.(($status=='1')?'selected="selected"':"").'>Mottagen</option>
									<option value="2" '.(($status=='2')?'selected="selected"':"").'>Bearbetas</option>
									<option value="3" '.(($status=='3')?'selected="selected"':"").'>Nekades</option>
									<option value="4" '.(($status=='4')?'selected="selected"':"").'>Klar</option>
									<option value="5"'.(($status=='5')?'selected="selected"':"").'>Klar/Betald</option>
					
								</select>'; ?>

								</div>
											
											
								<div class="field required">
									<label>Produkt ID</label>
								
									<input placeholder="" value="<?php echo $product_id; ?>" id="product_id" title="Fyll i ett produkt id" name="product_id" type="text" required>

								</div>				
												
						
						<div class="field">
							<input type="submit" value="Ändra" class="ui button green">
						</div>

						</form>

	    </div>
					</div>
	
	
	<script>
	    $(function() {
		
				    
		    $('.tab-itemer').tab({
				  history: false,
				  cache: false,
				  apiSettings: {
				  	url: 'pages2/{$tab}.php'
				  }
				    
			  })
			  ;
			
	    });
    </script>
    
    <script>
	    $(function() {
		
				    
		    $('.tab-itemers').tab({
				  history: false,
				  cache: false,
				  apiSettings: {
				  	url: 'pages2/one_product.php?id={$tab}'
				  }
				    
			  })
			  ;
			
	    });
    </script>
    
    
   
      	<script>
		 $(document).ready(function() {
		    $('.orders-customers-table').dataTable({
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
		
    
