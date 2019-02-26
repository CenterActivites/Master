<?php
	//First page on the CustomerSelection section. This would be the section main page, the page where most of the back and cancel button in the section
	//	will go to
	function CustomerSelection()
	{
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../CustomerselectionSection/cust_css/cust_selection.css"/>
	
	<!-- JavaScript Starts here -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
	<script type="text/javascript" src="jquery.quicksearch.js"></script>  <!-- Plugin for the item Search function -->

	<!-- Creation of a hidden input called cust_id to grab the selected customer id -->
	<script type="text/javascript">
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'cust_id',
				name: 'cust_id'
			}).appendTo('#button');
		});
	</script>
	
	<!-- A "check" function for the button "Customer Information" that sees if a customer have been selected or not -->
	<!-- A customer must be selected to move on -->
	<script type="text/javascript">
		function is_blank(){
			if(document.getElementById('cust_id').value.length == 0){
				alert("please select a customer");
				return false;
			}
		}
	</script>

	<!-- Function for saving the selected customer's id to the hidden input "cust_id" -->
	<script type="text/javascript">
	$(document).ready(function(){
		$("#table_div").click(function(){
			$('input[type="radio"]:checked').each(function(){
				var box_value = $(this).val();
				$('#cust_id').val(box_value);
				console.log($('#cust_id').val());
			});
		});
	});
	</script>

	<script type="text/javascript">
	//this script goes off when a table row is clicked it checks the radio button
		$(document).ready(function(){
			$("#cust_table_info tr").click(function(){
					$(this).find('td input:radio').prop('checked',true);
				});
			});
	</script>

	<script type = "text/javascript">
		// this script calls a CSS class called .highlight in the CSS file
		// So that when a click happens It hightlights the row letting the user know that they've selected it.
		$(document).ready(function(){
			$("#cust_table_info tr").click(function(){
				$("#cust_table_info tr").removeClass("highlight");
				$(this).addClass("highlight");
			});
		});
	</script>

	<!-- Search functionally for the Customer table -->
	<script type="text/javascript">
		$(function ()
		{
			$('input#searchCust').quicksearch('#cust_table_info tbody tr'); //On key search for customer names here
		});
	</script>
	
	<!-- Modal script got from online with little adjustments for this page purpose -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			//Grabs the hidden div called 'myModal" and the span tag
			var modal = document.getElementById('myModal');
			var span = document.getElementsByClassName("close")[0];
			
			//Once the Rental button is clicked
			$("#rent").click(function(){
				//Does the check if a customer have been selected
				if(document.getElementById('cust_id').value.length == 0)
				{
					alert("Please Select a Customer");
					return false;
				}
				else
				{
					console.log("Rental click");
					//If a customer is selected, the hidden div will be shown
					modal.style.display = "block";
				}
			});
			
			//Once the close/span, on the right top corner, is clicked; we re-hid the div
			span.onclick = function(){
				console.log("Close click");
				modal.style.display = "none";
			};
		});
	</script>
	
	<!-- Another check funtion that makes sure the user selects both "pick up date" and "return date" -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			//Once the "Continue" button is clicked
			$("#on_to_rental").click(function(){
				//Does the check
				if(document.getElementById('pickUpDate').value.length == 0 || document.getElementById('returnDate').value.length == 0)
				{
					alert("Please Enter in the Requested Dates");
					return false;
				}
			});
		});
	</script>
	
	

</head>
<body>
<?php
	//Since this function is shared by both Customer and Item return sections. The Label of the page will change according to which section the user wants to work in
	if($_SESSION["itemReturn"] == "Yes")
	{
?>
		<div id="pageHeader" style="font-size: 35px; text-align: center;"> Rental Return </div>
<?php
	}
	else
	{
?>
		<div id="pageHeader" style="font-size: 35px; text-align: center;"> Customer </div>
<?php
	}
?>
<div>
<?php
		//Using the username and password that was entered in the login page to connect to the database
        $username = $_SESSION['username']; 
		$password = $_SESSION['password'];
        $conn = hsu_conn_sess($username, $password);
 ?>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id='button' >
			<fieldset style="border:none">
				<fieldset id='fieldset_label' style="background-color: #D3D3D3;">
					<label id='header_for_table' style="padding-left: 5%; font-size: 20px"> Select A Customer </label>
				</fieldset>
					<div id='table_div'>
						<!-- Customer table creation starts here -->
						<table id='cust_table_info'>
							<thead>
								<!-- Labels for each column  -->
								<tr>
									<!-- The hidden column for the hidden radio buttons for the selection purposes since tables don't really have selecting capabilities -->
									<th id='hide_me'></th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Phone Number</th>
<?php
									//Only the item return section will have this extra column
									if($_SESSION["itemReturn"] == "Yes")
									{
?>
										<th>Due By</th>
<?php
									}
?>
								</tr>
							</thead>
							<!-- The body of the table. Basically where all the customer's information is going to be -->
							<tbody>

