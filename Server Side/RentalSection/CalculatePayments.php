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
	
	$loc = strip_tags($_POST['rent_location']);
	
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
		$displayput = "<input name='tax_input' id='tax_input' value=" . $loc_tax[0]['loc_tax'] . ">%</input>";
	}
	else
	{
		$displayput = "<output>" . $loc_tax[0]['loc_tax'] . "%</output>";
	}
	
	//Calls the priceCal function to calcuate the prices for the rental
	// input :: request date, due date, array of selected items for rental, and the customer id
	// output :: a array that consist of the total cost of rental, without tax, and a array of individually pricing for each items
	// Example of output :: $returned_array[0]['total_price'] = the total price int
	//						$returned_array[0]['receipt_prices'] = array of prices per item
	$calcuated = priceCal($request_date_format, $due_date_format, $array_of_items, $sel_cust);
	
	//Saving the total price of rental and the array of prices for each item for receipt page
	$_SESSION['total_price'] = $calcuated['total_price'];
	$_SESSION['receipt_prices'] = $calcuated['receipt_prices'];
	
	//Doing calculation of the taxs and the total price with tax
	$tax_amount = (int)$calcuated[0]['total_price'] * ((float)$loc_tax[0]['loc_tax'] / 100);
	$tax_amount = round($tax_amount, 2, PHP_ROUND_HALF_DOWN);
	$total_price_with_tax = (float)$calcuated[0]['total_price'] + (float)$tax_amount;
	
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
					Subtotal Cost of Rental(without tax):
				</th>
				<td>
					<!-- prints the subtotal price to the screen --> 
					<output name="subtotalCost"  id="subtotalCost" for="subtotalCost"><?= $calcuated[0]['total_price'] ?></output>
				</td>
			</tr>
			
			<tr>
				<th>
					Tax: (Change the tax rate if needed)
				</th>
				<td>
					<?= $displayput ?>
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
		<div>
			<fieldset style="border:none;">
				<!-- Two hidden inputs for keeping the total price of the rental including tax down and the tax amount for receipt page -->
				<input type="hidden" name="total_price_with_tax" id="total_price_with_tax" value="<?= $total_price_with_tax  ?>"/>
				<input type="hidden" name="tax_amount" id="tax_amount" value="<?= (float)$tax_amount  ?>"/>
				
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
		$(document).ready(function(){
			//When the tax input changes, indicating that the user have inputed a new tax rate
			$("#tax_input").on("input", function() {
				//Grab the subtotal price of the rental
				subtotal_price = $('#subtotalCost').val();
				
				//Calculate the tax amount with the new tax rate
				tax_amount = subtotal_price * (this.value / 100);
				
				//Make sure the new tax amount is 2 decimals long
				tax_amount = tax_amount.toFixed(2);
				
				//Add subtotal price with new tax amount
				total_price_with_tax = parseFloat(subtotal_price) + parseFloat(tax_amount);
				
				//And set the values to the output "totalCost" for viewing purposes and to the hidden inputs for receipt purposes
				$('#totalCost').val(total_price_with_tax);
				$('#total_price_with_tax').val(total_price_with_tax);
				$('#tax_amount').val(parseFloat(tax_amount));
			});
		});
	</script>

</html>


<?php
$conn = null;
	}
?>