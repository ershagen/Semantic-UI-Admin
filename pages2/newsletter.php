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
		

	     <h2>Nyhetsbrev</h2>
		<div class="ui segment" style="box-shadow: none;">
			<div class="ui breadcrumb">
			  <a href="#" class="section">Hem</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">Nyhetsbrev</a>
			</div>
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
									
								   $('#send').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-products-send").fadeIn(300).html(resp);
									            }
									        });
									　}
									});

							});
					</script>
						
					<h3>Skicka</h3>
					
					<div class="ui divider"></div>
					
					<div id="result" style="display: none;" class="ui error message"></div>
					<div id="success-products-send" style="display: none;" class="ui success message"></div>
								
								
								
	
					<form action="http://valfrimobil.se/send_newsletter.php" method="post" id="send" class="ui form">
							
							<div class="field">
							Meddelandet kommer skickas genom TinyLetter's server. Därför måste e-postadresserna finnas inne på Tinyletter.com på ert konto för att det ska kunna skickas till alla.
							</div>
							
							<div class="field required">
									<label>Ämne</label>
									<input id="subject" name="subject" type="text" />

								</div>
								
								
								<div class="field required">
									<label>Meddelande</label>
									<textarea id="newsletter_message" name="newsletter_message" required></textarea>

								</div>
								
											
				
						
						<div class="field">
							<input type="submit" value="Skicka" class="ui button green">
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
        $('#newsletter_message').editable({inlineMode: false,  minHeight: 100,
      maxHeight: 200, placeholder: 'Meddelande'})

      });
  </script>
  