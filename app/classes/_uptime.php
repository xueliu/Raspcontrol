<?php
	class systemUptime {
		function getSystemUptime(){
		
		 	$uptime = shell_exec("cat /proc/uptime");
			$uptime = explode(" ", $uptime);          
            $init = $uptime[0];
            $hours = floor($init / 3600);
            $minutes = floor(($init / 60) % 60);
            $seconds = $init % 60;
            $uptime = $hours.":".$minutes.":".$seconds;

            
			echo "<img src='app/images/uptime.png' align='middle'>Uptime: <strong>$uptime</strong>";
		}
		}
	
?>
