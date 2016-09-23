<!DOCTYPE html>
<html>
	<title>Nytt</title>
	<head>
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<meta charset="utf-8" />
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="js/dataTables.pageResize.min.js"></script>

	<script>
							$(function() {
																 
								 $('#employee-grid').on('change', '.selectshit', function() {
								 
								 var element = $(this);
								 var I = element.attr("id");
								
									var options = $(this).find('option:selected').val();
									var ids = I;
									var selecto = 'id='+ ids + '&option='+ options;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_status2s.php",
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
								    $('#employee-grid').on('input propertychange change', '.code-form-latest', function() {
									    console.log('Textarea Change');

									    var element = $(this);
										var I = element.attr("id");
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('.code-form-latest');
									    var code_code = $(".code_code"+I).val();
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
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					 "pagingType": "full_numbers",
				"order": [[ 1, "desc" ]],
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
			        },
   
		    
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
					"ajax":{
						url :"employee-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				
				$("#bulkDelete").on('click',function() { // bulk checked
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
							url: "employee-delete.php",
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
	</head>
	<body>
		<div class="header"><h1></h1></div>
		<div class="container">
			<div id="resize_wrapper">
				<table id="employee-grid"  class="display dataTable" cellspacing="0" style="width:100%;" width="100%" >
					<thead>
						<tr>
							<td><input type="checkbox"  id="bulkDelete"  /> <button id="deleteTriger">Radera</button></td>

							<td>Order.nr</td>
							<td>Produkt</td>
							<td>Datum</td>
							<td>E-post</td>
							<td>Imei</td>
							<td>Pris</td>
							<td>Status</td>
						</tr>
					</thead>
				</table>

			</div><!--#resize_wrapper-->
		</div><!--.container-->
	</body>
</html>