<?php
								//Again since both Item Return and Customer section both uses this page, we have to make sure the correct data is going to the correct section
								if($_SESSION["itemReturn"] != "Yes")
								{
									//The Customer Section 
									
									//MYSQL select. Grab all customers in the data with the following information about them
									//Their id, first and last name, phone number, and email
									foreach($conn->query("SELECT cust_id, f_name, l_name,c_phone,c_email
															FROM Customer
															ORDER BY l_name, f_name") as $row)
									{
										$curr_f_name = $row["f_name"]; //each row is a object that has a f_name, l_name, and a cust_id
										$curr_l_name = $row["l_name"];
										$curr_cust_id = $row["cust_id"];
										$curr_c_email = $row["c_email"];
										$curr_c_phone =$row["c_phone"];
?>
										<!-- Placing the data into their correct columns -->
										<tr>
											<!-- Since tables really doesn't have a select capabilities to it, We just add a hidden radio button that will allow us to see which customer have been selected -->
											<td id = "hide_me"><input id ="radio_in" type="radio"  name="item_id[]" value = "<?= $curr_cust_id ?>"/></td>
											<td><?= $curr_f_name ?></td>
											<td><?= $curr_l_name ?></td>
											<td><?= $curr_c_email ?></td>
											<td><?= $curr_c_phone ?></td>
										</tr>
<?php
									}
								}
								else
								{
									//Item return section
									
									//First we created a bool var for later seeing is there were any rentals to be return at all
									$if_for_ran = false;
									
									//MYSQL select query for all customers with rentals out there. We grab the following data
									//The customer's id, first and last name, phone number, e-mail, and the due date for the rentals
									foreach($conn->query("SELECT b.cust_id, f_name, l_name, c_phone, c_email, due_date
															FROM Customer a, Reserve b
															WHERE a.cust_id = b.cust_id and b.pick_up_date IS NOT NULL
															GROUP BY b.cust_id
															ORDER BY due_date, l_name, f_name") as $row)
									{
										$curr_f_name = $row["f_name"]; //each row is a object that has a f_name, l_name, and a cust_id
										$curr_l_name = $row["l_name"];
										$curr_cust_id = $row["cust_id"];
										$curr_c_phone = $row["c_phone"];
										$curr_c_email = $row["c_email"];
										$curr_due_date = $row["due_date"];
										
										//Does a check here to see if the due date is late or not
										//If is late, we add the label "Late" to the customer 
										if(strtotime($curr_due_date) < strtotime(date('Y-m-d')))
										{
											$display_late_rental = " Late";
										}
										else
										{
											$display_late_rental = "";
										}
										
										//The following two lines is for formatting reasons. Basically to make the date we get from the database more readable for users
										$curr_due_date = strtotime($curr_due_date);
										$curr_due_date = date('M d, Y', $curr_due_date);
?>
										<!-- Placing the data into their correct columns -->
										<tr>
											<!-- Since tables really doesn't have a select capabilities to it, We just add a hidden radio button that will allow us to see which customer have been selected -->
											<td id = "hide_me"><input id ="radio_in" type="radio"  name="item_id[]" value = "<?= $curr_cust_id ?>"/></td>
											<td><?= $curr_f_name ?></td>
											<td><?= $curr_l_name?></td>
											<td><?=$curr_c_email?></td>
											<td><?=$curr_c_phone?></td>
											<td><?= $curr_due_date . $display_late_rental?></td>
										</tr>

<?php
										//If the query does ends up running then we change the bool var we created in the beginning of the script to true
										$if_for_ran = true;
									}
									
									//If the bool var is still false, that means the query did not run which means that that is no rentals to be return
									//We will just let the user know that there is no rentals out at the moment
									if($if_for_ran == false)
									{
?>
										<tr> <td colspan="5"> No Rentals </td> </tr>
<?php
									}
								}
?>
							</tbody>
						</table>
					</div>
			</fieldset>
		
		<!-- Modal content. The box that appears when the "Rental" button is clicked -->
		<div id="myModal" class="dates">
			<div class="modal-content">
				<span class="close">&times;</span>
				
				<!-- The "Pick up" and "Return" date inputs. Have it where users can not select past dates for rentals -->
				Pick up Date: <input type = "date" name = "pickUpDate" id = "pickUpDate" min="<?php echo date('Y-m-d'); ?>"/>
				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				Return Date: <input type = "date" name = "returnDate" id = "returnDate" min="<?php echo date('Y-m-d'); ?>"/>
				</br>
				<input type="submit" name="on_to_rental" id="on_to_rental" value="Continue" /><br />
			</div>
		</div>
			
	    <fieldset style="border:none;">
		
			<!-- The Search bar -->
			<label id='search_lable'>Search:</label> <input type = "text" name = "searchCust" id = "searchCust" placeholder="Search for names..." /> <br/>   <!-- Search bar -->
			</br>
			</br>
<?php
				//Again since both Item Return and Customer section both uses this page, there will some buttons that will only appear in Customer and some will only appear in Item Return 
				if($_SESSION["itemReturn"] != "Yes")
				{
?>
					<input type="submit" name="custInfo" id="custInfo" value="Customer Information" onclick="return is_blank()"/> &nbsp; &nbsp;
					<input type="submit" name="newCust" id="newCust" value="New Customer" /> &nbsp; &nbsp;
					<input type="button" name="rent" id="rent" value="Rental" /><br />
<?php
				}
				else
				{
?>
					<input type="submit" name="select" id="select" value="Select" /><br />
<?php
				}
?>
	
		</form>
		</fieldset>
</div>
</body>
</html>


<?php
	$conn = null;   //also remember to close the connection to the database
}
?>
