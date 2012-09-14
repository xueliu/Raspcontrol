<?php

// ----------------------------
// GENERAL INFO
// ----------------------------

/**
 * Fetches the distribution name.
 *
 * @return string The pretty name of the distribution.
 */
function getDistribution() {
  $distroTypeRaw = exec("sudo cat /etc/*-release | grep PRETTY_NAME=", $out);
  $distroTypeRawEnd = str_ireplace('PRETTY_NAME="', '', $distroTypeRaw);
  return str_ireplace('"', '', $distroTypeRawEnd);
}

/**
 * Returns the verision of the kernel.
 *
 * @return string The kernel version.
 */
function getKernelVersion() {
  return exec("uname -mrs");
}

/**
 * Returns the firmware.
 *
 * @return string The firmware.
 */
function getFirmware() {
  return exec("uname -v");
}

/**
 * Returns the time the system is running.
 *
 * @return string Seconds the system is running.
 */
function getUptime() {
  $uptime = shell_exec("cat /proc/uptime");
	$uptime = explode(" ", $uptime);
  return $uptime[0];
}


// ----------------------------
// CPU
// ----------------------------

/**
 * Returns the CPU speed (BogoMIPS).
 *
 * @return string The CPU speed.
 */
function getCpuSpeed() {
  $raw = shell_exec('cat /proc/cpuinfo | grep BogoMIPS');
  return str_replace("BogoMIPS	: ", "", $raw);
}

/**
 * Returns the average load on the system.
 *
 * @return array (double) with the 3 loads: over the last 1, 5 and 15 minutes.
 */
function getAverageLoad() {
  return sys_getloadavg();
}

// ----------------------------
// RAM
// ----------------------------

/**
 * Returns information about RAM and RAM usage.
 *
 * @return array Associative array containing the following
 *    keys: 'total', 'used', 'free', 'shared', 'buffers', 'cached'.
 *    They are all strings.
 */
function getRamInfo() {
  exec('free -mo', $out);
  echo $out;
  preg_match_all('/\s+([0-9]+)/', $out[1], $matches);
  return array(
    'total' => $matches[1][0],
    'used' => $matches[1][1],
    'free' => $matches[1][2],
    'shared' => $matches[1][3],
    'buffers' => $matches[1][4],
    'cached' => $matches[1][5],
  );
}


// ----------------------------
// SWAP
// ----------------------------

/**
 * Returns information about SWAP memory.
 *
 * @return array An associative array containing the
 *    keys 'total', 'used', 'free' (strings) in MB.
 */
function getSwapInfo() {
  exec('free -mo', $out);
  preg_match_all('/\s+([0-9]+)/', $out[2], $matches);
  return array(
    'total' => $matches[1][0],
    'used' => $matches[1][1],
    'free' => $matches[1][2]
  );
}


// ----------------------------
// HDD
// ----------------------------

/**
 * Returns information about mounted filesystems.
 *
 * @return array
 */
function getHddInfo() {
  exec('df -hT | grep -vE "tmpfs|rootfs|Filesystem"', $drives);
  $info = array();
  foreach ($drives as $drive) {
    $drive = preg_replace('!\s+!', ' ', $drive);
    preg_match_all('/\S+/', $drive, $drivedetails);

    array_push($info, array(
      'fs' => $drivedetails[0][0],
      'type' => $drivedetails[0][1],
      'size' => $drivedetails[0][2],
      'used' => $drivedetails[0][3],
      'available' => $drivedetails[0][4],
      'percentage' => rtrim($drivedetails[0][5], '%'),
      'mounted' => $drivedetails[0][6]
    ));
  }
  return $info;
}


// ----------------------------
// NETWORK
// ----------------------------

/**
 * Returns information about the network.
 *
 * @return array An associative array containing the
 *    keys 'received', 'sent', 'total' (all in MB) and 'connections'.
 */
function getNetworkInfo() {
  // Network type
  $netInfo = shell_exec("ifconfig");
  $netInfoRaw = explode(" ", $netInfo);
  $netTypeFormatted = str_replace("encap:", "", $netInfoRaw);

  $dataThroughput = exec("sudo ifconfig eth0 | grep RX\ bytes", $out);
  $dataThroughput = str_ireplace("RX bytes:", "", $dataThroughput);
  $dataThroughput = str_ireplace("TX bytes:", "", $dataThroughput);
  $dataThroughput = trim($dataThroughput);
  $dataThroughput = explode(" ", $dataThroughput);

  $rxRaw = $dataThroughput[0] / 1024 / 1024;
  $txRaw = $dataThroughput[4] / 1024 / 1024;
  $rx = round($rxRaw, 2)." ";
  $tx = round($txRaw, 2);
  $totalRxTx = $rx + $tx;

  $totalConnections = shell_exec("netstat -nta --inet | wc -l");
  $totalConnections--; // do not count the table header line

  return array(
    'type' => $netTypeFormatted,
    'received' => $rx,
    'sent' => $tx,
    'total' => $totalRxTx,
    'connections' => $totalConnections
  );
}


// ----------------------------
// USERS
// ----------------------------

/**
 * Returns all active users returned by the 'who' command.
 *
 * @return array An array containing associative arrays with the user data:
 *    'name', 'ip' and 'login' for the login date.
 */
function getActiveUsers() {
  $who = shell_exec('who');
  $users = array();

  foreach(explode("\n", $who) as $user) {
    $line = preg_replace("/ +/", " ", $line); // remove multiple spaces

    if (strlen($line) > 0) {
      $rawInfo = explode(" ", $line);
      array_push($users, array(
        'name' => $rawInfo[0],
        'login' => $rawInfo[4],
        'ip' => $rawInfo[5]
      ));
    }

  }

  return $users;
}
