# SVCatConnector

Z3950 Connector and Modified Display built for use in Harvard's Stack View project


## Requirements

Server environment (WAMP, LAMP)  
libyaz4  
yaz  
php5-yaz  
* I recommend installing the above packages from source rather than your server's built-in repositories, as, at least with Ubuntu, these packages seem to be out-of-date otherwise  
* Has been tested on an Ubuntu 10.04 LAMP server pointing to a III (Millennium) Z3950 Server (using scan and search services)  


## Installation Instructions

The instructions below demonstrate how use WSULS' Z3950 connector and display inside in conjunction with Harvard LIL's Stack View project.

* Download [SVCatConnector](#)
* Unpackage and place it in a web-accessible folder on your webserver
* Modify ownership of the SVCatConnector/json/temp/ folder so that the webserver (perhaps called httpd or www-data if using Apache) has write permission
* Modify SVCatConnector/php/settings.php to configure your Z3950 instance
* In your browser, navigate to SVCatConnector/index.php, and you should see your catalog stack.
* Errors in your configuration should appear on the index page.
