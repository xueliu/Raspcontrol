<?php
function networkUsage() {
    $string = exec("sudo ifconfig eth0 | grep RX\ bytes", $out);
    $string = str_ireplace("RX bytes:", "", $string);
    $string = str_ireplace("TX bytes:", "", $string);
    $string = trim($string);
    $string = explode(" ", $string);
    $out['rx'] = ($string[0] / 1024 / 1024);
    $out['rx'] = round($out['rx'], 2);
    $out['tx'] = ($string[4] / 1024 / 1024);
    $out['tx'] = round($out['tx'], 2);
    return $out;
}
?>