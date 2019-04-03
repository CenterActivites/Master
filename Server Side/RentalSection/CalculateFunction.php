<?php
	function priceCal($request_date_format, $due_date_format, $array_of_items, $sel_cust)
	{

		//PDO Connection to the Databse
		$conn = hsu_conn_sess();
		
		//Creating a date array of int for both the request and due dates
		$request_date = array_map('intval', explode("-", $request_date_format));
		$due_date = array_map('intval', explode("-", $due_date_format));
		$leap_year = array('2020', '2024', '2028', '2032'); //Array to keep track of the leap years, Also remember to update the leap year
		
		$diff = 0;    //the difference in days var
		
		//checking if the customer is a student or not query
		$if_student = $conn->prepare("select is_student
										from Customer
										where cust_id = :sel_cust");
		$if_student->bindValue(':sel_cust', $sel_cust, PDO::PARAM_INT);
		$if_student->execute();  //excute the query. Also is the query went wrong somewhere, the "or die($conn->error)" part can tell us what is wrong with the select statement
		$if_student_row = $if_student->fetchAll();
		
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
		
		/*echo "request date: " . $request_date_format . "</br>";
		echo "due date: " . $due_date_format . "</br>";
		echo "diff: " . $diff . "</br>";*/
		
		//The next following lines are a little function to calculate how many weeks, weekends, and days are the user renting out the item for
		while($diff > 0)
		{
			//We see if a certain amount of days can be substract from the $diff. 
			//If yes that we add 1 to the correct correlating placeholder. We do this until $diff is 0
			if($diff - 7 >= 0) //We set week to be 7-5 days long
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
		/*echo "days: " . $days . "</br>";
		echo "weekends: " . $weekends . "</br>";
		echo "weeks: " . $weeks . "</br>";*/
		
		$receipt_prices = array(); //Here is where we going to be saving all the prices for the receipt
		$total_price = 0; //Here is where we are going to be storing the total price of all the item is been selected
		//If the $pack_select is 0 then that mean the user didn't select a pack at all so the items would be price according to each item
		if($pack_select == 0)
		{
			foreach($array_of_items as $item_id) //FOR loop to go through the array of selected item ids
			{
				$curr_item_total_pricing = 0; //Assign curr_item_total_pricing to 0 because now we're going item by item, grabbing each total price per item
				
				$_price = $conn->prepare("select stu_day_price, stu_weekend_price, stu_week_price, day_price, weekend_price, week_price, item_Frontid, inv_name
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
				$receipt_prices[] = array("id"=>$price[0]['item_Frontid'], "name"=>$price[0]['inv_name'], "price"=>$curr_item_total_pricing);
			}
		}
		//Else if the $pack_select is other than 0, that means the user did select a package which we will have to account to
		else
		{
			$curr_item_total_pricing = 0; //Created a temp var to hold the total price for each item which will be added to the total price of the whole rental and be record by receipt_prices for recipts
			
			$_price = $conn->prepare("select stu_day_price, stu_weekend_price, stu_week_price, pack_name, day_price, weekend_price, week_price
										from Packages
										where pack_id = :pack_select"); //query to get the student day price of the item
			$_price->bindValue(':pack_select', $pack_select, PDO::PARAM_INT); //Binds the var
			$_price->execute(); //excute the query
			$price = $_price->fetchAll(); //Grabs the price

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
			$total_price = $total_price + $curr_item_total_pricing; //Adding up the prices by multiplying the correct correlating days or weekends or weeks
			$receipt_prices[] = array("id"=>" ", "name"=>$price[0]['pack_name'], "price"=>$curr_item_total_pricing); //Also save the amount for reciept purposes
			
			//Grabs all item_id that is associated with that package
			$items_in_pack = $conn->prepare("select a.item_Backid
											from Item a, InvPack b
											where a.inv_id = b.inv_id and b.pack_id = :pack_select");
			$items_in_pack->bindValue(':pack_select', $pack_select, PDO::PARAM_INT);
			$items_in_pack->execute();
			$items_in_pack = $items_in_pack->fetchAll();
			
			foreach($array_of_items as $item_id) //FOR loop to go through the array of selected item ids
			{
				//Create a check where if the current item is in the pack, then we just move on to the next. If not then we process the item like normal
				//This is for in case user selected other items other than the ones in the package
				foreach($items_in_pack as $item_in_pack)
				{
					if($item_in_pack[0] != $item_id)
					{
						$curr_item_total_pricing = 0; //Assign curr_item_total_pricing to 0 because now we're going item by item, grabbing each total price per item
				
						$_price = $conn->prepare("select stu_day_price, stu_weekend_price, stu_week_price, day_price, weekend_price, week_price, item_Frontid, inv_name
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
						$receipt_prices[] = array("id"=>$price[0]['item_Frontid'], "name"=>$price[0]['inv_name'], "price"=>$curr_item_total_pricing);
					}
				}
			}
		}
		
		$return_array[] = array("total_price"=>$total_price, "receipt_prices"=>$receipt_prices);
		
		return $return_array;
	}
?>