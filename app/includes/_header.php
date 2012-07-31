<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
    <title>Raspcontrol - The Raspberry Pi Control Centre</title>
    <link rel="stylesheet" href="app/styles/style.css" type="text/css" media="screen" charset="utf-8">
    
    <script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-33662683-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>

</head>

<body>
    <div id="topContainer">
        <div class="topWrapper">
            <div style="float: left;&gt;">
               <h1><img src="app/images/snallLogo.png" style="float: left; margin-top: -15px;"> Raspcontrol.</h1>

                <h2>The Raspberry Pi Control Centre</h2>
            </div>

			<?php
				if($_SESSION['username'] == ""){
					
				}else{ ?>
					
					<?php 
					$distroTypeRaw = exec("sudo cat /etc/*-release | grep PRETTY_NAME=", $out); 
					$distroTypeRawEnd = str_ireplace('PRETTY_NAME="', '', $distroTypeRaw);
					$distroTypeRawEnd = str_ireplace('"', '', $distroTypeRawEnd);	
					
					$kernal = exec("sudo uname -mrs");
					?>
					
					<div style="text-align: right; padding-top: 9px; color: #FFFFFF; font-family: Arial; font-size: 14px; float: right; width:500px;">
		                <strong>Hostname:</strong> <?php echo gethostname(); ?> &middot; 
		                <strong>Internal IP:</strong> <?php echo $_SERVER['SERVER_ADDR']; ?><br/>
		                <strong>Accessed From:</strong> <?php echo $_SERVER['SERVER_NAME']; ?> &middot; 
		                <strong>Port:</strong> <?php echo $_SERVER['SERVER_PORT']; ?> &middot; 
		                <strong>HTTP:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?><br/><br/>
		                <?php echo "<strong>Distribution:</strong> ".$distroTypeRawEnd; ?><br/>
		                <?php echo "<strong>Kernal:</strong> ".$kernal; ?>
		            </div>
					
				<?php }
			?>
            
        </div>
    </div>

	<div class="clear"></div>
<?php
	if($_SESSION['username'] == ""){				
	}else{ ?>
			
    <div id="subNavContainer">
        <div class="subNavWrapper">
            
            <a href="" onclick="rebootWarn()"><div class="subNavButton">
            	<div style="float: left; padding-top: 8px; padding-right: 10px;"><img src="app/images/reboot.png"></div> <div style="float: left; padding-top: 8px;">Reboot</div>
            </div></a>
            
            <a href="app/commands/_updatesources.php"><div class="subNavButton">
            	<div style="float: left; padding-top: 8px; padding-right: 10px;"><img src="app/images/sources.png"></div> <div style="float: left; padding-top: 8px;">Update Sources</div>
            </div></a>


				<?php
                if (file_exists("/usr/bin/rpi-update")) { ?>
                    <a href="app/commands/_updatefirmware.php"><div class="subNavButton">
		            	<div style="float: left; padding-top: 8px; padding-right: 10px;"><img src="app/images/updatesources.png"></div> <div style="float: left; padding-top: 8px;">Update Firmware</div>
		    		</div></a>
               <?php } else { ?>
		            <a href="app/commands/_installfirmware.php"><div class="subNavButton">
		            	<div style="float: left; padding-top: 8px; padding-right: 10px;"><img src="app/images/updatesources.png"></div> <div style="float: left; padding-top: 8px;">Install Firmware Updater</div>
		    		</div></a>
                <? }
                ?>
			

        </div>
    </div>

<?php
	}
?>