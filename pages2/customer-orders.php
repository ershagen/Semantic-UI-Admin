<?php
session_start();

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');

	
	
	$order_cust_sql = "SELECT * FROM `v_customers_orders` ORDER by order_id ASC";
	$order_state_cust = $objDb->query($order_cust_sql);
	$orders_cust = $order_state_cust->fetchAll(PDO::FETCH_ASSOC);
	

	$customers_sql = "SELECT * FROM `v_customers` ORDER by customer_id DESC";
	$customers_state = $objDb->query($customers_sql);
	$cust = $customers_state->fetchAll(PDO::FETCH_ASSOC);	
	
	
	
	
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
			  	  <i class="right chevron icon divider"></i>
			  <a class="active section">Kunder</a>
			</div>
		</div>

		<div class="ui segment" style="box-shadow: none;">
				
<h3 style="float:left;">Lista på beställningar</h3>
		
				<script>
						$(function() {
						$('.orderss.menu .item').tab();
						});
						</script>
		
    <div  class="ui orderss secondary pointing menu" style=" margin: 0; border-width: 0px; float: right;">
      <a class="item active" data-tab="latests-cust-order">Alla</a>
      <a class="item grey" data-tab="processings-cust-order">Mottagen</a>
      <a class="item yellow" data-tab="processeds-cust-order">Bearbetas</a>
      <a class="item red" data-tab="denieds-cust-order">Nekades</a>
      <a class="item green" data-tab="finishs-cust-order">Klar</a>
      <a class="item green" data-tab="finpaids-cust-order">Klar/betald</a>
    </div>
    
    
        <div style="clear: both; margin-bottom: -13px;"></div>

		<div class="ui divider"></div>
		
		
		    <div class="ui tab active" data-tab="latests-cust-order"> <!-- senaste -->

	  <table class="ui table stripe orders-tables"  style="border-radius: 0px;" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Order #</th>
            <th>Produkt</th>
            <th>Datum</th>
            <th>Företag</th>
            <th>IMEI</th>
            <th>Pris</th>
            <th>Status</th>
            <th>Åtgärder</th>
        </tr>
    </thead>
 
    <tbody>        
        <?php if(!empty($orders_cust)) { ?>
		<?php foreach($orders_cust as $ord) {
				
	$productid_sql = "SELECT * FROM `v_products_2` WHERE product_id = '{$ord['product_id']}'";
	$productid_state = $objDb->query($productid_sql);
	$productid = $productid_state->fetchAll(PDO::FETCH_ASSOC);
	
	$customers_sqls = "SELECT * FROM `v_customers` WHERE customer_id = '{$ord['customer_id']}' ORDER by customer_id DESC";
	$customers_states = $objDb->query($customers_sqls);
	$custs = $customers_states->fetchAll(PDO::FETCH_ASSOC);	

		?>
		<tr>
						
						<td><?php echo $ord['order_id']; ?></td><td><?php if(!empty($productid)) { 
		 foreach($productid as $produ) {
		 echo $produ['carrier']." ".$produ['mobile'];
		 }} ?> <?php echo $ord['model']; ?></td><td><?php echo $ord['date']; ?></td><td><?php if(!empty($custs)) { 
		 foreach($custs as $customer) {
		 echo $customer['company_name'];
		 }} ?></td><td><?php echo $ord['imei_number']; ?></td><td><?php echo $ord['price']; ?> <?php echo $ord['currency']; ?></td>
						
						<td>
						<?php 
						if(!empty($productid)) { 
						foreach($productid as $produ) {
						if($produ['code'] == '1') {
						?>
							<form id="code-form-latest-<?php echo $ord['order_id']; ?>" method="post">
									<div class="ui form" style="position: relative;">
									
										<input type="text" style="width: 100px; margin-bottom: 5px;" placeholder="Kod (Sparas)" value="<?php echo $ord['code']; ?>" id="code_code<?php echo $ord['order_id']; ?>" name="code_code">
									
										<div style="position: absolute; right: 10px; top: 10px;" id="form-status-holder<?php echo $ord['order_id']; ?>"></div>
					
					
									</div>
									
								</form>
								
						
						
						<script>
									var timeoutId;
									$('#code-form-latest-<?php echo $ord['order_id']; ?> input').on('input propertychange change', function() {
									    console.log('Textarea Change');
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('#code-form-latest-<?php echo $ord['order_id']; ?>');
									    var code_code = $("#code_code<?php echo $ord['order_id']; ?>").val();
									    var order_id = "<?php echo $ord['order_id']; ?>";
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('#form-status-holder<?php echo $ord['order_id']; ?>').html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('#form-status-holder<?php echo $ord['order_id']; ?>').html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
							
									
									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.code-form-latest-<?php echo $ord['order_id']; ?>').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									</script>
									
									<?php }}} ?>
							<script>
							$(function() {
																 
								 $('.orders-tables').on('change', '#select-firsts<?php echo $ord['order_id']; ?>', function() {
								 
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $ord['order_id']; ?>";
									var customer_id = "<?php echo $ord['customer_id']; ?>";
									var selecto = 'id='+ id + '&option='+ option + '&customer_id='+ customer_id;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
							});
							</script>
							
							<select id="select-firsts<?php echo $ord['order_id']; ?>" name="status" class="ui compact dropdown">
							  <option value="1" <?php if($ord['status'] == '1') echo "selected" ?>>Mottagen</option>
							  <option value="2" <?php if($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
							  <option value="3" <?php if($ord['status'] == '3') echo "selected" ?>>Nekades</option>

							  <option value="4" <?php if($ord['status'] == '4') echo "selected" ?>>Klar</option>
							  <option value="5" <?php if($ord['status'] == '5') echo "selected" ?>>Klar/Betald</option>


							</select>
							
						</td>

<td>
						
						<a href="javascript:void();" class="delbutton_all<?php echo $ord['order_id']; ?> ui button icon compact">
						<i class="trash icon"></i>
						</a>
							  <script type="text/javascript">
								$(function() {
								
								
									$(".orders-tables").on('click', '.delbutton_all<?php echo $ord['order_id']; ?>', function() {
									var del_id = "<?php echo $ord['order_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här beställningar?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_customers_orders.php",
												data: info,
												success: function(){
												}
											});
											
											$(this).parents(".record_cust").animate({ backgroundColor: "#fbc7c7" }, "fast")
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
		    

    <div class="ui tab" data-tab="processings-cust-order">
    
 <?php
				$order_sql = "SELECT * FROM `v_customers_orders` WHERE status = '1'";
				$order_state = $objDb->query($order_sql);
				$oeks = $order_state->fetchAll(PDO::FETCH_ASSOC);
			?>
			
			
	  <table class="ui table stripe orders-tables"  style="border-radius: 0px;" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Order #</th>
            <th>Produkt</th>
            <th>Datum</th>
            <th>Företag</th>
            <th>IMEI</th>
            <th>Pris</th>
            <th>Status</th>
            <th>Åtgärder</th>
        </tr>
    </thead>
 
    <tbody>        
        <?php if(!empty($oeks)) { ?>
		<?php foreach($oeks as $ord) {
				
	$productid_sql = "SELECT * FROM `v_products_2` WHERE product_id = '{$ord['product_id']}'";
	$productid_state = $objDb->query($productid_sql);
	$productid = $productid_state->fetchAll(PDO::FETCH_ASSOC);
	
		$customers_sqls = "SELECT * FROM `v_customers` WHERE customer_id = '{$ord['customer_id']}' ORDER by customer_id DESC";
	$customers_states = $objDb->query($customers_sqls);
	$custs = $customers_states->fetchAll(PDO::FETCH_ASSOC);	



		?>
		<tr>
						
						<td><?php echo $ord['order_id']; ?></td><td><?php if(!empty($productid)) { 
		 foreach($productid as $produ) {
		 echo $produ['carrier']." ".$produ['mobile'];
		 }} ?> <?php echo $ord['model']; ?></td><td><?php echo $ord['date']; ?></td><td><?php if(!empty($custs)) { 
		 foreach($custs as $customer) {
		 echo $customer['company_name'];
		 }} ?></td><td><?php echo $ord['imei_number']; ?></td><td><?php echo $ord['price']; ?> <?php echo $ord['currency']; ?></td>						
						<td>
							<?php
							if(!empty($productid)) { 
							foreach($productid as $produ) {
						if($produ['code'] == '1') {
						?>
								<form id="code-form-processings-<?php echo $ord['order_id']; ?>" method="post">
									<div class="ui form" style="position: relative;">
									
										<input type="text" style="width: 100px; margin-bottom: 5px;" placeholder="Kod (Sparas)" value="<?php echo $ord['code']; ?>" id="code_code<?php echo $ord['order_id']; ?>" name="code_code">
									
										<div style="position: absolute; right: 10px; top: 10px;" id="form-status-holder<?php echo $ord['order_id']; ?>"></div>
					
					
									</div>
									
								</form>
								
						
						
						<script>
									var timeoutId;
									$('#code-form-processings-<?php echo $ord['order_id']; ?> input').on('input propertychange change', function() {
									    console.log('Textarea Change');
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('#code-form-processings-<?php echo $ord['order_id']; ?>');
									    var code_code = $("#code_code<?php echo $ord['order_id']; ?>").val();
									    var order_id = "<?php echo $ord['order_id']; ?>";
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('#form-status-holder<?php echo $ord['order_id']; ?>').html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('#form-status-holder<?php echo $ord['order_id']; ?>').html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
							
									
									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.code-form-processings-<?php echo $ord['order_id']; ?>').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									</script>
									
										<?php }}} ?>
										
										
									<script>
							$(function() {
								
								
							
									 $('.orders-tables').on('change', '#processings<?php echo $ord['order_id']; ?>', function() {
								
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $ord['order_id']; ?>";
									var customer_id = "<?php echo $ord['customer_id']; ?>";
									var dataString = 'id='+ id + '&option='+ option + '&customer_id='+ customer_id;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: dataString,
										cache: false,
										success: function(html){
										}
									});


								});
								
							});
							</script>
							
							
							<select name="status" class="ui compact dropdown" id="processings<?php echo $ord['order_id']; ?>">
							  <option value="1" <?php if($ord['status'] == '1') echo "selected" ?>>Mottagen</option>
							  <option value="2" <?php if($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
							  <option value="3" <?php if($ord['status'] == '3') echo "selected" ?>>Nekades</option>

							  <option value="4" <?php if($ord['status'] == '4') echo "selected" ?>>Klar</option>
							  <option value="5" <?php if($ord['status'] == '5') echo "selected" ?>>Klar/Betald</option>


							</select>
							
								
						</td>
						
						
												
						
						<td>
						
						<a href="javascript:void();" class="delbutton_all<?php echo $ord['order_id']; ?> ui button icon compact">
						<i class="trash icon"></i>
						</a>
							  <script type="text/javascript">
								$(function() {
								
								
									$(".orders-tables").on('click', '.delbutton_all<?php echo $ord['order_id']; ?>', function() {
									var del_id = "<?php echo $ord['order_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här beställningar?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_customers_orders.php",
												data: info,
												success: function(){
												}
											});
											
											$(this).parents(".record_cust").animate({ backgroundColor: "#fbc7c7" }, "fast")
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
    
    <div class="ui tab" data-tab="processeds-cust-order">
    
 <?php
				$order_sql = "SELECT * FROM `v_customers_orders` WHERE status = '2'";
				$order_state = $objDb->query($order_sql);
				$oeks = $order_state->fetchAll(PDO::FETCH_ASSOC);
			?>

			<table class="ui table stripe orders-tables" style="border-radius: 0px;" cellspacing="0" id="orders-tables">
				<thead>
				<tr>
		    <th>Order #</th>
            <th>Produkt</th>
            <th>Datum</th>
            <th>Företag</th>
            <th>IMEI</th>
            <th>Pris</th>
            <th>Status</th>
            <th>Åtgärder</th>
				</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($oeks)) {
					foreach($oeks as $ord) {
					$productids_sql = "SELECT * FROM `v_products_2` WHERE product_id = '{$ord['product_id']}'";
					$productids_state = $objDb->query($productids_sql);
	$productids = $productids_state->fetchAll(PDO::FETCH_ASSOC);
	
		$customers_sqls = "SELECT * FROM `v_customers` WHERE customer_id = '{$ord['customer_id']}' ORDER by customer_id DESC";
	$customers_states = $objDb->query($customers_sqls);
	$custs = $customers_states->fetchAll(PDO::FETCH_ASSOC);	

		
						?>
						
						<tr>
					<td><?php echo $ord['order_id']; ?></td><td><?php if(!empty($productids)) { 
		 foreach($productids as $produ) {
		 echo $produ['carrier']." ".$produ['mobile'];
		 }} ?> <?php echo $ord['model']; ?></td><td><?php echo $ord['date']; ?></td><td><?php if(!empty($custs)) { 
		 foreach($custs as $customer) {
		 echo $customer['company_name'];
		 }} ?></td><td><?php echo $ord['imei_number']; ?></td><td><?php echo $ord['price']; ?> <?php echo $ord['currency']; ?></td>
						 <td>
						 
						 <?php 
						if(!empty($productids)) { 
						foreach($productids as $produ) {
						if($produ['code'] == '1') {
						?>
							<form id="code-sform-processeds-<?php echo $ord['order_id']; ?>" method="post">
									<div class="ui form" style="position: relative;">
									
										<input type="text" style="width: 100px; margin-bottom: 5px;" placeholder="Kod (Sparas)" value="<?php echo $ord['code']; ?>" id="code_code<?php echo $ord['order_id']; ?>" name="code_code">
									
										<div style="position: absolute; right: 10px; top: 10px;" id="form-status-holder<?php echo $ord['order_id']; ?>"></div>
					
					
									</div>
									
								</form>
								
						
						
						<script>
									var timeoutId;
									$('#code-sform-processeds-<?php echo $ord['order_id']; ?> input').on('input propertychange change', function() {
									    console.log('Textarea Change');
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('#code-sform-processeds-<?php echo $ord['order_id']; ?>');
									    var code_code = $("#code_code<?php echo $ord['order_id']; ?>").val();
									    var order_id = "<?php echo $ord['order_id']; ?>";
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('#form-status-holder<?php echo $ord['order_id']; ?>').html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('#form-status-holder<?php echo $ord['order_id']; ?>').html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
							
									
									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.code-sform-processeds-<?php echo $ord['order_id']; ?>').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									</script>
									
									<?php }}} ?>
									
									
									<script>
							$(function() {
								
								 $('.orders-tables').on('change', '#processeds<?php echo $ord['order_id']; ?>', function() {
								
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $ord['order_id']; ?>";
									var customer_id = "<?php echo $ord['customer_id']; ?>";
									var dataString = 'id='+ id + '&option='+ option + '&customer_id='+ customer_id;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: dataString,
										cache: false,
										success: function(html){
										}
									});


								});
								
							});
							</script>
							<select name="customer_status" class="ui compact dropdown" id="processeds<?php echo $ord['order_id']; ?>">
							  <option value="1" <?php if($ord['status'] == '1') echo "selected" ?>>Mottagen</option>
							  <option value="2" <?php if($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
							  <option value="3" <?php if($ord['status'] == '3') echo "selected" ?>>Nekades</option>

							  <option value="4" <?php if($ord['status'] == '4') echo "selected" ?>>Klar</option>
							  <option value="5" <?php if($ord['status'] == '5') echo "selected" ?>>Klar/Betald</option>


							</select>
						</td>
						
						
						<td>
						
						<a href="javascript:void();" class="delbutton_all<?php echo $ord['order_id']; ?> ui button icon compact">
						<i class="trash icon"></i>
						</a>
							  <script type="text/javascript">
								$(function() {
								
								
									$(".orders-tables").on('click', '.delbutton_all<?php echo $ord['order_id']; ?>', function() {
									var del_id = "<?php echo $ord['order_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här beställningar?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_customers_orders.php",
												data: info,
												success: function(){
												}
											});
											
											$(this).parents(".record_cust").animate({ backgroundColor: "#fbc7c7" }, "fast")
.animate({ opacity: "hide" }, "slow");
										}
									return false;
									});
									
								});
								</script>


						</td>
						
						</tr>
						
						<?php
					}}
					?>
				</tbody>
			</table>



    </div>
 <div class="ui tab" data-tab="denieds-cust-order">
    
 <?php
				$order_sql = "SELECT * FROM `v_customers_orders` WHERE status = '3'";
				$order_state = $objDb->query($order_sql);
				$oeks = $order_state->fetchAll(PDO::FETCH_ASSOC);
			?>

			<table class="ui table stripe orders-tables" style="border-radius: 0px;" cellspacing="0" id="orders-tables">
				<thead>
				<tr>
			<th>Order #</th>
            <th>Produkt</th>
            <th>Datum</th>
            <th>Företag</th>
            <th>IMEI</th>
            <th>Pris</th>
            <th>Status</th>
            <th>Åtgärder</th>
				</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($oeks)) {
					foreach($oeks as $ord) {
					$productids_sql = "SELECT * FROM `v_products_2` WHERE product_id = '{$ord['product_id']}'";
					$productids_state = $objDb->query($productids_sql);
	$productids = $productids_state->fetchAll(PDO::FETCH_ASSOC);
		
						?>
						
						<tr>
						<td><?php echo $ord['order_id']; ?></td><td><?php if(!empty($productids)) { 
		 foreach($productids as $produ) {
		 echo $produ['carrier']." ".$produ['mobile'];
		 }} ?> <?php echo $ord['model']; ?></td><td><?php echo $ord['date']; ?></td><td><?php if(!empty($custs)) { 
		 foreach($custs as $customer) {
		 echo $customer['company_name'];
		 }} ?></td><td><?php echo $ord['imei_number']; ?></td><td><?php echo $ord['price']; ?> <?php echo $ord['currency']; ?></td>
						<td>
						<?php 
						if(!empty($productids)) { 
						foreach($productids as $produ) {
						if($produ['code'] == '1') {
						?>
							<form id="codes-form-latest-<?php echo $ord['order_id']; ?>" method="post">
									<div class="ui form" style="position: relative;">
									
										<input type="text" style="width: 100px; margin-bottom: 5px;" placeholder="Kod (Sparas)" value="<?php echo $ord['code']; ?>" id="code_code<?php echo $ord['order_id']; ?>" name="code_code">
									
										<div style="position: absolute; right: 10px; top: 10px;" id="form-status-holder<?php echo $ord['order_id']; ?>"></div>
					
					
									</div>
									
								</form>
								
						
						
						<script>
									var timeoutId;
									$('#codes-form-latest-<?php echo $ord['order_id']; ?> input').on('input propertychange change', function() {
									    console.log('Textarea Change');
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('#codes-form-latest-<?php echo $ord['order_id']; ?>');
									    var code_code = $("#code_code<?php echo $ord['order_id']; ?>").val();
									    var order_id = "<?php echo $ord['order_id']; ?>";
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('#form-status-holder<?php echo $ord['order_id']; ?>').html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('#form-status-holder<?php echo $ord['order_id']; ?>').html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
							
									
									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.codes-form-latest-<?php echo $ord['order_id']; ?>').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									</script>
									
									<?php }}} ?>
							<script>
							$(function() {
																 
								 $('.orders-tables').on('change', '#select-firsts<?php echo $ord['order_id']; ?>', function() {
								 
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $ord['order_id']; ?>";
									var customer_id = "<?php echo $ord['customer_id']; ?>";
									var selecto = 'id='+ id + '&option='+ option + '&customer_id='+ customer_id;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
							});
							</script>
							
							<select id="select-firsts<?php echo $ord['order_id']; ?>" name="status" class="ui compact dropdown">
							  <option value="1" <?php if($ord['status'] == '1') echo "selected" ?>>Mottagen</option>
							  <option value="2" <?php if($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
							  <option value="3" <?php if($ord['status'] == '3') echo "selected" ?>>Nekades</option>

							  <option value="4" <?php if($ord['status'] == '4') echo "selected" ?>>Klar</option>
							  <option value="5" <?php if($ord['status'] == '5') echo "selected" ?>>Klar/Betald</option>


							</select>
							
						</td>						
						
						
						<td>
						
						<a href="javascript:void();" class="delbutton_all<?php echo $ord['order_id']; ?> ui button icon compact">
						<i class="trash icon"></i>
						</a>
							  <script type="text/javascript">
								$(function() {
								
								
									$(".orders-tables").on('click', '.delbutton_all<?php echo $ord['order_id']; ?>', function() {
									var del_id = "<?php echo $ord['order_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här beställningar?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_customers_orders.php",
												data: info,
												success: function(){
												}
											});
											
											$(this).parents(".record_cust").animate({ backgroundColor: "#fbc7c7" }, "fast")
.animate({ opacity: "hide" }, "slow");
										}
									return false;
									});
									
								});
								</script>


						</td>
						
						
						</tr>
						
						<?php
					}}
					?>
				</tbody>
			</table>



    </div>
        
         <div class="ui tab" data-tab="finishs-cust-order">
 <?php
				$order_sql = "SELECT * FROM `v_customers_orders` WHERE status = '4'";
				$order_state = $objDb->query($order_sql);
				$oeks = $order_state->fetchAll(PDO::FETCH_ASSOC);
			?>

			<table class="ui table stripe orders-tables" style="border-radius: 0px;" cellspacing="0" id="orders-tables">
				<thead>
				<tr>
		           <th>Order #</th>
            <th>Produkt</th>
            <th>Datum</th>
            <th>Företag</th>
            <th>IMEI</th>
            <th>Pris</th>
            <th>Status</th>
            <th>Åtgärder</th>
				</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($oeks)) {
					foreach($oeks as $ord) {
					$productids_sql = "SELECT * FROM `v_products_2` WHERE product_id = '{$ord['product_id']}'";
					$productids_state = $objDb->query($productids_sql);
	$productid = $productids_state->fetchAll(PDO::FETCH_ASSOC);
		
						?>
						
						<tr>
						<td><?php echo $ord['order_id']; ?></td><td><?php if(!empty($productid)) { 
		 foreach($productid as $produ) {
		 echo $produ['carrier']." ".$produ['mobile'];
		 }} ?> <?php echo $ord['model']; ?></td><td><?php echo $ord['date']; ?></td><td><?php if(!empty($custs)) { 
		 foreach($custs as $customer) {
		 echo $customer['company_name'];
		 }} ?></td><td><?php echo $ord['imei_number']; ?></td><td><?php echo $ord['price']; ?> <?php echo $ord['currency']; ?></td>
						 <td>
						<?php 
						if(!empty($productid)) { 
						foreach($productid as $produ) {
						if($produ['code'] == '1') {
						?>
							<form id="codess-form-latest-<?php echo $ord['order_id']; ?>" method="post">
									<div class="ui form" style="position: relative;">
									
										<input type="text" style="width: 100px; margin-bottom: 5px;" placeholder="Kod (Sparas)" value="<?php echo $ord['code']; ?>" id="code_code<?php echo $ord['order_id']; ?>" name="code_code">
									
										<div style="position: absolute; right: 10px; top: 10px;" id="form-status-holder<?php echo $ord['order_id']; ?>"></div>
					
					
									</div>
									
								</form>
								
						
						
						<script>
									var timeoutId;
									$('#codess-form-latest-<?php echo $ord['order_id']; ?> input').on('input propertychange change', function() {
									    console.log('Textarea Change');
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('#codess-form-latest-<?php echo $ord['order_id']; ?>');
									    var code_code = $("#code_code<?php echo $ord['order_id']; ?>").val();
									    var order_id = "<?php echo $ord['order_id']; ?>";
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('#form-status-holder<?php echo $ord['order_id']; ?>').html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('#form-status-holder<?php echo $ord['order_id']; ?>').html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
							
									
									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.codess-form-latest-<?php echo $ord['order_id']; ?>').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									</script>
									
									<?php }}} ?>
							<script>
							$(function() {
																 
								 $('.orders-tables').on('change', '#select-firsts<?php echo $ord['order_id']; ?>', function() {
								 
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $ord['order_id']; ?>";
									var customer_id = "<?php echo $ord['customer_id']; ?>";
									var selecto = 'id='+ id + '&option='+ option + '&customer_id='+ customer_id;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
							});
							</script>
							
							<select id="select-firsts<?php echo $ord['order_id']; ?>" name="status" class="ui compact dropdown">
							  <option value="1" <?php if($ord['status'] == '1') echo "selected" ?>>Mottagen</option>
							  <option value="2" <?php if($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
							  <option value="3" <?php if($ord['status'] == '3') echo "selected" ?>>Nekades</option>

							  <option value="4" <?php if($ord['status'] == '4') echo "selected" ?>>Klar</option>
							  <option value="5" <?php if($ord['status'] == '5') echo "selected" ?>>Klar/Betald</option>


							</select>
							
						</td>						
						
						<td>
						
						<a href="javascript:void();" class="delbutton_all<?php echo $ord['order_id']; ?> ui button icon compact">
						<i class="trash icon"></i>
						</a>
							  <script type="text/javascript">
								$(function() {
								
								
									$(".orders-tables").on('click', '.delbutton_all<?php echo $ord['order_id']; ?>', function() {
									var del_id = "<?php echo $ord['order_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här beställningar?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_customers_orders.php",
												data: info,
												success: function(){
												}
											});
											
											$(this).parents(".record_cust").animate({ backgroundColor: "#fbc7c7" }, "fast")
.animate({ opacity: "hide" }, "slow");
										}
									return false;
									});
									
								});
								</script>


						</td></tr>



						
						<?php
					}}
					?>
				</tbody>
			</table>



    </div>
    
     <div class="ui tab" data-tab="finpaids-cust-order">
    
 <?php
				$order_sql = "SELECT * FROM `v_customers_orders` WHERE status = '5'";
				$order_state = $objDb->query($order_sql);
				$oeks = $order_state->fetchAll(PDO::FETCH_ASSOC);
			?>

			<table class="ui table stripe orders-tables" style="border-radius: 0px;" cellspacing="0" id="orders-tables">
				<thead>
				<tr>
					           <th>Order #</th>
            <th>Produkt</th>
            <th>Datum</th>
            <th>Företag</th>
            <th>IMEI</th>
            <th>Pris</th>
            <th>Status</th>
            <th>Åtgärder</th>
            
				</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($oeks)) {
					foreach($oeks as $ord) {
					$productids_sql = "SELECT * FROM `v_products_2` WHERE product_id = '{$ord['product_id']}'";
					$productids_state = $objDb->query($productids_sql);
	$productid = $productids_state->fetchAll(PDO::FETCH_ASSOC);
		
						?>
						
						<tr>
						<td><?php echo $ord['order_id']; ?></td><td><?php if(!empty($productid)) { 
		 foreach($productid as $produ) {
		 echo $produ['carrier']." ".$produ['mobile'];
		 }} ?> <?php echo $ord['model']; ?></td><td><?php echo $ord['date']; ?></td><td><?php if(!empty($custs)) { 
		 foreach($custs as $customer) {
		 echo $customer['company_name'];
		 }} ?></td><td><?php echo $ord['imei_number']; ?></td><td><?php echo $ord['price']; ?> <?php echo $ord['currency']; ?></td>
					<td>
						<?php 
						if(!empty($productid)) { 
						foreach($productid as $produ) {
						if($produ['code'] == '1') {
						?>
							<form id="codeser-form-latest-<?php echo $ord['order_id']; ?>" method="post">
									<div class="ui form" style="position: relative;">
									
										<input type="text" style="width: 100px; margin-bottom: 5px;" placeholder="Kod (Sparas)" value="<?php echo $ord['code']; ?>" id="code_code<?php echo $ord['order_id']; ?>" name="code_code">
									
										<div style="position: absolute; right: 10px; top: 10px;" id="form-status-holder<?php echo $ord['order_id']; ?>"></div>
					
					
									</div>
									
								</form>
								
						
						
						<script>
									var timeoutId;
									$('#codeser-form-latest-<?php echo $ord['order_id']; ?> input').on('input propertychange change', function() {
									    console.log('Textarea Change');
									    
									    clearTimeout(timeoutId);
									    timeoutId = setTimeout(function() {
									        // Runs 1 second (1000 ms) after the last change    
									    console.log('Sparar till databas..');
									    form = $('#codeser-form-latest-<?php echo $ord['order_id']; ?>');
									    var code_code = $("#code_code<?php echo $ord['order_id']; ?>").val();
									    var order_id = "<?php echo $ord['order_id']; ?>";
									    var dataStrings = 'order_id='+ order_id + '&code_code='+ code_code;
										$.ajax({
											url: "http://valfrimobil.se/admin/change_code_customer.php",
											type: "POST",
											data: dataStrings, // serializes the form's elements.
											beforeSend: function(xhr) {
									            // Let them know we are saving
												$('#form-status-holder<?php echo $ord['order_id']; ?>').html('Sparar...');
											},
											success: function(data) {
												var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
									            // Now show them we saved and when we did
									            var d = new Date();
									            $('#form-status-holder<?php echo $ord['order_id']; ?>').html("<i class='icon checkmark' style='color: green;'></i>");
											},
										});
										
									    }, 500);
									});
							
									
									// This is just so we don't go anywhere  
									// and still save if you submit the form
									$('.codeser-form-latest-<?php echo $ord['order_id']; ?>').submit(function(e) {
										saveToDB();
										e.preventDefault();
									});
									</script>
									
									<?php }}} ?>
							<script>
							$(function() {
																 
								 $('.orders-tables').on('change', '#select-firstss<?php echo $ord['order_id']; ?>', function() {
								 
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $ord['order_id']; ?>";
									var customer_id = "<?php echo $ord['customer_id']; ?>";
									var selecto = 'id='+ id + '&option='+ option + '&customer_id='+ customer_id;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_customerorder_status_2.php",
										data: selecto,
										cache: false,
										success: function(html){
											alert(html);
										}
									});


								});
								
							});
							</script>
							
							<select id="select-firstss<?php echo $ord['order_id']; ?>" name="status" class="ui compact dropdown">
							  <option value="1" <?php if($ord['status'] == '1') echo "selected" ?>>Behandlas</option>
							  <option value="2" <?php if($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
							  <option value="3" <?php if($ord['status'] == '3') echo "selected" ?>>Nekades</option>

							  <option value="4" <?php if($ord['status'] == '4') echo "selected" ?>>Klar</option>
							  <option value="5" <?php if($ord['status'] == '5') echo "selected" ?>>Klar/Betald</option>


							</select>
							
						</td>
						
						<td>
						
						<a href="javascript:void();" class="delbutton_all<?php echo $ord['order_id']; ?> ui button icon compact">
						<i class="trash icon"></i>
						</a>
							  <script type="text/javascript">
								$(function() {
								
								
									$(".orders-tables").on('click', '.delbutton_all<?php echo $ord['order_id']; ?>', function() {
									var del_id = "<?php echo $ord['order_id']; ?>";
									var info = 'id=' + del_id;
										if(confirm("Vill du ta bort den här beställningar?"))
										{
											$.ajax({
												type: "POST",
												url: "http://valfrimobil.se/admin/delete_customers_orders.php",
												data: info,
												success: function(){
												}
											});
											
											$(this).parents(".record_cust").animate({ backgroundColor: "#fbc7c7" }, "fast")
.animate({ opacity: "hide" }, "slow");
										}
									return false;
									});
									
								});
								</script>


						</td></tr>


						
						<?php
					}}
					?>
				</tbody>
			</table>



    </div>
    

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
		 $(document).ready(function() {
		    $('.orders-tables').dataTable({
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