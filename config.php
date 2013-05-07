<?php

/*
 * To enable URL rewriting, please set the $rewriting variable on 'true'
 *
 * If you are running Apache:
 * - ensure that the rewrite module is enabled (if not, enable it with the command 'a2enmod rewrite')
 * - ensure your vhost configuration file has the line 'AllowOverride All'
 * - ensure you have uncommented lines on the .htaccess file
 *
 * If you are running Nginx, you have to add some rules as described on https://github.com/nicolabricot/Raspcontrol/issues/4
 */
$rewriting = false;

/*
 * Do NOT change the following lines
 */
error_reporting(0);
define('INDEX', './');
define('LOGIN', 'login.php');
define('FILE_PASS', '/etc/raspcontrol/database.aptmnt');

if ($rewriting) {
  define('LOGOUT', './logout');
  define('DETAILS', './details');
}
else {
  define('LOGOUT', './login.php?logout');
  define('DETAILS', './?page=details');
}

?>