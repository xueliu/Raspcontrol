<?php

namespace lib;
use lib\Uptime;
use lib\Memory;
use lib\CPU;
use lib\Storage;
use lib\Network;

$uptime = Uptime::uptime();
$ram = Memory::ram();
$swap = Memory::swap();
$cpu = CPU::cpu();
$cpu_heat = CPU::heat();
$hdd = Storage::hdd();
$hdd_alert = 'success';
for ($i=0; $i<sizeof($hdd); $i++) {
  if ($hdd[$i]['alert'] == 'warning')
    $hdd_alert = 'warning';
}
$network = Network::network();

function icon_alert($alert) {
  echo '<i class="icon-';
  switch($alert) {
    case 'success':
      echo 'ok';
      break;
    case 'warning':
      echo 'warning-sign';
      break;
    default:
      echo 'exclamation-sign';
  }
  echo ' pull-right"></i>';
}

?>

      <div class="container home">
        <div class="row-fluid">
          <div class="span10">
            <i class="icon-time"></i> Uptime <?php echo $uptime; ?>
          </div>
        </div>

        <div class="row-fluid">
          <div class="span2">
            <i class="icon-asterisk"></i> RAM <?php echo icon_alert($ram['alert']); ?>
          </div>
          <div class="span2 offset1">
            <i class="icon-refresh"></i> Swap <?php echo icon_alert($swap['alert']); ?>
          </div>
          <div class="span2 offset1">
            <i class="icon-tasks"></i> CPU <?php echo icon_alert($cpu['alert']); ?>
          </div>
          <div class="span2 offset1">
            <i class="icon-fire"></i> CPU <?php echo icon_alert($cpu_heat['alert']); ?>
          </div>
        </div>

        <div class="row-fluid">
          <div class="span2">
            <i class="icon-hdd"></i> Storage <?php echo icon_alert($hdd_alert); ?>
          </div>
          <div class="span2 offset1">
            <i class="icon-globe"></i> Network <?php echo icon_alert($network['alert']); ?>
          </div>
        </div>

      </div>
