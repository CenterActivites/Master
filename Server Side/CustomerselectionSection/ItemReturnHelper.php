<?php

		//                                                     !!!!!!!!!!!!!!!!!!!DO NOT PUSH THIS FILE TO GITHUB!!!!!!!!!!!!!!!!!!!!


		//Connecting to the database through a PDO connection. For now DO NOT PUSH THIS FILE TO GITHUB!!! It has SENSITIVE INFORMATION ABOUT THE LOGIN

		$connctn = new PDO("mysql:host=localhost; dbname=centerac_center_activities", "centerac_test", "Testing123+", array('charset'=>'utf8'));

		//TODO: Try to get the hsu_conn_sess function to work properly so we just don't have to hard code in the username and password to the database

		/*require_once('hsu_conn_sess.php');
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
        $connctn = hsu_conn_sess($username, $password);
		
		strtotime (date ("Y-m-d"))
		
		*/

		//Setting the data's character setting we get from the database to utf8 because JSON only works with utf8. Also have to do it too along with the
		//initial connecting to the database, at the end of the statement.
		$connctn->query("SET CHARACTER SET utf8");

		//Grabs the button_value sent by the AJAX call
		$button_value = $_REQUEST['button_value'];

		//Checks if the button_value is "Late Retur", if is then user wants to display all customers that are late in returning their items.
		if($button_value == "Late Returns")
		{
			$current_date = date("Y-m-d");
			$select_item = $connctn->prepare("SELECT b.cust_id, f_name, l_name, c_phone,c_email
												FROM Customer a, Reserve b
												WHERE a.cust_id = b.cust_id and b.pick_up_date IS NOT NULL and b.due_date < :current_date
												GROUP BY b.cust_id");
			$select_item->bindValue(':current_date', $current_date, PDO::PARAM_STR);
			$select_item->execute();
			$display_array = $select_item->fetchAll();
			$connctn = null; //Also remember to close the Database Connection
			print json_encode($display_array); //Returns the data back to the AJAX call in JSON format
		}
		//Else which is our "all" option where the user would want to display everyone that has an item out
		else
		{
			$select_item = $connctn->prepare("SELECT b.cust_id, f_name, l_name, c_phone,c_email
												FROM Customer a, Reserve b
												WHERE a.cust_id = b.cust_id and b.pick_up_date IS NOT NULL
												GROUP BY b.cust_id");
			$select_item->execute();
			$display_array = $select_item->fetchAll();
			$connctn = null;
			print json_encode($display_array);
		}
?>
