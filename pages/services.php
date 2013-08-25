<?php

namespace lib;
use lib\Services;

$services = Services::services();

function label_service($status) {
  echo '<span class="label label-';
  switch($status) {
    case '+':
      echo 'success';
      break;
    case '?':
      echo 'warning';
      break;
    default:
      echo 'important';
  }
  echo '">';
  switch($status) {
    case '+':
      echo 'Running';
      break;
    case '?':
      echo 'Unknown';
      break;
    default:
      echo 'Stopped';
  }
  echo '</span>';
}

if (isset($_GET['changeservicestatus']) && $rootpermission == "true")
{
	for ($i = 0; $i < sizeof($services); $i++) {
		if ($services[$i]['name'] == $_GET['changeservicestatus'])
		{
			if ($services[$i]['status'] == '+')
			{
				shell_exec("sudo /etc/init.d/" . $services[$i]['name'] . " stop");
			}
			else
			{
				shell_exec("sudo /etc/init.d/" . $services[$i]['name'] . " start");
			}
			
			header("location: ?page=services");
		}
	}
}
?>
<div id="popover-requirerootpermission-services-head" class="hide">Root permission</div>
<div id="popover-requirerootpermission-services-body" class="hide">To start/stop a service Raspcontrol must have root permission</div>		
<div class="container details">
  <table>
    <tr class="services" id="check-services">
      <td class="check" rowspan="<?php echo sizeof($services); ?>"><i class="icon-cog"></i> Services</td>
      <?php
        for ($i = 0; $i < sizeof($services); $i++) {
          echo '<td class="icon" style="padding-left: 10px;">';
		  echo $rootpermission == "true" ? '<a href="?page=services&changeservicestatus=' . $services[$i]['name'] .'">' : '<a class="popover-requirerootpermission-services" href="#">';
		  echo label_service($services[$i]['status']), '</a></td>
            <td class="infos">', $services[$i]['name'] , '</td>
          </tr>
          ', ($i == sizeof($hdd)-1) ? null : '<tr class="service">';
        }
      ?>
  </table>
</div>