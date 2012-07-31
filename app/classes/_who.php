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
		  	<?php if($whoUsersFormatted == ""){
		  		echo "<strong>No users logged in</strong>";
		  	}else{
		  		echo "<strong>$whoUsersFormatted</strong>";
		  	}
			?>
		  </div>
	
	
	
<?php
}
}

?>