<?php
/*
	This page is the session page for the website.  It allowed for menu changes across the index.php that was given to us by Sharon's framework.

	/////////////////////////////////////////////
		Look for this set of comments below for...
		- Currently, anyone can login to the website.  That had to be connected to the Users table.
		- We were in the middle of adding a permissions system. See php-permissions.php for more information.
	/////////////////////////////////////////////

*/
	// handles logout and sets up next_page in session
	if ((isset($_GET['page'])) && (($_GET['page']) == 'logout' ))
	{
		session_destroy();
		session_regenerate_id(TRUE);
		session_start();
		//echo "<meta http-equiv='refresh' content='.5'; url=".domain.' />';
	}
	elseif(!isset($_POST['connect']) && isset($_SESSION['logged_in']))
	{
		if (($_SESSION['logged_in'] == true) && (isset($_GET['page'])))
		{
			$_SESSION['next_screen'] = $_GET['page'];
			return;
		}
	}

////////////////////////////////////////////////////////////////////////////////////////
	/////////////  Now anyone can login
	/////////////  work on permissions
//////////////////////////////////////////////////////////////////////////////////////////
	if ((isset($_POST['connect'])) && (isset($_POST['username'])) && (isset($_POST['password'])))
	{
		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = strip_tags($_POST['username']);
		$_SESSION['next_screen'] = 'rentals';

		echo '<script type="text/javascript">

		// similar behavior as an HTTP redirect
		window.location.replace(\''.domain.'/\');

		// similar behavior as clicking on a link
		window.location.href = \''.domain.'/\';
		</script>';
	}
	/*
	// connect script if user and pass
	if ((isset($_POST['connect'])) && (isset($_POST['username'])) && (isset($_POST['password'])))
	{
		//echo $_POST['connect'].' '.$_POST['username'].' '.$_POST['password']."\n";
        $db_conn_str = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = cedar.humboldt.edu)
                                       (PORT = 1521))
                            (CONNECT_DATA = (SID = STUDENT)))";

		// @ sign hides system errors
        $connctn = @oci_connect(strip_tags($_POST['username']), $_POST['password'], $db_conn_str);
        if (!$connctn)
		{
			session_destroy();
			$_SESSION['next_screen'] = 'conn_failure';
			return;
		}

		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = strip_tags($_POST['username']);
		$_SESSION['password'] = $_POST['password'];
		$_SESSION['next_screen'] = 'rentals';
		echo '<script type="text/javascript">

		// similar behavior as an HTTP redirect
		window.location.replace(\''.domain.'/\');

		// similar behavior as clicking on a link
		window.location.href = \''.domain.'/\';
		</script>';
	}
	*/

///////////////////////////////////////////////////////////////////////
//                                                                   //
//                          SESSION CACHE                            //
//                                                                   //
///////////////////////////////////////////////////////////////////////

//
//  Get Global
//  If you rented something and therefore need to clear the cache (FOR OTHER USERS), you need to notify
//  them somehow... well, how?  Database update is 'slow,' and using a $_GLOBAL or $_SERVER variable is
//  unprofessional.  Instead, we're using a 'known' session_id to all who can login that will let other
//  accounts know if they need to clear the cache.
//
//
    function set_session_global($key, $value, $global_id = '1')
    {
        // Get current session
        if (session_status() != PHP_SESSION_ACTIVE) session_start();
        $current_id = session_id();
        session_write_close();

        // Set a global session with session_id
        session_id($global_id);
        session_start();

        // Get superglobal value
        $_SESSION[$key] = $value;
        session_write_close();

        // Set the before session
        session_id($current_id);
        session_start();
    }

    function get_session_global($key, $global_id = '1')
    {
        // Get current session
        if (session_status() != PHP_SESSION_ACTIVE) session_start();
        $current_id = session_id();
        session_write_close();

        // Set a global session with session_id
        session_id($global_id);
        session_start();

        // Get superglobal value
        $value = null;
        if (isset($_SESSION[$key])) $value = $_SESSION[$key];
        session_write_close();

        // Set the before session
        session_id($current_id);
        session_start();

        return $value;
    }


///////////////////////////////////////////////////////////////////////
//                                                                   //
//                      / END OF SESSION CACHE /                     //
//                                                                   //
///////////////////////////////////////////////////////////////////////
?>