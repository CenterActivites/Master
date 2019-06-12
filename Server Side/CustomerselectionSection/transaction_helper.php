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
		$rent_id = $_REQUEST['trans_id'];
		$cust_id = $_REQUEST['cust_id'];
		
		//Checks if the pack_value is 0, if is then user just want all items. 
		$int_cust_id = (int)$cust_id;
		$int_rent_id = (int)$rent_id;
		
		$transaction = $connctn->prepare("SELECT inv_name, item_modeltype, item_size, item_Frontid, pick_up_date, return_date
											FROM Item a, Inventory b, Rental c, Reserve1 d
											WHERE a.inv_id = b.inv_id and a.item_Backid = d.item_Backid and c.rent_id = d.rent_id
													and c.cust_id = :a and c.rent_id = :z"); 
		$transaction->bindValue(':a', $int_cust_id, PDO::PARAM_INT);
		$transaction->bindValue(':z', $int_rent_id, PDO::PARAM_INT);
		$transaction->execute();
		$display_array = $transaction->fetchAll();
		$connctn = null;
		print json_encode($display_array);
?>