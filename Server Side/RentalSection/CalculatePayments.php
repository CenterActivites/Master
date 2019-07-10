<?php
	function CalPay()
	{
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../RentalSection/rental_css.css"/>
	
</head>
<body>
<?php
	require('/home/centerac/public_html/RentalSection/CalculateFunction.php');
	
	//PDO Connection to the Databse
    $conn = hsu_conn_sess();
	
	//grabbing the customer's id and the item/items id they picked to rent
	$sel_cust = $_SESSION['sel_user'];
	$array_of_items = $_SESSION['array_of_items'];
	
	//Grabbing the dates they want to rent the items out for
	$request_date_format = $_SESSION['request_date'];
	$due_date_format = $_SESSION['due_date'];
	$loc = $_SESSION['loc'];
	$on_site_check = $_SESSION['on_site'];
	
	if($on_site_check == NULL)
	{
		//Grabbing the tax of the location
		$loc_tax = $conn->prepare("select loc_tax
										from Location
										where loc_id = :loc_id");
		$loc_tax->bindValue(':loc_id', $loc, PDO::PARAM_INT);
		$loc_tax->execute();
		$loc_tax = $loc_tax->fetchAll();
		
		//Access level view check. Only users who have level 3 and 4 can add new Inventory includes new prices.
		//Level 2 and up can only add new items
		$lvl_access = $_SESSION['lvl_access'];
		if($lvl_access == "4" || $lvl_access == "3")
		{
			$displayput = "";
		}
		else
		{
			$displayput = "readonly";
		}
		
		//Calls the priceCal function to calcuate the prices for the rental
		// input :: request date, due date, array of selected items for rental, and the customer id
		// output :: a array that consist of the total cost of rental, without tax, and a array of individually pricing for each items
		// Example of output :: $returned_array[0]['total_price'] = the total price int
		//						$returned_array[0]['receipt_prices'] = array of prices per item
		$calcuated = priceCal($request_date_format, $due_date_format, $array_of_items, $sel_cust);
		
		//Doing calculation of the taxs and the total price with tax
		$tax_amount = (int)$calcuated['total_price'] * ((float)$loc_tax[0]['loc_tax'] / 100);
		$tax_amount = round($tax_amount, 2);
		$total_price_with_tax = (float)$calcuated['total_price'] + (float)$tax_amount;
		
		//Saving the total price of rental, the array of prices for each item, and the total price with tax for receipt page
		$_SESSION['receipt_prices'] = $calcuated['receipt_prices'];
		$_SESSION['total_deposit'] = $calcuated['total_deposit'];
		
		$sub_total = $calcuated['total_price'];
		$total_deposit = $calcuated['total_deposit'];
	}
	else
	{
		//Grab the package value. if customer didnt select a package then the value would be 0
		$pack_select = $_POST['pack'];
		
		//Grab the customer's student and employee's status. If the customer is employee and the rental is a pick-up, then the rental is free. If the customer is a student, the student discount prices will be applied
		$if_student = $conn->prepare("select is_student, is_employee
										from Customer
										where cust_id = :sel_cust");
		$if_student->bindValue(':sel_cust', $sel_cust, PDO::PARAM_INT);
		$if_student->execute();  //excute the query. Also is the query went wrong somewhere, the "or die($conn->error)" part can tell us what is wrong with the select statement
		$if_student_row = $if_student->fetchAll();
		
		if(!($if_student_row[0]['is_employee'] == 'Yes'))
		{
			if($if_student_row[0]['is_student'] == 'yes' || $if_student_row[0]['is_student'] == 'Yes')
			{
				$_price = $conn->prepare("SELECT stu_price
											FROM OnSitePrices a
											WHERE a.pack_id = :pack_select");
				$_price->bindValue(':pack_select', $pack_select, PDO::PARAM_INT);
				$_price->execute();
				$price = $_price->fetchAll();
				$price = $price[0]['stu_price']; 
			}
			else
			{
				$_price = $conn->prepare("SELECT reg_price
											FROM OnSitePrices a
											WHERE a.pack_id = :pack_select");
				$_price->bindValue(':pack_select', $pack_select, PDO::PARAM_INT);
				$_price->execute();
				$price = $_price->fetchAll();
				$price = $price[0]['reg_price']; 
			}
		}
		else
		{
			$price = 0;
		}
		$sub_total = ""; 
		$total = $price;
		$displayput = "";
		
		$pack_name = $conn->prepare("SELECT pack_name
									FROM Packages
									WHERE pack_id = :pack_select");
		$pack_name->bindValue(':pack_select', $pack_select, PDO::PARAM_INT);
		$pack_name->execute();
		$pack_name = $pack_name->fetchAll();
		$pack_name = $pack_name[0]['pack_name'];
		
		$_SESSION['pack_name'] = $pack_name;
		$_SESSION['sub_total_price'] = $sub_total;
		$_SESSION['total_price'] = $total;
	}
	
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
					<!-- Prints out the total deposit for the rental -->
					<input type="text" name="total_deposit"  id="total_deposit" value="<?= $total_deposit ?>" readonly />
				</td>
			</tr>
			
			<tr>
				<th>
					Subtotal Cost of Rental(without tax):
				</th>
				<td>
					<!-- prints the subtotal price to the screen --> 
					<input type="text" name="subtotalCost"  id="subtotalCost" value="<?= $sub_total ?>" readonly />
				</td>
			</tr>
			
			<tr>
				<th>
					Tax:
				</th>
				<td>
					<input type='text' name='tax_input' id='tax_input' value="<?= $loc_tax[0]['loc_tax'] ?>" <?= $displayput ?> >%</input>
				</td>
			</tr>
			
			<tr>
				<th>
					Total Cost:
				</th>
				<td>
					<output name="totalCost" id="totalCost" for="totalCost"><?= $total_price_with_tax ?></output>
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
		
		</br>
		<!-- Comments section for any comments about the transaction or items condition -->
		&nbsp;&nbsp;&nbsp;&nbsp;
		<label for="comments"> Comments: </label>
			<textarea name="comments" id="comments" rows="2" cols="50"></textarea> 
		</br>
		
		<div>
			<fieldset style="border:none;">
				<!-- Three hidden inputs for keeping the total price of the rental including tax down, the tax amount for receipt page, and subtotal cost of the rental -->
				<input type="hidden" name="tax_amount" id="tax_amount" value="<?= $tax_amount  ?>"/>
				<input type="hidden" name="total_price_with_tax" id="total_price_with_tax" value="<?= $total_price_with_tax  ?>"/>
				<input type="hidden" name="sub_total_price" id="sub_total_price" value="<?= $sub_total  ?>"/>
				
				<!-- Input button that will take users either to the receipt page or back to the customer selection  -->
				<input type="submit" name="finalize" id="finalize" value="Finalize" />
				&nbsp;&nbsp;
				<input type="submit" name="cancelFinal" id="cancelFinal" value="Cancel" />
			</fieldset>
	</form>
		</div>
</body>

	<!-- Little script to dynamically change the total price with tax output according to whatever the user enters in as the tax amount -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			//When the tax input changes, indicating that the user have inputed a new tax rate
			$("#tax_input, #subtotalCost").on("input", function() {
				//Grab the subtotal price of the rental
				subtotal_price = $('#subtotalCost').val();
				tax_amount = $('#tax_input').val();
				
				//Calculate the tax amount with the new tax rate
				tax_amount = subtotal_price * (tax_amount / 100);
				
				//Make sure the new tax amount is 2 decimals long
				tax_amount = tax_amount.toFixed(2);
				
				//Add subtotal price with new tax amount
				total_price_with_tax = parseFloat(subtotal_price) + parseFloat(tax_amount);
				
				//And set the values to the output "totalCost" for viewing purposes and to the hidden inputs for receipt purposes
				$('#totalCost').val(total_price_with_tax);
				$('#total_price_with_tax').val(total_price_with_tax);
				$('#tax_amount').val(parseFloat(tax_amount));
				$('#sub_total_price').val(subtotal_price);
			});
			
			$( "#subtotalCost" ).dblclick(function()
			{
				document.getElementById('subtotalCost').readOnly = false;
			});
			
		});
	</script>

</html>


<?php
$conn = null;
	}
?>