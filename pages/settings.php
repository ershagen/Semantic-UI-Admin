<?php
session_start();

try {
	$objDb = new PDO('mysql:host=mysql08.citynetwork.se;dbname=111335-valfrimobil', '111335-ve72158', 'Sommar11');
	$objDb->exec('SET CHARACTER SET utf8');
	
} catch(PDOException $e) {
	echo "Något fel hände.."; 
}


?>
	      
<h2>Inställningar</h2>
	    
	     <div class="ui doubling two column grid">
			
				<div class="column">
						    
					<div class="ui segment" style="box-shadow: none;">
			     
							<h3>Maintenance</h3>
							<div class="ui divider"></div>
							<div class="ui form">
							
							<div class="field">
								<label>Meddelande</label>
								<textarea></textarea>
							</div>
							
							<div class="field">
								<input type="submit" class="ui button" />
							</div>
							
							</div>
							
					</div>
				
				</div>
				
				<div class="column">
					
					<div class="ui segment" style="box-shadow: none;">
						<h3>Kunder</h3>
						<div class="ui divider"></div>
						
						<b>Lägg till</b>
						<div class="ui divider"></div>
						
						<i>Standard produkter</i>
						<select multiple="" name="skills" class="ui fluid normal dropdown">
							<option value="">Skills</option>
							<option value="angular">Angular</option>
						</select>

					</div>
									
				</div>
			
	     </div>
