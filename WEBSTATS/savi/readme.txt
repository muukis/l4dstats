** Installation and Usage **

Extract archive to desired location on your webserver.
The directory "steamprofile/cache" is used for caching, therefore it must be read- and writable for the web server process.

You can change configurations for the XML proxy in "steamprofile/xmlproxy.php".
For client configuration and template editing, open "steamprofile/steamprofile.xml".

See example.html for examples and instructions for proper embedding into your website.

** Server Requirements **

 - Any PHP-compliant webserver (tested with Apache/2.2.11)
 - PHP 5.0.0 or higher, 5.2.x recommended (tested with PHP/5.2.6-3ubuntu4.2)
 - cURL (libcurl 7.x)

** Client Requirements **

 - Any modern browser with enabled JavaScript

** Known Problems **

Internet Explorer 7 / Internet Explorer 8 in compatibility mode:
 - "Loading..." is not displayed
 - icons are not showing up

Internet Explorer 6 (of course):
 - unable to display transparent 32-bit PNG images
 - slider menu unusable
 - flawed layout