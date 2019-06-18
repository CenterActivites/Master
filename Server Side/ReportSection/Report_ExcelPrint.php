<?php
	require_once '../PHPExcel-1.8/Classes/PHPExcel.php';
	
	//Connecting to the database through a PDO connection
	require('/home/centerac/public_html/connect_info.php');
	require('/home/centerac/public_html/DB.php');
    error_reporting(E_ERROR | E_PARSE);
	$usr =  "centerac_" . $username;
	$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));
	
	$choosen_report = $_POST['chosen_report'];
	$stat_val = $_POST['status_hidden'];
	$dbw_val = $_POST['dbw_hidden'];
	$public_val = $_POST['public_hidden'];
	$loc_val = $_POST['location_hidden'];
	$cat_val = $_POST['cat_hidden'];
	$from_date_value = $_POST['from_date'];
	$to_date_value = $_POST['to_date'];
	
	
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
			
			if($cat_val == "0")
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
						
			$excel_report = $connctn->prepare($report);
			$excel_report->execute();
			$display_array = $excel_report->fetchAll();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Front ID');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Item Name');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Model');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Category of Item');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Customer Name');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Customer Phone');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Customer Email');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Date Item was Due By');
			
			$row_count = 2;
			
			for($i = 0; $i < count($display_array); $i++)
			{
				$curr_inv_name = $display_array[$i]["inv_name"];
				$curr_item_model = $display_array[$i]["item_modeltype"];
				$curr_item_frontid = $display_array[$i]["item_Frontid"];
				$curr_cat_name = $display_array[$i]["cat_name"];
				$curr_f_name = $display_array[$i]["f_name"];
				$curr_l_name = $display_array[$i]["l_name"];
				$curr_c_phone = $display_array[$i]["c_phone"];
				$curr_c_email = $display_array[$i]["c_email"];
				$curr_due_date = $display_array[$i]["due_date"];

				if($curr_item_model == NULL)
				{
					$curr_item_model = "";
				}
				
				if($curr_item_frontid == NULL)
				{
					$curr_item_frontid = "";
				}
				
				$cust_name = $curr_f_name . " " . $curr_l_name;
				
				
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row_count, $curr_item_frontid);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row_count, $curr_inv_name);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, $curr_item_model);
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $row_count, $curr_cat_name);
				$objPHPExcel->getActiveSheet()->setCellValue('E' . $row_count, $cust_name);
				$objPHPExcel->getActiveSheet()->setCellValue('F' . $row_count, $curr_c_phone);
				$objPHPExcel->getActiveSheet()->setCellValue('G' . $row_count, $curr_c_email);
				$objPHPExcel->getActiveSheet()->setCellValue('H' . $row_count, $curr_due_date);
				
				$row_count++;
			}
			
			
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
			
			$report = "SELECT f_name, l_name, c_phone, c_email, request_date, item_Frontid, inv_name
						FROM Customer a, Rental b, Reserve1 c, Item d, Inventory e
						WHERE a.cust_id = b.cust_id and 
								b.rent_id = c.rent_id and 
								c.item_Backid = d.item_Backid and 
								d.inv_id = e.inv_id and 
								b.pick_up_date IS NULL and 
								" . $loc_val . "
								b.rental_status = 'On-Going'
						ORDER BY request_date, l_name, f_name";
						
						
			$excel_report = $connctn->prepare($report);
			$excel_report->execute();
			$display_array = $excel_report->fetchAll();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Front ID');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Item Name');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Customer Name');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Customer Phone');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Customer Email');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Request Date');
			
			$row_count = 2;
			
			for($i = 0; $i < count($display_array); $i++)
			{
				$curr_inv_name = $display_array[$i]["inv_name"];
				$curr_item_frontid = $display_array[$i]["item_Frontid"];
				$curr_f_name = $display_array[$i]["f_name"];
				$curr_l_name = $display_array[$i]["l_name"];
				$curr_c_phone = $display_array[$i]["c_phone"];
				$curr_c_email = $display_array[$i]["c_email"];
				$curr_request_date = $display_array[$i]["request_date"];
				
				if($curr_item_frontid == NULL)
				{
					$curr_item_frontid = "";
				}
				
				$cust_name = $curr_f_name . " " . $curr_l_name;
				
				
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row_count, $curr_item_frontid);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row_count, $curr_inv_name);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, $cust_name);
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $row_count, $curr_c_phone);
				$objPHPExcel->getActiveSheet()->setCellValue('E' . $row_count, $curr_c_email);
				$objPHPExcel->getActiveSheet()->setCellValue('F' . $row_count, $curr_request_date);
				
				$row_count++;
			}		
			
			
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
			
			if($cat_val == "0")
			{
				$cat_val = "";
			}
			else
			{
				$cat_val = "C.cat_id = " . $cat_val . " and ";
			}
			
			if($stat_val == "0")
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
						
						
			$excel_report = $connctn->prepare($report);
			$excel_report->execute();
			$display_array = $excel_report->fetchAll();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Item Name');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Category');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Number of Items');
			
			$row_count = 2;
			
			for($i = 0; $i < count($display_array); $i++)
			{
				$curr_inv_name = $display_array[$i]["inv_name"];
				$curr_cat_name = $display_array[$i]["cat_name"];
				$curr_count = $display_array[$i]["count(inv_name)"];
				
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row_count, $curr_inv_name);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row_count, $curr_cat_name);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, $curr_count);
				
				$row_count++;
			}
			
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
						
			$excel_report = $connctn->prepare($report);
			$excel_report->execute();
			$display_array = $excel_report->fetchAll();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Employee Name');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Phone Number');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Email');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Title');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Access Level');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Location');
			
			$row_count = 2;
			
			for($i = 0; $i < count($display_array); $i++)
			{
				$curr_empl_fname = $display_array[$i]["empl_fname"];
				$curr_empl_lname = $display_array[$i]["empl_lname"];
				$curr_phone_num = $display_array[$i]["phone_num"];
				$curr_title = $display_array[$i]["title"];
				$curr_access_lvl = $display_array[$i]["access_lvl"];
				$curr_empl_email = $display_array[$i]["empl_email"];
				$curr_loc_name = $display_array[$i]["loc_name"];
				
				$empl_name = $curr_empl_fname . " " . $curr_empl_lname;
				
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row_count, $empl_name);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row_count, $curr_phone_num);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, $curr_empl_email);
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $row_count, $curr_title);
				$objPHPExcel->getActiveSheet()->setCellValue('E' . $row_count, $curr_access_lvl);
				$objPHPExcel->getActiveSheet()->setCellValue('F' . $row_count, $curr_loc_name);
				
				$row_count++;
			}
			
			
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
			
			if($cat_val == "0")
			{
				$cat_val = "";
			}
			else
			{
				$cat_val = "C.cat_id = " . $cat_val . " and ";
			}
			
			if($stat_val == "0")
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
			
			$excel_report = $connctn->prepare($report);
			$excel_report->execute();
			//echo "\nPDO::errorInfo():\n";
			//print_r($excel_report->errorInfo());
			//echo "</br>";
			$display_array = $excel_report->fetchAll();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Front ID');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Item Name');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Model');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Item Size');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Category');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Rentable');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Status');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Purchase Price');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Purchase Date');
			
			$row_count = 2;
			
			for($i = 0; $i < count($display_array); $i++)
			{
				$curr_inv_name = $display_array[$i]["inv_name"];
				$curr_item_model = $display_array[$i]["item_modeltype"];
				$curr_item_frontid = $display_array[$i]["item_Frontid"];
				$curr_cat_name = $display_array[$i]["cat_name"];
				$curr_item_size = $display_array[$i]["item_size"];
				$curr_public_value = $display_array[$i]["public"];
				$curr_stat = $display_array[$i]["stat_name"];
				$curr_pur_price = $display_array[$i]["pur_price"];
				$curr_pur_date = $display_array[$i]["pur_date"];

				if($curr_item_model == NULL)
				{
					$curr_item_model = "";
				}
				
				if($curr_item_frontid == NULL)
				{
					$curr_item_frontid = "";
				}
				
				if($curr_item_size == NULL)
				{
					$curr_item_size = "";
				}
				
				if($curr_public_value == '0')
				{
					$curr_public_value = "Non-Rentable";
				}
				else
				{
					$curr_public_value = "Rentable";
				}
				
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row_count, $curr_item_frontid);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row_count, $curr_inv_name);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, $curr_item_model);
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $row_count, $curr_item_size);
				$objPHPExcel->getActiveSheet()->setCellValue('E' . $row_count, $curr_cat_name);
				$objPHPExcel->getActiveSheet()->setCellValue('F' . $row_count, $curr_public_value);
				$objPHPExcel->getActiveSheet()->setCellValue('G' . $row_count, $curr_stat);
				$objPHPExcel->getActiveSheet()->setCellValue('H' . $row_count, $curr_pur_price);
				$objPHPExcel->getActiveSheet()->setCellValue('I' . $row_count, $curr_pur_date);
				
				$row_count++;
			}
			
			break;
		case "revenue":
			
			if($from_date_value != "" && $to_date_value != "")
			{
				$dates_to_narrow = "request_date BETWEEN '" . $from_date_value . "' AND '" . $to_date_value . "' and ";
			}
			elseif($from_date_value != "" && $to_date_value == "")
			{
				$current_date = date('Y-m-d');
				$dates_to_narrow = "request_date BETWEEN '" . $from_date_value . "' AND '" . $current_date . "' and ";
			}
			else
			{
				$dates_to_narrow = "";
			}
			
			if($loc_val == 'ca')
			{
				$loc_val = "a.loc_id = '1' and ";
			}
			elseif($loc_val == 'hbac')
			{
				$loc_val = "a.loc_id = '2' and ";
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
				$cat_val = "e.cat_id = " . $cat_val . " and ";
			}
			
			if($dbw_val == 'yes')
			{
				$dbw_val = "a.dbw_own = 1 and ";
			}
			elseif($dbw_val == 'no')
			{
				$dbw_val = "a.dbw_own = 0 and ";
			}
			else
			{
				$dbw_val = "";
			}
			
			$report = "SELECT item_Frontid, inv_name, item_modeltype, SUM(cost_at_time)
						FROM Item a, Inventory b, Rental c, Category e, Reserve1 f
						WHERE a.inv_id = b.inv_id and
								a.item_Backid = f.item_Backid and 
								e.cat_id = b.cat_id and
								" . $dbw_val . $loc_val . $cat_val . $dates_to_narrow . "
								c.rent_id = f.rent_id
						GROUP BY a.item_Backid
						ORDER BY inv_name, item_Frontid, item_modeltype";
						
			$excel_report = $connctn->prepare($report);
			$excel_report->execute();
			$display_array = $excel_report->fetchAll();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Item Id');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Item Name');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Item Model/Type');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Revenue Generated by Item');
			
			$row_count = 2;
			$total_revenue = 0;
			for($i = 0; $i < count($display_array); $i++)
			{
				$curr_item_id = $display_array[$i]["item_Frontid"];
				$curr_item_name = $display_array[$i]["inv_name"];
				$curr_item_modeltype = $display_array[$i]["item_modeltype"];
				$curr_revenue_by_item = $display_array[$i]["SUM(cost_at_time)"];
				
				$total_revenue = $total_revenue + (int)$curr_revenue_by_item;
				
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row_count, $curr_item_id);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row_count, $curr_item_name);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, $curr_item_modeltype);
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $row_count, $curr_revenue_by_item);
				
				$row_count++;
			}
			
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, "Total Revenue: ");
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $row_count, $total_revenue);
			
			break;
		case "num_rent":
			
			if($from_date_value != "" && $to_date_value != "")
			{
				$dates_to_narrow = "request_date BETWEEN '" . $from_date_value . "' AND '" . $to_date_value . "' and ";
			}
			elseif($from_date_value != "" && $to_date_value == "")
			{
				$current_date = date('Y-m-d');
				$dates_to_narrow = "request_date BETWEEN '" . $from_date_value . "' AND '" . $current_date . "' and ";
			}
			else
			{
				$dates_to_narrow = "";
			}
			
			if($loc_val == 'ca')
			{
				$loc_val = "a.loc_id = '1' and ";
			}
			elseif($loc_val == 'hbac')
			{
				$loc_val = "a.loc_id = '2' and ";
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
				$cat_val = "e.cat_id = " . $cat_val . " and ";
			}
			
			if($dbw_val == 'yes')
			{
				$dbw_val = "a.dbw_own = 1 and ";
			}
			elseif($dbw_val == 'no')
			{
				$dbw_val = "a.dbw_own = 0 and ";
			}
			else
			{
				$dbw_val = "";
			}
			
			$report = "SELECT item_Frontid, inv_name, item_modeltype, count(d.rent_id)
						FROM Item a, Inventory b, Rental c, CheckOut d, Category e
						WHERE a.inv_id = b.inv_id and
								a.item_Backid = d.item_Backid and 
								e.cat_id = b.cat_id and
								" . $dbw_val . $loc_val . $cat_val . $dates_to_narrow . "
								c.rent_id = d.rent_id
						GROUP BY a.item_Backid
						ORDER BY inv_name, item_Frontid, item_modeltype";
						
			$excel_report = $connctn->prepare($report);
			$excel_report->execute();
			$display_array = $excel_report->fetchAll();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Item Id');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Item Name');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Item Model/Type');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Usage');
			
			$row_count = 2;
			for($i = 0; $i < count($display_array); $i++)
			{
				$curr_item_id = $display_array[$i]["item_Frontid"];
				$curr_item_name = $display_array[$i]["inv_name"];
				$curr_item_modeltype = $display_array[$i]["item_modeltype"];
				$curr_item_usage = $display_array[$i]["count(d.rent_id)"];
				
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row_count, $curr_item_id);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row_count, $curr_item_name);
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, $curr_item_modeltype);
				$objPHPExcel->getActiveSheet()->setCellValue('D' . $row_count, $curr_item_usage);
				
				$row_count++;
			}
			
			break;
		default:
			echo "Something went wrong";
	}
	
	$connctn = null; //Also remember to close the Database Connection
	
	$objPHPExcel->getActiveSheet()->setTitle('Report');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Item_List.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
?>