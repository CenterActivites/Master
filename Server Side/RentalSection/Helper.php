<?php

		//                                                     !!!!!!!!!!!!!!!!!!!DO NOT PUSH THIS FILE TO GITHUB!!!!!!!!!!!!!!!!!!!!


		//Connecting to the database through a PDO connection. For now DO NOT PUSH THIS FILE TO GITHUB!!! It has SENSITIVE INFORMATION ABOUT THE LOGIN

		$connctn = new PDO("mysql:host=localhost; dbname=centerac_center_activities", "centerac_test", "Testing123+", array('charset'=>'utf8'));

		//TODO: Try to get the hsu_conn_sess function to work properly so we just don't have to hard code in the username and password to the database

		/*require_once('hsu_conn_sess.php');
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
        $connctn = hsu_conn_sess($username, $password);*/

		//Setting the data's character setting we get from the database to utf8 because JSON only works with utf8. Also have to do it too along with the
		//initial connecting to the database, at the end of the statement.
		$connctn->query("SET CHARACTER SET utf8");

		//Grabs the pack_value sent by the AJAX call
		$pack_value = $_REQUEST['pack_value'];

		//Checks if the pack_value is 0, if is then user just want all items.
		if($pack_value[0] == "0")
		{
			$select_item = $connctn->prepare("SELECT item_Backid, inv_name, item_size, item_Frontid, item_modeltype
											FROM Item a, Inventory c, Status b
											WHERE a.inv_id = c.inv_id and a.stat_id = b.stat_id and a.stat_id = 1");
			$select_item->execute();
			$display_array = $select_item->fetchAll();
			$connctn = null; //Also remember to close the Database Connection
			print json_encode($display_array); //Returns the data back to the AJAX call in JSON format
		}
		//Else we just use the pack_value in our select query because pack_value just correlate with the pack_id in our database
		else
		{
			$int_pack_value = (int)$pack_value[0];
			$select_item = $connctn->prepare("select item_Backid, inv_name, item_size, item_Frontid, item_modeltype
							from Item a, Inventory c, Status b, InvPack d, Packages e
							where a.inv_id = c.inv_id and a.stat_id = b.stat_id and a.stat_id = 1
									and c.inv_id = d.inv_id and e.pack_id = d.pack_id and d.pack_id = :a
									and a.stat_id = 1
							group by item_Backid");
			$select_item->bindValue(':a', $int_pack_value, PDO::PARAM_INT);
			$select_item->execute();
			$display_array = $select_item->fetchAll();
			$connctn = null;
			print json_encode($display_array);
		}
?>
