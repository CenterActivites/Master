<?php
		//Connecting to the database through a PDO connection
		require('/home/centerac/public_html/connect_info.php');
		require('/home/centerac/public_html/DB.php');
        error_reporting(E_ERROR | E_PARSE);
		
		$usr =  "centerac_" . $username;
		
		$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));
		
		//Setting the data's character setting we get from the database to utf8 because JSON only works with utf8. Also have to do it too along with the 
		//initial connecting to the database, at the end of the statement.
		$connctn->query("SET CHARACTER SET utf8");
		
		//Grabs the time_stamp sent by the AJAX call
		$trip_id = $_REQUEST['trip_id'];
		
		$select_trip_inv_list = $connctn->prepare("select inv_id
													from InvTrip
													where trip_id = :a");
		$select_trip_inv_list->bindValue(':a', $trip_id, PDO::PARAM_INT);
		$select_trip_inv_list->execute();
		$display_array = $select_trip_inv_list->fetchAll();
		
		print json_encode($display_array); //Returns the data back to the AJAX call in JSON format
		
		$connctn = null;
?>