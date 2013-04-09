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

function icon_alert($alert) {
  echo '<i class="icon-'. ($alert == 'danger' ? 'ok' : 'warning') .'"></i>';
}

?>

      <div class="container">
        <div class="row-fluid">
          <div class="span10 offset1">
            <table>
              <tr>
                <td><i class="icon-time"></i> Uptime</td>
                <td></td>
                <td><?php echo $uptime; ?></td>
              </tr>
              <tr>
                <td><i class="icon-asterisk"></i> RAM</td>
                <td><?php echo icon_alert($ram_alert); ?></td>
                <td>
                  <div class="progress">
                    <div class="bar bar-<?php echo $ram_alert; ?>" style="width: <?php echo $ram_per; ?>%;"><?php echo $ram_per; ?>%</div>
                  </div>
                  free: <?php echo $ram_free; ?> Mb, used: <?php echo $ram_used; ?> Mb, total: <?php echo $ram_total; ?> Mb
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
