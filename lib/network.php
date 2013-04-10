<?php

namespace lib;

class Network {
  
  public static function network() {

    $connections = shell_exec("netstat -nta --inet | wc -l");
    $connections--;

    return array(
      'connections' => substr($connections, 0, -1),
      'alert' => ($connections >= 50 ? 'warning' : 'success')
      );
  }

}