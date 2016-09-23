<?php
session_start();
require_once '../../customers-login/dbconfig.php';

		$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	$supplier_sql = "SELECT * FROM `v_suppliers` ORDER by supplier_id DESC";
	$supplier_state = $objDb->query($supplier_sql);
	$supp = $supplier_state->fetchAll(PDO::FETCH_ASSOC);	
	
?>

<?php
$id = substr($_GET['id'], strrpos($_GET['id'], '/') + 1);

$product = $user->getOneProduct($id);

$url = $product[0]->address;
$carrier = $product[0]->carrier;
$mobile = $product[0]->mobile;
$picture = $product[0]->phone_picture;
$pro_id = $product[0]->product_id;
$delivery = $product[0]->delivery;
$models = $product[0]->model;
$express = $product[0]->express;
$express_price = $product[0]->express_price;
$price = $product[0]->price;
$description = $product[0]->description;
$code = $product[0]->code;
$published = $product[0]->published;
$supplier = $product[0]->supplier_id;
$language = $product[0]->language;
$phone_picture = $product[0]->phone_picture;
?>

	      
	      <h2>Produkter</h2>
	      
			<div class="ui segment" style="box-shadow: none;">
				<div class="ui breadcrumb">
				  <a href="#" class="section tab-item">Hem</a>
				  <i class="right chevron icon divider"></i>
				  <a data-tab="products" class="section tab-item">Produkter</a>
				  <i class="right chevron icon divider"></i>
				  <a class="active section"><?php echo $carrier; ?> <?php echo $mobile; ?></a>
				</div>
			</div>

			<div class="ui segment" style="box-shadow: none;">
			
				<script>
							jQuery(document).ready(function($) {
									
								   $('#validateMes<?php echo $pro_id; ?>').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-product<?php echo $pro_id; ?>").fadeIn(300).html(resp);
									            }
									        });
									　}
									});

							});
					</script>

			
			<h3 style="float: left;">Ändra produkt</h3>
			
			<a style="float: left; margin-left: 20px;" href="http://valfrimobil.se/las-upp/<?php echo $url; ?>-<?php echo $id; ?>" target="_blank" class="ui button">Se produktsida</a>

			<div style="clear: both;"></div>
			
			<div class="ui divider"></div>
			
						<div id="result" style="display: none;" class="ui error message"></div>
					<div id="success-product<?php echo $pro_id; ?>" style="display: none;" class="ui success message"></div>
								
								
								
								
				
				<form class="ui form" id="validateMes<?php echo $pro_id; ?>" enctype="multipart/form-data" action="http://valfrimobil.se/admin/pages2/edit_product.php" method="post">
					
					<div class="ui doubling two column grid">
				
					
					<div class="column">
					
					<input type="hidden" value="<?php echo $pro_id; ?>" name="id">
							
							
								<div class="field">
									<label>Operatör</label>
									<input value="<?php echo $carrier; ?>" id="carrier" name="carrier" type="text">

								</div>
								<div class="field">
									<label>Mobil</label>
									<input value="<?php echo $mobile; ?>" id="mobile" title="Fyll i en mobil" name="mobile" type="text">

								</div>
								
								<div class="field required">
									<label>Modell (Om flera - markera ut andra genom ett kommatecken)</label>
									<input value="<?php echo $models; ?>" id="model" title="Fyll i en modell" name="model" type="text" required>

								</div>
								
								<div class="field required">
									<label>Status</label>
									<select name="published" class="ui dropdown">
										<option value="1" <?php if($published == '1') { echo "selected"; } ?>>Publicerad</option>
										<option value="0" <?php if($published == '0') { echo "selected"; } ?>>Inte publicerad</option>
									</select>
								</div>
								
								<div class="field">
										<label>Leveranstid (timmar)</label>
												<input value="<?php echo $delivery; ?>" id="delivery" title="Fyll i detta fältet" name="delivery" type="text" required>

								</div>
								
									<div class="field">
										<label>Kod (Om kod ska fås vid upplåsning)</label>
										<select name="codeco" class="ui dropdown">
											<option value="1" <?php if($code == '1') { echo "selected"; } ?>>Ja</option>
											<option value="0" <?php if($code == '0') { echo "selected"; } ?>>Nej</option>
										</select>
									</div>
									
								<div class="two fields">
										<div class="field six wide">
											<label>Nuvarande bild</label>
											<img src="<?php echo $phone_picture; ?>" width="100%" /><br />
										</div>
										 <div class="field nine wide">
											 <label>Ändra</label>
											 <input type="file" title="Du måste ladda upp en bild" accept="image/*" id="file" name="file"><br />
										 </div>
									</div>
								<br />


															
				
					</div>
					
					<div class="column">
					
						<div class="field">
							<label>Beskrivning</label>
							<textarea title="Fyll i en beskrivning" id="description" name="description" style="height: 189px;"><?php echo nl2br($description); ?></textarea>
						</div>
						
																	
								
								<div class="field required">
									<label>Pris</label>
									<input value="<?php echo $price; ?>" id="price" title="Skriv in ett pris i siffror" name="price" type="text" required>
									<div class="error"></div>
								</div>
						
						
								<div class="field">
								
									<label>Leverantör (välj ingen om bara admin ska sköta)</label>
									<select name="supplier_id" class="ui search selection dropdown">
										<option value="0">Ingen</option>
										  <?php if(!empty($supp)) { ?>
										  <?php foreach($supp as $suppliers) { ?>
													
											<option value="<?php echo $suppliers['supplier_id']; ?>" <?php if($suppliers['supplier_id'] == $supplier) { echo "selected"; } ?>><?php echo $suppliers['company_name']; ?></option>
										
										<?php }} ?>
									</select>
								</div>
								
								<div class="field">
								
									<label>Land</label>
									<select name="language" class="ui search selection dropdown">
										  	
											<option value="0" <?php if($language == '0') { echo "selected"; } ?>>Sverige</option>
										
											<option value="1" <?php if($language == '1') { echo "selected"; } ?>>USA</option>


									</select>
								</div>
								
								
					</div>
				
				
			
					
					</div>
						
						<div class="field">
						<input type="submit" value="Ändra" class="ui button">
						</div>

						</form>
						

						
				
				
			</div>
	
		<link href="http://valfrimobil.se/admin/froala_editor/css/froala_editor.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">

  <script src="http://valfrimobil.se/admin/froala_editor/js/froala_editor.min.js"></script>
  <!--[if lt IE 9]>
    <script src="../js/froala_editor_ie8.min.js"></script>
  <![endif]-->
  <script src="http://valfrimobil.se/admin/froala_editor/js/plugins/tables.min.js"></script>
  <script src="http://valfrimobil.se/admin/froala_editor/js/plugins/lists.min.js"></script>
  <script src="http://valfrimobil.se/admin/froala_editor/js/plugins/colors.min.js"></script>
  <script src="http://valfrimobil.se/admin/froala_editor/js/plugins/media_manager.min.js"></script>
  <script src="http://valfrimobil.se/admin/froala_editor/js/plugins/font_family.min.js"></script>
  <script src="http://valfrimobil.se/admin/froala_editor/js/plugins/font_size.min.js"></script>
  <script src="http://valfrimobil.se/admin/froala_editor/js/plugins/block_styles.min.js"></script>
  <script src="http://valfrimobil.se/admin/froala_editor/js/plugins/video.min.js"></script>

  <script>
      $(function(){
        $('#description').editable({inlineMode: false})

      });
  </script>
  
  
	
	<script>
	    $(function() {
		
				    
		    $('.tab-item').tab({
				  history: false,
				  cache: false,
				  apiSettings: {
				  	url: 'pages2/{$tab}.php'
				  }
				    
			  })
			  ;
			
	    });
    </script>
    
