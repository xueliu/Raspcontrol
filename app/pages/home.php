<?php

namespace lib;
use lib\Uptime;
use lib\Memory;
use lib\CPU;
use lib\Storage;

$uptime = Uptime::uptime();
$ram = Memory::ram();
$swap = Memory::swap();
$cpu = CPU::cpu();
$cpu_heat = CPU::heat();
$hdd = Storage::hdd();

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

      <div class="container home">
        <table>
          <tr>
            <td class="check"><i class="icon-time"></i> Uptime</td>
            <td class="icon"></td>
            <td><?php echo $uptime; ?></td>
          </tr>
          
          <tr>
            <td class="check"><i class="icon-asterisk"></i> RAM</td>
            <td class="icon"><?php echo icon_alert($ram['alert']); ?></td>
            <td>
              <div class="progress">
                <div class="bar bar-<?php echo $ram['alert']; ?>" style="width: <?php echo $ram['percentage']; ?>%;"><?php echo $ram['percentage']; ?>%</div>
              </div>
              free: <?php echo $ram['free']; ?> Mb  &middot; used: <?php echo $ram['used']; ?> Mb &middot; total: <?php echo $ram['total']; ?> Mb
            </td>
          </tr>
          
          <tr>
            <td class="check"><i class="icon-refresh"></i> Swap</td>
            <td class="icon"><?php echo icon_alert($swap['alert']); ?></td>
            <td>
              <div class="progress">
                <div class="bar bar-<?php echo $swap['alert']; ?>" style="width: <?php echo $swap['percentage']; ?>%;"><?php echo $swap['percentage']; ?>%</div>
              </div>
              free: <?php echo $swap['free']; ?> Mb  &middot; used: <?php echo $swap['used']; ?> Mb &middot; total: <?php echo $swap['total']; ?> Mb
            </td>
          </tr>

          <tr>
            <td class="check"><i class="icon-tasks"></i> CPU</td>
            <td class="icon"><?php echo icon_alert($cpu['alert']); ?></td>
            <td>
              loads: <?php echo $cpu['loads']; ?> [1 min] &middot; <?php echo $cpu['loads5']; ?> [5 min] &middot; <?php echo $cpu['loads15']; ?> [15 min]
              <br />running at <?php echo $cpu['current']; ?> (min: <?php echo $cpu['min']; ?>  &middot;  max: <?php echo $cpu['max']; ?>)
              <br />governor: <?php echo $cpu['governor']; ?>
            </td>
          </tr>

          <tr>
            <td class="check"><i class="icon-fire"></i> CPU</td>
            <td class="icon"><?php echo icon_alert($cpu_heat['alert']); ?></td>
            <td>
              <div class="progress">
                <div class="bar bar-<?php echo $cpu_heat['alert']; ?>" style="width: <?php echo $cpu_heat['percentage']; ?>%;"><?php echo $cpu_heat['percentage']; ?>%</div>
              </div>
              heat: <?php echo $cpu_heat['degrees']; ?>°C
            </td>
          </tr>

          <tr class="storage">
            <td class="check" rowspan="<?php echo sizeof($hdd); ?>"><i class="icon-hdd"></i> Storage</td>
            <?php
              for ($i=0; $i<sizeof($hdd); $i++) {
                echo '<td class="icon">', icon_alert($hdd[$i]['alert']), '</td>
            <td>
              <i class="icon-folder-open"></i> ', $hdd[$i]['name'] , '
              <div class="progress">
                <div class="bar bar-', $hdd[$i]['alert'], '" style="width: ', $hdd[$i]['percentage'], '%;">', $hdd[$i]['percentage'], '%</div>
              </div>
              free: ', $hdd[$i]['free'], 'b &middot; used: ', $hdd[$i]['used'], 'b &middot; total: ', $hdd[$i]['total'], 'b &middot; format: ', $hdd[$i]['format'], '
            </td>
            </tr>
            ', ($i == sizeof($hdd)-1) ? null : '<tr class="storage">';
              }
            ?>

        </table>
      </div>
