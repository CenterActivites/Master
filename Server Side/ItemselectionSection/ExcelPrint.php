<?php
	require_once '../PHPExcel-1.8/Classes/PHPExcel.php';
	
	//Connecting to the database through a PDO connection
	require('/home/centerac/public_html/connect_info.php');
	require('/home/centerac/public_html/DB.php');
    error_reporting(E_ERROR | E_PARSE);
	$usr =  "centerac_" . $username;
	$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));

	$stat_val = $_POST['status_hidden'];
	$dbw_val = $_POST['dbw_hidden'];
	$public_val = $_POST['public_hidden'];
	
	if($dbw_val == 'yes')
	{
		$dbw_val = " and A.dbw_own = 1";
	}
	elseif($dbw_val == 'no')
	{
		$dbw_val = " and A.dbw_own = 0";
	}
	else
	{
		$dbw_val = "";
	}
	
	if($public_val == 'yes')
	{
		$public_val = " and A.public = 1";
	}
	elseif($public_val == 'no')
	{
		$public_val = " and A.public = 0";
	}
	else
	{
		$public_val = "";
	}
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Front ID');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Item Size');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Model');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Item Name');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Public Use');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Status');
	
	$row_count = 2;

	//so, if the selection vlaue = 0 I want the information to remain uncahnged.
	if($stat_val[0] == '0')
	{
		$select_item = $connctn->prepare("SELECT item_Backid, item_size, item_modeltype, inv_name, cat_name, item_Frontid, public, D.stat_name
					FROM Item A, Inventory B, Category C, Status D
					WHERE A.inv_id = B.inv_id and B.cat_id = C.cat_id and A.stat_id = D.stat_id" . $dbw_val . $public_val . "
					ORDER BY inv_name, item_modeltype");

		$select_item->execute();
		$display_array = $select_item->fetchAll();
		for($i = 0; $i < count($display_array); $i++)
		{
			$curr_item_backid = $display_array[$i]["item_Backid"];
			$curr_item_size = $display_array[$i]["item_size"];
			$curr_inv_name = $display_array[$i]["inv_name"];
			$curr_item_model = $display_array[$i]["item_modeltype"];
			$curr_item_frontid = $display_array[$i]["item_Frontid"];
			$curr_pub_use = $display_array[$i]["public"];
			$curr_stat_info = $display_array[$i]["stat_name"];

			$item_backid = (int)$curr_item_backid;
			
			if($curr_pub_use == "1"){
				$curr_pub_use = "Yes";
			}
			else{
				$curr_pub_use = "No";
			}

			if($curr_item_size == NULL)
			{
				$curr_item_size = "";
			}
			
			
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $row_count, $curr_item_frontid);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $row_count, $curr_item_size);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, $curr_item_model);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $row_count, $curr_inv_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $row_count, $curr_pub_use);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $row_count, $curr_stat_info);
			
			$row_count++;
		}
		$connctn = null; //Also remember to close the Database Connection
	}
	//else lets change that information according to the value of the status. 1-5
	else
	{
		$int_value_stat = (int)$stat_val[0];

		$select_item = $connctn->prepare("select item_Backid, item_size, item_modeltype, inv_name, cat_name, item_Frontid, public, D.stat_name
				from Item A, Inventory B, Category C, Status D
				where A.inv_id = B.inv_id and B.cat_id = C.cat_id and A.stat_id = D.stat_id and D.stat_id = :a" . $dbw_val . $public_val . "
				ORDER BY inv_name, item_modeltype");

		$select_item->bindValue(':a', $int_value_stat, PDO::PARAM_INT);
		$select_item->execute();
		$display_array = $select_item->fetchAll();
		for($i = 0; $i < count($display_array); $i++)
		{
			$curr_item_backid = $display_array[$i]["item_Backid"];
			$curr_item_size = $display_array[$i]["item_size"];
			$curr_inv_name = $display_array[$i]["inv_name"];
			$curr_item_model = $display_array[$i]["item_modeltype"];
			$curr_item_frontid = $display_array[$i]["item_Frontid"];
			$curr_pub_use = $display_array[$i]["public"];
			$curr_stat_info = $display_array[$i]["stat_name"];

			if($curr_pub_use == "1"){
				$curr_pub_use = "Yes";
			}
			else{
				$curr_pub_use = "No";
			}

			if($curr_item_size == NULL)
			{
				$curr_item_size = "";
			}
			
			
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $row_count, $curr_item_frontid);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $row_count, $curr_item_size);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $row_count, $curr_item_model);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $row_count, $curr_inv_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $row_count, $curr_pub_use);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $row_count, $curr_stat_info);
			
			$row_count++;
		}
		$connctn = null;
	}
	
	$objPHPExcel->getActiveSheet()->setTitle('Item Information');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Item_List.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
?>