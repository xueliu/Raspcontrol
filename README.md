# Raspcontrol
### Getting Started Guide
##### Typical Requirements:

Raspcontrol can be deployed standalone with only PHP __5.4__ installed which means there is no requirements for a HTTP server such as Apache or NGINX. __PHP 5.4 and above only, no later version__

If your distribution does not support PHP 5.4 then you will need a HTTP server such as Apache to access Raspcontrol.


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

There are two typical ways to deploy Raspcontrol, standalone with PHP 5.4 or with a HTTP server such as Apache.

#### Standalone with PHP 5.4

If you're using PHP 5.4 it is possible to deploy a development server right from within PHP, to do this simply navigate to the location you downloaded Raspcontrol and then run the command
	
	sudo php -S ip-to-bind-to:80
	
This will start a temporary web server from PHP without the need for Apache or any other HTTP server. You can now access Raspcontrol from _localhost_ or the Internal IP from a different computer on your LAN and externally if you're using Port Forwarding.

__This will work with PHP 5.4 ONLY__ you can check your PHP version by running the command
	
	php -v
	
#### With Apache

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

[raspcontrol.com](http://raspcontrol.com)

Hosting proudly supplied by [Fusion Strike](http://fusionstrike.com)
