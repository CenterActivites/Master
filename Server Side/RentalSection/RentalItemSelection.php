<?php
	//Item Selection Page. Where users are going to select the items the customers want to rent out 
	function RentalItemSelect()
	{
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../RentalSection/rental_css.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/toggle.css">
	<link rel="stylesheet" type="text/css" href="../CSS/Mult_column_select.css">
	
</head>
<body>

    <fieldset id='fieldset_label' style="border:none; text-align: center;">
		<label id='header_for_table' style="font-size: 25px"> Item Selection </label>
	</fieldset>
    <div style="text-align:center;"> 
<?php
		//PDO Connection to the Databse
        $conn = db();
		
		//Grabs the selected customer and their request dates for the rental
		$sel_cust = $_SESSION['sel_user'];
		$cust_request_date = $_SESSION['request_date'];
		$cust_due_date = $_SESSION['due_date'];
		$curr_loc = $_POST['rent_location'];
		$on_site_check = $_POST['on_site_button'];
		
		//Storing the on-site check and location of the rental to session
		$_SESSION['on_site'] = $on_site_check;
		$_SESSION['loc'] = $curr_loc;
		
		$curr_date = Date("Y-m-d");
		
		//Creating the current customer's padding request and padding due dates for the later sql select
		$cust_padded_request_date = date('Y-m-d', strtotime($cust_request_date. ' - 2 days'));;
		$cust_padded_due_date = date('Y-m-d', strtotime($cust_due_date. ' + 2 days'));
	
		//MYSQl select query to see if the selected customer is a student or not
		$is_student = $conn->prepare("SELECT is_student
										FROM Customer
										WHERE cust_id = :sel_cust");
		$is_student->bindValue(':sel_cust', $sel_cust, PDO::PARAM_INT);
		$is_student->execute();
		$is_student = $is_student->fetchAll();
		
		//Grabbing the list of items that have been reserved already to see if the current request dates will not come into conflict with each other
		$list_of_reserve = $conn->prepare("select item_Backid, request_date, due_date
										from Rental a, Reserve1 b
										where a.rent_id = b.rent_id and a.pick_up_date is null;");
		$list_of_reserve->execute();
		$list_of_reserve = $list_of_reserve->fetchAll();
		
		//Create a list of conflict to keep track of all reserve conflict if there are any
		$list_of_conflicts = [];
		
		//Loop though the list of current reserves
		foreach($list_of_reserve as $row)
		{
			//Grab item id, the reserve request date and due date
			$item_id = $row['item_Backid'];
			$reserve_request_date = $row['request_date'];
			$reserve_due_date = $row['due_date'];
			
			//Checks if the customer's request date and the reserve request date are the same
			if($reserve_request_date == $cust_request_date)
			{
				//Used for Debugging :: echo "Both request dates are the same, conflict" . "</br>";
				//If are then that is a conflict since the item is already been reserved by someone else
				array_push($list_of_conflicts, $item_id);
			}
			
			//Checks if the customer's request date is after the reserve request date
			// EX: customer's request date is 01/12/2019 and the reserve request date is 01/10/2019.
			//     Here because the customer's request date is after the reserve request date, we have to check
			//     between the reserve due date with the 2 day needed for cleaning and the customer's request date.
			elseif($reserve_request_date < $cust_request_date)
			{
				//Add the 2 days needed for cleaning
				$pad_reserve_due_date = date('Y-m-d', strtotime($reserve_due_date. ' + 2 days'));
				
				//Does the check with the reserve due date with cleaning and customer's request date
				if($pad_reserve_due_date > $cust_request_date or $pad_reserve_due_date == $cust_request_date)
				{
					//Used for Debugging :: echo "Cust request date conflict with reserve due date" . "</br>";
					//If there is conflict then push the item id to the conflict array
					array_push($list_of_conflicts, $item_id);
				}
			}
			
			//If it gets to this then it means that the customer's request date is before the reserve request date
			//Which means we need to check the customer's due date with the 2 day needed for cleaning and the reserve's request date.
			else
			{
				//Add the 2 days needed for cleaning
				$pad_cust_due_date = date('Y-m-d', strtotime($cust_due_date. ' + 2 days'));
				
				//Does the check with the customer's due date with cleaning and reserve's request date
				if($pad_cust_due_date > $reserve_request_date or $pad_cust_due_date == $reserve_request_date)
				{
					//Used for Debugging :: echo "Cust due date conflict with reserve request date" . "</br>";
					//If there is conflict then push the item id to the conflict array
					array_push($list_of_conflicts, $item_id);
				}
			}
		}
 ?>
	<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
		
		<fieldset style="border:none; word-wrap: break-word;">
			<div id="div_for_selection" name="div_for_selection"  style="float:left; width:65%;">
				<fieldset id='fieldset_label' style="border:none; text-align: center;">
					<label id='header_for_table' style="font-size: 20px"> List of Available Items: </label>
				</fieldset>
				<table id="item_selection" name="item_selection">
					<thead>
						<tr>
							<th id = "hide_me"> </th>
							<th id ="th_front">Item Id</th>
							<th>Item Size</th>
							<th>Item Model</th>
							<th>Item Name</th>
						</tr>
					</thead>
					<tbody id='select_empty'>
<?php
						//Query for item selection with Items status 'Ready'
						foreach($conn->query("SELECT item_Backid, inv_name, item_size, item_Frontid, item_modeltype
												FROM Item a, Inventory c, Status b
												WHERE a.inv_id = c.inv_id and 
														a.stat_id = b.stat_id and 
														a.loc_id = " . $curr_loc . " and 
														a.public = 1 and
														(a.stat_id = 1 or a.stat_id = 7)
												ORDER BY inv_name, item_modeltype, item_Backid") as $row)
						{
							//Check if the selected customer is a student or not.
							if($is_student[0][0] == 'no' || $is_student[0][0] == 'No' || $cust_request_date > $curr_date)
							{
								//If the selected customer is not a student, then check each item is the item is Outdoor Nation or not
								//Basically we're filtering out the Outdoor Nation items when the selected customer is not a student
								if(!(strpos($row["inv_name"], "Outdoor Nation") !== false))
								{
									$curr_item_backid = $row["item_Backid"];
									if(!(in_array($curr_item_backid, $list_of_conflicts)))
									{
										$curr_inv_name = $row["inv_name"];
										$curr_item_size = $row["item_size"];
										$curr_item_frontid = $row["item_Frontid"];
										$curr_item_modeltype = $row["item_modeltype"];
										if($curr_item_size == null || $curr_item_size == "") 
										{
											$curr_item_size = "No Size";
										}
?>
										<tr id='table_row_info'>
											<td id = "hide_me"><input type="radio" id ="item_id" name="item_id[]" value = "<?= "0-" . $curr_item_backid ?>"/></td>
											<td id = 'td_front'><?= $curr_item_frontid?></td>
											<td><?= $curr_item_size ?></td>
											<td><?= $curr_item_modeltype ?></td>
											<td><?= $curr_inv_name ?></td>
										</tr>
<?php
									}
								}
							}
							else
							{
								$curr_item_backid = $row["item_Backid"];
								if(!(in_array($curr_item_backid, $list_of_conflicts)))
								{
									$curr_inv_name = $row["inv_name"];
									$curr_item_size = $row["item_size"];
									$curr_item_frontid = $row["item_Frontid"];
									$curr_item_modeltype = $row["item_modeltype"];
									if($curr_item_size == null)   
									{
										$curr_item_size = "No Size";
									}
?>
									<tr id='table_row_info'>
										<td id = "hide_me"><input type="radio" id ="item_id" name="item_id[]" value = "<?= "0-" . $curr_item_backid ?>"/></td>
										<td id = 'td_front'><?= $curr_item_frontid?></td>
										<td><?= $curr_item_size ?></td>
										<td><?= $curr_item_modeltype ?></td>
										<td><?= $curr_inv_name ?></td>
									</tr>
<?php
								}
							}
						}
?>
					</tbody>
				</table>
				</br>
				</br>
				<label id="search_lable">Search: </label> 
				<input type = "text" name = "searchItem" id = "searchItem" placeholder="Item Name, Size, Model, Id"/> </br>
			</div>
					
			<div id="div_for_cart" name="div_for_cart" style="float:right; width:30%;">
				<fieldset id='fieldset_label' style="border:none; text-align: center;">
					<label id='header_for_table' style="font-size: 20px"> Cart: </label>
				</fieldset>
				<table id="cart" name="cart" style="float:left">
					<thead>
						<tr>
							<th id = "hide_me"> </th>
							<th id ="th_front">Item Id</th>
							<th>Item Size</th>
							<th>Item Model</th>
							<th>Item Name</th>
						</tr>
					</thead>
					<tbody id='cart_empty'>
						<tr>
							<td colspan="5" id="delete_me">
								Cart Empty
							</td>							
						</tr>
					</tbody>
				</table>
			</div>
		
			</br>
			</br>
			</br>
			</br>
			
			<div id="div_for_package_select" name="div_for_package_select">
				<fieldset id='fieldset_label' style="border:none; text-align: center;">
					<label id='header_for_table' style="font-size: 20px"> Packages: </label>
				</fieldset>
				<select name="pack" id="pack" multiple="multiple" class="pack">
					<option value=0 selected="selected"> None </option>
<?php
					if($on_site_check == NULL)
					{
						$pack_query = "SELECT pack_name, a.pack_id
										FROM Packages a, PackLoc b
										WHERE a.pack_id = b.pack_id and b.loc_id =" . $curr_loc;
					}
					else
					{
						$pack_query = "SELECT pack_name, a.pack_id
										FROM Packages a, PackLoc b, OnSitePrices c
										WHERE a.pack_id = b.pack_id and c.pack_id = a.pack_id and b.loc_id =" . $curr_loc;
					}
					//Query for package name
					foreach($conn->query($pack_query) as $row)
					{
						$curr_pack_name = $row['pack_name'];
						$curr_pack_id = $row['pack_id'];
?>
						<!-- Pushing the fetch information to the screen -->
						<option value="<?= $curr_pack_id ?>">
							<?= $curr_pack_name ?> 
						</option>
<?php
					}
?>
				</select>
			</div>
			
			</br>
			</br>
			
			<div style="float:right; text-align: center; padding:10px; width:25%;">
				<div id="pack_infor" name="pack_infor">
				</div>
			</div>
			
		</fieldset>
		
		</br>
		</br>
		
	    <fieldset style="border:none;">
			<input type="hidden" name="item_array" id="item_array"/>  <!-- input tag for the returning the list of selected items from Cart -->
			<input type="hidden" id="loc_hidden" name="loc_hidden" value="<?= $curr_loc ?>"/>
            <input type="submit" name="calPay" id="calPay" value="Continue to Payments" style="float: left; margin-left:40%;"/>    <!-- Sends the user onto the next page, the CalculatePayments page -->
	</form>
	<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
		<input type="submit" name="cancel" id="cancel" value="Cancel" style="float: left; margin-left:20px;"/><br />     <!-- Sends the user back to customer selection page -->
	</form>
	    </fieldset>
</body>

	<!-- JavaScript Starts here -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
	<script type="text/javascript" src="jquery.quicksearch.js"></script>  <!-- Plugin for the item Search function -->

	<!-- Make sure the cart is empty everytime -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#item_array").val("");
		});
	</script>
	
	<!-- Little script set the selection item id values to the item array hidden input, and move it to the cart -->
	<script type="text/javascript">
	$(document).ready(function(){
		
		//Once user select an item on the selection item table
		$("#div_for_selection").on('click', 'table tr', function(){
			
			//Check the hidden radio button so that we can grab the item id value that is set with the radio button
			$(this).find('td input:radio').prop('checked',true);
			
			$('input[type="radio"]:checked').each(function(){
				//Grab the item_id value of the selected item
				var box_value = $(this).val();
				
				//Logs the item id into the console
				console.log("Item id that was selected to add to the cart: " + $(this).val());
				
				var get_val = $("#item_array").val();  //Grabs current string values from the input tag "item_array"
				var hidden_val = (get_val != "") ? get_val+"," : get_val; //Adds the item to the string with "," separating the items
				$("#item_array").val(hidden_val + box_value); //Have the input tag "item_array" hold/keep the string
				
				//Logs the current values of the cart array
				console.log("Current cart array: " + $("#item_array").val());
				
				//Grab the whatever is in the current cart
				if_cart_is_empty = $("#delete_me").text();
				if_cart_is_empty = if_cart_is_empty.replace(/\s/g, '');
				
				//Grabs the "tbody" select tag
				var tbody = document.getElementById('cart_empty'); //Grabs the "tbody" select tag
				
				//Grab all the needed information to be added to the cart
				item_id = $(this).closest("tr").find('td:nth-child(2)').text();
				item_size = $(this).closest("tr").find('td:nth-child(3)').text();
				item_model = $(this).closest("tr").find('td:nth-child(4)').text();
				item_name = $(this).closest("tr").find('td:nth-child(5)').text();
				
				//Check the currenty cart to see if its empty or not
				if(if_cart_is_empty == "CartEmpty")
				{
					//Remove the "Cart Empty" row because now there is a item in the cart
					$('#cart_empty').empty();
					
					//Create a tr tag
					var tr = document.createElement('tr');
					
					//Populate the tr tag
					tr.innerHTML = "<td id='hide_me'>" + "<input type='radio' id ='item_id' name='item_id[]' value = '"+box_value+"'/>" +"</td>" + 
									"<td>" + item_id + "</td>"  + 
									"<td>" + item_size + "</td>" +
									"<td>" + item_model + "</td>" + 
									"<td>" + item_name + "</td>";
									
					//Add the tr tag to the tbody of the item selection list
					tbody.appendChild(tr);
				}
				else
				{
					var tr = document.createElement('tr');
					tr.innerHTML = "<td id='hide_me'>" + "<input type='radio' id ='item_id' name='item_id[]' value = '"+box_value+"'/>" +"</td>" + 
									"<td>" + item_id + "</td>"  + 
									"<td>" + item_size + "</td>" +
									"<td>" + item_model + "</td>" + 
									"<td>" + item_name + "</td>";
					tbody.appendChild(tr);
				}
			});
			
			//Remove the selected item from the selection list
			$(this).remove();
		});
		
	});
	</script>
	
	<!-- Little script that remove the item_id value, that was selected to be remove from the cart, from the cart_array and move the item back to the list of selectable items -->
	<script type="text/javascript">
		$(document).ready(function(){
			
			//Once the user select a item from the cart to be deselected
			$("#div_for_cart").on('click', 'table tr', function(){
				//Grab the whatever is in the current cart
				what_in_cart_curr = $("#delete_me").text();
				what_in_cart_curr = what_in_cart_curr.replace(/\s/g, '');
				
				//Check the currenty cart to see if its empty or not. If the cart is empty, we do nothing. If it is not empty and has a item then we do...
				if(what_in_cart_curr != "CartEmpty")
				{
					//Check the hidden radio button so that we can grab the item id value that is set with the radio button
					$(this).find('td input:radio').prop('checked',true);
					
					$('input[type="radio"]:checked').each(function(){
						//Grab the item_id value of the selected item
						var box_value = $(this).val();
						
						//Logs the item id into the console
						console.log("Item id that was selected to be removed from the cart: " + $(this).val());
						
						//Like the selecting the item, here the following lines to for when the user deselect a item from cart.
						var get_val = $("#item_array").val(); //Grabs current string values from the input tag "item_array"
						var new_val = get_val.replace(box_value, "");  //Finds it in the string and replace it with just a emply one, ""
						$("#item_array").val(new_val); //Have the input tag "item_array" hold/keep the new string
						
						//Logs the current values or the cart array
						console.log("Current cart array: " + $("#item_array").val());
					
						//Grabs the "tbody" select tag for adding rows to it
						var tbody = document.getElementById('select_empty'); 
						
						//Grab all the needed information to be added to the item selection list
						item_id = $(this).closest("tr").find('td:nth-child(2)').text();
						item_size = $(this).closest("tr").find('td:nth-child(3)').text();
						item_model = $(this).closest("tr").find('td:nth-child(4)').text();
						item_name = $(this).closest("tr").find('td:nth-child(5)').text();
						
						//Create a tr tag
						var tr = document.createElement('tr');
						
						//Populate the tr tag
						tr.innerHTML = "<td id='hide_me'>" + "<input type='radio' id ='item_id' name='item_id[]' value = '"+box_value+"'/>" +"</td>" + 
										"<td>" + item_id + "</td>"  + 
										"<td>" + item_size + "</td>" +
										"<td>" + item_model + "</td>" + 
										"<td>" + item_name + "</td>";
										
						//Add the tr tag to the tbody of the item selection list
						tbody.appendChild(tr);
					
					});
				
					//Remove the selected item from the selection list
					$(this).remove();
					
					//The next following lines is a little script for checking if the item that was deselect was the last item in the cart or not
					//If the item was the last item in the cart then we add the "Cart Empty" td tag to let the user know that the cart is empty.
					if_cart_is_empty = $("#cart_empty").text();
					if_cart_is_empty = if_cart_is_empty.replace(/\s/g, '');
					if(if_cart_is_empty == "")
					{ 
						//Grabs the "tbody" of the cart
						var tbody = document.getElementById('cart_empty');
						var tr = document.createElement('tr');
						tr.innerHTML = "<td colspan='5' id='delete_me'>" + "Cart Empty" + "</td>";
						tbody.appendChild(tr);
					}
				}
			});
		});
	</script>
	
	<!-- Plugin for the item Search function -->
	<script type="text/javascript">
		$(function ()
		{
			$('input#searchItem').quicksearch('#item_selection tbody tr'); //On key search for customer names here
		});
	</script>
	
	<!-- The AJAX script that changes the item selection field to whatever package the user select -->
	<script type="text/javascript">
		$(function() 
		{
			$('#pack').change(function() //Starts the script when the user select a package from the package selection field
			{
				$.ajax(
				{
					url: "../RentalSection/Helper.php", //The file where the php select query is at
					type: "post",
					data: 
					{
						'pack_value': $(this).val(), //assigning the value of the selected package to "pack_value"
						'loc_id' : $('#loc_hidden').val()
					},
					success: function(data) //When the AJAX call is successful, the script does the following
					{
						//console.log("Selection of Package:" + data); //Tells the console log that the AJAX call was good
						
						var json_object = JSON.parse(data); //Grabs the data that is in JSON format and parse it so it is usable
						
						//Empties the select in preparation of inserting all items that associated with the package
						$('#select_empty').empty();
						
						var item_display = document.getElementById('select_empty'); //Grabs the "item_selection" select tag
						var cart = $("#item_array").val(); //Also grab the "cart_array" input tag for processing the cart for display
						var cart_array = cart.split(","); //Turns the cart string into a cart array by separating the string by the "," char
						
						//The next following lines creates a filtered cart, that filtered out any empty spots in the array
						var filtered_cart_array = cart_array.filter(function () { return true });
						
						//Create the finally filtered cart array for the checks we're about to do for knowing if to display the item or not
						var finished_filtered_cart_array = [];
						
						//Loop through the filtered cart array
						for(var a = 0; a < filtered_cart_array.length; a++)
						{
							//Split the item id because it looks like "0-143" currently and we need it as just "143"
							var each_item_id = filtered_cart_array[a].split("-");
							
							//Push the newly edited id onto the finished filtered cart array for checking use.
							finished_filtered_cart_array.push(each_item_id[1]);
						}
						
						//Here the script starts processing all the item data it got from the AJAX call by looping through it in a FOR loop
						for(var i = 0; i < json_object.length; i++)
						{
							var obj = json_object[i]; //First it grabs the current item in the data
							
							//Then grab the is_student value to see if the customer is a student or not
							var is_student = "<?php echo $is_student[0][0] ?>";
							
							//Also grab the conflict list
							var conflict_list = <?php echo json_encode($list_of_conflicts); ?>;
							
							//If the customer is not a student
							if(is_student == 'no' || is_student == 'No')
							{
								//Grab the item name
								inv_name = obj['inv_name'];
								
								//Checks if the item is not a 'OutDoor Nation' then we continue repopulating the select. If it then we do nothing and move on to the next item
								if(inv_name.includes("Outdoor Nation") != 1)
								{
									//Grab the item id
									item_Backid = obj['item_Backid'];
									
									//Check if the item is in conflict with this rental date range
									if(conflict_list.includes(item_Backid) === false)
									{
										//
										//The next following lines checks if the item that is going diplayed is already in the cart
										//
										
										//Does the check here. The if statement reads if current item that is about to be displayed is also in the cart, then return true else false
										if(finished_filtered_cart_array.includes(item_Backid) === false)
										{
											//Sets all the item data to its corresponding fields
											item_size = obj['item_size'];
											item_Frontid = obj['item_Frontid'];
											item_modeltype = obj['item_modeltype'];
											
											//Sees if the item_size from the item data is null or blank, if is then it sets the item_size field to "No Size"
											if(item_size == null || item_size == "")
											{
												item_size = "No Size";
											}
											
											//Sees if the item_modeltype from the item data is null, if is then it sets the item_modeltype field to " "
											if(item_modeltype == null)
											{
												item_modeltype = " ";
											}
											
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td id='hide_me'>" + "<input type='radio' id ='item_id' name='item_id[]' value = '" + $('#pack').val() + "-" + item_Backid + "'/>" +"</td>" + 
															"<td>" + item_Frontid + "</td>"  + 
															"<td>" + item_size + "</td>" +
															"<td>" + item_modeltype + "</td>" + 
															"<td>" + inv_name + "</td>";
															
											//Add the tr tag to the tbody of the item selection list
											item_display.appendChild(tr);
										}
									}
								}
							}
							//If the customer is a student
							else
							{
								item_Backid = obj['item_Backid'];
								if(conflict_list.includes(item_Backid) === false)
								{
									//
									//The next following lines checks if the item that is going diplayed is already in the cart
									//
									
									//Does the check here. The if statement reads if current item that is about to be displayed is also in the cart, then return true else false
									if(finished_filtered_cart_array.includes(item_Backid) === false)
									{
										//Sets all the item data to its corresponding fields
										item_size = obj['item_size'];
										item_Frontid = obj['item_Frontid'];
										item_modeltype = obj['item_modeltype'];
										inv_name = obj['inv_name'];
										
										//Sees if the item_size from the item data is null or blank, if is then it sets the item_size field to "No Size"
										if(item_size == null || item_size == "")
										{
											item_size = "No Size";
										}
										
										//Sees if the item_modeltype from the item data is null, if is then it sets the item_modeltype field to " "
										if(item_modeltype == null)
										{
											item_modeltype = " ";
										}
										
										//Create a tr tag
										var tr = document.createElement('tr');
										
										//Populate the tr tag
										tr.innerHTML = "<td id='hide_me'>" + "<input type='radio' id ='item_id' name='item_id[]' value = '" + $('#pack').val() + "-" + item_Backid + "'/>" +"</td>" + 
														"<td>" + item_Frontid + "</td>"  + 
														"<td>" + item_size + "</td>" +
														"<td>" + item_modeltype + "</td>" + 
														"<td>" + inv_name + "</td>";
														
										//Add the tr tag to the tbody of the item selection list
										item_display.appendChild(tr);
									}
								}
							}
						}
						
						//this resets the search functioallity after the table is refilled
						$('input#searchItem').quicksearch('#item_selection tbody tr'); //On key search for customer names here
					}
				});
			});
		});
	</script>
	
	<!-- The AJAX script that list the items needed for a package. Just in case the user does not know all item involve with a package -->
	<script type="text/javascript">
		$(function() 
		{
			$('.pack').change(function() //Starts the script when the user select a package from the package selection field
			{
				if($("#pack").val() != 0)
				{
					$.ajax(
					{
						url: "../RentalSection/Pack_List_Helper.php", //The file where the php select query is at
						type: "post",
						data: 
						{
							'pack_id': $(this).val() //assigning the value of the selected package to "pack_value"
						},
						success: function(data) //When the AJAX call is successful, the script does the following
						{
							var json_object = JSON.parse(data); //Grabs the data that is in JSON format and parse it so it is usable
							
							document.getElementById('pack_infor').innerHTML = "***Items in the Package*** </br>";
							//Here the script starts processing all the item data it got from the AJAX call by looping through it in a FOR loop
							for(var i = 0; i < json_object.length; i++)
							{
								var obj = json_object[i]; //First it grabs the current item in the data
							
								inv_name = obj['inv_name'];
								amount = obj['count(inv_name)'];
								
								curr = document.getElementById('pack_infor').innerHTML;
								
								//Then set the first string to the div tab "item_info_label" which will be displayed for the user to see
								document.getElementById('pack_infor').innerHTML = curr + amount + " " + inv_name + "</br>";
							}
						}
					});
				}
				else{
					document.getElementById('pack_infor').innerHTML = " ";
				}
			});
		});
	</script>
	
</html>


<?php
		$conn = null;   //also remember to close the connection to the database
	}
?>