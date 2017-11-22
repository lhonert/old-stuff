# Ptyxis Comic CMS
Ptyxis Comic CMS was created by comic creators, for comic creators. The goal- to create a free, simple, yet powerful dedicated comic CMS for online comic publishing. We believe publishing comics can be simple.

Website http://ptyxis.cthonic.com/

# Installation
Installing Ptyxis is easy. Simply extract the zip file and upload it to the root of your web site. Then visit yourdomain.com/install to install. You'll need the following details from your web hosting provider.

* Database host
* Database name
* Database username
* Database password

If for some reason your host does not let you write to the web directory, Ptyxis will need you to create the config file manually. Below is the configuration file format for reference

```
<?php

$kc_config =  array(
        'base_url' => 'http://example.com/',
        'salt' => ''
);

$db_config = array(
  'host' => 'localhost',
  'user' => 'root',
  'password' => 'password',
  'database' => 'comic',
);
```
note - the salt should be a long complicated string. Ptyxis will generate this during install.

#Licence
Ptyxis Comic CMS

Copyright (C) 2015 Mark Kestler ptyxis.cthonic.com

Ptyxis Comic CMS is released under the GNU General Public License, version 2.
