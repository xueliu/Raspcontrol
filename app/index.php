<?php
//session_start();

$filename = '/etc/raspcontrol/database.aptmnt';

if (file_exists($filename)) {
		session_start();

		if($_SESSION['username'] != "")
                {
			require('main.php'); 
			die;
		}

		require('_lib/includes/_header.php');
		require('_lib/classes/_login.php'); 
?>

	    <div id="firstBlockContainer">
	        <div class="firstBlockWrapper">
	        	
	        	<div style="padding-top: 20px;">
	        	<center>
	        		Please login to Raspcontrol!<br/><br/>
		        	<form name="login" method="post" action="index.php">
		        		<input type="text" name="username" class="loginForm" placeholder="Username" />
		        		<input type="password" name="password" class="loginForm" placeholder="Password" /><br/>
		        		<input type="submit" value="Login" name="login" class="minimal" />
		        		
		        		<br/><br/>
		        		
		        		<?php if($wrong == 1){
			        		echo "<font color='red'>Incorrect Username/Password</font>";
		        		}
		        		?>
		        		
		        	</form>
		        	
		        	<br/><br/>
		        	Raspcontrol has been drastically improved! &middot <a href="https://github.com/Bioshox/Raspcontrol/blob/master/README.md" target="_blank">Find out more</a> 
		        	
	        	</center>
	        	</div>
	        	
	       	</div>
	       	<br/><br/><br/>
	    </div>

<?php    
	} else {
	require('_lib/includes/_header.php');
?>

	<div id="firstBlockContainer">
	        <div class="firstBlockWrapper">
	        	<strong>Raspcontrol Installation</strong>
			<br/><br/>	
				<center>Please choose a username and password to login with<br/><br/>
		        	<form name="setup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		        		<input type="text" name="username" class="loginForm" onfocus="if(this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}" value="Username">
		        		<input type="password" name="password" class="loginForm" onfocus="if(this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}" value="Password"><br/>
		        		<input type="submit" value="Create Account" name="setup" class="minimal">
		        		
		        		
		        		</center>
				<br/><br/><br/><br/>
				</form>
			</div>
	</div>
	
<?php
}

require('_lib/includes/_footer.php'); 
