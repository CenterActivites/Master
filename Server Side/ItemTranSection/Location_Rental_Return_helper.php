<?php
		//Connecting to the database through a PDO connection
		require('/home/centerac/public_html/connect_info.php');
		require('/home/centerac/public_html/DB.php');
		error_reporting(E_ERROR | E_PARSE);
		$usr =  "centerac_" . $username;
		$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));

		//Grabs the pack_value sent by the AJAX call
		$loc = $_REQUEST['loc_id'];
		
		//"Due rental" query
		$late_rentals = $connctn->prepare("SELECT b.cust_id, f_name, l_name, c_phone, c_email, due_date
											FROM Customer a, Rental b
											WHERE a.cust_id = b.cust_id and 
													b.pick_up_date IS NOT NULL and 
													b.return_date is NULL and 
													b.loc_id = :a
											GROUP BY b.cust_id
											ORDER BY due_date, l_name, f_name");
		$late_rentals->bindValue(':a', $loc, PDO::PARAM_INT);
		$late_rentals->execute();
		$display_array = $late_rentals->fetchAll();
		
		$connctn = null;
		print json_encode($display_array);
?>
