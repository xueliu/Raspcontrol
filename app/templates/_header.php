<!DOCTYPE html>

<html>
<head>
    <title>Raspcontrol - The Raspberry Pi Control Centre</title>
    <meta charset=utf-8>
    <link rel="stylesheet" href="styles/normalize.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="styles/style.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="styles/menu.css" type="text/css" media="screen" charset="utf-8">
</head>

<body>
  <header>
    <div class="upper">
      <div class="title-box">
        <img src="images/smallLogo.png">
        <h1>Raspcontrol</h1>
        <h2>The Raspberry Pi Control Center</h2>
      </div>
      <?php if(isLoggedIn())
        require '_sysinfo.php'; // show system info
      ?>
    </div>

<?php if(isLoggedIn()) { ?>
    <nav>
      <ul id="menu">
        <li>
          <a href="./">Home</a>
          <ul>
            <li><a href="reboot" onclick="return warnReboot()">Reboot Raspberry Pi</a></li>
          </ul>
        </li>
        <li><a href="updatefirmware">Update Firmware</a>
        <li><a href="updateraspcontrol">Update RaspControl</a>
        <li class="right"><a href="logout">Logout</a>
      </ul>
    </nav>
<?php } ?>

  </header>

<?php if (isset($flash['message'])) { ?>
<div class="message-bar"><?= $flash['message']; ?></div>
<?php } ?>
