<?php
		//Connecting to the database through a PDO connection
		require('/home/centerac/public_html/connect_info.php');
		require('/home/centerac/public_html/DB.php');
		error_reporting(E_ERROR | E_PARSE);
		$usr =  "centerac_" . $username;
		$conn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));

		//Grabs the pack_value sent by the AJAX call
		$item_id = $_REQUEST['item_id'];
		$request_date = $_REQUEST['request_date'];
		$due_date = $_REQUEST['due_date'];
		
		$pad_request_date = date('Y-m-d', strtotime($request_date. ' - 5 days'));
		$pad_due_date = date('Y-m-d', strtotime($due_date. ' + 2 week'));

		$reserve = $conn->prepare("select request_date, due_date, rental_status 
									from Rental a, Reserve1 b
									where a.rent_id = b.rent_id and 
											a.return_date is null and 
											(a.rental_status = 'On-Going' or 
											a.rental_status = 'Trip') and 
                                            b.item_Backid = :a and 
                                            (due_date BETWEEN :b AND :c or 
                                            request_date BETWEEN :d AND :e)
                                    order by request_date");
		$reserve->bindValue(':a', $item_id, PDO::PARAM_INT);
		$reserve->bindValue(':b', $pad_request_date, PDO::PARAM_STR);
		$reserve->bindValue(':c', $request_date, PDO::PARAM_STR);
		$reserve->bindValue(':d', $due_date, PDO::PARAM_STR);
		$reserve->bindValue(':e', $pad_due_date, PDO::PARAM_STR);
		$reserve->execute();
		$reserve = $reserve->fetchAll();
		
		$conn = null;
		print json_encode($reserve);
?>
