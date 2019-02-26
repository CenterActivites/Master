<?php
	require_once '../PHPExcel-1.8/Classes/PHPExcel.php';
	$connctn = new PDO("mysql:host=localhost", $DB, $user, $pass, array('charset'=>'utf8'));
	$connctn->query("SET CHARACTER SET utf8");

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Front ID');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Item Size');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Model');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Item Name');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Public Use');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Status');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Usage');
	
	$row_count = 2;

	foreach($connctn->query("SELECT item_Backid, item_size, item_modeltype, inv_name, cat_name, item_Frontid, public, D.stat_name
							FROM Item A, Inventory B, Category C, Status D
							WHERE A.inv_id = B.inv_id and B.cat_id = C.cat_id and A.stat_id = D.stat_id
							ORDER BY inv_name, item_modeltype") as $row)
	{
		$curr_item_backid = $row["item_Backid"];
		$curr_item_size = $row["item_size"];
		$curr_inv_name = $row["inv_name"];
		$curr_item_model = $row["item_modeltype"];
		$curr_item_frontid = $row["item_Frontid"];
		$curr_pub_use = $row["public"];
		$curr_stat_info = $row["stat_name"];

		$item_backid = (int)$curr_item_backid;
							
		$number_of_use = $connctn->prepare("select count(itemtran_id)
										from Item A, Transaction B, ItemTran C
										where A.item_Backid = C.item_Backid and B.trans_id = C.tran_id and B.trans_type = 'return' and C.item_Backid = :a");
		$number_of_use->bindValue(':a', $item_backid, PDO::PARAM_INT);
		$number_of_use->execute();
		$number_of_use = $number_of_use->fetchAll();
		$curr_number_of_use = $number_of_use[0][0];

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
		$objPHPExcel->getActiveSheet()->setCellValue('G' . $row_count, $curr_number_of_use);
		
		$row_count++;
	}

	$objPHPExcel->getActiveSheet()->setTitle('Item Information');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="helloworld.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
?>
