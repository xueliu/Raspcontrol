<?php
session_start();

if($_SESSION['username'] == ""){
	die("You are not logged in");
}

echo '<pre>';

// Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
$last_line = system('sudo apt-get -y upgrade', $retval);

// Printing additional info
echo '
</pre>'; ?>
Packages Upgraded!<br/>
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Return To Previous Page</a>
