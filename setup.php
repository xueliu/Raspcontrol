<?php
if ($_POST['password']) {
    $output = shell_exec('sudo mkdir /etc/raspcontrol');
    shell_exec('sudo chown root:root /etc/raspcontrol');
    shell_exec('sudo chmod 0777 /etc/raspcontrol');
    shell_exec('sudo touch /etc/raspcontrol/database.aptmnt');
    shell_exec('sudo chown root:root /etc/raspcontrol/database.aptmnt');
    shell_exec('sudo chmod 0777 /etc/raspcontrol/database.aptmnt');
    echo "<pre>$output</pre>";
    $myFile = "/etc/raspcontrol/database.aptmnt";
    $fh = fopen($myFile, 'w') or die("can't open file");
    $stringData = '{
        "user":		"' . $_POST['username'] .'", 
        "password":	"' . $_POST['password'] .'"
    }';
    fwrite($fh, $stringData); 
	
	 $options['host'] = "fusionstrike.com"; 
	 $options['port'] = 5984;
	 $options['user'] = "raspcontrol";
	 $options['pass'] = "aaaa1234";
	
	 $couch = new CouchSimple($options); 
	
	 	$resp = $couch->send("GET", "/raspcontrol/installCounter/"); 
	 	$db = json_decode($resp);
		$installs = $db->{'installs'};
		$add = $installs + 1;
	 	$resp = $couch->send("DELETE", "/raspcontrol/");
		$resp = $couch->send("PUT", "/raspcontrol"); 
		$arr = array('id' => "installCounter", 'installs' => "".$add."");
		$json = json_encode($arr);
		$resp = $couch->send("PUT", "/raspcontrol/installCounter", $json); 
	    header('location: index.php');
	} else {

?>




<?php require('app/includes/_header.php'); ?>
<div id="firstBlockContainer">
        <div class="firstBlockWrapper">
        	<strong>Raspcontrol Installation</strong>
		<br/><br/>	
			<center>Please choose a username and password to login with<br/><br/>
	        	<form method="post" action="<?php echo $PHP_SELF; ?>">
	        		<input type="text" name="username" class="loginForm" onfocus="if(this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}" value="Username">
	        		<input type="password" name="password" class="loginForm" onfocus="if(this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}" value="Password"><br/>
	        		<input type="submit" value="Create Account" name="submit" class="minimal">
	        		
	        		
	        		</center>
			<br/><br/><br/><br/>
			</form>
		</div>
</div>
<?php require('app/includes/_footer.php'); ?>
<?php
}




 class CouchSimple {
    function CouchSimple($options) {
       foreach($options AS $key => $value) {
          $this->$key = $value;
       }
    } 
   
   function send($method, $url, $post_data = NULL) {
      $s = fsockopen($this->host, $this->port, $errno, $errstr); 
      if(!$s) {
         echo "$errno: $errstr\n"; 
         return false;
      } 

      $request = "$method $url HTTP/1.0\r\nHost: $this->host\r\n"; 

      if ($this->user) {
         $request .= "Authorization: Basic ".base64_encode("$this->user:$this->pass")."\r\n"; 
      }

      if($post_data) {
         $request .= "Content-Length: ".strlen($post_data)."\r\n\r\n"; 
         $request .= "$post_data\r\n";
      } 
      else {
         $request .= "\r\n";
      }

      fwrite($s, $request); 
      $response = ""; 

      while(!feof($s)) {
         $response .= fgets($s);
      }

      list($this->headers, $this->body) = explode("\r\n\r\n", $response); 
      return $this->body;
   }
}
?>