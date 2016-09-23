<!DOCTYPE html>
<html>
	<title>Datatable Bulk Delete Server Side | CoderExample</title>
	<head>
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
					"ajax":{
						url :"employee-grid-data2.php", // json datasource
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
		<style>
			div.container {
			    margin: 0 auto;
			    max-width:760px;
			}
			div.header {
			    margin: 100px auto;
			    line-height:30px;
			    max-width:760px;
			}
			body {
			    background: #f7f7f7;
			    color: #333;
			    font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
			}
		</style>
	</head>
	<body>
		<div class="header"><h1>DataTable Bulk Delete Server Side </h1></div>
		<div class="container">
			<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
					<thead>
						<tr>
							<th><input type="checkbox"  id="bulkDelete"  /> <button id="deleteTriger">Delete</button></th>
							<th>Employee name</th>
							<th>Salary</th>
							<th>Age</th>
						</tr>
					</thead>
			</table>
		</div>
	</body>
</html>
