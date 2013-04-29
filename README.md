# Raspcontrol

Lots of merges from many different people! See the commit history for everybodies hard work. ~ Jacob.

![Home of Raspcontrol](raspcontrol-home.png)


This guide works with an apache server.

***

## Installation

### Source

Clone the repo
	git clone https://github.com/bioshox/Raspcontrol.git
	
When done, just put the files where your web server folder is installed

### Authentification file

You have to create a json format file in `/etc/raspcontrol` named `database.aptmnt`, for instance with `nano /etc/raspcontrol/database.aptmnt`, which contains:
	
	{
		"user":       "yourName",
		"password":   "yourPassword"
	}

### Statictics access

To get some statistics, we need to have some rigth. Adding `www-data` to the `video` group is a safe way. You can do that by executing the following command :

	usermod -a -G video www-data
	
### Drink coffee

That's all! You're ready to show the status of your Raspberry Pi :)
	
