<?php require '_header.php'; ?>

    <div class=login>
      <p>Please login to Raspcontrol!<p>
      <form name="login" method="post" action="login">
        <input type="text" name="username" class="loginForm" placeholder="Username">
        <input type="password" name="password" class="loginForm" placeholder="Password"><br/>
        <input type="submit" value="Login" name="login" class="minimal">
      </form>
    </div>

<?php require '_footer.php'; ?>