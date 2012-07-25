<?php
/*
function networkUsage() {
    $string = exec("sudo ifconfig eth0 | grep RX\ bytes", $out);
    $string = str_ireplace("RX bytes:", "", $string);
    $string = str_ireplace("TX bytes:", "", $string);
    $string = trim($string);
    $string = explode(" ", $string);
    $out['rx'] = ($string[0] / 1024 / 1024);
    $out['rx'] = round($out['rx'], 2);
    $out['tx'] = ($string[4] / 1024 / 1024);
    $out['tx'] = round($out['tx'], 2);
    return $out;
}
 * */
 
?>

<?php
class network{
	function networkUsage() {
    $string = exec("sudo ifconfig eth0 | grep RX\ bytes", $out);
    $string = str_ireplace("RX bytes:", "", $string);
    $string = str_ireplace("TX bytes:", "", $string);
    $string = trim($string);
    $string = explode(" ", $string);
    $rxRaw = $string[0] / 1024 / 1024;
    $txRaw = $string[4] / 1024 / 1024;
	$rx = round($rxRaw, 2)." ";
	$tx = round($txRaw, 2);
	$totalRxTx = $rx + $tx;
	?>
	
	
	<div class="networkIcon">
		  	<img src='app/images/network.png' align='middle'>
		  </div> 
		  
		  <div class="networkTitle">
		  	Network <?php echo $warning ?>
		  </div>
		  
		  <div class="networkText">
			  Received: <strong><?php echo $rx; ?> MB</strong> &middot Sent: <strong><?php echo $tx; ?> MB</strong> &middot Total: <strong><?php echo $totalRxTx; ?> MB</strong>
		  </div>
	
	
	
<?php
}
}

?>