<?php
session_start();
require_once '../login/dbconfig.php';

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
	$sql = "SELECT * FROM `v_products_2` WHERE product_id = '{$_GET['id']}'";
	$statement = $objDb->query($sql);
	$list = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$sql_list = "SELECT * FROM `v_products_2` ORDER BY product_id DESC";
	$statement_list = $objDb->query($sql_list);
	$list_list = $statement_list->fetchAll(PDO::FETCH_ASSOC);
	
	$product_sql = "SELECT * FROM `v_products_2` ORDER by product_id DESC";
	$product_state = $objDb->query($product_sql);
	$products = $product_state->fetchAll(PDO::FETCH_ASSOC);
	
	$product_sql_list = "SELECT * FROM `v_products_2` WHERE customer_id = '0' ORDER by product_id DESC";
	$product_state_list = $objDb->query($product_sql_list);
	$products_list = $product_state_list->fetchAll(PDO::FETCH_ASSOC);
	
	$customers_sql = "SELECT * FROM `v_customers` ORDER by customer_id DESC";
	$customers_state = $objDb->query($customers_sql);
	$cust = $customers_state->fetchAll(PDO::FETCH_ASSOC);	
	
	$supplier_sql = "SELECT * FROM `v_suppliers` ORDER by supplier_id DESC";
	$supplier_state = $objDb->query($supplier_sql);
	$supp = $supplier_state->fetchAll(PDO::FETCH_ASSOC);	
	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}


