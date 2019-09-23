<?php
		/* Setting the Timezone */
		date_default_timezone_set('America/Los_Angeles');
		//Connecting to the database through a PDO connection
		require('/home/centerac/public_html/connect_info.php');
		require('/home/centerac/public_html/DB.php');
		error_reporting(E_ERROR | E_PARSE);
		$usr =  "centerac_" . $username;
		$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));
		
		//Grabs the pack_value sent by the AJAX call
		$empl_id = $_REQUEST['empl_id'];
		$log = $_REQUEST['log'];
		$expire_date = $_REQUEST['expire_date'];
		
		$date_time = date("Y-m-d H:i:s");
		$insert = $connctn->prepare("insert into Notes
									(note, timestamp, empl_id)
									values
									(:a, :b, :c)");
		//Binding the vars along with their respected datatype
		$insert->bindValue(':a', $log, PDO::PARAM_STR);
		$insert->bindValue(':b', $date_time, PDO::PARAM_STR);
		$insert->bindValue(':c', $empl_id, PDO::PARAM_INT);
		$insert->execute();
		$note_id = $connctn->lastInsertId();
		
		$insert = $connctn->prepare("insert into CommunicationLog
									(expire_date)
									values
									(:a)");
		//Binding the vars along with their respected datatype
		$insert->bindValue(':a', $expire_date, PDO::PARAM_STR);
		$insert->execute();
		$log_id = $connctn->lastInsertId();
		
		$insert = $connctn->prepare("insert into NotesComLog
									(note_id, log_id)
									values
									(:a, :b)");
		//Binding the vars along with their respected datatype
		$insert->bindValue(':a', $note_id, PDO::PARAM_INT);
		$insert->bindValue(':b', $log_id, PDO::PARAM_INT);
		$insert->execute();
		
		$empl_information = $connctn->prepare("SELECT empl_fname, empl_lname
												FROM Employee
												WHERE empl_id = :a");
		$empl_information->bindValue(':a', $empl_id, PDO::PARAM_INT);
		$empl_information->execute();
		$empl_information = $empl_information->fetchAll();
		
		$display_array['log_id'] = $log_id;
		$display_array['empl_name'] = $empl_information[0]['empl_fname'] . " " . $empl_information[0]['empl_lname'];
		$date_time = date("D, j M Y g:i a");
		$display_array['timestamp'] = $date_time;
		
		$connctn = null;
		print json_encode($display_array);
?>
