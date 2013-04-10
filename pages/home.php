<?php

namespace lib;
use lib\Uptime;
use lib\Memory;
use lib\CPU;
use lib\Storage;
use lib\Network;
use lib\Rbpi;

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
        <div class="row-fluid infos">
          <div class="span4">
            <i class="icon-home"></i> <?php echo Rbpi::hostname(); ?>
          </div>
          <div class="span4">
            <i class="icon-map-marker"></i> <?php echo Rbpi::ip(); ?>
          </div>
          <div class="span4">
            <i class="icon-play-circle"></i> Server <?php echo Rbpi::webServer(); ?>
          </div>
        </div>

        <div class="infos">
          <div>
            <i class="icon-time"></i> <?php echo $uptime; ?>
          </div>
        </div>

        <div class="row-fluid">
          <div class="span4 rapid-status">
            <div>
              <i class="icon-asterisk"></i> RAM <?php echo icon_alert($ram['alert']); ?>
            </div>
            <div>
              <i class="icon-refresh"></i> Swap <?php echo icon_alert($swap['alert']); ?>
            </div>
            <div>
              <i class="icon-tasks"></i> CPU <?php echo icon_alert($cpu['alert']); ?>
            </div>
            <div>
              <i class="icon-fire"></i> CPU <?php echo icon_alert($cpu_heat['alert']); ?>
            </div>
          </div>
          <div class="span4 offset4 rapid-status">
            <div>
              <i class="icon-hdd"></i> Storage <?php echo icon_alert($hdd_alert); ?>
            </div>
            <div>
              <i class="icon-globe"></i> Network <?php echo icon_alert($network['alert']); ?>
            </div>
          </div>
        </div>

      </div>
