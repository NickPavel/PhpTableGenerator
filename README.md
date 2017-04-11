PHP Table Generator

Just a simple PHP table generator. All the code is in one php file (index.php). This is custom designed to generate tables containing links to pdf files with results from multiple bowling seasons and leagues.

Here's what it does step by step:
1.	Echos html code for <head>
2.	Counts the league folders ($leagues)
3.	Validates league GET variable ($x)
4.	Counts the season folders for that league ($seasons)
5.	Validates season GET variable ($y)
6.	Reads league and season specific variables
7.	Echos html code for <header> that also contains a drop-down form to change the displayed bowling season
8.	Reads league and season specific variables (yes, again, otherwise the $weeks varialble is wrong)
9.	Echos html code for <table> containg links to pdf files
10.	Echos html code for drop-down form to change the displayed bowling league
11.	Echos html code for <footer>

Nomeclature requirements:
1.	First league folder must be named "league.1", the second one is "league.2", and so on.
2.	Each league folder must include a vars.php file containg three varialbles. For example:
			<?php
			$league_name='Wednesday Night Mixed';
			$day='Wednesday';
			$time='6:30 PM';
			$town='Hazlet, NJ';
3.	Subfolders for seasons are added to league folders. First season folder must be named "season.1", the second one is "season.2", and so on.
4.	Each season folder must include a vars.php file containg three varialbles. For example:
			<?php
			$season_name='2015-2016';
			$weeks=35;
			$columns=5;
5.	The pdf files are placed in the seasons folders
6.	The first pdf file is named "week1of35.pdf", where "1" is the season week number ($week), and "35" is the total number of weeks for that season ($weeks). Second week will be "week2of35.pdf", and so on
7.	Upload files and create folders and subfolders using FTP (FileZilla) 

Tested on a Debian 8 LAMP server!

Here's the Apache2 configuration file:
(of course, replace example.com and IP address)
<VirtualHost 192.168.1.5:80>
        ServerAdmin webmaster@example.com
        ServerName example.com
        ServerAlias www.example.com
        DocumentRoot /var/www/example.com/web
        <Directory />
                Options FollowSymLinks
                AllowOverride None
        </Directory>
        <Directory /var/www/example.com/web/>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride None
                Order allow,deny
                allow from all
        </Directory>
        ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
        <Directory "/usr/lib/cgi-bin">
                AllowOverride None
                Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
                Order allow,deny
                Allow from all
        </Directory>
        ErrorLog ${APACHE_LOG_DIR}/error.log
        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

Here's the line needed in /etc/hosts
192.168.1.5     wwww.example.com       www

Enjoy, pay it forward, and code on!
Nick Pavel (2017-04-10)
