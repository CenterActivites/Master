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
	$empl_id = $_REQUEST['empl_id'];
	$curr_timestamp = date("Y-m-d h:i:s");
	
	$previous_status = $connctn ->prepare("SELECT stat_id 
											FROM Item 
											WHERE item_Backid = '$item_id'");
	$previous_status ->execute();
	$previous_status = $previous_status->fetchAll();

	$update = $connctn ->prepare("UPDATE Item
									SET stat_id = '$stat_id'
									WHERE item_Backid = '$item_id'");
	$update ->execute();
	
	$insert = $connctn->prepare("insert into StatusChange
								(timestamp, change_from, change_to, item_Backid, empl_id)
								values
								(:a, :b, :c, :d, :e)");
	//Binding the vars along with their respected datatype
	$insert->bindValue(':a', $curr_timestamp, PDO::PARAM_STR);
	$insert->bindValue(':b', $previous_status[0][0], PDO::PARAM_INT);
	$insert->bindValue(':c', $stat_id, PDO::PARAM_INT);
	$insert->bindValue(':d', $item_id, PDO::PARAM_INT);
	$insert->bindValue(':e', $empl_id, PDO::PARAM_INT);
	$insert->execute();
	//print "Insert to StatusChange: ";
	//echo "\nPDO::errorInfo():\n";
	//print_r($insert->errorInfo());
	//echo "</br>";
	
	$connctn = null;

?>