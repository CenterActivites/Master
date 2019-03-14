<?php
		//Connecting to the database through a PDO connection
		require('/home/centerac/public_html/connect_info.php');
		require('/home/centerac/public_html/DB.php');
		error_reporting(E_ERROR | E_PARSE);
		$usr =  "centerac_" . $username;
		$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));

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