?>	


		 
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

	


	  <table class="products-tables" style="border-radius: 0px;" width="100%">
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
		$items = $user->getAllproducts("0");

				if(is_array($items)) {
					foreach($items as $item) {
					
					$product_id = $item->product_id;
					$carrier = $item->carrier;
					$address = $item->address;
					$picture = $item->phone_picture;
					$model = $item->model;
					$mobile = $item->mobile;
					$price = $item->price;
					$delivery = $item->delivery;
					$date = $item->date;
					$published = $item->published;
		?>			
		
		<tr class="record">
						
						<td><?php echo $product_id; ?></td><td><?php echo $carrier; ?> <?php echo $mobile; ?></td><td><?php echo $model; ?></td><td><?php echo $price; ?> <?php echo $currency; ?></td><td><?php echo $date; ?></td>
						
						<td>
							<script>
							$(function() {
								$('#product<?php echo $product_id; ?>').change(function(){
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $product_id; ?>";
									var dataString = 'id='+ id + '&option='+ option;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_status_product.php",
										data: dataString,
										cache: false,
										success: function(html){

										}
									});


								});
								
							});
							</script>
							<select name="status" class="ui compact dropdown" id="product<?php echo $product_id; ?>">
							  <option value="1" <?php if($published == '1') echo "selected" ?>>Publicerad</option>
							  <option value="0" <?php if($published == '0') echo "selected" ?>>Inte publicerad</option>
				     </select>
						</td>
						
						<td>
						
						<a class="tab-item" href="javascript:void();" data-tab="products/<?php echo $product_id; ?>"><div class="ui button icon green compact"><i class="edit icon"></i></div> </a>
				
						<a href="javascript:void();" class="delbuttono<?php echo $product_id; ?>">
						<div class="ui button icon compact"><i class="trash icon"></i></div>
						</a>
						
							  <script type="text/javascript">
								$(function() {
							
					$(".products-tables").on('click', '.tab-item-<?php echo $product_id; ?>', function() {
										$.tab('change tab', 'products/<?php echo $product_id; ?>');
										$.tab('set state', 'products/<?php echo $product_id; ?>');
									
									});
									
								
									
									$(".products-tables").on('click', '.delbuttono<?php echo $product_id; ?>', function() {

									var del_id = "<?php echo $product_id; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här produkten?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_product.php",
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
									
								   $('#validateMe').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-product").fadeIn(300).html(resp);
									               $("#validateMe").find("input[type=text], textarea").val("");
									            }
									        });
									　}
									});

							});
					</script>
						
					<h3>Lägg till</h3>
					
					<div class="ui divider"></div>
					
					<div id="result" style="display: none;" class="ui error message"></div>
					<div id="success-product" style="display: none;" class="ui success message"></div>
								
								
								
	
					<form class="ui form" id="validateMe" enctype="multipart/form-data" action="http://valfrimobil.se/admin/add_product.php" method="post">
					
					<div class="ui doubling two column grid">
				
					
					<div class="column">
							
							
								<div class="field">
									<label>Operatör</label>
									<input placeholder="Telia, Telenor, etc.." id="carrier" name="carrier" type="text">

								</div>
								
								<div class="field required">
									<label>Mobil</label>
									<input placeholder="iPhone, android, etc" id="mobile" title="Fyll i en mobil" name="mobile" type="text" required>

								</div>
								
								<div class="field required">
									<label>Modell (Om flera - markera ut andra genom ett kommatecken)</label>
									<input placeholder="4, 4S, etc.." id="model" title="Fyll i en modell" name="model" type="text" required>

								</div>
								
								<div class="field required">
									<label>Status</label>
									<select name="published" class="ui dropdown">
										<option value="1">Publicerad</option>
										<option value="0">Inte publicerad</option>
									</select>
								</div>
								
								<div class="field required">
										<label>Leveranstid (timmar)</label>
										<div class="two fields required">
											<div class="field">
												<input placeholder="Från" id="from-deliver" title="Fyll i detta fältet" name="from-deliver" type="text" required> 
											</div>
											<div class="field">
												<input placeholder="Till" id="to-deliver" title="Fyll i detta fältet" name="to-deliver" type="text" required>
											</div>
									</div>
								</div>
								
								<div class="field">
									<div class="two fields">
										<div class="field">
											<label>Express</label>
											<select name="express" class="ui dropdown">
												<option value="0">Nej</option>
												<option value="1">Ja</option>
											</select>
										</div>
										<div class="field">
											<label>Express Pris</label>
											<input placeholder="99" id="express_price" name="express_price" type="text">
										</div>
									</div>
								</div>
							
									<div class="field">
										<label>Kod (Om kod ska fås vid upplåsning)</label>
										<select name="code" class="ui dropdown">
											<option value="1">Ja</option>
											<option value="0">Nej</option>
										</select>
									</div>
									
									
								<div style="height: 3px;"></div>

															
				
					</div>
					
					<div class="column">
					
						<div class="field required">
							<label>Beskrivning</label>
							<textarea title="Fyll i en beskrivning" id="description" required name="description" style="height: 189px;" placeholder="Text"></textarea>
						</div>
						
									<div class="field required">
									 <label>Produktbild</label>
								    <input type="file" title="Du måste ladda upp en bild" class="required" accept="image/*" id="file" name="file"><br />
								</div>
								
								
								<div class="field required">
									<label>Pris</label>
									<input placeholder="Pris" id="price" title="Skriv in ett pris i siffror" name="price" type="text" required>
									<div class="error"></div>
								</div>
									
						
								
								<div class="field">
								
									<label>Kund (välj ingen om det ska visas för alla)</label>
									<select name="customer_id" class="ui search selection dropdown">
										<option value="0">Ingen</option>
										  <?php if(!empty($cust)) { ?>
										  <?php foreach($cust as $customer) { ?>
													
											<option value="<?php echo $customer['customer_id']; ?>"><?php echo $customer['company_name']; ?></option>
										
										<?php }} ?>
									</select>
								</div>
								
								<div class="field">
								
									<label>Leverantör (välj ingen om bara admin ska sköta)</label>
									<select name="supplier_id" class="ui search selection dropdown">
										<option value="0">Ingen</option>
										  <?php if(!empty($supp)) { ?>
										  <?php foreach($supp as $supplier) { ?>
													
											<option value="<?php echo $supplier['supplier_id']; ?>"><?php echo $supplier['company_name']; ?></option>
										
										<?php }} ?>
									</select>
								</div>
								
								
								<div class="field">
									<label>Land</label>
									<select name="language" class="ui search selection dropdown">
										<option value="0">Sverige</option>
										<option value="1">USA</option>
									</select>
								</div>
						
					</div>
				
				
			
					
					</div>
						
						<div class="field">
							<input type="submit" value="Lägg till" class="ui button green">
						</div>

						</form>

					</div>


<script>
	    $(function() {
		
				    
		    $('.tab-item').tab({
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
		    $('.products-tables').dataTable({
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
		