<?php
		//Connecting to the database through a PDO connection
		require('/home/centerac/public_html/connect_info.php');
		require('/home/centerac/public_html/DB.php');
		error_reporting(E_ERROR | E_PARSE);
		$usr =  "centerac_" . $username;
		$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));

		//Grabs the pack_value sent by the AJAX call
		$pack_value = $_REQUEST['pack_id'];

		//Checks if the pack_value is 0, if is then user deselects the package and we need to show nothing
		if($pack_value[0] == "0")
		{
			$connctn = null; //Also remember to close the Database Connection
			print json_encode(""); //Returns the data back to the AJAX call in JSON format
		}
		//Else we need to show what items are in the package and the amount of each item
		else
		{
			$int_pack_value = (int)$pack_value[0];
			$select_item = $connctn->prepare("select inv_name, count(inv_name)
							from Inventory c, InvPack d, Packages e
							where c.inv_id = d.inv_id and 
									e.pack_id = d.pack_id and 
									d.pack_id = :a 
							group by inv_name");
			$select_item->bindValue(':a', $int_pack_value, PDO::PARAM_INT);
			$select_item->execute();
			$display_array = $select_item->fetchAll();
			$connctn = null;
			print json_encode($display_array);
		}
?>
