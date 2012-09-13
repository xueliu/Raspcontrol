<div class="sysinfo">
  <strong>Hostname:</strong> <?= gethostname(); ?> &middot;
  <strong>Internal IP:</strong> <?= $_SERVER['SERVER_ADDR']; ?><br/>
  <strong>Accessed From:</strong> <?= $_SERVER['SERVER_NAME']; ?> &middot;
  <strong>Port:</strong> <?= $_SERVER['SERVER_PORT']; ?> &middot;
  <strong>HTTP:</strong> <?= $_SERVER['SERVER_SOFTWARE']; ?><br/><br/>
  <strong>Distribution:</strong> <?= getDistribution(); ?><br/>
  <strong>Kernel:</strong> <?= getKernelVersion(); ?><br/>
  <strong>Firmware:</strong> <?= getFirmware(); ?>
</div>