<?php
session_start();

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
	$order_sql = "SELECT * FROM `v_orders` ORDER by order_id ASC";
	$order_state = $objDb->query($order_sql);
	$orders = $order_state->fetchAll(PDO::FETCH_ASSOC);

	$order_sql_dash = "SELECT * FROM `v_orders` ORDER by order_id ASC LIMIT 5";
	$order_state_dash = $objDb->query($order_sql_dash);
	$orders_dash = $order_state_dash->fetchAll(PDO::FETCH_ASSOC);
	
	
	
	
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
			</div>
		</div>

		<div class="ui segment" style="box-shadow: none;">
				
		<h3 style="float:left;">Lista på beställningar</h3>
		
					<script>
						$(function() {
							$('.orders.menu .item').tab();
						});
						</script>
						
    <div class="ui orders secondary pointing menu" style="margin: 0; border-width: 0px; float: right;">
      <a class="item grey active" data-tab="latests-orders">Alla</a>
      <a class="item grey" data-tab="processings-orders">Mottagen</a>
      <a class="item yellow" data-tab="processeds-orders">Bearbetas</a>
      <a class="item red" data-tab="denieds-orders">Nekades</a>
      <a class="item green" data-tab="finishs-orders">Klar</a>
      <a class="item green" data-tab="finpaids-orders">Klar/betald</a>
    </div>
    
    
        <div style="clear: both; margin-bottom: -13px;"></div>

		<div class="ui divider"></div>
		
		
		    <div class="ui tab active" data-tab="latests-orders"> <!-- senaste -->


			<table id="latests-orders-table" class="dataTable" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  class="bulkDelete"  /></td>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Modell</th>
							<th>Datum</th>
							<th>Imei</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Trustpilot</th>
							<th>Åtgärder</th>
						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button deleteTriger">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- avslut -->
		    
		    
		    
		        <div class="ui tab" data-tab="processings-orders"> <!-- senaste -->


			<table id="processings-orders-table" class="dataTable" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  class="bulkDelete_processing"  /></td>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Modell</th>
							<th>Datum</th>
							<th>Imei</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Trustpilot</th>
							<th>Åtgärder</th>
						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTriger_processing">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- Senaste -->
		    
		    
		    <div class="ui tab" data-tab="processeds-orders"> <!-- senaste -->


			<table id="processeds-orders-table" class="dataTable" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDelete_processeds"  /></th>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Modell</th>
							<th>Datum</th>
							<th>Imei</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Trustpilot</th>
							<th>Åtgärder</th>
						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTriger_processeds">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- Senaste -->
		    
		    
		    <div class="ui tab" data-tab="denieds-orders"> <!-- senaste -->


			<table id="denieds-orders-table" class="dataTable" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDelete_denieds"  /></th>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Modell</th>
							<th>Datum</th>
							<th>Imei</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Trustpilot</th>
							<th>Åtgärder</th>

						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTriger_denieds">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- Senaste -->
		    
		    
		    		    
		    <div class="ui tab" data-tab="finishs-orders"> <!-- senaste -->


			<table id="finishs-orders-table" class="dataTable" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDelete_finishs"  /></th>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Modell</th>
							<th>Datum</th>
							<th>Imei</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Trustpilot</th>
							<th>Åtgärder</th>

						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTriger_finishs">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- Senaste -->
		    
		    
		    		    
		    <div class="ui tab" data-tab="finpaids-orders"> <!-- senaste -->


			<table id="finpaids-orders-table" class="dataTable" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDelete_finpaids"  /></th>
							<th>Order.nr</th>
							<th>Produkt</th>
							<th>Modell</th>
							<th>Datum</th>
							<th>Imei</th>
							<th>Pris</th>
							<th>Status</th>
							<th>Trustpilot</th>
							<th>Åtgärder</th>

						</tr>
					</thead>
					<tfoot>
					<td>Markerade: </td>
					<td><button class="ui button" id="deleteTriger_finpaids">Radera</button></td>
					</tfoot>
				</table>
				

		    </div> <!-- Senaste -->
		    
		    
		    

  
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
																 
								 $('#latests-orders-table').on('change', '.selectshit', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'id='+ ids + '&option='+ options;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_status.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
								var timeoutId;
								 $('#latests-orders-table').on('change', '.trustpilotsall', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								
									var options = $(".trustpilot"+I+"all").val();
									var ids = I;
									var selecto = 'id='+ ids + '&option='+ options;
									
									clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
											    
									    $.ajax({
											type: "POST",
											url: "http://valfrimobil.se/admin/update_trustpilot.php",
											data: selecto,
											cache: false,
											beforeSend: function(xhr) {
									            // Let them know we are saving
												//$('.form-status-holder'+I).html('Sparar...');
											},
											success: function(html) {
												var jqObj = jQuery(html); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            alert(html);
											},
										});
										
										}, 200);
	

								});
								
								
								 $('#processings-orders-table').on('change', '.selectshit', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'id='+ ids + '&option='+ options;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_status.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
								
								 $('#processeds-orders-table').on('change', '.selectshit', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'id='+ ids + '&option='+ options;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_status.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
								 $('#denieds-orders-table').on('change', '.selectshit', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'id='+ ids + '&option='+ options;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_status.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});


								$('#finishs-orders-table').on('change', '.selectshit', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'id='+ ids + '&option='+ options;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_status.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});

								$('#finpaids-orders-table').on('change', '.selectshit', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'id='+ ids + '&option='+ options;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_status.php",
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
								    $('#latests-orders-table').on('input propertychange change', '.code-form-latestall', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latest');
									    var code_code = $(".code_code"+I+"all").val();
									    var order_id = I;
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code2.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder'+I).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder'+I).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 300);
									});
							
									
									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.code-form-latest').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									});
									</script>
									
									
										<script>
							$(function() {
									var timeoutId;
								    $('#processings-orders-table').on('input propertychange change', '.code-form-latest', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latest');
									    var code_code = $(".code_code"+I+"1").val();
									    var order_id = I;
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code2.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder'+I).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder'+I).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 300);
									});
							
									
									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.code-form-latest').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									});
									</script>



										<script>
							$(function() {
									var timeoutId;
								    $('#processeds-orders-table').on('input propertychange change', '.code-form-latest2', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latest');
									    var code_code = $(".code_code"+I+"2").val();
									    var order_id = I;
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code2.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder'+I).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder'+I).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 300);
									});
							
									
									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.code-form-latest').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									});
									</script>


	<script>
							$(function() {
									var timeoutId;
								    $('#denieds-orders-table').on('input propertychange change', '.code-form-latest3', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latest');
									    var code_code = $(".code_code"+I+"3").val();
									    var order_id = I;
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code2.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('.form-status-holder'+I).html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('.form-status-holder'+I).html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 300);
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
	
				var dataTable = $('#latests-orders-table').DataTable( {
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
    dom: 'Bfrtip',
        buttons: [
           'csv'
        ],
		    
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
					"ajax":{
						url :"http://valfrimobil.se/admin/new-table/employee-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#latests-orders-table").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				
				$(".bulkDelete").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRow").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTriger').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRow').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/new-table/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTable.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	
				
				
				var dataTable = $('#processings-orders-table').DataTable( {
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
						url :"http://valfrimobil.se/admin/new-table/employee-grid-data.php?status=1", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#processings-orders-table").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDelete_processing").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRow_processing").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTriger_processing').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRow_processing:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRow_processing').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/new-table/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTable.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	
				
				
				var dataTable = $('#processeds-orders-table').DataTable( {
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
						url :"http://valfrimobil.se/admin/new-table/employee-grid-data.php?status=2", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#processeds-orders-table").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processeds").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDelete_processeds").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRow_processeds").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTriger_processeds').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRow_processeds:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRow_processeds').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/new-table/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTable.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	
				
				
					var dataTable = $('#denieds-orders-table').DataTable( {
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
						url :"http://valfrimobil.se/admin/new-table/employee-grid-data.php?status=3", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#denieds-orders-table").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_denieds").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDelete_denieds").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRow_processeds").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTriger_denieds').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRow_denieds:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRow_denieds').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/new-table/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTable.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	
				
				
				
				
				var dataTable = $('#finishs-orders-table').DataTable( {
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
						url :"http://valfrimobil.se/admin/new-table/employee-grid-data.php?status=4", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#finishs-orders-table").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_finishs").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDelete_finishs").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRow_finishs").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTriger_finishs').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRow_finishs:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRow_finishs').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/new-table/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTable.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	

				

				var dataTable = $('#finpaids-orders-table').DataTable( {
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
						url :"http://valfrimobil.se/admin/new-table/employee-grid-data.php?status=5", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#finpaids-orders-table").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_finpaids").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDelete_finpaids").on('click',function() { // bulk checked
					var status = this.checked;
					$(".deleteRow_finpaids").each( function() {
						$(this).prop("checked",status);
					});
				});
				
				$('#deleteTriger_finpaids').on("click", function(event){ // triggering delete one by one
					if( $('.deleteRow_finpaids:checked').length > 0 ){  // at-least one checkbox checked
						var ids = [];
						$('.deleteRow_finpaids').each(function(){
							if($(this).is(':checked')) { 
								ids.push($(this).val());
							}
						});
						var ids_string = ids.toString();  // array to string conversion 
						$.ajax({
							type: "POST",
							url: "http://valfrimobil.se/admin/new-table/employee-delete.php",
							data: {data_ids:ids_string},
							success: function(result) {
								dataTable.draw(); // redrawing datatable
							},
							async:false
						});
					}
				});	


				
				
			} );
		</script>
		

		
		
		