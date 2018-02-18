<?php
/*
This is the main index file for the modified Sharon's Framework.

Domain Variable: 
	created a domain variable so that the website could be moved easily without much work.
ob_start / ob_flush:
	There are instances when you may want to do things such as switch session users (used in caching) during a page loag.  ob_start is like hitting a record button (while not sending out any data).  PHP command can executed within the page, but when the ob_flush happens at the end of the 'recording', data is sent out to the client.  When a user visits a website, a header that is part of the HTTP protocol gets sent out and received.  When you session_start (at any time) headers are sent out.  You can't send two headers to a client viewing a webpage, that isn't how the protocol works ergo, we ob_start ::run / generate code:: then ob_flush sending out one set of headers though we're making multiple session_starts within a single load of a script / page.
*/
	// domain globals set: here, rentals.js
	define("domain", "http://nrs-projects.humboldt.edu/~Alt-F4");
	ob_start();
	session_start();
	require_once("php-session.php");
	require_once("php-database.php");
	require_once("php-cache.php");
	require_once("php-funcs.php");
	//require_once("php-inputhandler.php");
?>
<html>
<head>
	<!--  CSS   -->
    <link href="<?= domain?>/css/normalize.css"     type="text/css" rel="stylesheet" />
    <link href="<?= domain?>/css/home.css" 		    type="text/css" rel="stylesheet" />
    <link href="<?= domain?>/css/navbar.css" 	    type="text/css" rel="stylesheet" />
    <link href="<?= domain?>/css/forms.css" 	    type="text/css" rel="stylesheet" />
	
	<script src ="js/general.js" type="text/javascript"> </script>
	<script src="js/admin-add-vendors.js"  type="text/javascript"></script>
	<script src="js/admin-edit-vendors.js"  type="text/javascript"></script>
	
</head>
<body>
	<div style="z-index:0; position:relative;">
	<div style="z-index:-1000; opacity:0.9;position:fixed;" ><img src="<?= domain?>/images/wallpaper.jpg" /></div>


    <?php
    //*************  Global Navbar   ************/
	require_once("navigation-bar.php");

	//*******  Sharon's Page Framework *********/
	if ((!array_key_exists("next_screen", $_SESSION)) || ($_SESSION['next_screen'] == 'home'))
	{
		if(!isset($_SESSION['logged_in']))
		{
			echo '<br><br><br><br>';
			create_login();
		}
	}
	elseif ($_SESSION['next_screen'] == 'conn_failure')
	{
		if(!isset($_SESSION['logged_in']))
		{
			unset($_SESSION['next_screen']);
			echo '<br><br><br><br>';
			create_login('Session has been terminated.<br>Either the credentials failed or the system is no-longer able to connect to the database.<br>');
		}
	}
	elseif ($_SESSION['next_screen'] == 'rentals')
	{
		require_once("rentals-item-select.php");
	}
	elseif ($_SESSION['next_screen'] == 'returns')
	{
		require_once("returns.php");
	}
	elseif ($_SESSION['next_screen'] == 'inventory')
	{
		require_once("inventory.php");
	}
	elseif ($_SESSION['next_screen'] == 'history')
	{
		require_once("item_history.php");
	}
	elseif($_SESSION['next_screen'] == 'vendors')
	{
		require_once("vendors.php");
	}
	//trying to figure our how to use this to handle page transitions
	elseif($_SESSION['next_screen'] == 'create_account')
	{
		require_once("admin-add-users.php");
	}
	elseif($_SESSION['next_screen'] == 'add_vendors')
	{
		require_once("admin-add-vendors.php");
	}
	elseif($_SESSION['next_screen'] == 'add_packages')
	{
		require_once("admin-add-package.php");
	}
		elseif($_SESSION['next_screen'] == 'broken_fingers')
	{
		require_once("check-add-user.php");
	}
	
	//
	elseif($_SESSION['next_screen'] == 'help')
	{
		echo "Text Shouldn't Be Here... lol? <br>";
		var_dump($_SESSION);
		phpversion();
	}
	elseif ($_SESSION['next_screen'] == 'logout')
	{
		session_destroy();
		session_regenerate_id(TRUE);
		session_start();
		//echo "<meta http-equiv='refresh' content='.5'; url=".domain.'index.php />';
	}
	else
	{
		// since should not get here "normally",
		//    we'll destroy and restart session in
		//    this case
		echo "You shouldn't have gotten here.  Error in 'Sharon\'s' Page Framework.  See index.php";
		session_destroy();
		session_regenerate_id(TRUE);
		session_start();
	}

	for($i = 0; $i < 3; $i++)
		echo  '<br>';
?>
	<div id="botleft"> </div>
</div>
</body>
</html>
<?php ob_flush(); ?>