<?php
	class cpuLoad {
		function getCpuLoad(){

		  $getLoad = sys_getloadavg();

		  $rawCPUSpeed = shell_exec('cat /proc/cpuinfo | grep BogoMIPS');
		  $cpuSpeed = str_replace("BogoMIPS	: ", "", "$rawCPUSpeed");

                  $fh = fopen("/sys/devices/system/cpu/cpu0/cpufreq/cpuinfo_min_freq", 'r');
                  $cpuMinFreq = round(fgets($fh) / 1000) . "MHz";
                  fclose($fh);

                  $fh = fopen("/sys/devices/system/cpu/cpu0/cpufreq/cpuinfo_max_freq", 'r');
                  $cpuMaxFreq = round(fgets($fh) / 1000) . "MHz";
                  fclose($fh);

		  $fh = fopen("/sys/devices/system/cpu/cpu0/cpufreq/scaling_governor", 'r');
                  $cpuFreqGovernor = fgets($fh);
                  fclose($fh);

          if ($getLoad[0] > 1) {
              $warning = "<img src=\"_lib/images/warning.png\" height=\"18\" />";
          } else {
              $warning = "<img src=\"_lib/images/ok.png\" height=\"18\" />";
          }
          ?>

		  <div class="cpuIcon">
		  	<img src='_lib/images/cpu.png' align='middle'>
		  </div>

		  <div class="cpuTitle">
		  	CPU 
		  </div>

		  <div class="cpuWarning">
		  	<?php echo $warning ?>
		  </div>

		  <div class="cpuText">
			  Loads: 1 Min: <strong> <?php echo $getLoad[0]; ?> </strong> &middot
			  5 Mins: <strong><?php echo $getLoad[1]; ?> </strong> &middot
			  15 Mins: <strong><?php echo $getLoad[2]; ?> </strong> <br/><br/> CPU booted at <strong><?php echo $cpuSpeed; ?> MHz</strong><br/><br/>
			  Min: <strong><?php echo $cpuMinFreq; ?> </strong> Max: <strong><?php echo $cpuMaxFreq; ?> </strong>  <strong><?php echo $cpuFreqGovernor; ?> </strong> 
		  </div>
<?php
		}
		}
