<?php
session_start();

require '../Slim/Slim.php';
require 'lib/auth.php';

// constants
define('HOME', dirname(__FILE__));

// init Slim framework
$app = new Slim();
$app->config('templates.path', '../app/templates');

// Simple authenication middleware
$authenticate = function () {
  if (!isLoggedIn()) {
    Slim::getInstance()->flash('message', 'Login required!');
    Slim::getInstance()->redirect('/Raspcontrol/public/login');
  }
};

// Load info stubs if necessary
if(php_uname('s') === 'Linux') {
  require 'lib/info.php';
} else {
  $app->flashNow('message', 'Warning: Using stubs for system information!');
  require 'lib/info-stub.php';
}

// ------------
// HOME
// ------------
$app->get('/', $authenticate, function() use ($app) {
  require 'lib/util.php';
  $app->render('index.php');
});

// ------------
// LOGIN
// ------------
$app->get('/login', function() use ($app) {
  if (!isAuthSetup()) {
    $app->redirect('setup');
  }

  $app->render('login.php');
});

$app->post('/login', function() use ($app) {
  $req = $app->request();

  if ($req->post("username") != null && $req->post("password") != null) {
    if (login($req->post("username"), $req->post("password"))) {
      $app->flash('message', 'Login succeeded.');
      $app->redirect('/');
    } else {
      $app->flashNow('message', 'Username or password were not correct!');
      $app->render('login.php');
    }
  }
});

// ------------
// LOGOUT
// ------------
$app->get('/logout', $authenticate, function() use ($app) {
  logout();
  $app->flash('message', 'Logged out.');
  $app->redirect('login');
});

// ------------
// SETUP
// ------------
$app->get('/setup', function() use ($app) {
  // if RaspControl is already setup, you need to be logged in
  // to change your password.
  if (isAuthSetup()) {
    $authenticate();
  }

  $app->render('setup.php');
});

$app->post('/setup', function() use ($app) {
  $req = $app->request();

  if (isAuthSetup()) {
    $authenticate();
  }
  
  if ($req->post("username") != null && $req->post("password") != null) {
    setup_auth($req->post("username"), $req->post("password"));
    $app->flash('message', 'Successfully set your new password. Please log in now.');
    $app->redirect('login');
  }

  $app->redirect('setup');
});

// ------------
// COMMANDS
// ------------
$app->get('/reboot', $authenticate, function() use ($app) {
  require 'lib/commands.php';

  $app->render('command.php', array(
    'message' => 'Now rebooting!'
  ));

  reboot();
});

$app->get('/updatefirmware', $authenticate, function() use ($app) {
  require 'lib/commands.php';

  $app->render('command.php', array(
    'message' => 'Updating Firmware!'
  ));

  updateFirmware();
});

$app->get('/updateraspcontrol', $authenticate, function() use ($app) {
  require 'lib/commands.php';

  $app->render('command.php', array(
    'message' => 'Updating RaspControl!'
  ));

  updateRaspControl();
});


// now run
$app->run();

