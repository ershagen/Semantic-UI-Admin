<?php
session_start();
require_once '../../customers-login/dbconfig.php';

$id = substr($_GET['id'], strrpos($_GET['id'], '/') + 1);

$product = $user->getOnePage($id);
$subject = $product[0]->subject;
$subject_left = $product[0]->subject_left;
$text = $product[0]->text;
$link = $product[0]->address;
$page_id = $product[0]->page_id;
?>

	      
	       <h2>Sidor</h2>
	      
			<div class="ui segment" style="box-shadow: none;">
				<div class="ui breadcrumb">
				  <a href="#" class="section tab-item">Hem</a>
				  <i class="right chevron icon divider"></i>
				  <a data-tab="pages" class="section tab-item">Sidor</a>
				  <i class="right chevron icon divider"></i>
				  <a class="active section"><?php echo $subject; ?></a>
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
									
								   $('#ansoktss').validate({
									    submitHandler: function(form) {
									        $(form).ajaxSubmit({
									            success: function(resp) {
									               $("#success-producters").fadeIn(300).html(resp);
									            }
									        });
									　}
									});

							});
					</script>
						
					<h3>Ändra</h3>
					
					<div class="ui divider"></div>
					
					<div id="result" style="display: none;" class="ui error message"></div>
					<div id="success-producters" style="display: none;" class="ui success message"></div>
								
								
								
	
					<form action="http://valfrimobil.se/edit_page.php" method="post" id="ansoktss" class="ui form">
							
<input id="page_id" name="page_id" type="hidden" value="<?php echo $page_id; ?>">

						
								<div class="field required">
									<label>Rubrik</label>
									<input placeholder="" title="Fyll i ett namn" id="name" name="name" type="text" value="<?php echo $subject; ?>" required>

								</div>
								
								<div class="field required">
									<label>Placering av Rubrik</label>
									<select name="subject_left">
										<option value="1" <?php echo ''.(($subject_left=='1')?'selected="selected"':"").''; ?>>Vänster</option>
										<option value="0" <?php echo ''.(($subject_left=='0')?'selected="selected"':"").''; ?>>Mitten</option>
									</select>
								</div>
								
								<div class="field required">
									<label>Länk (http://valfrimobil.se/sidor/LÄNK-SIDID)</label>
									<input placeholder="" title="Fyll i en länk" id="link" name="link" type="text" value="<?php echo $link; ?>" required>

								</div>

								
								
								<div class="field required">
									<label>Innehåll</label>
									<textarea name="text" id="page_edits"><?php echo $text; ?></textarea>

								</div>
							
															
						
						<div class="field">
						<input type="submit" value="Ändra" class="ui button green">
						</div>

						</form>

	    </div>
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
        $('#page_edits').editable({inlineMode: false,  minHeight: 500,
      maxHeight: 700, placeholder: 'Innehåll'})

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
    