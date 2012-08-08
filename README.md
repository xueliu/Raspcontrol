# Raspcontrol
### Getting Started Guide
##### Typical Installation Requirements:

_OS:_ Raspbian/Debian Wheezy

_HTTP:_ Apache 2 

	sudo apt-get install apache2

_Language:_ PHP-5 

	sudo apt-get install php5

***

## How to setup:

### Getting the source

#### .zip Download

You can download this as a _.zip_ from the GitHub Repository via the following link: 

	https://github.com/Bioshox/Raspcontrol/zipball/master
		
#### Git Clone

If you have Git installed you can clone the repo

	git clone https://github.com/Bioshox/Raspcontrol.git

### Getting it running

#### PHP 5.4

If you're using PHP 5.4 it is possible to deploy a development server right from within PHP, to do this simply navigate to the location you downloaded Raspcontrol and then run the command
	
	sudo php -S ip-to-bind-to:80
	
This will start a temporary web server from PHP without the need for Apache or any other HTTP server. You can now access Raspcontrol from _localhost_ or the Internal IP from a different computer on your LAN and externally if you're using Port Forwarding.

__This will work with PHP 5.4 ONLY__ you can check your PHP version by running the command
	
	php -v
	
#### Apache

Add www-data on Apache to the SUDOERS file

	sudo VISUDO

On the last line add the following

	www-data ALL=(ALL) NOPASSWD: ALL
	
__Raspcontrol is not designed for production use, adding www-data to a SUDOERS file is dangerous and is not a permanent solution.__
		
If you're accessing Apaches web directory on your Raspberry Pi (using startx) you can navigate to http://localhost/raspcontrol, if you're accessing it from another computer on your Network you will need to navigate to http://your.internal.ip/raspcontrol.

### Setting up your account
				
Once you can see a login screen this is your indication that Raspcontrol is now running at this point you __must__ navigate to 

	raspcontrol/setup.php 

this will create the initial user to login to the system, you can then log in with the username "admin" and the password that you chose during setup.

__For security ensure you remove setup.php once complete__

***	
		
### Thanks!

Please feel free to contribute to this development!

Hosting proudly supplied by [Fusion Strike](http://fusionstrike.com)
