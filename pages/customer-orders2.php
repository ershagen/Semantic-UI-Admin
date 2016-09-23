<?php
session_start();

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');

	
	
	$order_cust_sql = "SELECT * FROM `v_customers_orders` ORDER by order_id ASC";
	$order_state_cust = $objDb->query($order_cust_sql);
	$orders_cust = $order_state_cust->fetchAll(PDO::FETCH_ASSOC);
	

	$customers_sql = "SELECT * FROM `v_customers` ORDER by customer_id DESC";
	$customers_state = $objDb->query($customers_sql);
	$cust = $customers_state->fetchAll(PDO::FETCH_ASSOC);	
	
	
	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}


?>
	
	<h2>Beställningar</h2>
		<div class="ui segment" style="box-shadow: none;">
			<div class="ui breadcrumb">
			  <a href="#" class="section">Hem</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">Beställningar</a>
			  	  <i class="right chevron icon divider"></i>
			  <a class="active section">Återförsäljare</a>
			</div>
		</div>

		<div class="ui segment" style="box-shadow: none;">
				
<h3 style="float:left;">Lista på beställningar</h3>
		
				<script>
						$(function() {
						$('.ordersss.menu .item').tab();
						});
						</script>
		
    <div  class="ui ordersss secondary pointing menu" style=" margin: 0; border-width: 0px; float: right;">
      <a class="item active" data-tab="latests-cust-order">Alla</a>
      <a class="item grey" data-tab="processings-cust-order">Mottagen</a>
      <a class="item yellow" data-tab="processeds-cust-order">Bearbetas</a>
      <a class="item red" data-tab="denieds-cust-order">Nekades</a>
      <a class="item green" data-tab="finishs-cust-order">Klar</a>
      <a class="item green" data-tab="finpaids-cust-order">Klar/betald</a>
    </div>
    
    
        <div style="clear: both; margin-bottom: -13px;"></div>

		<div class="ui divider"></div>
		
		
			<div class="ui tab active" data-tab="latests-cust-order"> <!-- senaste -->


			<table id="latests-cust-orders" class="display" cellspacing="0" style="width:100%;" width="100%">
					<thead>
						<tr>
							<th><input type="checkbox" id="bulkDeletes_1"  /></td>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Datum</th>
							<th>Företag</th>
							<th>IMEI</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Åtgärder</th>
						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTrigers_1">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- avslut -->
		    
		    
		    <div class="ui tab" data-tab="processings-cust-order"> <!-- senaste -->


			<table id="processings-orders-tables" class="display" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDeletes_processings"  /></th>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Datum</th>
							<th>Företag</th>
							<th>IMEI</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Åtgärder</th>
						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTrigers_processings">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- avslut -->
		    
		    
		    <div class="ui tab" data-tab="processeds-cust-order"> <!-- senaste -->


			<table id="processeds-orders-tables" class="display" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDeletes_processeds"  /></th>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Datum</th>
							<th>Företag</th>
							<th>IMEI</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Åtgärder</th>
						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTrigers_processeds">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- avslut -->
		    
		    
		      <div class="ui tab" data-tab="denieds-cust-order"> <!-- senaste -->


			<table id="denieds-orders-tables" class="display" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDeletes_deniedss"  /></th>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Datum</th>
							<th>Företag</th>
							<th>IMEI</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Åtgärder</th>
						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTrigers_deniedss">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- avslut -->
		    
		    
		          <div class="ui tab" data-tab="finishs-cust-order"> <!-- senaste -->


			<table id="finishs-orders-tables" class="display" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDeletes_finishss"  /></th>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Datum</th>
							<th>Företag</th>
							<th>IMEI</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Åtgärder</th>
						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTrigers_finishss">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- avslut -->
		    
		    
		     <div class="ui tab" data-tab="finpaids-cust-order"> <!-- senaste -->


			<table id="finpaids-orders-tables" class="display" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDeletes_finpaidss"  /></th>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Datum</th>
							<th>Företag</th>
							<th>IMEI</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Åtgärder</th>
						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTrigers_finpaidss">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- avslut -->
		    
		    
		
		</div>					
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
									
								   $('#orders-form').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-order").fadeIn(300).html(resp);
									            }
									        });
									　}
									});

							});
					</script>
					
					
					<div class="ui segment" style="box-shadow: none;">
					<h3>Lägg till</h3>
					
					<div class="ui divider"></div>
						
						<form class="ui form" id="orders-form" action="add_order.php" method="post">
							
								<div id="result" class="ui error message"></div>
								<div id="success-order" class="ui success message"></div>
								
								<div class="field required">
									<label>E-post</label>
									<input data-rule-email="true" placeholder="Ex. mail@live.com" id="email" name="email" type="text" data-msg-email="Ange en giltig e-post" title="Fyll i en e-post" required>
								</div>
																	
								<div class="field required">
									<label>IMEI</label>
									<input type="text" id="imei" name="imei" placeholder="" minlength="15" maxlength="15" title="Fyll i ett IMEI nummer" data-msg-minlength="Ett IMEI nummer innehåller 15 tecken!" required>
								</div>
								
						<div class="field">
						
							<label>Status</label>
							<select class="ui dropdown" name="status">
									<option value="1">Behandlas</option>
									<option value="2">Bearbetas</option>
									<option value="3">Nekades</option>
									<option value="4">Klar</option>
									<option value="5">Klar/Betald</option>
							</select>
						
						</div>
								
	
						<div class="field">
						<label>Operatör</label>
							<select name="manufacturer" class="ui dropdown" id="manufacturer" onChange="resetValues();doAjax('http://valfrimobil.se/cascad/type_list.php', 'man='+getValue('manufacturer'), 'populateType', 'post', '1')">
							<option value="">Välj operatör</option></select>
						</div>
						<div class="field">
						<label>Mobil</label>
							<select class="ui dropdown" name="printertype" id="printertype" disabled="disabled" onChange="doAjax('http://valfrimobil.se/cascad/model_list.php', 'man='+getValue('manufacturer')+'&typ='+getValue('printertype'), 'populateModel', 'post', '1')">
							<option value="">Välj mobil</option></select>
						</div>
						<div class="field">
						<label>Modell</label>
							<select class="ui dropdown" name="printermodel" id="printermodel" disabled="disabled" onChange="showOutput();">
								<option value="">Välj modell</option></select>
						</div>
						
						<input type="hidden" id="model-order" name="product">
			
						
						<div id="loading" style="display: none;"></div>
						<div id="output"></div>

						<div class="field">
							<label>Telefonnummer</label>
							<input type="text" id="phone" name="phone" placeholder="">
						</div>
														
						<div class="field required">
							<label>Pris</label>
							<input type="text" id="price" name="price" placeholder="">
						</div>
								
						    <input type="submit" value="Lägg till" class="ui button">
						
						</form>
					
					</div>	
					
					
						<script>
							$(function() {
																 
								 $('#latests-cust-orders').on('change', '.selectshits', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								 var customer_id = I.substr(I.indexOf("-") + 1);
								 var newId = I.substr(0, I.indexOf('-'));
								 
									var options = $(this).find('option:selected').val();
									var ids = I;			
						
									var selecto = 'ids='+ newId + '&option='+ options + '&customer_id=' + customer_id;									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
								
								 $('#processings-orders-tables').on('change', '.selectshits', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								 var customer_id = I.substr(I.indexOf("-") + 1);
								 var newId = I.substr(0, I.indexOf('-'));
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'ids='+ newId + '&option='+ options + '&customer_id=' + customer_id;									
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
								
								 $('#processeds-orders-tables').on('change', '.selectshits', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								 var customer_id = I.substr(I.indexOf("-") + 1);
								 var newId = I.substr(0, I.indexOf('-'));
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'ids='+ newId + '&option='+ options + '&customer_id=' + customer_id;									
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
								 $('#denieds-orders-tables').on('change', '.selectshits', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								 var customer_id = I.substr(I.indexOf("-") + 1);
								 var newId = I.substr(0, I.indexOf('-'));
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'ids='+ newId + '&option='+ options + '&customer_id=' + customer_id;									
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});


								$('#finishs-orders-tables').on('change', '.selectshits', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								 var customer_id = I.substr(I.indexOf("-") + 1);
								 var newId = I.substr(0, I.indexOf('-'));
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'ids='+ newId + '&option='+ options + '&customer_id=' + customer_id;									
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});

								$('#finpaids-orders-tables').on('change', '.selectshits', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								 var customer_id = I.substr(I.indexOf("-") + 1);
								 var newId = I.substr(0, I.indexOf('-'));
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'ids='+ newId + '&option='+ options + '&customer_id=' + customer_id;									
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});


								
							});
							</script>
							
							<script>
							$(function() {
									var timeoutId;
								    $('#latests-cust-orders').on('input propertychange change', '.code-form-latests', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var Ids = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latests');
									     var status = Ids.substr(Ids.indexOf("-") + 1);
										var order_ids = Ids.substr(0, Ids.indexOf('-'));
									    var code_codes = $('.code_codes' + order_ids + '-' + status).val();									    
									    
									    var dataStrings = 'order_id='+ order_ids + '&code_code='+ code_codes;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder' + order_ids + status).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder' + order_ids + status).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
									
									
									
									
										var timeoutId;
								    $('#processings-orders-tables').on('input propertychange change', '.code-form-latests', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									 

									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latests');
									    var status = I.substr(I.indexOf("-") + 1);
										var order_id = I.substr(0, I.indexOf('-'));
									    var code_code = $('.code_codes' + order_id + '-' + status).val();									    
								 
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder' + order_id + status).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder' + order_id + status).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
									
									
									
										var timeoutId;
								    $('#processeds-orders-tables').on('input propertychange change', '.code-form-latests', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latests');
									    
									    var status = I.substr(I.indexOf("-") + 1);
										var order_id = I.substr(0, I.indexOf('-'));
									    var code_code = $('.code_codes' + order_id + '-' + status).val();									    
									    
									    
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder' + order_id + '-' + status).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder' + order_id + '-' + status).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
									
									

							
									
									
										var timeoutId;
								    $('#denieds-orders-tables').on('input propertychange change', '.code-form-latests', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latests');
									     var status = I.substr(I.indexOf("-") + 1);
										var order_id = I.substr(0, I.indexOf('-'));
									    var code_code = $('.code_codes' + order_id + '-' + status).val();									    
									    
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder' + order_id + '-' + status).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder' + order_id + '-' + status).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
									


										var timeoutId;
								    $('#finishs-orders-tables').on('input propertychange change', '.code-form-latests', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latests');
									     var status = I.substr(I.indexOf("-") + 1);
										var order_id = I.substr(0, I.indexOf('-'));
									    var code_code = $('.code_codes' + order_id + '-' + status).val();									    
									    
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder' + order_id + '-' + status).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder' + order_id + '-' + status).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
									



										var timeoutId;
								    $('#finpaids-orders-tables').on('input propertychange change', '.code-form-latests', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latests');
									      var status = I.substr(I.indexOf("-") + 1);
										var order_id = I.substr(0, I.indexOf('-'));
									    var code_code = $('.code_codes' + order_id + '-' + status).val();									    
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder' + order_id + '-' + status).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder' + order_id + '-' + status).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
									
									
									

									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.code-form-latest').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									});
									</script>
									
									


							
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTables = $('#latests-cust-orders').DataTable( {
					"processing": true,
					"serverSide": true,
					 "pagingType": "full_numbers",
				"order": [[ 1, "desc" ]],
			        "language": {
			            "lengthMenu": "Visa _MENU_ st per sida",
			            "sProcessing": "Laddar..",
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
			        },
   
		    
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
					"ajax":{
						url :"http://valfrimobil.se/admin/reseller-customers-orders/employee-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#latests-orders-table").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_latest").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDeletes_1").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRows_1").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTrigers_1').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRows_1:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRows_1').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/reseller-customers-orders/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTables.draw('page'); // redrawing datatable
							},
							async:false
						});
					}
				});	
				
				
				
					
				var dataTabless = $('#processings-orders-tables').DataTable( {
					"processing": true,
					"serverSide": true,
					 "pagingType": "full_numbers",
				"order": [[ 1, "desc" ]],
			        "language": {
			            "lengthMenu": "Visa _MENU_ st per sida",
			            "sProcessing": "Laddar..",
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
			        },
   
		    
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
					"ajax":{
						url :"http://valfrimobil.se/admin/reseller-customers-orders/employee-grid-data.php?status=1", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#processings-orders-tables").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDeletes_processings").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRows_1").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTrigers_processings').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRows_1:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRows_1').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/reseller-customers-orders/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTabless.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});
				
				//nytt
				
				
				var dataTablesss = $('#denieds-orders-tables').DataTable( {
					"processing": true,
					"serverSide": true,
					 "pagingType": "full_numbers",
				"order": [[ 1, "desc" ]],
			        "language": {
			            "lengthMenu": "Visa _MENU_ st per sida",
			            "sProcessing": "Laddar..",
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
			        },
   
		    
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
					"ajax":{
						url :"http://valfrimobil.se/admin/reseller-customers-orders/employee-grid-data.php?status=3", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#processings-orders-tables").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDeletes_deniedss").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRows_1").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTrigers_deniedss').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRows_1:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRows_1').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/reseller-customers-orders/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTablesss.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	

// nytt


var dataTableser = $('#finishs-orders-tables').DataTable( {
					"processing": true,
					"serverSide": true,
					 "pagingType": "full_numbers",
				"order": [[ 1, "desc" ]],
			        "language": {
			            "lengthMenu": "Visa _MENU_ st per sida",
			            "sProcessing": "Laddar..",
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
			        },
   
		    
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
					"ajax":{
						url :"http://valfrimobil.se/admin/reseller-customers-orders/employee-grid-data.php?status=4", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#processings-orders-tables").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDeletes_finishss").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRows_1").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTrigers_finishss').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRows_1:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRows_1').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/reseller-customers-orders/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTableser.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	

		// nytt
		
		
		var dataTableer = $('#finpaids-orders-tables').DataTable( {
					"processing": true,
					"serverSide": true,
					 "pagingType": "full_numbers",
				"order": [[ 1, "desc" ]],
			        "language": {
			            "lengthMenu": "Visa _MENU_ st per sida",
			            "sProcessing": "Laddar..",
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
			        },
   
		    
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
					"ajax":{
						url :"http://valfrimobil.se/admin/reseller-customers-orders/employee-grid-data.php?status=5", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#processings-orders-tables").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDeletes_finpaidss").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRows_1").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTrigers_finpaidss').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRows_1:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRows_1').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/reseller-customers-orders/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTableer.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	


// nytt


var dataTableser = $('#processeds-orders-tables').DataTable( {
					"processing": true,
					"serverSide": true,
					 "pagingType": "full_numbers",
				"order": [[ 1, "desc" ]],
			        "language": {
			            "lengthMenu": "Visa _MENU_ st per sida",
			            "sProcessing": "Laddar..",
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
			        },
   
		    
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
					"ajax":{
						url :"http://valfrimobil.se/admin/reseller-customers-orders/employee-grid-data.php?status=2", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#processings-orders-tables").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDeletes_processedss").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRow_processing").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTrigers_processedss').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRows_1:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRows_1').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/reseller-customers-orders/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTableser.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	




				
				
			} );
		</script>
		
		
					
					<script>
		 $(document).ready(function() {
		    $('.orders-tables').dataTable({
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