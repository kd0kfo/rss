rss
===

About
-----

PHP RSS Feed.

Requirements
------------

* PHP
* MySQL database functions

Installation
------------

First, place this directory tree on the webserver. Next, copy the talk_db.inc.example.php file to talk_db.inc.php and edit the file with custom settings for the webserver. The top of the file contains the fields that have to be edited. These include base URLs and descriptions. Lastly, the database must be setup with a "news" table (see *SQL Table Creation* for an example creation statement). Once the table has been added, add the database information to the *db_init* function in talk_db.inc.php. 

Security
--------

Since talk_db.inc.php contains a database password, it is very important to keep this file from being read by users. Ensure proper permissions are in place for this file. The feed posting file, edit.php, does not use any authentication. It is suggested that the admin/ subdirectory be restricted, for example, behind a webserver password.


SQL Table Creation
------------------

The following SQL statement may be used to create the table:
    CREATE TABLE `news` (
      `id` int(10) unsigned NOT NULL auto_increment,
      `title` varchar(75) NOT NULL,
      `message` text NOT NULL,
      `author` int(11) default NULL COMMENT 'optional index to user db',
      `linkURL` varchar(75) default NULL,
      `lastUpdate` int(11) NOT NULL COMMENT 'unix timestamp',
      PRIMARY KEY  (`id`)
      ) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
