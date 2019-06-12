<?php
	//Connecting to the database through a PDO connection
	require('/home/centerac/public_html/connect_info.php');
	require('/home/centerac/public_html/DB.php');
	error_reporting(E_ERROR | E_PARSE);
	$usr =  "centerac_" . $username;
	$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));
	
	//Grabs the pack_value sent by the AJAX call
	$choosen_report = $_REQUEST['chosen_report'];
	$stat_val = $_REQUEST['status'];
	$dbw_val = $_REQUEST['dbw'];
	$public_val = $_REQUEST['public'];
	$loc_val = $_REQUEST['location'];
	$cat_val = $_REQUEST['cat'];
	$from_date_value = $_REQUEST['from_date'];
	$to_date_value = $_REQUEST['to_date'];
	
	switch ($choosen_report) 
	{
		case "over_due":
			
			if($dbw_val == 'yes')
			{
				$dbw_val = "A.dbw_own = 1 and ";
			}
			elseif($dbw_val == 'no')
			{
				$dbw_val = "A.dbw_own = 0 and ";
			}
			else
			{
				$dbw_val = "";
			}
			
			if($public_val == 'yes')
			{
				$public_val = "A.public = 1 and ";
			}
			elseif($public_val == 'no')
			{
				$public_val = "A.public = 0 and ";
			}
			else
			{
				$public_val = "";
			}
			
			if($loc_val == 'ca')
			{
				$loc_val = "A.loc_id = '1' and ";
			}
			elseif($loc_val == 'hbac')
			{
				$loc_val = "A.loc_id = '2' and ";
			}
			else
			{
				$loc_val = "";
			}
			
			if($cat_val == 0)
			{
				$cat_val = "";
			}
			else
			{
				$cat_val = "C.cat_id = " . $cat_val . " and ";
			}
			
		
			$report = "SELECT item_modeltype, inv_name, cat_name, item_Frontid, f_name, l_name, c_phone, c_email, due_date
						FROM Item A, Inventory B, Category C, Rental D, CheckOut E, Customer F
						WHERE A.inv_id = B.inv_id and 
								B.cat_id = C.cat_id and 
								A.item_Backid = E.item_Backid and 
								D.rent_id = E.rent_id and
								D.cust_id = F.cust_id and
								D.pick_up_date IS NOT NULL and
								" . $dbw_val . $public_val . $loc_val . $cat_val . "
								D.return_date IS NULL
						ORDER BY due_date, inv_name, item_modeltype";
			break;
		case "upcoming":
			
			if($loc_val == 'ca')
			{
				$loc_val = "b.loc_id = '1' and ";
			}
			elseif($loc_val == 'hbac')
			{
				$loc_val = "b.loc_id = '2' and ";
			}
			else
			{
				$loc_val = "";
			}
			
			$report = "SELECT f_name, l_name, c_phone, c_email, request_date
						FROM Customer a, Rental b
						WHERE a.cust_id = b.cust_id and 
								b.pick_up_date IS NULL and 
								" . $loc_val . "
								b.rental_status = 'On-Going'
						ORDER BY request_date, l_name, f_name";
			break;
		case "equ_count":
			
			if($dbw_val == 'yes')
			{
				$dbw_val = "A.dbw_own = 1 and ";
			}
			elseif($dbw_val == 'no')
			{
				$dbw_val = "A.dbw_own = 0 and ";
			}
			else
			{
				$dbw_val = "";
			}
			
			if($public_val == 'yes')
			{
				$public_val = "A.public = 1 and ";
			}
			elseif($public_val == 'no')
			{
				$public_val = "A.public = 0 and ";
			}
			else
			{
				$public_val = "";
			}
			
			if($loc_val == 'ca')
			{
				$loc_val = "A.loc_id = '1' and ";
			}
			elseif($loc_val == 'hbac')
			{
				$loc_val = "A.loc_id = '2' and ";
			}
			else
			{
				$loc_val = "";
			}
			
			if($cat_val == 0)
			{
				$cat_val = "";
			}
			else
			{
				$cat_val = "C.cat_id = " . $cat_val . " and ";
			}
			
			if($stat_val == 0)
			{
				$stat_val = "";
			}
			else
			{
				$stat_val = "A.stat_id = " . $stat_val . " and ";
			}
		
			$report = "SELECT inv_name, cat_name, count(inv_name)
						FROM Item A, Inventory B, Category C
						WHERE A.inv_id = B.inv_id and 
								" . $dbw_val . $public_val . $loc_val . $cat_val .  $stat_val . "
								B.cat_id = C.cat_id
						GROUP BY inv_name
						ORDER BY cat_name, inv_name";
			break;
		case "empl_infor":
			
			if($loc_val == 'ca')
			{
				$loc_val = "and b.loc_id = '1'";
			}
			elseif($loc_val == 'hbac')
			{
				$loc_val = "and b.loc_id = '2'";
			}
			else
			{
				$loc_val = "";
			}
			
			$report = "SELECT empl_fname, empl_lname, phone_num, title, access_lvl, empl_email, loc_name
						FROM Employee a, Location b
						WHERE a.loc_id = b.loc_id 
								" . $loc_val . "
						ORDER BY access_lvl, empl_lname, empl_fname";
			break;
		case "all_equ":
			
			if($dbw_val == 'yes')
			{
				$dbw_val = "A.dbw_own = 1 and ";
			}
			elseif($dbw_val == 'no')
			{
				$dbw_val = "A.dbw_own = 0 and ";
			}
			else
			{
				$dbw_val = "";
			}
			
			if($public_val == 'yes')
			{
				$public_val = "A.public = 1 and ";
			}
			elseif($public_val == 'no')
			{
				$public_val = "A.public = 0 and ";
			}
			else
			{
				$public_val = "";
			}
			
			if($loc_val == 'ca')
			{
				$loc_val = "A.loc_id = '1' and ";
			}
			elseif($loc_val == 'hbac')
			{
				$loc_val = "A.loc_id = '2' and ";
			}
			else
			{
				$loc_val = "";
			}
			
			if($cat_val == 0)
			{
				$cat_val = "";
			}
			else
			{
				$cat_val = "C.cat_id = " . $cat_val . " and ";
			}
			
			if($stat_val == 0)
			{
				$stat_val = "";
			}
			else
			{
				$stat_val = "A.stat_id = " . $stat_val . " and ";
			}
			
			if($from_date_value != "" && $to_date_value != "")
			{
				$dates_to_narrow = "pur_date BETWEEN '" . $from_date_value . "' AND '" . $to_date_value . "' and ";
			}
			elseif($from_date_value != "" && $to_date_value == "")
			{
				$current_date = date('Y-m-d');
				$dates_to_narrow = "pur_date BETWEEN '" . $from_date_value . "' AND '" . $current_date . "' and ";
			}
			else
			{
				$dates_to_narrow = "";
			}
		
			$report = "SELECT item_size, item_modeltype, inv_name, cat_name, item_Frontid, public, D.stat_name, pur_price, pur_date
						FROM Item A, Inventory B, Category C, Status D
						WHERE A.inv_id = B.inv_id and 
								B.cat_id = C.cat_id and 
								" . $dbw_val . $public_val . $loc_val . $cat_val .  $stat_val . $dates_to_narrow . "
								A.stat_id = D.stat_id
						ORDER BY cat_name, inv_name, item_modeltype, item_Backid";
			break;
		default:
			echo "Something went wrong";
	}
	
	
	$selected_report = $connctn->prepare($report);
	$selected_report->execute();
	$selected_report = $selected_report->fetchAll();
	
	$connctn = null; //Also remember to close the Database Connection
	print json_encode($selected_report); //Returns the data back to the AJAX call in JSON format

?>
