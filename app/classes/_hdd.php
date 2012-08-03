<?php
	class hddPercentage {
		function freeStorage(){
				    
			    $bytes = disk_free_space("."); 
			    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
			    $base = 1024;
			    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
			    $free =  sprintf('%1.2f' , $bytes / pow($base,$class));
				
				
				
			    $bytes = disk_total_space("."); 
			    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
			    $base = 1024;
			    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
			    $total = sprintf('%1.2f' , $bytes / pow($base,$class));
		    
			
				
				$used = $total - $free;
				$percentage = round($used / $total * 100);
				
				if($percentage > '80'){
			    $warning = "<img src=\"app/images/warning.png\" height=\"18\" />";
			    $bar = "barAmber";
	          } else {
	            $warning = "<img src=\"app/images/ok.png\" height=\"18\" />";
	            $bar = "barGreen";
	          } 
				?>
			
				<div class="sdIcon">
					<img src="app/images/sd.png" align="middle"> 
				</div>
				
				<div class="sdTitle">
					SD Card <?php echo $warning ?>
				</div>
				
				<div class="sdText">
					<div class="graph">
						<strong class="<?php echo $bar; ?>" style="width:<?php echo $percentage ?>%;"><?php echo $percentage ?>%</strong>
				</div>
				
				<div class="clear"></div>
				
				<br/>
				
				Total: <strong><?php echo $total ?></strong> GB &middot
				Free: <strong><?php echo $free ?></strong> GB
				
				</div>
						
				<div class="clear"></div>
			
				
				
				
				
<?php				
		}
		}
?>
