<?php
	class cpuLoad {
		function getCpuLoad(){
		
		  $getLoad = sys_getloadavg();
		  
		  $rawCPUSpeed = shell_exec('cat /proc/cpuinfo | grep BogoMIPS');
		  $cpuSpeed = str_replace("BogoMIPS	: ", "", "$rawCPUSpeed");
		  
          if ($getLoad[0] > 1) {
              $warning = "<font color=\"red\"> (Warning)</font>";
          } else {
              $warning = "<font color=\"green\"> (OK)</font>";
          } 
          ?>
		  
		  <div class="cpuIcon">
		  	<img src='app/images/cpu.png' align='middle'>
		  </div> 
		  
		  <div class="cpuTitle">
		  	CPU <?php echo $warning ?>
		  </div>
		  
		  <div class="cpuText">
			  Loads: 1 Min: <strong> <?php echo $getLoad[0]; ?> </strong> &middot
			  5 Mins: <strong><?php echo $getLoad[1]; ?> </strong> &middot
			  15 Mins: <strong><?php echo $getLoad[2]; ?> </strong> <br/><br/> CPU is running at <strong><?php echo $cpuSpeed; ?> MHz</strong>
		  </div>
<?php		
		}
		}
	
?>
