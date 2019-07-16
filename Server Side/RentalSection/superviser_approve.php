<?php
		//Connecting to the database through a PDO connection
		require('/home/centerac/public_html/connect_info.php');
		require('/home/centerac/public_html/DB.php');
		error_reporting(E_ERROR | E_PARSE);
		$usr =  "centerac_" . $username;
		$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));

		//Grabs the pack_value sent by the AJAX call
		$user_name = $_REQUEST['user_name'];
		$password = $_REQUEST['password'];
		
		$approval = $connctn->prepare("SELECT access_lvl
										FROM Employee
										WHERE user_n = :a and pass_w = :b");
		$approval->bindValue(':a', $user_name, PDO::PARAM_STR);
		$approval->bindValue(':b', $password, PDO::PARAM_STR);
		$approval->execute();
		$approval = $approval->fetchAll();
		$return_array = $approval[0]['access_lvl'];
		$connctn = null;
		print json_encode($return_array);
?>
