<?php

function reboot() {
  system('sudo reboot');
}

function updateFirmware() {
  system('sudo rpi-update > /dev/null &');
  system('sudo ldconfig');
}

function updateRaspControl() {
  system('if [ ! -d /usr/lib/git-core ]; then sudo apt-get -y install git-core;fi && sudo git clone https://github.com/Bioshox/Raspcontrol.git '.HOME.'Update && sudo rm -R -f '.HOME.' && sudo mv '.HOME.'Update '.HOME.'', $retval);
}
