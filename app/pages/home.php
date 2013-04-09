<?php

namespace lib;
use lib\Uptime;
use lib\Memory;

$uptime = Uptime::uptime();
$ram = Memory::ram();
$ram_alert = $ram['alert'];
$ram_per = $ram['percentage'];
$ram_free = $ram['free'];
$ram_used = $ram['used'];
$ram_total = $ram['total'];
$swap = Memory::swap();
$swap_alert = $swap['alert'];
$swap_per = $swap['percentage'];
$swap_free = $swap['free'];
$swap_used = $swap['used'];
$swap_total = $swap['total'];


function icon_alert($alert) {
  echo '<i class="icon-'. ($alert == 'success' ? 'ok' : 'warning-sign') .'"></i>';
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
            <td class="icon"><?php echo icon_alert($ram_alert); ?></td>
            <td>
              <div class="progress">
                <div class="bar bar-<?php echo $ram_alert; ?>" style="width: <?php echo $ram_per; ?>%;"><?php echo $ram_per; ?>%</div>
              </div>
              free: <?php echo $ram_free; ?> Mb, used: <?php echo $ram_used; ?> Mb, total: <?php echo $ram_total; ?> Mb
            </td>
          </tr>
          <tr>
            <td class="check"><i class="icon-refresh"></i> Swap</td>
            <td class="icon"><?php echo icon_alert($swap_alert); ?></td>
            <td>
              <div class="progress">
                <div class="bar bar-<?php echo $swap_alert; ?>" style="width: <?php echo $swap_per; ?>%;"><?php echo $swap_per; ?>%</div>
              </div>
              free: <?php echo $swap_free; ?> Mb, used: <?php echo $swap_used; ?> Mb, total: <?php echo $swap_total; ?> Mb
            </td>
          </tr>
        </table>
      </div>
