<?php
session_start();

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	

	$customers_sql = "SELECT * FROM `v_customers` ORDER by customer_id DESC";
	$customers_state = $objDb->query($customers_sql);
	$cust = $customers_state->fetchAll(PDO::FETCH_ASSOC);	
	
	
	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}


?>   
		

	     <h2>Återförsäljare</h2>
		<div class="ui segment" style="box-shadow: none;">
			<div class="ui breadcrumb">
			  <a href="#" class="section">Hem</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">Återförsäljare</a>
			</div>
		</div>

		<div class="ui segment" style="box-shadow: none;">
				
		<h3>Lista på återförsäljare</h3>
		<div class="ui divider"></div>

	


	  <table class="customertable" style="border-radius: 0px;" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Företagsnamn</th>
            <th>Org.nr</th>
            <th>Användarnamn</th>
            <th>Aktiv</th>
            <th>Standard produkter</th>
            <th>Åtgärder</th>
        </tr>
    </thead>
 
    <tbody>        
        <?php if(!empty($cust)) { ?>
		<?php foreach($cust as $custer) {?>
		<tr class="record">
						
						<td><?php echo $custer['customer_id']; ?></td><td><?php echo $custer['company_name']; ?></td><td><?php echo $custer['org_number']; ?></td>
						<td><?php echo $custer['username']; ?></td>
						<td>
							<script>
							$(function() {
								$('#customer<?php echo $custer['customer_id']; ?>').change(function(){
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $custer['customer_id']; ?>";
									var dataString = 'id='+ id + '&option='+ option;
									
								    $.ajax({
										type: "POST",
										url: "update_status_customer.php",
										data: dataString,
										cache: false,
										success: function(html){

										}
									});


								});
								
							});
							</script>
							<select name="status" class="ui compact dropdown" id="customer<?php echo $custer['customer_id']; ?>">
							  <option value="1" <?php if($custer['active'] == '1') echo "selected" ?>>Aktiverad</option>
							  <option value="0" <?php if($custer['active'] == '0') echo "selected" ?>>Inte aktiverad</option>
				     </select>
						</td>
						
						<td>
						
						<script>
							$(function() {
								$(".customertable").on('click', '#add_standard_products<?php echo $custer['customer_id']; ?>', function() {

									var option = $(this).val();
									var id = "<?php echo $custer['customer_id']; ?>";
									var dataString = 'id='+ id + '&option='+ option;
									
								    $.ajax({
										type: "POST",
										url: "add_standard_products.php",
										data: dataString,
										cache: false,
										beforeSend: function(html) {
										$("#add_standard_products<?php echo $custer['customer_id']; ?>").fadeIn(200).html("<div class='ui active inline loader' style='margin-bottom: 12px;'></div>");
									   },
										success: function(html){
											//alert(html);
											$("#add_standard_products<?php echo $custer['customer_id']; ?>").html("<div class='ui message positive'>Tillagda!</div>");
										}
									});


								});
								
							});
							</script>
							
							<a href="javascript:void();" id="add_standard_products<?php echo $custer['customer_id']; ?>">Lägg till</a>
							
						</td>
						
				<td>
						
				<a class="tab-items" href="javascript:void();" data-tab="customers/<?php echo $custer['customer_id']; ?>"><div class="ui button icon green compact"><i class="edit icon"></i></div> </a>
				
				<a href="javascript:void();" class="delbutton_cust<?php echo $custer['customer_id']; ?> ui button icon compact">
					<i class="trash icon"></i>
				</a>

			    <script type="text/javascript">
								$(function() {
							
					$(".customertable").on('click', '.tab-item-show-cust<?php echo $custer['customer_id']; ?>', function() {
										$.tab('change tab', 'customers/<?php echo $custer['customer_id']; ?>');
										$.tab('set state', 'customers/<?php echo $custer['customer_id']; ?>');
									
									});
									
								
									
									$(".customertable").on('click', '.delbutton_cust<?php echo $custer['customer_id']; ?>', function() {

									var del_id = "<?php echo $custer['customer_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här kunden?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_customer.php",
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
									
								   $('#ansok').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-products").fadeIn(300).html("Kunden lades till!");
									            }
									        });
									　}
									});

							});
					</script>
						
					<h3>Lägg till</h3>
					
					<div class="ui divider"></div>
					
					<div id="result" style="display: none;" class="ui error message"></div>
					<div id="success-products" style="display: none;" class="ui success message"></div>
								
								
								
	
					<form action="http://valfrimobil.se/add_customer.php" method="post" id="ansok" class="ui form">
							
							
								<div class="field required">
									<label>Kontaktperson</label>
									<input placeholder="" title="Fyll i en kontaktperson" id="name" name="name" type="text" required>

								</div>
								<div class="field required">
									<label>Företagsnamn</label>
									<input placeholder="" title="Fyll i ett företagsnamn" id="company" name="company" type="text" required>

								</div>
								
								<div class="field required">
									<label>Org.nr</label>
									<input placeholder="" title="Fyll i ett org.nr" id="orgnr" name="orgnr" type="text" required>

								</div>
								
								
								<div class="field required">
									<label>Adress</label>
									<input placeholder="" id="address" title="Fyll i en adress" name="model" type="text" required>

								</div>
								
									<div class="field required">
									<label>Postnummer</label>
									<input placeholder="" id="postnumber" title="Fyll i ett postnummer" name="postnumber" type="text" required>

								</div>
								
									<div class="field required">
									<label>Telefonnummmer</label>
									<input placeholder="" id="number" title="Fyll i ett telefonnummer" name="number" type="text" required>

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
							<input type="submit" value="Lägg till" class="ui button green">
						</div>

						</form>


					</div>
	      <script>
	    $(function() {
		
				    
		    $('.tab-items').tab({
				  history: false,
				  cache: false,
				  apiSettings: {
				  	url: 'pages2/one_customer.php?id={$tab}'
				  }
				    
			  })
			  ;
			
	    });
    </script>
	
	
	          	<script>
		 $(document).ready(function() {
		    $('.customertable').dataTable({
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
		
