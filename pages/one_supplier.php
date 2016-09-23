<?php
session_start();
require_once '../../suppliers-login/dbconfig.php';

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}



$id = substr($_GET['id'], strrpos($_GET['id'], '/') + 1);

$supplier = $user->getOneSupplier($id);

$company_name = $supplier[0]->company_name;
$supplier_id = $supplier[0]->supplier_id;
$name = $supplier[0]->name;
$email = $supplier[0]->email;
?>

	      
	       <h2>Leverantörer</h2>
	      
			<div class="ui segment" style="box-shadow: none;">
				<div class="ui breadcrumb">
				  <a href="#" class="section tab-item">Hem</a>
				  <i class="right chevron icon divider"></i>
				  <a data-tab="suppliers" class="section tab-itemer">Leverantörer</a>
				  <i class="right chevron icon divider"></i>
				  <a class="active section"><?php echo $company_name; ?></a>
				</div>
			</div>
	    
	    
		    
	    
	    
	    <div class="ui segment" style="box-shadow: none;"> <!-- Ändra kunder, produkter -->
				
		<h3>Lista på produkter</h3>
		<div class="ui divider"></div>

	


	  <table class="ui table stripe suppliertable" style="border-radius: 0px;" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produktnamn</th>
            <th>Modeller</th>
            <th>Pris</th>
            <th>Datum</th>
            <th>Status</th>
            <th>Åtgärder</th>
        </tr>
    </thead>
 
    <tbody>        
        <?php
        	$products_sql = "SELECT * FROM `v_products_2` WHERE supplier_id = '{$supplier_id}' ORDER by product_id DESC";
			$products_state = $objDb->query($products_sql);
			$products_cust = $products_state->fetchAll(PDO::FETCH_ASSOC);
	
			if(!empty($products_cust)) {
		?>
		
		<?php foreach($products_cust as $pro) {?>
		<tr class="record">
						
						<td><?php echo $pro['product_id']; ?></td><td><?php echo $pro['carrier']; ?> <?php echo $pro['mobile']; ?></td><td><?php echo $pro['model']; ?></td><td><?php echo $pro['price']; ?> <?php echo $pro['currency']; ?></td><td><?php echo $pro['date']; ?></td>
						
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
							  <option value="0" <?php if($pro['published'] == '0') echo "selected" ?>>Inte publicerad</option>
				     </select>
						</td>
						
						<td>
						
						<a class="tab-itemers ui button compact icon green" data-tab="products/<?php echo $pro['product_id']; ?>">
						<i class="edit icon"></i>
						</a>
						
						<a href="javascript:void();" class="delbuttoner<?php echo $pro['product_id']; ?> ui button compact icon">
						<i class="trash icon"></i>
						</a>
						
							  <script type="text/javascript">
								$(function() {
								
									$(".delbuttoner<?php echo $pro['product_id']; ?>").click(function(){
									var del_id = "<?php echo $pro['product_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här produkten från leverantören?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_product_from_supplier.php",
												data: info,
												success: function(){
												}
											});
											
											$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
.animate({ opacity: "hide" }, "slow");
										}
									return false;
									});
									
								});
								</script>


						</td>
						</tr>


	
	
	
	<?php }} ?>


    </tbody>
</table>


		</div>

	    

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
									
								   $('#ansokts').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-producter").fadeIn(300).html(resp);
									            }
									        });
									　}
									});

							});
					</script>
						
					<h3>Ändra</h3>
					
					<div class="ui divider"></div>
					
					<div id="result" style="display: none;" class="ui error message"></div>
					<div id="success-producter" style="display: none;" class="ui success message"></div>
								
								
								
	
					<form action="http://valfrimobil.se/edit_customer.php" method="post" id="ansokts" class="ui form">
							
<input id="supplier_id" name="supplier_id" type="hidden" value="<?php echo $supplier_id; ?>">

								<div class="field required">
									<label>Kontaktperson</label>
									<input placeholder="" title="Fyll i en kontaktperson" id="name" name="name" type="text" value="<?php echo $name; ?>" required>

								</div>
								<div class="field required">
									<label>Företagsnamn</label>
									<input placeholder="" title="Fyll i ett företagsnamn" id="company" name="company" type="text" value="<?php echo $company_name; ?>" required>

								</div>
							
								
								<div class="field required">
									<label>E-post</label>
									<input placeholder="" value="<?php echo $email; ?>" id="email" title="Fyll i en e-postadress" name="email" type="text" required>

								</div>
															
												
						
						<div class="field">
						<input type="submit" value="Ändra" class="ui button">
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
		    $('.suppliertable').dataTable({
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
		
    
