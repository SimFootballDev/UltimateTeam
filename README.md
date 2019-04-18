# NSFL Ultimate Team

A "hacky" trading card platform for sim leagues, but probably can be used for other stuff too.

## Getting Started

I'll explain the database structure here later. No time right now.

There will also be a demo database sql script probably, and a script to truncate the tables for your initial set up.

### Prerequisites

You'll need PHP, and access to a MySQL database

NOTE: Your MySQL user needs CRUD permissions, and the ability to execute stored procedures

(if the database is not on the same webhost as the interface, you will need to make sure you have remote database access allowed)

Uhh... that's all I think.

### Installing

Once the database is set up, you'll need to create a config file holding the database credentials, then dump the entire project folder onto your server.

If you used the demo database, you'll want to truncate all tables (I'll provide a handy script for this) and register your first user account.

From there, you should be able to manage the whole system without needing to access the database directly... if I did this right. (Spoiler: I won't have done it right)

**config.php**

Use the following code, and just fill in the correct credentials.

```
<?php

session_start();

/* Database credentials */
define('DB_SERVER', ' -- Server -- ');
define('DB_USERNAME', ' -- Username -- ');
define('DB_PASSWORD', ' -- Password -- ');
define('DB_NAME', ' -- database name -- ');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
	mysqli_query($link, "SET NAMES UTF8");
}

?>
```

You'll also want to create images for the card frames and artwork at some point, in png format.

Those should be stored in a folder `/img` at the top level of the project (same level as the login.php script)

Store the images in the subfolders `../renders` and `../frames` with file names as numbers corresponding to the ids in the database

For example, the frame for cardRarityId `1` should be stored as `../img/frames/1.png` and the artwork for playerAttributesID `37` should be stored as `../img/renders/037.png`

## Versioning and Release Info

This was never originally intended for collaborative development and widespread sharing, so I update as and when I feel like it and/or have time.

I don't use any special methods or anything. I just... update things.

## Authors

* **37thchamber** (that's me) - *Initial work*

(NOTE: I lifted the basic frame for the login system from an article online somewhere that I no longer have the URL for, and tweaked it for my own purposes. If it's yours, sorry! But let me know and I'll gladly credit you.)
* **PDXBaller** - *Initial concept planning and design*

See also the list of [contributors](https://github.com/blackmage37/UltimateTeam/contributors) who participated in this project.

## License

This project is licensed under the UniLicense - see the [LICENSE](LICENSE) file for details.

Basically, do whatever you want with this. Just don't be a dick, eh?

## Acknowledgments

* **Yurt6** and **Shadowz** for originally getting the trading cards system going in NSFL and PBE
