<?php

session_start();

require 'config.php';

// logout
if (isset($_GET['logout'])) {
  unset($_SESSION['authentificated']);
  session_destroy();
}

// check identification
else if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  $db = json_decode(file_get_contents("/etc/raspcontrol/database.aptmnt"));
  $username = $db->{'user'};
  $password = $db->{'password'};
  /*
  $username = 'test';
  $password = 'test';
  */
  if ($_POST['username'] == $username && $_POST['password'] == $password) {
    $_SESSION['authentificated'] = true;
  }
}

header('Location: '.INDEX);
exit();

?>