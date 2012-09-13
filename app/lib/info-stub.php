<?php

// Stub for info functions, for example
// for development on Windows

function getDistribution() {
  return "Raspbian";
}

function getKernelVersion() {
  return "Linux 1.2.3";
}

function getFirmware() {
  return "Firmware 1.2.3";
}

function getUptime() {
  return 123456;
}

function getCpuSpeed() {
  return 697.95;
}

function getAverageLoad() {
  return array(
    0.01, 0.02, 0.03
  );
}

function getRamInfo() {
  return array(
    'total' => 185,
    'used' => 49,
    'free' => 135,
    'shared' => 0,
    'buffers' => 9,
    'cached' => 25,
  );
}

function getSwapInfo() {
  return array(
    'total' => 99,
    'used' => 0,
    'free' => 99
  );
}

function getHddInfo() {
  return array(
    array(
      'fs' => "fs",
      'type' => "type",
      'size' => "29.20 G",
      'used' => "3.55 G",
      'available' => "25.65 G",
      'percentage' => "12",
      'mounted' => "SD Card"
    ),
  );
}

function getNetworkInfo() {
  return array(
    'type' => 'Ethernet',
    'received' => 19.3,
    'sent' => 178.61,
    'total' => 197.91,
    'connections' => 16
  );
}

function getActiveUsers() {
  return array(
    array(
      'name' => 'pi',
      'login' => 'pts/0',
      'ip' => 'host81-149-36-22'
    )
  );
}
