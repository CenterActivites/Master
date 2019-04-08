<?php
/*
This is the database file for our website.
Contains Functions:
    db_conn()
    db_insert($table, $cols, $values)

    // this get_nextval probably should not be used
    db_query_get_nextval($select, $from)
    
    db_query($select, $from, $where = '1=1')
    db_query_with_cache($select, $from, $where = '1=1', $debug = 0)
    
    // This is the nextval function that probably should be used.
    get_nextval($select, $from)

    remove_from_db($from,$where,$col)
*/
require_once("php-cache.php");
require_once("php-session.php");
//connects to the database
    function db_conn()
    {
        require_once("config.php");
        $config = new Config();
        $db_conn_str = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = ".$config->get_host().")
                                       (PORT = ".$config->get_port()."))
                            (CONNECT_DATA = (SID = STUDENT)))";
        $conn = oci_connect(strip_tags($config->get_user()), $config->get_pass(), $db_conn_str);
        if (!$conn)
        {
            session_destroy();
            $_SESSION['next_screen'] = 'conn_failure';
            return false;
        }

        return $conn;
    }
//inserts into the database
    function db_insert($table, $cols, $values)
    {
        $conn   = db_conn();
        if (!$conn) return -1;

        $table  = htmlspecialchars($table);
        $cols   = htmlspecialchars($cols);
        $values = htmlspecialchars($values);

        $insert = "INSERT INTO $table ($cols) VALUES ($values)";
        echo "<br>INSERT: " . $insert . "<br>";
        $stid = oci_parse($conn, $insert);
        oci_execute($stid);

        oci_free_statement($stid);
        oci_close($conn);
    }
//gets the next value of the database uses get next val function
    function db_query_get_nextval($select, $from)
    {
        $conn   = db_conn();
        if (!$conn) return -1;

        $select = htmlspecialchars($select);
        $from   = htmlspecialchars($from);

        $sql = "SELECT $select FROM $from";

        $stid = oci_parse($conn, $sql);
        oci_execute($stid);

        oci_fetch_all($stid, $res);

        oci_free_statement($stid);
        oci_close($conn);

        $nextval = $res[$select][0] + rand(1,100000) + rand(1,100) + rand(1,10);

        return get_nextval($select, $from);
    }
//queries the database 
    function db_query($select, $from, $where = '1=1')
    {
        $conn   = db_conn();
        if (!$conn) return -1;

        $select = htmlspecialchars($select);
        $from   = htmlspecialchars($from);
        $where  = htmlspecialchars($where);

        $sql = "SELECT $select FROM $from WHERE $where";

        $stid = oci_parse($conn, $sql);
        oci_execute($stid);

        oci_fetch_all($stid, $res);

        oci_free_statement($stid);
        oci_close($conn);

        return $res;
    }
    // I want to try and make a vague insert function like the db_query you have above. ~Eric

    function db_query_with_cache($select, $from, $where = '1=1', $debug = 0)
    {
        ////////////////////////////////////////////////
        // Adam Carter memoisation high kick example. //
        ////////////////////////////////////////////////

        require_once("config.php");                                             // loads config info for cache timer length
        $config = new Config();

        // gets 'global' clear-cache?- flag on table.      if flag = 1, UNSETS session (user) cache-time for table
        if ($debug) echo 'get_session_global('."'clear-cache?-$from".') = ' . get_session_global('clear-cache?-'.$from).'<br>';
        if (get_session_global('clear-cache?-'.$from) == 1)
        {
            $cacheArr = array();
            set_session_global('cache-table-'.$from,$cacheArr);
            unset($_SESSION['cache-time-'.$from]);
        }

        // setup initial cache time so that the cache / process gets restarted
        $OhBaby = 0;
        if ((!isset($_SESSION['cache-time-'.$select.$from.$where])) || (is_null($_SESSION['cache-time-'.$select.$from.$where])))
        {
            $_SESSION['cache-time-'.$select.$from.$where] = microtime(true);
            $OhBaby = 1;
        }

        // sets easy to recognize variables to referenced session variables. note session specificity.
        $cache     = &$_SESSION['cache-'.$select.$from.$where];
        $cacheTime = &$_SESSION['cache-time-'.$select.$from.$where];

        // if there wasn't a cache-time or we've gone over the cache time for our config limit
        // conduct query and set times.
        if (($OhBaby) || ((microtime(true) - $cacheTime) > $config->get_hold_cache_time()))
        {
            $res       = db_query($select, $from, $where);
            $cache     = $res;
            $cacheTime = microtime(true);
            set_session_global('clear-cache?-'.$from, 0);
        }

        if ($debug == 1)
        {
            echo 'cache null = '.(int) is_null($_SESSION['cache-time-'.$select.$from.$where]).'<br>';
            echo 'microtime  = '.microtime(true).'<br>';
            echo 'cache-time = '.$cacheTime.'<br>';
            echo "microtime - cache-time = ".(microtime(true) - $cacheTime).'<br><br>';
        }

        return $cache;
    }
//creates a random num for the next Id number in the list. 
    function get_nextval($select, $from)
    { 
        $res = db_query($select, $from);
		$time = time();
        foreach ($res as $key => $arr)
        {
            $nextval = sizeof($res[$key]) + $time;
            break;
        } 
        return $nextval;
    }
	//removes from the data base
	function remove_from_db($from,$where,$col)
	{
		$conn   = db_conn();
        if (!$conn) return -1;

        $from   = htmlspecialchars($from);
        $where  = htmlspecialchars($where);

        $sql = "DELETE FROM $from WHERE $col = '$where'";
		
		//echo "<br>DELETE: " . $sql . "<br>";

        $stid = oci_parse($conn, $sql);
        oci_execute($stid);

        oci_free_statement($stid);
        oci_close($conn);

	}
	
	function update_db($table,$where,$col,$value)
	{
		$conn   = db_conn();
        if (!$conn) return -1;

        $table   = htmlspecialchars($table);
        $where  = htmlspecialchars($where);

        $sql = "UPDATE $table SET $col = $value WHERE $col = '$where'";
		
		//echo "<br>DELETE: " . $sql . "<br>";

        $stid = oci_parse($conn, $sql);
        oci_execute($stid);

        oci_free_statement($stid);
        oci_close($conn);

	}
?>