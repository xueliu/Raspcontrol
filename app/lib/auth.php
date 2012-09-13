<?php
require 'password.php';

function setup_auth($username, $password) {
  shell_exec('sudo chown root:root /etc/raspcontrol');
  shell_exec('sudo chmod 0777 /etc/raspcontrol');
  shell_exec('sudo touch /etc/raspcontrol/settings.json');
  shell_exec('sudo chown root:root /etc/raspcontrol/settings.json');
  shell_exec('sudo chmod 0777 /etc/raspcontrol/settings.json');
  
  $path = "/etc/raspcontrol/settings.json";
  $file = fopen($path, 'w') or die("can't open file");

  $data = '{
  "user": "' . $username .'",
  "password": "' . $password .'"
  }';
  
  fwrite($file, $data); 
}

function isAuthSetup() {
  return file_exists("/etc/raspcontrol/settings.json");
}

function login($username, $password) {
	$handle = file_get_contents("/etc/raspcontrol/settings.json");
  $db = json_decode($handle);

  if ($username == $db->{'pi'} && password_verify($password, $db->{'password'})) {
    $_SESSION["isLoggedIn"] = true;
    return true;
  }
  return false;
}

function isLoggedIn() {
  return isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"];
}

function logout() {
  $_SESSION['isLoggedIn'] = false;
}
