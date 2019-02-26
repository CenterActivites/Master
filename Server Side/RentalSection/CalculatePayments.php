<?php
	function CalPay()
	{
?>
<html>
	<link rel="stylesheet" type="text/css" href="../RentalSection/rental_css.css"/>

<body>
<?php
	//setting up the mysql connection
	$username = $_SESSION['username']; 
	$password = $_SESSION['password'];
	$conn = hsu_conn_sess($username, $password);       
	
	//grabbing the customer's id and the item/items id they picked to rent
	$sel_cust = $_SESSION['sel_user'];
	$array_of_items = $_SESSION['array_of_items'];
	
	//Grabbing the dates they want to rent the items out for
	$request_date_format = $_SESSION['request_date'];
	$due_date_format = $_SESSION['due_date'];
	
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
	
	//This is where how we are going to see how much days is the customer going to be renting the item/items
	//Can make this easier and short by using PHP date_diff() function, but was having alot of troubles with formating the dates correctly for the function to be used
	//TODO: replace this little php date difference script with the PHP function date_diff()
	
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
	
	//Once we have the amount of differents between the two dates the user have selected
	//We create a placeholder for the amount of days, weekends, and weeks are in the difference
	$days = 0;
	$weekends = 0;
	$weeks = 0;
	
	//The next following lines are a little function to calculate how many weeks, weekends, and days are the user renting out the item for
	while($diff > 0)
	{
		//We see if a certain amount of days can be substract from the $diff. 
		//If yes that we add 1 to the correct correlating placeholder. We do this until $diff is 0
		if($diff - 7 > 0) //We set week to be 7-5 days long
		{
			$diff = $diff - 7;
			$weeks++;
		}
		elseif($diff - 6 > 0)
		{
			$diff = $diff - 6;
			$weeks++;
		}
		elseif($diff - 5 > 0)
		{
			$diff = $diff - 5;
			$weeks++;
		}
		elseif($diff - 4 > 0) //Weekends are 4-3 days long
		{
			$diff = $diff - 4;
			$weekends++;
		}
		elseif($diff - 3 > 0)
		{
			$diff = $diff - 3;
			$weekends++;
		}
		elseif($diff - 2 > 0) //days are 1-2 days long
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
	
	$receipt_prices = array(); //Here is where we going to be saving all the prices for the receipt
	$total_price = 0; //Here is where we are going to be storing the total price of all the item is been selected
	foreach($array_of_items as $item_id) //FOR loop to go through the array of selected item ids
	{
		//Now here we actually check if the customer is a student or not and get the correct pricing for the 
		//amount of days they are planning to rent the item for
		if($if_student_row[0]['is_student'] == 'yes') //Checks if the customer is a student or not
		{
			if($days > 0)
			{
				$_price = $conn->prepare("select stu_day_price ".
							"from Item a, Inventory c ".
							"where a.inv_id = c.inv_id and a.item_Backid = :item_id"); //query to get the student day price of the item
				$_price->bindValue(':item_id', $item_id, PDO::PARAM_INT); //Binds the var
				$_price->execute(); //excute the query
				$price = $_price->fetchAll(); //Grabs the price
				$total_price = $total_price + ($days * $price[0][0]); //Adding up the prices by multiplying the correct correlating days or weekends or weeks
				$receipt_prices[] = $days * $price[0][0]; //Also save the amount for reciept purposes
			}
			if($weekends > 0)
			{
				$_price = $conn->prepare("select stu_weekend_price ".
							"from Item a, Inventory c ".
							"where a.inv_id = c.inv_id and a.item_Backid = :item_id");
				$_price->bindValue(':item_id', $item_id, PDO::PARAM_INT);
				$_price->execute();
				$price = $_price->fetchAll();
				$total_price = $total_price + ($weekends * $price[0][0]);
				$receipt_prices[] = $weekends * $price[0][0];
			}
			if($weeks > 0)
			{
				$_price = $conn->prepare("select stu_week_price ".
							"from Item a, Inventory c ".
							"where a.inv_id = c.inv_id and a.item_Backid = :item_id");
				$_price->bindValue(':item_id', $item_id, PDO::PARAM_INT);
				$_price->execute();
				$price = $_price->fetchAll();
				$total_price = $total_price + ($weeks * $price[0][0]);
				$receipt_prices[] = $weeks * $price[0][0];
			}
		}
		else //If we get here then the customer is not a student and will be given the regular price
		{
			if($days > 0)
			{
				$_price = $conn->prepare("select day_price ".
							"from Item a, Inventory c ".
							"where a.inv_id = c.inv_id and a.item_Backid = :item_id");
				$_price->bindValue(':item_id', $item_id, PDO::PARAM_INT);
				$_price->execute();
				$price = $_price->fetchAll();
				$total_price = $total_price + ($days * $price[0][0]);
				$receipt_prices[] = $days * $price[0][0];
			}
			if($weekends > 0)
			{
				$_price = $conn->prepare("select weekend_price ".
							"from Item a, Inventory c ".
							"where a.inv_id = c.inv_id and a.item_Backid = :item_id");
				$_price->bindValue(':item_id', $item_id, PDO::PARAM_INT);
				$_price->execute();
				$price = $_price->fetchAll();
				$total_price = $total_price + ($weekends * $price[0][0]);
				$receipt_prices[] = $weekends * $price[0][0];
			}
			if($weeks > 0)
			{
				$_price = $conn->prepare("select week_price ".
							"from Item a, Inventory c ".
							"where a.inv_id = c.inv_id and a.item_Backid = :item_id");
				$_price->bindValue(':item_id', $item_id, PDO::PARAM_INT);
				$_price->execute();
				$price = $_price->fetchAll();
				$total_price = $total_price + ($weeks * $price[0][0]);
				$receipt_prices[] = $weeks * $price[0][0];
			}
		}
	}
	
	$_SESSION['total_price'] = $total_price;
	$_SESSION['receipt_prices'] = $receipt_prices;
	
?>
	<fieldset id='fieldset_label' style="border:none; text-align:center;">
		<label id='header_for_table' style="text-align:center; font-size: 20px"> Calculate Payments </label>
	</fieldset>
	</br></br>
	
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
		<table id="calculated_amounts">
			<tr>
				<th>
					Deposit Amount:
				</th>
				<td>
					<!-- TODO:: Once we get the deposit information we need from Susan or Bridget, we will do the calculations to display the deposit -->
					<output name="deposit" for="deposit"></output>
				</td>
			</tr>
			
			<tr>
				<th>
					Total Cost of Rental:
				</th>
				<td>
					<!-- prints the total price to the screen --> 
					<output name="totalCost" for="totalCost"><?= $total_price  ?></output>
				</td>
			</tr>
			
			<tr>
				<th>
					Tax: (Change the tax rate if needed)
				</th>
				<td>
					<input name="tax_input" id="tax_input" value="8.5"> %</input>
				</td>
			</tr>
		
		</table>

		</br></br>
		<div>
			<h3 style="margin-left:35px;">Please Read the Following Policy to Customer</h3>
			<!-- Rental Policy, for the user to read to the customer -->
			<p id="rental_policy_1" style="padding-left:15px; padding-right:15px;">
				&nbsp;&nbsp;&nbsp;&nbsp;  A. Rental equipment should be inspected by the renter for damage, missing parts and cleanliness before it is rented. Equipment
					should be returned in the same condition as it was received. Renters returning equipment that is damaged,
					has missing parts, or is in unsatisfactory condition, will be charged the amount necessary to restore the
					equipment to its original condition. Rental equipment is due back by noon of the last day of the rental period, or 24 hours
					from the time of rental for daily rentals. If equipment is returned after the rental period, the renter will be charged an additional
					daily rental fee. No refunds will be given for equipment returned early (prior to the last day of the agreed upon rental period.)
					24 hour cancellation notice is required in order to receive a refund, and a 25% service charge will be deducted from the refund
					amount.
			</p>
			<p id="rental_policy_2" style="padding-left:15px; padding-right:15px;">
				&nbsp;&nbsp;&nbsp;&nbsp;  B. I agree to the conditions set forth herein, and understand that I am using the above rental equipment at my own risk; I have
					examined the equipment and take full responsibility for its safe and proper use. I further agree to release, indemnify and hold
					harmless the State of California, Humboldt State University, the University Center, the Center Activities Program, their directors,
					officers, employees and agents (hereinafter, “Releasees”) from any liability for property damage, personal injury or death that
					may occur if myself or any user of the rented equipment whether caused by the negligence of Releasees, or otherwise. I hereby
					assume full responsibility for risk of bodily injury, death or property damage and will hold the Releasees harmless from any and
					all liability which may arise in connection with this rental agreement.
			</p>
			<p id="rental_policy_3" style="padding-left:15px; padding-right:15px;">
				&nbsp;&nbsp;&nbsp;&nbsp;  C. I understand this is a binding contract which shall serve as a release and assumption of risk that shall likewise be binding on
					my heirs, executors, and administrators and on all members of my family (including minors.)

			</p>
		</div>
		<div>
			<fieldset style="border:none;">
				<input type="submit" name="finalize" id="finalize" value="Finalize" />
				&nbsp;&nbsp;
				<input type="submit" name="cancelFinal" id="cancelFinal" value="Cancel" />
			</fieldset>
	</form>
		</div>
</body>
</html>


<?php
$conn = null;
	}
?>