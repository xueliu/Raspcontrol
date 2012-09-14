<?php
  // Helper functions
  $status_img = function($ok) {
    return $ok ? "images/ok.png" : "images/warning.png";
  };

  $status_class = function($ok) {
    return $ok ? "" : "not-ok";
  };

 require '_header.php';  // include the header
?>
<div class="overview">
  <table>

    <!-- Uptime -->
    <?php
      $uptime = getUptime();
    ?>
    <tr>
      <td><img src="images/uptime.png" /></td>
      <td>Uptime</td>
      <td></td>
      <td><strong><?= secondsToReadableTime($uptime); ?></strong></td>
    </tr>

    <!-- CPU -->
    <?php
      $loads = getAverageLoad();
      $loadOk = $loads[0] < 1;
    ?>
    <tr>
      <td><img src="images/cpu.png" /></td>
      <td>CPU</td>
      <td><img src="<?= $status_img($loadOk); ?>" /></td>
      <td>
        <p>Loads: 1 Min: <strong><?= $loads[0]; ?></strong> &middot; 5 Mins: <strong><?= $loads[1]; ?></strong> &middot; 15 Mins: <strong><?= $loads[2]; ?></strong></p>
        <p>CPU is running at <strong><?= getCpuSpeed(); ?> MHz</strong></p>
      </td>
    </tr>

    <!-- Memory -->
    <?php
      $ram = getRamInfo();
      $ramUsedPercent = round($ram['used'] / $ram['total'] * 100);
      $ramUsageOk = $ramUsedPercent < 80;
    ?>
    <tr>
      <td><img src="images/memory.png" /></td>
      <td>Memory</td>
      <td><img src="<?= $status_img($ramUsageOk); ?>" /></td>
      <td>
        <div class="progress-bar <?= $status_class($ramUsageOk); ?>">
          <span style="width:<?= $ramUsedPercent; ?>%;"><?= $ramUsedPercent; ?>%</span>
        </div>
        <p>
          Free: <strong><?= $ram['free']; ?> MB</strong> Used: <strong><?= $ram['used']; ?> MB</strong> &middot; Total: <strong> <?= $ram['total']; ?> MB</strong>
        </p>
      </td>
    </tr>

    <!-- Swap -->
    <?php
      $swap = getSwapInfo();
      $swapUsedPercent = round($swap['used'] / $swap['total'] * 100);
      $swapUsageOk = $swapUsedPercent < 80;
    ?>
    <tr>
      <td><img src="images/swap.png" /></td>
      <td>Swap</td>
      <td><img src="<?= $status_img($swapUsageOk); ?>" /></td>
      <td>
        <div class="progress-bar <?= $status_class($swapUsageOk); ?>">
          <span style="width:<?= $swapUsedPercent; ?>%;"><?= $swapUsedPercent; ?>%</span>
        </div>
        <p>
          Free: <strong><?= $swap['free']; ?> MB</strong> Used: <strong><?= $swap['used']; ?> MB</strong> &middot; Total: <strong> <?= $swap['total']; ?> MB</strong>
        </p>
      </td>
    </tr>

    <!-- HDD Info -->
    <?php
      $drives = getHddInfo();
      foreach ($drives as $drive) {
        $driveUsageOk = $drive['percentage'] < 80;
    ?>
    <tr>
      <td><img src="images/sd.png" /></td>
      <td>SD Card</td>
      <td><img src="<?= $status_img($driveUsageOk); ?>" /></td>
      <td>
        <div class="progress-bar <?= $status_class($driveUsageOk); ?>">
          <span style="width:<?= $drive['percentage']; ?>%"><?= $drive['percentage']; ?>%</span>
        </div>
        <p>
          Free: <strong>25.65 GB</strong> Used: <strong>3.55 GB</strong> &middot; Total: <strong> 29.20 GB</strong>
        </p>
      </td>
    </tr>
    <?php } ?>

    <!-- Network -->
    <?php
      $network = getNetworkInfo();
    ?>
    <tr>
      <td><img src="images/network.png" /></td>
      <td>Network</td>
      <td></td>
      <td>
        <p>
          <strong><?= $network['type']; ?></strong> |
          Received <strong><?= $network['received']; ?> MB</strong> &middot;
          Sent: <strong><?= $network['sent']; ?> MB</strong> &middot;
          Total: <strong> <?= $network['total']; ?> MB</strong>
        </p>
        <p>Active Network Connections: <strong><?= $network['connections']; ?></strong>
      </td>
    </tr>

    <!-- Active Users -->
    <tr>
      <td><img src="images/user.png" /></td>
      <td>Active Users</td>
      <td></td>
      <td>
      <?php foreach(getActiveUsers() as $user) { ?>
        <ul class="invisible">
          <li><strong>User:</strong> <?= $user['name']; ?></li>
          <li><strong>TTY:</strong> <?= $user['login']; ?></li>
          <li><strong>From:</strong> <?= $user['ip']; ?></li>
        </ul>
      <?php } ?>
      </td>
    </tr>

  </table>
</div>
<?php require '_footer.php'; ?>
