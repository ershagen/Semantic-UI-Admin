<?php
session_start();

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
	$order_sql_dash = "SELECT * FROM `v_orders` ORDER by order_id DESC LIMIT 5";
	$order_state_dash = $objDb->query($order_sql_dash);
	$orders_dash = $order_state_dash->fetchAll(PDO::FETCH_ASSOC);
	
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}


?>

<h2>Dashboard</h2>
	      
	      <div class="ui segment" style="box-shadow: none;">
			<div class="ui breadcrumb">
			  <a href="#" class="section">Hem</a>
			  <i class="right chevron icon divider"></i>
			  <a class="active section">Dashboard</a>
			</div>
		 </div>
		 
				<div class="ui doubling four column grid">
					    <div class="column">
						    <div class="views">
								 <div class="icon-order"><i class="eye icon"></i></div>
								 <div class="detail"><h3>214</h3>Visningar</div>
							</div>
					    </div>
					    <div class="column">
						    <div class="orders">
								 <div class="icon-order"><i class="users icon"></i></div>
								 <div class="detail"><h3><?php
								$nRows = $objDb->query('select count(*) from v_customers')->fetchColumn(); 
								echo $nRows;
			?></h3>Kunder</div>
							</div>
					    </div>
					    <div class="column">
						    <div class="new_orders">
								 <div class="icon-order"><i class="archive icon"></i></div>
								 <div class="detail"><h3><?php
								$nRows = $objDb->query('select count(*) from v_orders')->fetchColumn(); $nRows1 = $objDb->query('select count(*) from v_customers_orders')->fetchColumn(); 
								echo $nRows + $nRows1;
			?></h3>Beställningar</div>
							</div>
					    </div>
					     <div class="column">
						    <div class="total">
								 <div class="icon-order"><i class="bar icon"></i></div>
								 <div class="detail"><h3><?php
								 $results = $objDb->prepare("SELECT sum(price) FROM v_orders");
			$results->execute();
			for($i=0; $rows = $results->fetch(); $i++){
			echo $rows['sum(price)'];
			}
			?></h3>Total vinst i SEK</div>


							</div>
					    </div>
				</div>
				
				<div class="ui doubling two column grid">
				
				
					<div class="column">
					
					<div class="ui segment" style="box-shadow: none;">
					
						<h3>Översikt</h3>
						<div class="ui divider"></div>
						
						<script>
						$(function() {
						$('.overview.menu .item').tab();
						});
						</script>
						
						<div class="ui overview secondary pointing menu" style="border-width: 1px;">
						  <a class="green item" data-tab="most-sold-dashboard">
						   Mest sålda
						  </a>
						  <a class="green item" data-tab="most-views-dashboard">
						     Mest visningar
						  </a>
						  <a class="green active item" data-tab="latest-dashboard">
						    Senaste
						  </a>
						</div>
						
						<div class="ui tab" data-tab="most-sold-dashboard">
						Hej
						</div>

						<div class="ui tab" data-tab="most-views-dashboard">
						Hej
						</div>
						
						<div class="ui tab active" data-tab="latest-dashboard">
						
						<table class="ui table stripe" style="border-radius: 0px;">
						
						<tr>
						<thead><th>Status</th><th>Order.nr</th><th>Datum</th><th>Pris</th></thead>
						
						
							<?php if(!empty($orders_dash)) { ?>
							<?php foreach($orders_dash as $ord) {?>
						
						<td>
							<script>
							$(function() {
								$('#selecter<?php echo $ord['order_id']; ?>').change(function(){
									var option = $(this).find('option:selected').val();
									var id = "<?php echo $ord['order_id']; ?>";
									var dataString = 'id='+ id + '&option='+ option;
									
								    $.ajax({
										type: "POST",
										url: "http://valfrimobil.se/admin/update_status.php",
										data: dataString,
										cache: false,
										success: function(html){

										}
									});


								});
								
							});
							</script>
							<select name="status" class="ui compact dropdown" id="selecter<?php echo $ord['order_id']; ?>">
							  	  <option value="1" <?php if($ord['status'] == '1') echo "selected" ?>>Behandlas</option>
							  <option value="2" <?php if($ord['status'] == '2') echo "selected" ?>>Bearbetas</option>
							  <option value="3" <?php if($ord['status'] == '3') echo "selected" ?>>Nekades</option>

							  <option value="4" <?php if($ord['status'] == '4') echo "selected" ?>>Klar</option>
							  <option value="5" <?php if($ord['status'] == '5') echo "selected" ?>>Klar/Betald</option>
							</select>
						</td>
						
						<td><?php echo $ord['order_id']; ?></td><td><?php echo $ord['date']; ?></td><td>435 SEK</td></tr>
						<?php }} ?>
						
						
						
						</table>
						
						
					</div>
					
						
					
					</div>
		
					
					</div>
			<div class="column">
					
					<div class="ui segment" style="box-shadow: none;">
					
						<h3>Nyheter</h3>
						<div class="ui divider"></div>
						
						<p><b>Sidor</b> <i>2015-10-11 15:56</i><br />
						Äntligen sidor! Nu har ni möjlighet att kunna ändra era sidor (Förutom de som generas av systemet, så som upplåsningar-sidan etc). Men det fungerar bra att ändra "hur det fungerar" t.ex. Sen kan ni också skapa en sida. I menyn så länkar ni bara till sidor/sidan-ID.
						</p>


<p><b>Inställningar är nu utseende</b> <i>2015-10-11 11:50</i><br />
						Inställningar sektionen har bytt namn till utseende</p>

<p><b>Nyhetsbrev</b> <i>2015-10-10 23:52</i><br />
						En ny sektion för nyhetsbrev är tillagd och det går bra att skicka nyhetsbrev till alla
</p>


						<p><b>Rabattkod på alla produkter</b> <i>2015-10-10 23:27</i><br />
						Nu finns det möjlighet att kunna lägga till en rabattkod på ALLA produkter
</p>
						
						<p><b>Nya inställningar</b> <i>2015-10-10 23:25</i><br />
						Nu går det att ändra det som finns uppe högst upp på startsidan (Top bar)
- Telefonnummer, öppettider etc
</p>


						<p><b>Länder på upplåsning</b> <i>2015-10-10 23:24</i><br />
						Det finns nu möjlighet till att lägga till ett land till en upplåsning/produkt
						</p>
						
						<p><b>Menyalternativ</b> <i>2015-10-10 23:23</i><br />
						Nu kan ni ändra, lägga till ett nytt menyalternativ
						</p>
					</div>
					
						</div>
					