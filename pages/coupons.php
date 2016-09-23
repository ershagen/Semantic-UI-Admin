<?php
session_start();

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
	
	$sql_list = "SELECT * FROM `v_products_2` ORDER BY product_id DESC";
	$statement_list = $objDb->query($sql_list);
	$list_list = $statement_list->fetchAll(PDO::FETCH_ASSOC);
	
	
	$coupons_sql = "SELECT * FROM `v_coupons` ORDER by c_id DESC";
	$coupons_state = $objDb->query($coupons_sql);
	$coupons = $coupons_state->fetchAll(PDO::FETCH_ASSOC);

	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}


?> 

    <h2>Rabattkoder</h2>
		<div class="ui segment" style="box-shadow: none;">
			<div class="ui breadcrumb">
			  <a href="#" class="section">Hem</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">Rabattkoder</a>
			</div>
		</div>

		<div class="ui segment" style="box-shadow: none;">
				
		<h3>Lista på rabattkoder</h3>
		<div class="ui divider"></div>
		
	  <table id="orders-table" class="ui table stripe"  style="border-radius: 0px;" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Rabattkod</th>
            <th>Status</th>
            <th>Rabatt</th>
            <th>Produkt</th>
            <th>Åtgärder</th>
        </tr>
    </thead>
 
    <tbody>        
         <?php if(!empty($coupons)) { ?>
		<?php foreach($coupons as $cou) {?>
		<tr class="records">
						
						<td><?php echo $cou['coupan_code']; ?></td><td><?php echo $cou['status']; ?></td><td><?php echo $cou['discount']; ?> SEK</td><td><?php echo $cou['product_id']; ?></td>
						
						<td>
					
						
						<a href="javascript:void();" class="delbuttonser<?php echo $cou['c_id']; ?>">
						<div class="ui label"><i class="trash icon"></i></div>
						</a>
						
							  <script type="text/javascript">
								$(function() {
								
									$(".delbuttonser<?php echo $cou['c_id']; ?>").click(function(){
									var del_id = "<?php echo $cou['c_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här rabattkoden?"))
										{
											$.ajax({
												type: "POST",
												url: "delete_coupon.php",
												data: info,
												success: function(){
												}
											});
											
											$(this).parents(".records").animate({ backgroundColor: "#fbc7c7" }, "fast")
.animate({ opacity: "hide" }, "slow");
										}
									return false;
									});
									
								});
								</script>


						</td>
<?php }} ?>

</tr>




    </tbody>
</table>

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
									
								   $('#orders-formsers').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-orderss").fadeIn(300).html(resp);
									            }
									        });
									　}
									});

							});
					</script>
					
					
					<div class="ui segment" style="box-shadow: none;">
					<h3>Lägg till</h3>
					
					<div class="ui divider"></div>
						
						<form class="ui form" id="orders-formsers" action="add_coupon.php" method="post">
							
								<div id="result" class="ui error message"></div>
								<div id="success-orderss" class="ui success message"></div>
								
								<div class="field required">
									<label>Rabattkod</label>
									<input placeholder="SUMMER" id="discountcode" name="discountcode" type="text"  title="Fyll i en rabattkod" required>
								</div>
																	
								<div class="field required">
									<label>Status</label>
									<select class="ui dropdown" name="status">
										<option value="1">Aktiv</option>
										<option value="0">Inaktiv</option>
									</select>
								</div>
								
									<div class="field required">
									<label>Rabatt (minus)</label>
									<input type="text" id="discount" name="discount" placeholder="" title="Ange ett rabatt-pris" required>
								</div>
								
									<div class="field required">
									<label>Produkt</label>
									<select class="ui dropdown selection" data-size="5" name="product">
										    <?php if(!empty($list_list)) { ?>
											<?php foreach($list_list as $prod) {?>
											<option value="<?php echo $prod['product_id']; ?>"><?php echo $prod['carrier']; ?>, <?php echo $prod['price']; ?> SEK</option>
											<?php }} ?>
									</select>
						
								</div>
					
						    <input type="submit" value="Lägg till" class="ui button">
						
						</form>
					
					</div>	


	   
	
