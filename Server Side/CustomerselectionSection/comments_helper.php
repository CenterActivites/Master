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
		
		//Checks if the pack_value is 0, if is then user just want all items. 
		$int_cust_id = (int)$cust_id;
		$int_rent_id = (int)$rent_id;
		
		$transaction = $connctn->prepare("SELECT note, empl_fname, empl_lname
											FROM Notes a, Employee b, Rental c, NotesRental d
											WHERE a.empl_id = b.empl_id and 
													a.note_id = d.note_id and 
													c.rent_id = d.rent_id and 
													c.rent_id = :z"); 
		$transaction->bindValue(':z', $int_rent_id, PDO::PARAM_INT);
		$transaction->execute();
		$display_array = $transaction->fetchAll();
		$connctn = null;
		print json_encode($display_array);
?>