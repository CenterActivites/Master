<?php
	function priceCal($request_date_format, $due_date_format, $array_of_items, $sel_cust)
	{
		require('/home/centerac/public_html/connect_info.php');
		require('/home/centerac/public_html/DB.php');
		error_reporting(E_ERROR | E_PARSE);
		$usr =  "centerac_" . $username;
		$conn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));
		
		//Grab the customer's student and employee's status. If the customer is employee and the rental is a pick-up, then the rental is free. If the customer is a student, the student discount prices will be applied
		$if_student = $conn->prepare("select is_student, is_employee
										from Customer
										where cust_id = :sel_cust");
		$if_student->bindValue(':sel_cust', $sel_cust, PDO::PARAM_INT);
		$if_student->execute();  //excute the query. Also is the query went wrong somewhere, the "or die($conn->error)" part can tell us what is wrong with the select statement
		$if_student_row = $if_student->fetchAll();
	
		$curr_date = Date("Y-m-d");
		
		if(!($request_date_format <= $curr_date && $if_student_row[0]['is_employee'] == 'Yes'))
		{
			//Creating a date array of int for both the request and due dates
			$request_date = array_map('intval', explode("-", $request_date_format));
			$due_date = array_map('intval', explode("-", $due_date_format));
			$leap_year = array('2020', '2024', '2028', '2032'); //Array to keep track of the leap years, Also remember to update the leap year
			
			$diff = 0;    //the difference in days var
			
			//Once we have the amount of differents between the two dates the user have selected
			//We create a placeholder for the amount of days, weekends, and weeks are in the difference
			$days = 0;
			$weekends = 0;
			$weeks = 0;
			
			//We do a check here, if both request date and due date are the same then the customer is planning on picking up and returning the item on the same day.
			//So then we can just skip all the calculations on the diffence number of days there are between the two dates and see how many weeks, weekends, and days there are in 
			//between the two dates
			if($request_date_format == $due_date_format)
			{
				$days++;
			}
			else
			{
				//Script purpose is to get the day difference between two dates
					//Example: customer picked 5/21/2018 for request and 6/4/2018 for the date they will return the item/items
					//			then we would have to add 31, which is the max amount of days in Jan, to the due date day which is the 4th.
					//			Now we have 21 for request date day and 35 for the due date day. Minus both will give us 14 days difference
					//          which is the amount of days difference between the date 5/21/2018 and 6/4/2018 
					//          (not counting the day the customer pick up the item)											
					
				switch($request_date[1])  
				{
					case 1:   	//checks the month part of the request date array which is a array of int
					case 3:
					case 5:
					case 7:
					case 8:
					case 10:
					case 12:
						if($request_date[1] == $due_date[1])   //if the request and due date months are the same then just minus both dates
						{
							$diff = $due_date[2] - $request_date[2];
						}
						else                                   //else then add the correct according days of the request month to the due date for correct day difference
						{
							$diff = (31 + $due_date[2]) - $request_date[2];    //since the 1st month/Jan has 31 days, we add 31 to the due date
						}
						break;
					//And we do the same for the rest of the cases
					case 4:
					case 6:
					case 9:
					case 11:
						if($request_date[1] == $due_date[1])
						{
							$diff = $due_date[2] - $request_date[2];
						}
						else
						{
							$diff = (30 + $due_date[2]) - $request_date[2];
						}
						break;
					case 2:		//Since Feb had leap years, theres a initial if statement to see if the year is a leap year or not
						if(in_array($request_date[0], $leap_year))
						{
							if($request_date[1] == $due_date[1])
							{
								$diff = $due_date[2] - $request_date[2];
							}
							else
							{
								$diff = (29 + $due_date[2]) - $request_date[2]; //Remember to update the leap year array above for functionally purposes
							}
						}
						else
						{
							if($request_date[1] == $due_date[1])
							{
								$diff = $due_date[2] - $request_date[2];
							}
							else
							{
								$diff = (28 + $due_date[2]) - $request_date[2];
							}
						}
						break;
				}
				$diff++;
			}
			// ***************  Dont delete this, used for debugging the pricing function. ***************  
			/*echo "request date: " . $request_date_format . "</br>";
			echo "due date: " . $due_date_format . "</br>";
			echo "diff: " . $diff . "</br>";*/
			
			//The next following lines are a little function to calculate how many weeks, weekends, and days are the user renting out the item for
			while($diff > 0)
			{
				//We see if a certain amount of days can be substract from the $diff. 
				//If yes that we add 1 to the correct correlating placeholder. We do this until $diff is 0
				if($diff - 8 >= 0) //We set week to be 8-5 days long
				{
					$diff = $diff - 8;
					$weeks++;
				}
				elseif($diff - 7 >= 0)
				{
					$diff = $diff - 7;
					$weeks++;
				}
				elseif($diff - 6 >= 0)
				{
					$diff = $diff - 6;
					$weeks++;
				}
				elseif($diff - 5 >= 0)
				{
					$diff = $diff - 5;
					$weeks++;
				}
				elseif($diff - 4 >= 0) //Weekends are 4-3 days long
				{
					$diff = $diff - 4;
					$weekends++;
				}
				elseif($diff - 3 >= 0)
				{
					$diff = $diff - 3;
					$weekends++;
				}
				elseif($diff - 2 >= 0) //days are 1-2 days long
				{
					$diff = $diff - 2;
					$days++;
				}
				else
				{
					$diff = $diff - 1;
					$days++;
				}
			}
			// ***************  Dont delete this, used for debugging the pricing function. ***************  
			/*echo "days: " . $days . "</br>";
			echo "weekends: " . $weekends . "</br>";
			echo "weeks: " . $weeks . "</br>";*/
			
			$receipt_prices = array(); //Here is where we going to be saving all the prices for the receipt
			$total_price = 0; //Here is where we are going to be storing the total price of all the item is been selected
			$total_deposit = 0; //Here we're going to be storing the total deposit for the whole rental
			$pack_id_array = array();
			$pack_array_of_selected_items = array();
			
			foreach($array_of_items as $pack_id_with_item_id) //FOR loop to go through the array of selected item ids
			{
				$pack_item_array = explode('-', $pack_id_with_item_id); //First we grab the item string, and explode it into a array of ints
				
				if($pack_item_array[0] == "0")
				{
					$curr_item_total_pricing = 0; //Assign curr_item_total_pricing to 0 because now we're going item by item, grabbing each total price per item
					
					$_price = $conn->prepare("select stu_day_price, stu_weekend_price, stu_week_price, day_price, weekend_price, week_price, item_Frontid, inv_name, pur_price
												from Item a, Inventory c
												where a.inv_id = c.inv_id and a.item_Backid = :item_id");
					$_price->bindValue(':item_id', $pack_item_array[1], PDO::PARAM_INT);
					$_price->execute();
					$price = $_price->fetchAll();
					
					//Now here we actually check if the customer is a student or not and get the correct pricing for the 
					//amount of days they are planning to rent the item for
					if($if_student_row[0]['is_student'] == 'yes' || $if_student_row[0]['is_student'] == 'Yes') //Checks if the customer is a student or not
					{
						if($days > 0)
						{
							$curr_item_total_pricing = $curr_item_total_pricing + ($days * $price[0]['stu_day_price']);
						}
						if($weekends > 0)
						{
							$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $price[0]['stu_weekend_price']);
						}
						if($weeks > 0)
						{
							$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $price[0]['stu_week_price']);
						}
					}
					else
					{
						if($days > 0)
						{
							$curr_item_total_pricing = $curr_item_total_pricing + ($days * $price[0]['day_price']);
						}
						if($weekends > 0)
						{
							$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $price[0]['weekend_price']);
						}
						if($weeks > 0)
						{
							$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $price[0]['week_price']);
						}
					}
					$total_price = $total_price + $curr_item_total_pricing;
					$total_deposit = $total_deposit + $price[0]['pur_price'];
					$receipt_prices[$pack_item_array[1]] = array("id"=>$price[0]['item_Frontid'], "name"=>$price[0]['inv_name'], "price"=>$curr_item_total_pricing, "deposit"=>$price[0]['pur_price']);

				}
				else
				{
					if(!(in_array($pack_item_array[0], $pack_id_array)))
					{ 
						$pack_id_array[] = $pack_item_array[0];
					}
					$pack_array_of_selected_items[$pack_item_array[0]][] = $pack_item_array[1];
				}
			}
			foreach($pack_id_array as $pack_id)
			{
				$multi_same_pack_check = 0;
				$count_of_items_in_packages_selected = array();
				
				foreach($pack_array_of_selected_items[$pack_id] as $item_id)
				{
					$main_vessal = $conn->prepare("select main_inv_pack_id
													from Item a, MainInvPack c
													where a.inv_id = c.inv_id and 
															a.item_Backid = :item_id");
					$main_vessal->bindValue(':item_id', $item_id, PDO::PARAM_INT);
					$main_vessal->execute();
					$main_vessal = $main_vessal->fetchAll();
					
					if(!(empty($main_vessal)))
					{
						$multi_same_pack_check++;
					}
					else
					{
						$inv_name_select = $conn->prepare("select inv_name
															from Item a, Inventory c
															where a.inv_id = c.inv_id and 
																	a.item_Backid = :item_id");
						$inv_name_select->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$inv_name_select->execute();
						$inv_name_select = $inv_name_select->fetchAll();
					
						if(array_key_exists($inv_name_select[0]['inv_name'], $count_of_items_in_packages_selected)) 
						{
							$count_of_items_in_packages_selected[$inv_name_select[0]['inv_name']] = $count_of_items_in_packages_selected[$inv_name_select[0]['inv_name']] + 1;
						}
						else
						{
							$count_of_items_in_packages_selected[$inv_name_select[0]['inv_name']] = 1;
						}
					}
				}
				
				if($multi_same_pack_check > 0)
				{
					if($pack_id == '7' && $count_of_items_in_packages_selected['Booties'] < $multi_same_pack_check && $count_of_items_in_packages_selected['Wetsuit'] < $multi_same_pack_check)
					{
						if($count_of_items_in_packages_selected['Booties'] == $count_of_items_in_packages_selected['Wetsuit'])
						{
							$num_of_surfboard_rental = $multi_same_pack_check - $count_of_items_in_packages_selected['Booties'];
							$multi_same_pack_check = $multi_same_pack_check - $num_of_surfboard_rental;
						}
						elseif($count_of_items_in_packages_selected['Booties'] < $count_of_items_in_packages_selected['Wetsuit'])
						{
							$num_of_surfboard_rental = $multi_same_pack_check - $count_of_items_in_packages_selected['Wetsuit'];
							$multi_same_pack_check = $multi_same_pack_check - $num_of_surfboard_rental;
						}
						else
						{
							$num_of_surfboard_rental = $multi_same_pack_check - $count_of_items_in_packages_selected['Booties'];
							$multi_same_pack_check = $multi_same_pack_check - $num_of_surfboard_rental;
						}
						
						for($n = 0; $n < $multi_same_pack_check; $n++)
						{
							$curr_item_total_pricing = 0; //Assign curr_item_total_pricing to 0 because now we're going item by item, grabbing each total price per item
							
							$pack_price = $conn->prepare("select stu_day_price, stu_weekend_price, stu_week_price, day_price, weekend_price, week_price, pack_name
															from Packages
															where pack_id = :pack_id");
							$pack_price->bindValue(':pack_id', $pack_id, PDO::PARAM_INT);
							$pack_price->execute();
							$pack_price = $pack_price->fetchAll();
							
							//Now here we actually check if the customer is a student or not and get the correct pricing for the 
							//amount of days they are planning to rent the item for
							if($if_student_row[0]['is_student'] == 'yes' || $if_student_row[0]['is_student'] == 'Yes') //Checks if the customer is a student or not
							{
								if($days > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_price[0]['stu_day_price']);
								}
								if($weekends > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_price[0]['stu_weekend_price']);
								}
								if($weeks > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_price[0]['stu_week_price']);
								}
							}
							else
							{
								if($days > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_price[0]['day_price']);
								}
								if($weekends > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_price[0]['weekend_price']);
								}
								if($weeks > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_price[0]['week_price']);
								}
							}
							
							$count_of_items_in_packages_selected = array_map(function($val) { return $val-1; }, $count_of_items_in_packages_selected);
							
							$total_price = $total_price + $curr_item_total_pricing;
							$receipt_prices[$pack_id . $n] = array("id"=>" ", "name"=>$pack_price[0]['pack_name'], "price"=>$curr_item_total_pricing, "deposit"=>" ");
						}
					}
					elseif($pack_id == '4' || $pack_id == '6')
					{
						for($n = 0; $n < $multi_same_pack_check; $n++)
						{
							$curr_item_total_pricing = 0; //Assign curr_item_total_pricing to 0 because now we're going item by item, grabbing each total price per item
							
							$pack_price = $conn->prepare("select stu_day_price, stu_weekend_price, stu_week_price, day_price, weekend_price, week_price, pack_name
															from Packages
															where pack_id = :pack_id");
							$pack_price->bindValue(':pack_id', $pack_id, PDO::PARAM_INT);
							$pack_price->execute();
							$pack_price = $pack_price->fetchAll();
							
							//Now here we actually check if the customer is a student or not and get the correct pricing for the 
							//amount of days they are planning to rent the item for
							if($if_student_row[0]['is_student'] == 'yes' || $if_student_row[0]['is_student'] == 'Yes') //Checks if the customer is a student or not
							{
								if($days > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_price[0]['stu_day_price']);
								}
								if($weekends > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_price[0]['stu_weekend_price']);
								}
								if($weeks > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_price[0]['stu_week_price']);
								}
							}
							else
							{
								if($days > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_price[0]['day_price']);
								}
								if($weekends > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_price[0]['weekend_price']);
								}
								if($weeks > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_price[0]['week_price']);
								}
							}
							
							$count_of_items_in_packages_selected = array_map(function($val) { return $val-2; }, $count_of_items_in_packages_selected);
							
							$total_price = $total_price + $curr_item_total_pricing;
							$receipt_prices[$pack_id . $n] = array("id"=>" ", "name"=>$pack_price[0]['pack_name'], "price"=>$curr_item_total_pricing, "deposit"=>" ");
						}
					}
					else
					{
						for($n = 0; $n < $multi_same_pack_check; $n++)
						{
							$curr_item_total_pricing = 0; //Assign curr_item_total_pricing to 0 because now we're going item by item, grabbing each total price per item
							
							$pack_price = $conn->prepare("select stu_day_price, stu_weekend_price, stu_week_price, day_price, weekend_price, week_price, pack_name
															from Packages
															where pack_id = :pack_id");
							$pack_price->bindValue(':pack_id', $pack_id, PDO::PARAM_INT);
							$pack_price->execute();
							$pack_price = $pack_price->fetchAll();
							
							//Now here we actually check if the customer is a student or not and get the correct pricing for the 
							//amount of days they are planning to rent the item for
							if($if_student_row[0]['is_student'] == 'yes' || $if_student_row[0]['is_student'] == 'Yes') //Checks if the customer is a student or not
							{
								if($days > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_price[0]['stu_day_price']);
								}
								if($weekends > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_price[0]['stu_weekend_price']);
								}
								if($weeks > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_price[0]['stu_week_price']);
								}
							}
							else
							{
								if($days > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_price[0]['day_price']);
								}
								if($weekends > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_price[0]['weekend_price']);
								}
								if($weeks > 0)
								{
									$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_price[0]['week_price']);
								}
							}
							
							$count_of_items_in_packages_selected = array_map(function($val) { return $val-1; }, $count_of_items_in_packages_selected);
							
							$total_price = $total_price + $curr_item_total_pricing;
							$receipt_prices[$pack_id . $n] = array("id"=>" ", "name"=>$pack_price[0]['pack_name'], "price"=>$curr_item_total_pricing, "deposit"=>" ");
						}
					}
					
					foreach($pack_array_of_selected_items[$pack_id] as $item_id)
					{
						$pack_item_info = $conn->prepare("select stu_day_price, stu_weekend_price, stu_week_price, day_price, weekend_price, week_price, item_Frontid, inv_name, pur_price
														from Item a, Inventory c
														where a.inv_id = c.inv_id and a.item_Backid = :item_id");
						$pack_item_info->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$pack_item_info->execute();
						$pack_item_info = $pack_item_info->fetchAll();
						
						$main_vessal = $conn->prepare("select main_inv_pack_id
														from Item a, MainInvPack c
														where a.inv_id = c.inv_id and 
																a.item_Backid = :item_id");
						$main_vessal->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$main_vessal->execute();
						$main_vessal = $main_vessal->fetchAll();
						
						if(empty($main_vessal))
						{
							if($count_of_items_in_packages_selected[$pack_item_info[0]['inv_name']] > 0)
							{
								$curr_item_total_pricing = 0; //Assign curr_item_total_pricing to 0 because now we're going item by item, grabbing each total price per item
								//Now here we actually check if the customer is a student or not and get the correct pricing for the 
								//amount of days they are planning to rent the item for
								if($if_student_row[0]['is_student'] == 'yes' || $if_student_row[0]['is_student'] == 'Yes') //Checks if the customer is a student or not
								{
									if($days > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_item_info[0]['stu_day_price']);
									}
									if($weekends > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_item_info[0]['stu_weekend_price']);
									}
									if($weeks > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_item_info[0]['stu_week_price']);
									}
								}
								else
								{
									if($days > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_item_info[0]['day_price']);
									}
									if($weekends > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_item_info[0]['weekend_price']);
									}
									if($weeks > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_item_info[0]['week_price']);
									}
								}
								$total_price = $total_price + $curr_item_total_pricing;
								$total_deposit = $total_deposit + $pack_item_info[0]['pur_price'];
								$receipt_prices[$item_id] = array("id"=>$pack_item_info[0]['item_Frontid'], "name"=>$pack_item_info[0]['inv_name'], "price"=>$curr_item_total_pricing, "deposit"=>$pack_item_info[0]['pur_price']);
								$count_of_items_in_packages_selected[$pack_item_info[0]['inv_name']] = $count_of_items_in_packages_selected[$pack_item_info[0]['inv_name']] - 1;
							}
							else
							{
								$receipt_prices[$item_id] = array("id"=>$pack_item_info[0]['item_Frontid'], "name"=>$pack_item_info[0]['inv_name'] . " (" . $pack_price[0]['pack_name'] . ")", "price"=>0, "deposit"=>$pack_item_info[0]['pur_price']);
							}
						}
						else
						{
							if($num_of_surfboard_rental != null && $num_of_surfboard_rental > 0)
							{
								$curr_item_total_pricing = 0; //Assign curr_item_total_pricing to 0 because now we're going item by item, grabbing each total price per item
						
								if($if_student_row[0]['is_student'] == 'yes' || $if_student_row[0]['is_student'] == 'Yes') //Checks if the customer is a student or not
								{
									if($days > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_item_info[0]['stu_day_price']);
									}
									if($weekends > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_item_info[0]['stu_weekend_price']);
									}
									if($weeks > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_item_info[0]['stu_week_price']);
									}
								}
								else
								{
									if($days > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($days * $pack_item_info[0]['day_price']);
									}
									if($weekends > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $pack_item_info[0]['weekend_price']);
									}
									if($weeks > 0)
									{
										$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $pack_item_info[0]['week_price']);
									}
								}
								$total_price = $total_price + $curr_item_total_pricing;
								$total_deposit = $total_deposit + $pack_item_info[0]['pur_price'];
								$receipt_prices[$item_id] = array("id"=>$pack_item_info[0]['item_Frontid'], "name"=>$pack_item_info[0]['inv_name'], "price"=>$curr_item_total_pricing, "deposit"=>$pack_item_info[0]['pur_price']);
								
								$num_of_surfboard_rental--;
							}
							else
							{
								$total_deposit = $total_deposit + $pack_item_info[0]['pur_price'];
								$receipt_prices[$item_id] = array("id"=>$pack_item_info[0]['item_Frontid'], "name"=>$pack_item_info[0]['inv_name'] . " (" . $pack_price[0]['pack_name'] . ")", "price"=>$curr_item_total_pricing, "deposit"=>$pack_item_info[0]['pur_price']);
							}
						}
					}
				}
				else
				{
					foreach($pack_array_of_selected_items[$pack_id] as $item_id)
					{
						$curr_item_total_pricing = 0; //Assign curr_item_total_pricing to 0 because now we're going item by item, grabbing each total price per item
						
						$_price = $conn->prepare("select stu_day_price, stu_weekend_price, stu_week_price, day_price, weekend_price, week_price, item_Frontid, inv_name, pur_price
													from Item a, Inventory c
													where a.inv_id = c.inv_id and a.item_Backid = :item_id");
						$_price->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$_price->execute();
						$price = $_price->fetchAll();
						
						//Now here we actually check if the customer is a student or not and get the correct pricing for the 
						//amount of days they are planning to rent the item for
						if($if_student_row[0]['is_student'] == 'yes' || $if_student_row[0]['is_student'] == 'Yes') //Checks if the customer is a student or not
						{
							if($days > 0)
							{
								$curr_item_total_pricing = $curr_item_total_pricing + ($days * $price[0]['stu_day_price']);
							}
							if($weekends > 0)
							{
								$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $price[0]['stu_weekend_price']);
							}
							if($weeks > 0)
							{
								$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $price[0]['stu_week_price']);
							}
						}
						else
						{
							if($days > 0)
							{
								$curr_item_total_pricing = $curr_item_total_pricing + ($days * $price[0]['day_price']);
							}
							if($weekends > 0)
							{
								$curr_item_total_pricing = $curr_item_total_pricing + ($weekends * $price[0]['weekend_price']);
							}
							if($weeks > 0)
							{
								$curr_item_total_pricing = $curr_item_total_pricing + ($weeks * $price[0]['week_price']);
							}
						}
						$total_price = $total_price + $curr_item_total_pricing;
						$total_deposit = $total_deposit + $price[0]['pur_price'];
						$receipt_prices[$item_id] = array("id"=>$price[0]['item_Frontid'], "name"=>$price[0]['inv_name'], "price"=>$curr_item_total_pricing, "deposit"=>$price[0]['pur_price']);
					}
				}
			}
			$return_array['total_price'] = $total_price;
			$return_array['total_deposit'] = $total_deposit;
			$return_array['receipt_prices'] = $receipt_prices;
	
			return $return_array;

		}
		else
		{
			$total_deposit = 0;
			foreach($array_of_items as $item_id) //FOR loop to go through the array of selected item ids
			{
				$pack_item_array = explode('-', $item_id); //First we grab the item string, and explode it into a array of ints
				$_price = $conn->prepare("select item_Frontid, inv_name, pur_price
											from Item a, Inventory c
											where a.inv_id = c.inv_id and a.item_Backid = :item_id");
				$_price->bindValue(':item_id', $pack_item_array[1], PDO::PARAM_INT);
				$_price->execute();
				$price = $_price->fetchAll();
				
				$receipt_prices[$pack_item_array[1]] =  array("id"=>$price[0]['item_Frontid'], "name"=>$price[0]['inv_name'], "price"=>0, "deposit"=>$price[0]['pur_price']);
				$total_deposit = $total_deposit + $price[0]['pur_price'];
			}
			$return_array['total_price'] = 0;
			$return_array['total_deposit'] = $total_deposit;
			$return_array['receipt_prices'] = $receipt_prices;
			
			return $return_array;
		}
	}
?>