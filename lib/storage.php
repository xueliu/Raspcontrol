<?php

namespace lib;

class Storage {
  
  public static function hdd() {

    $result = array();

    exec('df -hT | grep -vE "tmpfs|rootfs|Filesystem"', $drivesarray);
    
    for ($i=0; $i<count($drivesarray); $i++) {
      $drivesarray[$i] = preg_replace('!\s+!', ' ', $drivesarray[$i]);
      preg_match_all('/\S+/', $drivesarray[$i], $drivedetails);
      list($fs, $type, $size, $used, $available, $percentage, $mounted) = $drivedetails[0];
        
      $result[$i]['name'] = $mounted;
      $result[$i]['total'] = $size;
      $result[$i]['free'] = $available;
      $result[$i]['used'] = ($size - $available) . substr($size, -1);
      $result[$i]['format'] = $type;
      
      $result[$i]['percentage'] = rtrim($percentage, '%');

      if($result[$i]['percentage'] > '80')
        $result[$i]['alert'] = 'warning';
      else
        $result[$i]['alert'] = 'success';
    }

    return $result;
  }
  
  private static function kConv($kSize){
    $unit = array('K', 'M', 'G', 'T');
    $i = 0;
    $size = $kSize;
    while($i < 3 && $size > 1024){
      $i++;
      $size = $size / 1024;
    }
    return $size.$unit[$i];
  }

}

?>