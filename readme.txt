Powered by Nette Sandbox

Browsing through larger DB.

Web Server Setup
----------------
1) setup DB using dump from:
           https://dev.mysql.com/doc/employee/en/

2) Specify DB connection settings in '/app/entities/DBwrap.php' if needed.
3) Start webserver by cmd:

	php -S localhost:8000 -t www

Then visit `http://localhost:8000` in your browser.

Make sure, you have set /WWW as webroot.