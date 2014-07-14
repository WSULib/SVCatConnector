# SVCatConnector

Z3950 Connector and Modified Display built for use in Harvard's Stack View project


## Requirements

libyaz4
yaz
php5-yaz
* I recommend installing from source rather than your server's repositories, as, at least with Ubuntu, these packages seem to be out-of-date otherwise
Server environment (WAMP, LAMP)
* Has been tested on an Ubuntu 10.04 LAMP server pointing to a III (Millennium) Z3950 Server (using scan and search services)


## Installation Instructions

The instructions below demonstrate how to insert WSULS' Z3950 connector and display inside an installation of Harvard LIL's Stack View project.

* Download Harvard Library Innovation Lab's [Stack View](https://github.com/harvard-lil/stackview)</a>
* Download [SVCatConnector](#)
* Unpackage and place both in a web-accessible folder on your webserver
* Place SVCatConnector inside Stack View's root directory
* Modify ownership of the json/temp/ folder so that the webserver (perhaps called httpd or www-data if using Apache) has write permission
* Modify SVCatConnector/php/settings.php to configure your Z3950 instance
* In your browser, navigate to Stack View folder/SVCatConnector/index.php, and you should see your catalog stack. Note: you are navigating to SVCatConnector's index page as opposed to Stack View's built-in index page.
* Errors in your configuration should appear on the index page.