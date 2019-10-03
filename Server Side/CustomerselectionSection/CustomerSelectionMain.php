<?php
	//First page on the CustomerSelection section. This would be the section main page, the page where most of the back and cancel button in the section
	//	will go to
	function CustomerSelection()
	{
		//Connecting to the Database
		$conn = db();
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../CustomerselectionSection/cust_css/cust_selection.css"/>
	
</head>
<body>
<?php
	//Since this function is shared by both Customer and Item return sections. The Label of the page will change according to which section the user wants to work in
	if($_SESSION["itemReturn"] == "Yes")
	{
?>
		<label for="rent_location"> Location: </label>
		<select name="location" id="location">
<?php
		foreach($conn->query("SELECT loc_name, loc_id
								FROM Location") as $row)
		{
			$selected = "";
			if($row['loc_id'] == '1')
			{
				$selected = "selected";
			}
?>
			<option value="<?= $row['loc_id'] ?>" <?= $selected ?>>
				<?= $row['loc_name'] ?>
			</option>
<?php
		}
?>
		</select>
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
							<tbody id="empty">

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
															FROM Customer a, Rental b
															WHERE a.cust_id = b.cust_id and 
																	b.pick_up_date IS NOT NULL and 
																	b.return_date is NULL and 
																	b.loc_id = 1
															GROUP BY cust_id
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
										$curr_due_date = date("D, j M Y", strtotime($curr_due_date));
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
			<div id="myModal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					
					<label for="rent_location"> Location: </label>
					<select name="rent_location" class="rent_location" id="rent_location">
<?php
						foreach($conn->query("SELECT loc_name, loc_id
												FROM Location") as $row)
						{
?>
							<option value="<?= $row['loc_id'] ?>">
								<?= $row['loc_name'] ?>
							</option>
<?php
						}
?>
					</select>
					
					</br>
					</br>
					
					<div id='on_site_rental' name='on_site_rental' style="display: none;">
						<label for="on_site_button"> On-Site Rental: </label>
						<input type='checkbox' name='on_site_button' id='on_site_button' value="1">
					</div>
					
					</br>
					<div id='input_dates' name='input_dates' style='display: block;'>
						<!-- The "Pick up" and "Return" date inputs. Have it where users can not select past dates for rentals   min="<?php //echo date('Y-m-d'); ?>"-->
						Pick up Date: <input type = "date" name = "pickUpDate" id = "pickUpDate"/>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						Return Date: <input type = "date" name = "returnDate" id = "returnDate"/>
					</div>
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
				alert("Please select a customer");
				return false;
			}
		}
	</script>

	<!-- Function for saving the selected customer's id to the hidden input "cust_id" -->
	<script type="text/javascript">
	$(document).ready(function(){
		$("#table_div").on('click', 'table tr', function(){
			
			$(this).find('td input:radio').prop('checked',true);
			
			$('input[type="radio"]:checked').each(function(){
				var box_value = $(this).val();
				$('#cust_id').val(box_value);
				console.log($('#cust_id').val());
			});
			
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
	
	<!-- A little Javascript that when the Location HBAC, the radio button for the on-site or not will appear below the location selection -->
	<script type="text/javascript">
		$(function() 
		{
			//when the location select is changed
			$('.rent_location').change(function()
			{
				//Log it
				console.log("Rental Location Change");
				
				//Checks if the new selected location is HBAC. 
				if($("#rent_location").val() == 2)
				{
					//If so then we display the on-site checkbox
					document.getElementById("on_site_rental").style.display = "block"; 
				}
				else
				{
					//If not, we make sure the on-site checkbox is hidden again
					document.getElementById("on_site_rental").style.display = "none"; 
					
					//Set the pick-up and return-dates to be nothing
					$('#pickUpDate').val("");
					$('#returnDate').val("");
					
					//if the on-site check-box is checked, uncheck it
					if($("#on_site_button").is(':checked'))
					{
						$('#on_site_button').prop('checked', false);
						
						//And we will re-display both dates inputs
						document.getElementById("input_dates").style.display = "block"; 
					}
				}
			});
		});
	</script>
	
	<!-- A little Javascript that when the 'on site' checkbox input is click inndicating that the rental is on-site, we will then just default both 'Pick up Date' and 'Return Date' to the current date -->
	<script type="text/javascript">
		$(function() 
		{
			//When the on-site checkbox is changed
			$("#on_site_button").on('change', function()
			{
				//Log it
				console.log("On-Site Rental");
				
				//Checks if the checkbox have been changed to uncheck
				if (!this.checked) {
					//If so then set both pick-up and return date to be nothing
					$('#pickUpDate').val("");
					$('#returnDate').val("");
					
					//And we will re-display both dates inputs
					document.getElementById("input_dates").style.display = "block"; 
				}
				else
				{
					//If the checkbox have been checked
					
					//Get the current date
					var today = new Date();
					
					//Format it so we can input it in the pick-up and return dates. Format has to be :::: YEAR(0000) - MONTH(00) - DAY(00)
					var dd = String(today.getDate()).padStart(2, '0');
					var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
					var yyyy = today.getFullYear();
					today = yyyy + '-' + mm + '-' + dd;
					
					//Set the both dates to the current date
					$('#pickUpDate').val(today);
					$('#returnDate').val(today);
					
					//And we will hid both dates inputs
					document.getElementById("input_dates").style.display = "none"; 
					
				}
			});
		});
	</script>
	
	<!--  -->
	<script type="text/javascript">
		$(function() 
		{
			$('#location').change(function() //Starts the script when the user select a package from the package selection field
			{
				$.ajax(
				{
					url: "../ItemTranSection/Location_Rental_Return_helper.php", //The file where the php select query is at
					type: "post",
					data: 
					{
						'loc_id': $(this).val() //assigning the value of the selected package to "pack_value"
					},
					success: function(data) //When the AJAX call is successful, the script does the following
					{
						var json_object = JSON.parse(data); //Grabs the data that is in JSON format and parse it so it is usable
						
						$('#empty').empty();
						
						var late_empty = document.getElementById('empty');
						
						if(json_object.length != 0)
						{
							for(var i = 0; i < json_object.length; i++)
							{
								var obj = json_object[i]; //First it grabs the current item in the data
							
								//Sets all the item data to its corresponding fields
								cust_id = obj['cust_id'];
								f_name = obj['f_name'];
								l_name = obj['l_name'];
								c_phone = obj['c_phone'];
								c_email = obj['c_email'];
								due_date = obj['due_date'];
								
								var d_names = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

								var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
								
								var d = new Date(due_date.replace(/-/g, '\/'));
								var curr_day = d.getDay();
								var curr_month = d.getMonth();
								var curr_date = d.getDate();
								var curr_month = d.getMonth();
								var curr_year = d.getFullYear();
							
								var current_date = new Date();
								
								if(d <= current_date)
								{
									due_date = d_names[curr_day] + ", " + curr_date + " " +  m_names[curr_month] + " " + curr_year + " Late";
								}
								else
								{
									due_date = d_names[curr_day] + ", " + curr_date + " " +  m_names[curr_month] + " " + curr_year;
								}
								
								//Create a tr tag
								var tr = document.createElement('tr');
								
								//Populate the tr tag
								tr.innerHTML = "<td id='hide_me'><input id ='radio_in' type='radio'  name='item_id[]' value=" + cust_id + "></input></td>" + 
												"<td>" + f_name + "</td>" + 
												"<td>" + l_name + "</td>" + 
												"<td>" + c_email + "</td>" + 
												"<td>" + c_phone + "</td>"  + 
												"<td>" + due_date + "</td>" ;
								
								//Add the tr tag to the tbody of the item selection list
								late_empty.appendChild(tr);
							}
						}
						else
						{
							//Create a tr tag
							var tr = document.createElement('tr');
							tr.innerHTML = "<td colspan='5'> No Rentals </td>";
								
							//Add the tr tag to the tbody of the item selection list
							late_empty.appendChild(tr);
						}
					}
				});
			});
		});
	</script>

</html>


<?php
	$conn = null;   //also remember to close the connection to the database
}
?>
