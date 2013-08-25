<?php

namespace lib;
use lib\Uptime;
use lib\Memory;
use lib\CPU;
use lib\Storage;
use lib\Network;
use lib\Rbpi;
use lib\Users;
use lib\Temp;

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
$network = Network::connections();
$users = sizeof(Users::connected());
$temp = Temp::temp();

$external_ip = Rbpi::externalIp();

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
            <i class="icon-map-marker"></i> <?php echo Rbpi::internalIp(); ?>
            <?php echo ($external_ip != 'Unavailable') ? '<br /><i class="icon-globe"></i> '. $external_ip : '' ; ?>
          </div>
          <div class="span4">
            <i class="icon-play-circle"></i> Server <?php echo Rbpi::webServer(); ?>
          </div>
        </div>

        <div class="infos">
          <div style="float:left">
            <a href="<?php echo DETAILS; ?>#check-uptime"><i class="icon-time"></i></a> <?php echo $uptime; ?>			
          </div>		
		  <div style="float:right"><?php echo ($rootpermission == "true" ? '<i class="icon-ok"></i>  Raspcontrol has root permission' : '<i class="icon-remove"></i>  Raspcontrol hasn\'t root permission'); ?> <a href="?forcerootpermissioncheck" title="Force check"><i class="icon-refresh"></i></a> <i id="popover-rootpermissioninfo" class="icon-question-sign"></i></div>
		  <div id="popover-rootpermissioninfo-head" class="hide">Root permission</div>
		  <div id="popover-rootpermissioninfo-body" class="hide">Give root permission to www-data allows you to performs these action<br>Shutdown/reboot your Raspberry Pi<br>Start/stop services<br>Mount/unmount partitions<br><br><i class="icon-warning-sign"></i> Security risk <i class="icon-warning-sign"></i><br>Give root permission to www-data could rapresent a security problem, mainly if your raspberry is publicly accessible.<br><br>If you considered the risks of doing this and still want to proceed, add this line to /etc/sudoers and reboot<br><br><pre>www-data ALL=(ALL) NOPASSWD: ALL</pre></div>		 
		</div>		

        <div class="row-fluid" style="float:left">
          <div class="span4 rapid-status">
            <div>
              <i class="icon-asterisk"></i> RAM <a href="<?php echo DETAILS; ?>#check-ram"><?php echo icon_alert($ram['alert']); ?></a>
            </div>
            <div>
              <i class="icon-refresh"></i> Swap <a href="<?php echo DETAILS; ?>#check-swap"><?php echo icon_alert($swap['alert']); ?></a>
            </div>
            <div>
              <i class="icon-tasks"></i> CPU <a href="<?php echo DETAILS; ?>#check-cpu"><?php echo icon_alert($cpu['alert']); ?></a>
            </div>
            <div>
              <i class="icon-fire"></i> CPU <a href="<?php echo DETAILS; ?>#check-cpu-heat"><?php echo icon_alert($cpu_heat['alert']); ?></a>
            </div>
          </div>
          <div class="span4 offset4 rapid-status">
            <div>
              <i class="icon-hdd"></i> Storage <a href="<?php echo DETAILS; ?>#check-storage"><?php echo icon_alert($hdd_alert); ?></a>
            </div>
            <div>
              <i class="icon-globe"></i> Network <a href="<?php echo DETAILS; ?>#check-network"><?php echo icon_alert($network['alert']); ?></a>
            </div>
            <div>
              <i class="icon-user"></i> Users <a href="<?php echo DETAILS; ?>#check-users"><span class="badge pull-right"><?php echo $users; ?></span></a>
            </div>
            <div>
              <i class="icon-fire"></i> Temperature <a href="<?php echo DETAILS; ?>#check-temp"><?php echo icon_alert($temp['alert']); ?></a>
            </div>
            </div>
          </div>
        </div>

      </div>
