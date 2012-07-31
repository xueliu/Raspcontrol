<div id="footerContainer">
        <div class="footerWrapper">
        	<br/><br/><br/>
            Powered by <a href="http://raspcontrol.com" target="_blank">Raspcontrol</a>
            
            <?php
            
            if($_SESSION['username'] == ""){}else{
	            echo '&middot; <a href="app/classes/_logout.php">Logout</a>';
				
            }
            ?>
            <br/><br/>
            The Raspberry Logo is a trademark of <a href="https://http://www.raspberrypi.org" target="_blank">The Raspberry Pi Foundation</a>
        </div>
    </div>
</body>
</html>