<?php
session_start();

if($_SESSION['username'] == ""){
	die("You are not logged in");
}

if(isset($_POST['location'])){
	echo '<pre>';

$last_line = system('if [ ! -d /usr/lib/git-core ]; then sudo apt-get -y install git-core;fi && sudo git clone https://github.com/Bioshox/Raspcontrol.git '.$_POST["location"].'Update && sudo rm -R -f '.$_POST["location"].' && sudo mv '.$_POST["location"].'Update '.$_POST["location"].'', $retval);
// Printing additional info
echo '
</pre>'; ?>
Raspcontrol updated!<br/>
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Return To Previous Page</a>
<?php
}else{
?>

Please enter the full path to where Raspcontrol is installed. (E,g: /var/www/Raspcontrol)<br/><br/>
<form action="" method="post">
	<input type="text" name="location">
	<input type="submit" value="Update!">
</form>

<?php
}
?>