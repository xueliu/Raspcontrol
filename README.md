# Raspcontrol

This a modified version of the excellent [Raspcontrol](//github.com/Bioshox/Raspcontrol) from [Bioshox](//github.com/Bioshox).


This guide works with an apache server.

***

## Installation

### Source

You can download this as a _.zip_ from the Github repository via the following link: 

	https://github.com/nicolabricot/Raspcontrol/zipball/master

If you have Git installed you can also clone the repo

	git clone https://github.com/nicolabricot/Raspcontrol.git
	
When done, just put the files where your web server folder is installed

### Authentification file

You have to create a json format file in `/etc/raspcontrol` named `database.aptmnt`, for instance with `nano /etc/raspcontrol/database.aptmnt`, which contains:
	
	{
		"user":       "yourName",
		"password":   "yourPassword"
	}

### Root privileges

To get some statistics, we need to be as root. We'll use the command `sudo`, but we need first to edit the table with `visudo`. Add the following line ath the end of the file:

	www-data ALL=(ALL) NOPASSWD: /sbin/ifconfig
	
### Drink coffee

That's all! You're ready to show the status of your raspberry pi :)
	
