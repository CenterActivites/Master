<?php
/*
This file consists of functions for caching (currently not implemented)
*/


//ob_start();  -- for testing

require_once("php-session.php");

// function set_session_global($key, $value, $global_id = '1');
// function get_session_global($key, $global_id = '1');

// tableArray = array(table => time)
// cacheArray = array(table => array(string, cache))

function set_cache($select, $from, $where = '1=1', $contents, $time)
{
    $tableArray = get_session_global('tableArray');
    set_session_global('tableArray', array($from => $time));

    $cacheArray = get_session_global('cacheArray');
    add_cache($select, $from, $where, $contents);
}

function get_cache($select, $from, $where)
{
    $cacheArray = get_session_global('cacheArray');

    foreach ($cacheArray as $table => $array)
    {
        if ($from == $table)
        {
            foreach($array as $sqlKey => $cache)
            {
                if($select.$from.$where == $sqlKey) return $cache;
            }
        }
    }

    return NULL;
}

// function set_session_global($key, $value, $global_id = '1');
// function get_session_global($key, $global_id = '1');

// tableArray = array(table => time)
// cacheArray = array(table => array(string, cache))

function add_cache($select, $from, $where, $contents)
{
    $cacheArray = get_session_global('cacheArray');
    $cacheArray[$select.$from.$where] = $contents;
    set_session_global('cacheArray', array($table => $cacheArray));
}

function clear_cache($table)
{
    $tableArray = get_session_global('tableArray');
    $tableArray[$table] = NULL;
    set_session_global('tableArray', $tableArray);

    $cacheArray = get_session_global('cacheArray');
    set_session_global('cacheArray', array($from => NULL));
}
/*set_cache('*', 'item', '1=1', 12345);
ob_flush();*/