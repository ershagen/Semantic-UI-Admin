<?php
session_start();

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	

	$customers_sql = "SELECT * FROM `v_menu` ORDER by menu_id DESC";
	$customers_state = $objDb->query($customers_sql);
	$cust = $customers_state->fetchAll(PDO::FETCH_ASSOC);	
	
	
	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}


?>   
		

	     <h2>Meny</h2>
		<div class="ui segment" style="box-shadow: none;">
			<div class="ui breadcrumb">
			  <a href="#" class="section">Hem</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">Meny</a>
			</div>
		</div>

		<div class="ui segment" style="box-shadow: none;">
				
		<h3>Lista på menyalternativ</h3>
		<div class="ui divider"></div>

	


	  <table class="menuTable" style="border-radius: 0px;" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Namn</th>
            <th>Länk</th>
            <th>Placering</th>
            <th>Publicerad</th>
            <th>Åtgärder</th>
        </tr>
    </thead>
 
    <tbody>        
        <?php if(!empty($cust)) { ?>
		<?php foreach($cust as $custer) {?>
		<tr class="record">
						
						<td><?php echo $custer['menu_id']; ?></td><td><?php echo $custer['value']; ?></td><td><?php echo $custer['link']; ?></td>
						<td><?php echo $custer['location']; ?></td>
						<td>
							<script>
							$(function() {
								$('#menu<?php echo $custer['menu_id']; ?>').change(function(){
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $custer['menu_id']; ?>";
									var dataString = 'id='+ id + '&option='+ option;
									
								    $.ajax({
										type: "POST",
										url: "update_status_menu.php",
										data: dataString,
										cache: false,
										success: function(html){

										}
									});


								});
								
							});
							</script>
							<select name="status" class="ui compact dropdown" id="menu<?php echo $custer['menu_id']; ?>">
							  <option value="1" <?php if($custer['published'] == '1') echo "selected" ?>>Publicerad</option>
							  <option value="0" <?php if($custer['published'] == '0') echo "selected" ?>>Ej publicerad</option>
				     </select>
						</td>

						
				<td>
						
				<a class="tab-items" href="javascript:void();" data-tab="customers/<?php echo $custer['menu_id']; ?>"><div class="ui button icon green compact"><i class="edit icon"></i></div> </a>
				
				<a href="javascript:void();" class="delbutton_custs<?php echo $custer['menu_id']; ?> ui button icon compact">
					<i class="trash icon"></i>
				</a>

			    <script type="text/javascript">
								$(function() {
							
					$(".customertable").on('click', '.tab-item-show-cust<?php echo $custer['customer_id']; ?>', function() {
										$.tab('change tab', 'customers/<?php echo $custer['customer_id']; ?>');
										$.tab('set state', 'customers/<?php echo $custer['customer_id']; ?>');
									
									});
									
								
									
									$(".menuTable").on('click', '.delbutton_custs<?php echo $custer['menu_id']; ?>', function() {

									var del_id = "<?php echo $custer['menu_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort det här menyalternativet?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_menu.php",
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
									
								   $('#add_menu').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-products2").fadeIn(300).html(resp);
									            }
									        });
									　}
									});

							});
					</script>
						
					<h3>Lägg till</h3>
					
					<div class="ui divider"></div>
					
					<div id="result" style="display: none;" class="ui error message"></div>
					<div id="success-products2" style="display: none;" class="ui success message"></div>
								
								
								
	
					<form action="http://valfrimobil.se/add_menu_item.php" method="post" id="add_menu" class="ui form">
							
							
								<div class="field required">
									<label>Namn</label>
									<input placeholder="" title="Fyll i ett namn" id="value" name="value" type="text" required>

								</div>
								<div class="field required">
									<label>Länk</label>
									<input placeholder="" title="Fyll i en länk" id="link" name="link" type="text" required>

								</div>
								
								<div class="field required">
									<label>Placering</label>
									<input placeholder="" title="Fyll i en placering" id="location" name="location" type="text" required>

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
				  	url: 'pages2/one_menu.php?id={$tab}'
				  }
				    
			  })
			  ;
			
	    });
    </script>
	
	
	          	<script>
		 $(document).ready(function() {
		    $('.menuTable').dataTable({
		        "pagingType": "full_numbers",
				"order": [[ 0, "asc" ]],
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
		
