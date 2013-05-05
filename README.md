# Raspcontrol

Raspcontrol is a web control centre written in PHP for Raspberry Pi.

![Home of Raspcontrol](raspcontrol-home.png)


Lots of merges from many different people! See the commit history for everybodies hard work. ~ Jacob.

***

## Installation

### Source

Clone the repo with

	git clone https://github.com/bioshox/Raspcontrol.git
	
When done, just put the files where your web server folder is installed.

### Authentification file

You have to create a json format file in `/etc/raspcontrol` named `database.aptmnt`, for instance with `nano /etc/raspcontrol/database.aptmnt`, which contains:
	
	{
		"user":       "yourName",
		"password":   "yourPassword"
	}

### Statictics access

To get some network statistics, we need to have some rights. Adding `www-data` to the `video` group is a safe way. You can do that by executing the following command :

	usermod -a -G video www-data
	
### Drink coffee

That's all! You're ready to show the status of your Raspberry Pi :)

***

## Optional configuration

In order to have some beautiful URLs (`raspcontrol/details` instead of `raspcontrol/?page=details`), you can enable URL Rewriting.
You have to do some other steps, described above.

__Note:__ It's not necessary to enable URL Rewriting to use Raspcontrol.


### Configure Rapscontrol

Please edit the `config.php` file, for instance with `nano config.php`, and set the `$rewriting` variable on `true`:

	$rewriting = true;
	
Then, you have to enable the URL Rewriting module of your web server. Steps are written for the main web server.

### Configure your web server

#### Apache

Enable the rewrite module with the command: `a2enmod rewrite`.

Edit your vhost configuration file to allow override rules. By default, you have to edit `/etc/apache2/sites-available/default`,
and change `AllowOverride None` by `AloowOverride All`:

	<Directory /var/www/>  
		Options Indexes FollowSymLinks MultiViews  
		AllowOverride All
		Order allow,deny  
		Allow from all  
	</Directory>  


Then, uncomment the three last lines from the `.htaccess` file (remove the `#`):

	# URL rewriting (uncomment = remove the # on the 3 following lines)
	RewriteEngine On
	RewriteRule ^details$ index.php?page=details
	RewriteRule ^logout$ login.php?logout


__Heads up:__ Do not forget to reload Apache with `service apache2 reload`.

#### Nginx

Edit your default location file:

	nano /etc/nginx/sites-enabled/default

Look at the above section:

	location / {
    		root   /var/www;
    		index  index.php index.html index.htm;

and add the following rules:

    rewrite ^/raspcontrol/details$ /raspcontrol/index.php?page=details last;
    rewrite ^/raspcontrol/logout$ /raspcontrol/login.php?logout last;

__Be careful:__ You have to remplace `raspcontrol` with the name of the folder wich contains Raspcontrol.

__Heads up:__ Do not forget to reload Nginx with `service nginx reload`.

