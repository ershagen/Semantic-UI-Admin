<?php
session_start();

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	

	$supplier_sql = "SELECT * FROM `v_suppliers` ORDER by supplier_id DESC";
	$supplier_state = $objDb->query($supplier_sql);
	$custs = $supplier_state->fetchAll(PDO::FETCH_ASSOC);	
	
	
	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}


?>   
		

	     <h2>Leverantörer</h2>
		<div class="ui segment" style="box-shadow: none;">
			<div class="ui breadcrumb">
			  <a href="#" class="section">Hem</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">Leverantörer</a>
			</div>
		</div>

		<div class="ui segment" style="box-shadow: none;">
				
		<h3>Lista på leverantörer</h3>
		<div class="ui divider"></div>

	


	  <table class="supplierstable" style="border-radius: 0px;" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Företagsnamn</th>
            <th>Användarnamn</th>
            <th>Aktiv</th>
            <th>Åtgärder</th>
        </tr>
    </thead>
 
    <tbody>        
        <?php if(!empty($custs)) { ?>
		<?php foreach($custs as $custer) {?>
		<tr class="record">
						
						<td><?php echo $custer['supplier_id']; ?></td><td><?php echo $custer['company_name']; ?></td><td><?php echo $custer['username']; ?></td>
						<td>
							<script>
							$(function() {
								$('#supplier<?php echo $custer['supplier_id']; ?>').change(function(){
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $custer['supplier_id']; ?>";
									var dataString = 'id='+ id + '&option='+ option;
									
								    $.ajax({
										type: "POST",
										url: "update_status_supplier.php",
										data: dataString,
										cache: false,
										success: function(html){

										}
									});


								});
								
							});
							</script>
							<select name="status" class="ui compact dropdown" id="supplier<?php echo $custer['supplier_id']; ?>">
							  <option value="1" <?php if($custer['active'] == '1') echo "selected" ?>>Aktiverad</option>
							  <option value="0" <?php if($custer['active'] == '0') echo "selected" ?>>Inte aktiverad</option>
				     </select>
						</td>
						
				<td>
						
				<a class="tab-itemss" href="javascript:void();" data-tab="suppliers/<?php echo $custer['supplier_id']; ?>"><div class="ui button icon green compact"><i class="edit icon"></i></div> </a>
				
				<a href="javascript:void();" class="delbutton_supp<?php echo $custer['supplier_id']; ?> ui button icon compact">
					<i class="trash icon"></i>
				</a>

			    <script type="text/javascript">
								$(function() {
								
									
									$(".supplierstable").on('click', '.delbutton_supp<?php echo $custer['supplier_id']; ?>', function() {

									var del_id = "<?php echo $custer['supplier_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här leverantören?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_supplier.php",
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
									
								   $('#new_supplier').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-supplie").fadeIn(300).html("Kunden lades till!");
									            }
									        });
									　}
									});

							});
					</script>
						
					<h3>Lägg till</h3>
					
					<div class="ui divider"></div>
					
					<div id="result" style="display: none;" class="ui error message"></div>
					<div id="success-supplie" style="display: none;" class="ui success message"></div>
								
								
								
	
					<form action="http://valfrimobil.se/admin/add_supplier.php" method="post" id="new_supplier" class="ui form">
							
							
								<div class="field required">
									<label>Kontaktperson</label>
									<input placeholder="" title="Fyll i en kontaktperson" id="name" name="name" type="text" required>

								</div>
								<div class="field required">
									<label>Företagsnamn</label>
									<input placeholder="" title="Fyll i ett företagsnamn" id="company" name="company" type="text" required>

								</div>
							
								<div class="field required">
									<label>E-post</label>
									<input placeholder="" id="email" title="Fyll i en e-postadress" name="email" type="text" required>

								</div>
								
								
								<div class="field required">
									<label>Användarnamn</label>
									<input placeholder="" id="username" title="Fyll i ett telefonnummer" name="username" type="text" required>

								</div>
								
								
								<div class="field required">
									<label>Lösenord</label>
									<input placeholder="" id="password" title="Fyll i ett lösenord" name="password" type="text" required>

								</div>
								
											
				
						
						<div class="field">
							<input type="submit" value="Lägg till" class="ui button">
						</div>

						</form>


					</div>
	      <script>
	    $(function() {
		
				    
		    $('.tab-itemss').tab({
				  history: false,
				  cache: false,
				  apiSettings: {
				  	url: 'pages2/one_supplier.php?id={$tab}'
				  }
				    
			  })
			  ;
			
	    });
    </script>
	
	
	          	<script>
		 $(document).ready(function() {
		    $('.supplierstable').dataTable({
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
		
