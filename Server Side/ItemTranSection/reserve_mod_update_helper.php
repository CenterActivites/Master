<?php
	//
	//Item status update php file. This is where the update is happening when users select a new status on the item select table.
	//


	//Connecting to the database through a PDO connection
	require('/home/centerac/public_html/connect_info.php');
	require('/home/centerac/public_html/DB.php');
    error_reporting(E_ERROR | E_PARSE);
	$usr =  "centerac_" . $username;
	$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));

	$item_id = $_REQUEST['item_id'];
	$stat_id = $_REQUEST['status_id'];

	$update = $connctn ->prepare("UPDATE Item
									SET stat_id = '$stat_id'
									WHERE item_Backid = '$item_id'");
	$update ->execute();
	$connctn = null;

?>