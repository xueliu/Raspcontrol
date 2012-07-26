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
                <h1>Raspcontrol.</h1>

                <h2>The Raspberry Pi Control Centre</h2>
            </div>

			<?php
				if($_SESSION['username'] == ""){
					
				}else{ ?>
					
					<div style="text-align: right; padding-top: 15px; color: #FFFFFF; font-family: Arial; font-size: 14px; float: right; width:500px;">
		                Hostname: <?php echo gethostname(); ?> &middot; Internal IP: <?php echo $_SERVER['SERVER_ADDR']; ?><br>
		                Accessed From: <?php echo $_SERVER['SERVER_NAME']; ?> &middot; Port <?php echo $_SERVER['SERVER_PORT']; ?> &middot; System: <?php echo $_SERVER['SERVER_SOFTWARE']; ?><br/>
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