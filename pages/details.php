<?php

namespace lib;
use lib\Uptime;
use lib\Memory;
use lib\CPU;
use lib\Storage;
use lib\Network;
use lib\Rbpi;
use lib\Users;

$uptime = Uptime::uptime();
$ram = Memory::ram();
$swap = Memory::swap();
$cpu = CPU::cpu();
$cpu_heat = CPU::heat();
$hdd = Storage::hdd();
$net_connections = Network::connections();
$net_eth = Network::ethernet();
$users = Users::connected();

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
  echo '"></i>';
}

?>

      <div class="container details">
        <table>
          <tr id="check-system">
            <td class="check"><i class="icon-cog"></i> System</td>
            <td class="icon"></td>
            <td class="infos">
              hostname: <span class="text-info"><?php echo Rbpi::hostname(true); ?></span>
              <br />distribution: <span class="text-info"><?php echo Rbpi::distribution(); ?></span>
              <br />kernel: <?php echo Rbpi::kernel(); ?>
              <br />firmware: <?php echo Rbpi::firmware(); ?>
            </td>
          </tr>

          <tr id="check-uptime">
            <td class="check"><i class="icon-time"></i> Uptime</td>
            <td class="icon"></td>
            <td class="infos"><?php echo $uptime; ?></td>
          </tr>
          
          <tr id="check-ram">
            <td class="check"><i class="icon-asterisk"></i> RAM</td>
            <td class="icon"><?php echo icon_alert($ram['alert']); ?></td>
            <td class="infos">
              <div class="progress">
                <div class="bar bar-<?php echo $ram['alert']; ?>" style="width: <?php echo $ram['percentage']; ?>%;"><?php echo $ram['percentage']; ?>%</div>
              </div>
              free: <span class="text-success"><?php echo $ram['free']; ?>Mb</span>  &middot; used: <span class="text-warning"><?php echo $ram['used']; ?>Mb</span> &middot; total: <?php echo $ram['total']; ?>Mb
            </td>
          </tr>
          
          <tr id="check-swap">
            <td class="check"><i class="icon-refresh"></i> Swap</td>
            <td class="icon"><?php echo icon_alert($swap['alert']); ?></td>
            <td class="infos">
              <div class="progress">
                <div class="bar bar-<?php echo $swap['alert']; ?>" style="width: <?php echo $swap['percentage']; ?>%;"><?php echo $swap['percentage']; ?>%</div>
              </div>
              free: <span class="text-success"><?php echo $swap['free']; ?>Mb</span>  &middot; used: <span class="text-warning"><?php echo $swap['used']; ?>Mb</span> &middot; total: <?php echo $swap['total']; ?>Mb
            </td>
          </tr>

          <tr id="check-cpu">
            <td class="check"><i class="icon-tasks"></i> CPU</td>
            <td class="icon"><?php echo icon_alert($cpu['alert']); ?></td>
            <td class="infos">
              loads: <?php echo $cpu['loads']; ?> [1 min] &middot; <?php echo $cpu['loads5']; ?> [5 min] &middot; <?php echo $cpu['loads15']; ?> [15 min]
              <br />running at <span class="text-info"><?php echo $cpu['current']; ?></span> (min: <?php echo $cpu['min']; ?>  &middot;  max: <?php echo $cpu['max']; ?>)
              <br />governor: <strong><?php echo $cpu['governor']; ?></strong>
            </td>
          </tr>

          <tr id="check-cpu-heat">
            <td class="check"><i class="icon-fire"></i> CPU</td>
            <td class="icon"><?php echo icon_alert($cpu_heat['alert']); ?></td>
            <td class="infos">
              <div class="progress">
                <div class="bar bar-<?php echo $cpu_heat['alert']; ?>" style="width: <?php echo $cpu_heat['percentage']; ?>%;"><?php echo $cpu_heat['percentage']; ?>%</div>
              </div>
              heat: <span class="text-info"><?php echo $cpu_heat['degrees']; ?>°C</span>
            </td>
          </tr>

          <tr class="storage" id="check-storage">
            <td class="check" rowspan="<?php echo sizeof($hdd); ?>"><i class="icon-hdd"></i> Storage</td>
            <?php
              for ($i=0; $i<sizeof($hdd); $i++) {
                echo '<td class="icon" style="padding-left: 10px;">', icon_alert($hdd[$i]['alert']), '</td>
            <td class="infos">
              <i class="icon-folder-open"></i> ', $hdd[$i]['name'] , '
              <div class="progress">
                <div class="bar bar-', $hdd[$i]['alert'], '" style="width: ', $hdd[$i]['percentage'], '%;">', $hdd[$i]['percentage'], '%</div>
              </div>
              free: <span class="text-success">', $hdd[$i]['free'], 'b</span> &middot; used: <span class="text-warning">', $hdd[$i]['used'], 'b</span> &middot; total: ', $hdd[$i]['total'], 'b &middot; format: ', $hdd[$i]['format'], '
            </td>
          </tr>
          ', ($i == sizeof($hdd)-1) ? null : '<tr class="storage">';
              }
            ?>

          <tr id="check-network">
            <td class="check"><i class="icon-globe"></i> Network</td>
            <td class="icon"><?php echo icon_alert($net_connections['alert']); ?></td>
            <td class="infos">
              IP: <span class="text-info"><?php echo Rbpi::ip(); ?></span> [internal]
              <br />received: <strong><?php echo $net_eth['down']; ?>Mb</strong> &middot; sent: <strong><?php echo $net_eth['up']; ?>Mb</strong> &middot; total: <?php echo $net_eth['total']; ?>Mb
              <br />connections: <?php echo $net_connections['connections']; ?>
            </td>
          </tr>

          <tr id="check-users">
            <td class="check"><i class="icon-user"></i> Active users</td>
            <td class="icon"><span class="badge"><?php echo sizeof($users); ?></span></td>
            <td class="infos">
              <?php
                for ($i=0; $i<sizeof($users); $i++) 
                  echo '<span class="text-info">', $users[$i]['user'] ,'</span> since ', $users[$i]['date'], 'at', $users[$i]['hour'], ' from <strong>', $users[$i]['ip'] ,'</strong> ', $users[$i]['dns'], ($i == sizeof($users)-1) ? null : '<br /><br />';
              ?>
            </td>
          </tr>

        </table>
      </div>
