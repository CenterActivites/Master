<?php
		//Connecting to the database through a PDO connection
		require('/home/centerac/public_html/connect_info.php');
		require('/home/centerac/public_html/DB.php');
		error_reporting(E_ERROR | E_PARSE);
		$usr =  "centerac_" . $username;
		$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));

		//Grabs the pack_value sent by the AJAX call
		$loc = $_REQUEST['loc_id'];
		
		$display_array = array(); //Here is where we going to be saving all the prices for the receipt
		
		//Grabs the current date to correspond to the database
		$current_date = date("Y-m-d");
		
		//"Due rental" query
		$late_rentals = $connctn->prepare("SELECT b.cust_id, f_name, l_name, c_phone,c_email, due_date
											FROM Customer a, Rental b
											WHERE a.cust_id = b.cust_id and 
													b.pick_up_date IS NOT NULL and 
													b.return_date IS NULL and 
													b.due_date < :a and 
													b.rental_status = 'On-Going' and 
													b.loc_id = :b
											GROUP BY b.cust_id
											ORDER BY due_date");
		$late_rentals->bindValue(':a', $current_date, PDO::PARAM_STR);
		$late_rentals->bindValue(':b', $loc, PDO::PARAM_INT);
		$late_rentals->execute();
		$late_rentals = $late_rentals->fetchAll();
		
		$display_array['late'] = $late_rentals;
		
		//"Due rental" query
		$reserved_rentals = $connctn->prepare("SELECT f_name, l_name, c_phone,c_email, request_date, rent_id
											FROM Customer a, Rental b
											WHERE a.cust_id = b.cust_id and 
													b.pick_up_date IS NULL and 
													b.rental_status = 'On-Going' and 
													b.loc_id = :a
											ORDER BY request_date, l_name, f_name");
		$reserved_rentals->bindValue(':a', $loc, PDO::PARAM_STR);
		$reserved_rentals->execute();
		$reserved_rentals = $reserved_rentals->fetchAll();
		
		$display_array['reserve'] = $reserved_rentals;
		
		$trips = $connctn->prepare("SELECT note, c.rent_id, request_date
									FROM Notes a, NotesRental b, Rental c
									WHERE a.note_id = b.note_id and 
											b.rent_id = c.rent_id and 
											c.rental_status = 'Trip' and 
											c.loc_id = :a
									ORDER BY request_date");
		$trips->bindValue(':a', $loc, PDO::PARAM_STR);
		$trips->execute();
		$trips = $trips->fetchAll();
		
		$display_array['trip'] = $trips;
		
		$connctn = null;
		print json_encode($display_array);
?>
