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
		$name_block = $_REQUEST['name_block'];
		$inv_array = $_REQUEST['inv_array'];
		$start_date = $_REQUEST['start_date'];
		$end_date = $_REQUEST['end_date'];
		$empl_id = $_REQUEST['empl_id'];
		
		$inv_array = explode(',', $inv_array); //First we grab the item string, and explode it into a array of ints
		
		//Insert statement for Item Reservation
		$insert = $connctn->prepare("insert into Rental
									(request_date, due_date, pick_up_date, return_date, sub_total_cost, total_cost, deposit, rental_status, cust_id, loc_id)
									values
									(:a, :b, NULL, NULL, NULL, NULL, NULL, 'Trip', 135, 1)"); //Remember to added in the quotes for the dates or result of the insert will look like "0000-00-00" on dates
		//Binding the vars along with their respected datatype
		$insert->bindValue(':a', $start_date, PDO::PARAM_STR);
		$insert->bindValue(':b', $end_date, PDO::PARAM_STR);
		$insert->execute();
		
		//The following is just a way to help Debug PDO inserts if something went wrong
		//print "Insert to Rental: ";
		//echo "\nPDO::errorInfo():\n";
		//print_r($insert->errorInfo());
		//echo "</br>";
		$rent_id = $connctn->lastInsertId();
		
		foreach($inv_array as $inv_id)
		{
			$array_of_items = $connctn->prepare("SELECT item_Backid
													FROM Item
													WHERE inv_id = :a");
							
			$array_of_items->bindValue(':a', $inv_id, PDO::PARAM_INT);
			$array_of_items->execute();
			$array_of_items = $array_of_items->fetchAll();
			foreach($array_of_items as $item_id)
			{
				$insert = $connctn->prepare("insert into Reserve1
											(cost_at_time, deposit_at_time, rent_id, item_Backid, empl_id)
											values
											(:a, :b, :c, :d, :e)");
				$insert->bindValue(':a', 0, PDO::PARAM_INT);
				$insert->bindValue(':b', 0, PDO::PARAM_INT);
				$insert->bindValue(':c', $rent_id, PDO::PARAM_INT);
				$insert->bindValue(':d', $item_id['item_Backid'], PDO::PARAM_INT);
				$insert->bindValue(':e', $empl_id, PDO::PARAM_INT);
				$insert->execute();
				//print "Insert to Reserve: ";
				//echo "\nPDO::errorInfo():\n";
				//print_r($insert->errorInfo());
				//echo "</br>";
			}
		}
		
		$date = date("Y-m-d h:i:s");
		$insert = $connctn->prepare("insert into Notes
									(note, timestamp, empl_id)
									values
									(:a, :b, :c)");
		//Binding the vars along with their respected datatype
		$insert->bindValue(':a', $name_block, PDO::PARAM_STR);
		$insert->bindValue(':b', $date, PDO::PARAM_STR);
		$insert->bindValue(':c', $empl_id, PDO::PARAM_INT);
		$insert->execute();
		$note_id = $connctn->lastInsertId();
		
		$insert = $connctn->prepare("insert into NotesRental
									(note_id, rent_id)
									values
									(:a, :b)");
		//Binding the vars along with their respected datatype
		$insert->bindValue(':a', $note_id, PDO::PARAM_INT);
		$insert->bindValue(':b', $rent_id, PDO::PARAM_INT);
		$insert->execute();
		$connctn = null;
?>