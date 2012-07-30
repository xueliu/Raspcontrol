<?php
class usersLoggedIn{
	function getusersLoggedIn() {
	$whoUsersType = shell_exec("sudo users");	
	$whoUsersFormatted = str_replace(" ", " &middot ", $whoUsersType);
	?>

	
	
	<div class="userIcon">
		  	<img src='app/images/user.png' align='middle'>
		  </div> 
		  
		  <div class="userTitle">
		  	Active Users
		  </div>
		  
		  <div class="userText">
			<strong> <?php echo $whoUsersFormatted; ?>
		  </div>
	
	
	
<?php
}
}

?>