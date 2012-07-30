<?php session_start();

if($_SESSION['username'] == ""){
	require('index.php'); 
	die;
}

?>

<?php 	
	require('app/classes/_ram.php'); 
	require('app/classes/_hdd.php'); 
	require('app/classes/_cpu.php'); 
	require('app/classes/_uptime.php'); 
	require('app/includes/_header.php'); 
    require('app/classes/_network.php');
	require('app/classes/_who.php');
	require('app/classes/_versionCheck.php'); 
            
?>

    <div id="firstBlockContainer">
        <div class="firstBlockWrapper">
        	
        	<?php $versionCheck = new versionCheck; $checkVersion = $versionCheck->checkVersion(); ?>

			<?php $uptime = new systemUptime; $getSystemUptime = $uptime->getSystemUptime();?>
        	
        	<div class="clear"></div>
        	
        	<br/><br/>

	        <?php $load = new cpuLoad; $getLoad = $load->getCpuLoad();?>
        	
        	<div class="clear"></div>
        	
        	<br/><br/>
        	
        	<?php $ram = new ramPercentage; $percentage = $ram->freeMemory(); $percentage = $ram->freeSwap();?>
        	
        	<div class="clear"></div>
        	
        	<br/><br/>

        	<?php $hdd = new hddPercentage; $storagepercentage = $hdd->freeStorage();?>
        	
        	<div class="clear"></div>
        	
        	<br/><br/>        	
            
            <?php //$net = networkUsage(); echo "Received: ".$net['rx']." Megabytes Sent: ".$net['tx']." Megabytes Total: ".($net['rx']+$net['tx'])." Megabytes"; ?>
            <?php $network = new network; $networkUseage = $network->networkUsage(); ?>

            <div class="clear"></div>
        	
        	<br/><br/>

        	<?php $users = new usersLoggedIn; $getusers = $users->getusersLoggedIn();?>
       	</div>
       	<br/><br/>
    </div>
    
    <?php require('app/includes/_footer.php'); ?>
    
   <script type="text/javascript">
	<!--
	function rebootWarn() {
		var answer = confirm("WARNING: This will make your Raspberry Pi temporarily unavailable, it may also connect back to the network with a different IP.")
		if (answer){
			alert("Rebooting...!")
			window.location = "app/commands/_reboot.php";
		}
		else{
			alert("Reboot Aborted")
		}
	}
	//-->
	</script>
