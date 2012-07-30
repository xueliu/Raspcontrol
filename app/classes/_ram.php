<?php
	class ramPercentage {
		function freeMemory(){
		    exec('free -mo', $out);
		    preg_match_all('/\s+([0-9]+)/', $out[1], $matches);
		    list($total, $used, $free, $shared, $buffers, $cached) = $matches[1];

			$percentage = round(($used) / $total * 100);
			
			if($percentage > '80'){
			    $warning = "<font color=\"red\"> (Warning)</font>";
			    $bar = "barAmber";
	          } else {
	            $warning = "<font color=\"green\"> (OK)</font>";
	            $bar = "barGreen";
	          } 
	          ?>
		
		
				<div class="ramIcon">
					<img src="app/images/memory.png" align="middle">
				</div>
				
				<div class="ramTitle">
					 Memory <?php echo $warning; ?>
				</div>
				
				<div class="ramText">
					<div class="graph">
						<strong class="<?php echo $bar; ?>" style="width:<?php echo $percentage; ?>%;"><?php echo $percentage; ?>%</strong>
					</div> 
					
					<div class="clear"></div>
					
					<br/>
					
					Free: <strong><?php echo ($free + $buffers + $cached); ?> MB</strong> Used: <strong><?php echo ($used - $buffers - $cached); ?> MB</strong> &middot Total: <strong><?php echo $total; ?> MB</strong><br/></div>
				
				
				<div class="clear"></div>
				
	<?php
		}

		function freeSwap(){
		    exec('free -mo', $out);
		    preg_match_all('/\s+([0-9]+)/', $out[2], $matches);
		    list($total, $used, $free) = $matches[1];
		    
		    $percentage = round($used / $total * 100);

			if($percentage > '80'){
			    $warning = "<font color=\"red\"> (Warning)</font>";
			    $bar = "barAmber";
	          } else {
	            $warning = "<font color=\"green\"> (OK)</font>";
	            $bar = "barGreen";
	          } 
	          ?>
		
		
				<div class="swapIcon">
					<img src="app/images/swap.png" align="middle">
				</div>
				
				<div class="swapTitle">
					 Swap <?php echo $warning; ?>
				</div>
				
				<div class="swapText">
					<div class="graph">
						<strong class="<?php echo $bar; ?>" style="width:<?php echo $percentage; ?>%;"><?php echo $percentage; ?>%</strong>
					</div> 
					
					<div class="clear"></div>
					
					<br/>
					
					Free: <strong><?php echo ($free + $buffers + $cached); ?> MB</strong> Used: <strong><?php echo ($used - $buffers - $cached); ?> MB</strong> &middot Total: <strong><?php echo $total; ?> MB</strong>
					
				</div>
				
				
				<div class="clear"></div>
				
<?php
		}
		}
	
?>
