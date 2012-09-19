================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Initial code written by msleeper
================================================

INSTALLATION INSTRUCTIONS:
Extract the ZIP into the directory on your webserver. Edit the config.php with your MySQL settings, and any
altered base settins as you desire. Refer to config.php for specific information on these settings.

After setting up config.php, run createtable.php from a web browser. This will create the tables and input
initial map data into them. After this file is ran successfully, remove it. You MUST delete this file
before running webstats!

You will need to chmod 777 the file templates/awards_cache.html for the Awards to cache properly.
With IIS (Microsoft) you have to grant the anonymous user (IUSR_<computername>) full access to the file.

UPDATE/UPGRADE INSTRUCTIONS:
Backup your existing files, espcially any templates that you may have modified, as well as your config.php.

Extract the latest release of webstats into your existing installation. Unless you have made custom
modifications, you can let it overwrite any files. Check the changelog for any changes to config.php or
any templates, and apply them as necessary to your custom changes.

After restoring any necessary files, run updatetable.php from a web browser. This will update your table
layout to any changes made. If there are no changes, or you have already made the changes, this update
will be harmless. You MUST delete this file before running webstats!

You will need to chmod 777 the file templates/awards_cache.html for the Awards to cache properly.
With IIS (Microsoft) you have to grant the anonymous user (IUSR_<computername>) full access to the file.

Thanks and enjoy!

================================================

Changelog:

-- 0.1 (1/12/09)
 . Initial release!

-- 0.2 (1/13/09)
 . Fixed "Headshot Ratio" award from being calculated when the conditions have
   not been met
 . Fixed recently added players not being listed on the Player List page, but
   breaking page count
 . Disabled "Community URL" when BCMath is not compiled in PHP
 . Added error message when invalid campaign name is selected

-- 0.3 (1/15/09)
 . Fixed typos on Awards page
 . Added "Minimum Points" requirement for "Headshot Ratio" award
 . Added "Minimum Playtime" requirement for all awards
 . Fixed UTF8 characters not displaying properly - thanks psychonic!

-- 1.0 (1/18/09)
 . Initial public release!
 . Changed Team Kill and Friendly Fire awards to ignore minimum playtime

-- 1.1 (1/28/09)
 . Fixed "createtable.php" to properly set the collation and character set of
   tables at creation
 . Fixed minor formatting issue with Campaigns page
 . Added "updatetable.php" file to update tables from previous versions to latest
   table layout
 . Removed unnecessary code from Awards page
 . Added "Minimum Points" requirements for all awards
 . Added "file_get_contents()" function to common.php in the instance that it
   does not function properly with existing PHP5 installs.
 . Added new "Population Comparison" system, as well as the beginning of
   individual player achievements. You can now compare your entire server's
   kill count, individual Campaign kill counts, and individual player kill
   counts to city, county, and state populations in the US!

-- 1.4B61 (1/28/10)
 . Full of new stuff from previous readme.txt update. Too much to remember. Sorry! :(