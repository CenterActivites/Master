<?php
	//First page on the CustomerSelection section. This would be the section main page, the page where most of the back and cancel button in the section
	//	will go to
	function HomePage()
	{
		//Connecting to the Database
        $conn = db();
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../CustomerselectionSection/cust_css/cust_selection.css"/>

</head>
<body>
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
		<div id="pageHeader" style="font-size: 35px; text-align: center;"> Home Page </div>
		</br>
		</br>
<div>
<?php
		
 ?>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id='button' >
			<div id='table_div'>
				<fieldset style="border: none;">
					<fieldset id='fieldset_label' style="background-color: #D3D3D3;">
						<label id='header_for_table' style="padding-left: 5%; font-size: 20px"> Late Rentals </label>
					</fieldset>
						<div id="late_table_div">
							<!-- First table creation. The Late rental table, used for seeing which customer has rentals that are overdue -->
							<table id='cust_table_info_late'>
								<thead>
									<tr>
										<th id='hide_me'></th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Phone Number</th>
										<th>Items Was Due By</th>
									</tr>
								</thead>
								<tbody id='late_empty'>
<?php							
									//Grabs the current date to correspond to the database
									$current_date = date("Y-m-d");
									
									//"Due rental" query
									$late_rentals = $conn->prepare("SELECT b.cust_id, f_name, l_name, c_phone,c_email, due_date, rent_id
																		FROM Customer a, Rental b
																		WHERE a.cust_id = b.cust_id and 
																				b.pick_up_date IS NOT NULL and 
																				b.return_date IS NULL and 
																				b.due_date < :a and 
																				b.rental_status = 'On-Going' and 
																				b.loc_id = 1
																		GROUP BY cust_id
																		ORDER BY due_date");
									$late_rentals->bindValue(':a', $current_date, PDO::PARAM_STR);
									$late_rentals->execute();
									$late_rentals = $late_rentals->fetchAll();
								
									if(!empty($late_rentals))
									{
										foreach($late_rentals as $row)
										{
											$curr_f_name = $row["f_name"]; //each row is a object that has a f_name, l_name, cust_id, c_email, and a due_date
											$curr_l_name = $row["l_name"];
											$curr_cust_id = $row["cust_id"];
											$curr_c_email = $row["c_email"];
											$curr_c_phone = $row["c_phone"];
											$curr_due_date = $row["due_date"];
											
											//The following two lines is for formatting reasons. Basically to make the date we get from the database more readable for users
											$curr_due_date = date("D, j M Y", strtotime($curr_due_date));
?>
											<tr>
												<td id = "hide_me"><input type="radio" name="radio[]" value = "<?= $curr_cust_id ?>"/></td>
												<td><?= $curr_f_name ?></td>
												<td><?= $curr_l_name ?></td>
												<td><?= $curr_c_email ?></td>
												<td><?= $curr_c_phone ?></td>
												<td><?= $curr_due_date ?></td>
											</tr>
<?php
										}
									}
									else
									{
?>
										<tr> <td colspan="5"> No Late Rentals </td> </tr>
<?php
									}
?>
								</tbody>
							</table>
						</div>
				</fieldset>

				</br>
			
				<fieldset style="border: none;">
					<fieldset id='fieldset_label' style="background-color: #D3D3D3;">
						<label id='header_for_table' style="padding-left: 5%; font-size: 20px"> Pick Ups </label>
					</fieldset>
						<div id="reserved_table_div">
							<!-- Second table creation. The Pick-Up table for user to see which customer's reserve rental is coming up to be picked up -->
							<table id='cust_table_info_pick'>
								<thead>
									<tr>
										<th id='hide_me'></th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Phone Number</th>
										<th>Pick-Up Date</th>
									</tr>
								</thead>
								<tbody id='reserved_empty'>
<?php
									//"Customer who are picking up their rental soon" query
									$pick_up_rentals = $conn->prepare("SELECT f_name, l_name, c_phone,c_email, request_date, rent_id
																	FROM Customer a, Rental b
																	WHERE a.cust_id = b.cust_id and 
																			b.pick_up_date IS NULL and 
																			b.rental_status = 'On-Going' and 
																			b.loc_id = 1
																	ORDER BY request_date, l_name, f_name");
									$pick_up_rentals->execute();
									$pick_up_rentals = $pick_up_rentals->fetchAll();
									
									$trips = $conn->prepare("SELECT note, c.rent_id, request_date
																FROM Notes a, NotesRental b, Rental c
																WHERE a.note_id = b.note_id and 
																		b.rent_id = c.rent_id and 
																		c.pick_up_date IS NULL and 
																		c.rental_status = 'Trip' and 
																		c.loc_id = 1
																ORDER BY request_date");
									$trips->execute();
									$trips = $trips->fetchAll();
									
									if(empty($trips) && empty($pick_up_rentals))
									{
?>
										<tr> <td colspan="5"> No Pick-ups </td> </tr>
<?php
									}
									elseif(empty($trips) && !empty($pick_up_rentals))
									{
										foreach($pick_up_rentals as $row)
										{
											$curr_f_name = $row["f_name"]; //each row is a object that has a f_name, l_name, cust_id, c_email, and request_date
											$curr_l_name = $row["l_name"];
											$curr_rent_id = $row["rent_id"];
											$curr_c_email = $row["c_email"];
											$curr_c_phone = $row["c_phone"];
											$curr_request_date = $row["request_date"];
											
											//Again same for the Due rental table, the next two lines is for allowing users to read the dates parts more easy
											$curr_request_date = date("D, j M Y", strtotime($curr_request_date));
?>
											<tr>
												<td id = "hide_me"><input type="radio" name="radio[]" value = "<?= $curr_rent_id ?>"/></td>
												<td><?= $curr_f_name ?></td>
												<td><?= $curr_l_name ?></td>
												<td><?= $curr_c_email ?></td>
												<td><?= $curr_c_phone ?></td>
												<td><?= $curr_request_date ?></td>
											</tr>
<?php
										}
									}
									elseif(empty($pick_up_rentals) && !empty($trips))
									{
										foreach($trips as $row)
										{
											$curr_rent_id = $row["rent_id"];
											$curr_trip = $row["note"];
											$curr_request_date = $row["request_date"];
											
											//Again same for the Due rental table, the next two lines is for allowing users to read the dates parts more easy
											$curr_request_date = date("D, j M Y", strtotime($curr_request_date));
?>
											<tr>
												<td id = "hide_me"><input type="radio" name="radio[]" value = "<?= $curr_rent_id ?>"/></td>
												<td colspan="4"><?= $curr_trip ?></td>
												<td><?= $curr_request_date ?></td>
											</tr>
<?php
										}
									}
									else
									{
										$trip_count = 0;
										$rental_count = 0;
										$at_end_for_trip = false;
										$at_end_for_rental = false;
										
										while($trip_count < sizeof($trips) || $rental_count < sizeof($pick_up_rentals))
										{
											if(($trips[$trip_count]['request_date'] < $pick_up_rentals[$rental_count]['request_date'] && $at_end_for_trip == false) || ($at_end_for_rental == true && $at_end_for_trip == false))
											{
												$curr_rent_id = $trips[$trip_count]["rent_id"];
												$curr_trip = $trips[$trip_count]["note"];
												$curr_request_date = $trips[$trip_count]["request_date"];
												
												//Again same for the Due rental table, the next two lines is for allowing users to read the dates parts more easy
												$curr_request_date = date("D, j M Y", strtotime($curr_request_date));
?>
												<tr>
													<td id = "hide_me"><input type="radio" name="radio[]" value = "<?= $curr_rent_id ?>"/></td>
													<td colspan="4"><?= $curr_trip ?></td>
													<td><?= $curr_request_date ?></td>
												</tr>
<?php
												if($trip_count >= (sizeof($trips)) - 1)
												{
													$at_end_for_trip = true;
												}
												else
												{
													$trip_count++;
												}
											}
											elseif(($trips[$trip_count]['request_date'] >= $pick_up_rentals[$rental_count]['request_date'] && $at_end_for_rental == false) || ($at_end_for_trip == true && $at_end_for_rental == false))
											{
												$curr_f_name = $pick_up_rentals[$rental_count]["f_name"]; //each row is a object that has a f_name, l_name, cust_id, c_email, and request_date
												$curr_l_name = $pick_up_rentals[$rental_count]["l_name"];
												$curr_rent_id = $pick_up_rentals[$rental_count]["rent_id"];
												$curr_c_email = $pick_up_rentals[$rental_count]["c_email"];
												$curr_c_phone = $pick_up_rentals[$rental_count]["c_phone"];
												$curr_request_date = $pick_up_rentals[$rental_count]["request_date"];
												
												//Again same for the Due rental table, the next two lines is for allowing users to read the dates parts more easy
												$curr_request_date = date("D, j M Y", strtotime($curr_request_date));
?>
												<tr>
													<td id = "hide_me"><input type="radio" name="radio[]" value = "<?= $curr_rent_id ?>"/></td>
													<td><?= $curr_f_name ?></td>
													<td><?= $curr_l_name ?></td>
													<td><?= $curr_c_email ?></td>
													<td><?= $curr_c_phone ?></td>
													<td><?= $curr_request_date ?></td>
												</tr>
<?php
												if($rental_count >= (sizeof($pick_up_rentals)) - 1)
												{
													$at_end_for_rental = true;
												}
												else
												{
													$rental_count++;
												}
											}
											else
											{
												break;
											}
										}
									}
?>
								</tbody>
							</table>
						</div>
					
					</br>
					</br>
					</br>
						
					<input type="submit" name="select" id="select" value="Select"/><br />
				</fieldset>
			</div>
			
			<!-- Hidden input value for seeing which of the two tables the selected row is from  -->
			<input type="hidden" id="which_table" name="which_table" />
			<input type="hidden" id="cust_id" name="cust_id" value="" />
			<input type="hidden" id="rent_id" name="rent_id" value="" />
		</form>
</div>
</body>

	<!-- JavaScript Starts here -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
	<script type="text/javascript" src="jquery.quicksearch.js"></script>  <!-- Plugin for the item Search function -->
	
	<!-- Little script that checks if a customer have been selected for the next page -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#select").click(function(){
				if($('#cust_id').val() == "" && $('#rent_id').val() == "")
				{
					alert("please select a customer");
					return false;
				}
			});
		});
	</script>
	
	<!-- Function for saving the selected customer's id to the hidden input "cust_id" -->
	<script type="text/javascript">
	$(document).ready(function(){
		$("#table_div").on('click', 'table tr', function()
		{
			$(this).find('td input:radio').prop('checked',true);
			
			$('input[type="radio"]:checked').each(function()
			{
				var box_value = $(this).val();
				$('#cust_id').val(box_value);
				$('#rent_id').val(box_value);
				console.log("Selected id: " + $('#cust_id').val() + " " + $('#rent_id').val());
			});
		
			$("#cust_table_info_late tr").removeClass("highlight");
			$("#cust_table_info_pick tr").removeClass("highlight");
			$(this).addClass("highlight");
		});
	});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			//The next following lines sets the hidden input "which_table" to values of either "Late" or "Pick". 
			//This allows the program to know which table was the row selected from so that program will know where to sent the user next to
			$("#late_table_div").on('click', 'table tr', function()
			{
				$('#which_table').val("Late");
				console.log("Late table was selected");
			});	
			
			
			$("#reserved_table_div").on('click', 'table tr', function()
			{
				$('#which_table').val("Pick");
				console.log("Pick-up table was selected");
			});	
		});
	</script>
	
	<!--  -->
	<script type="text/javascript">
		$(function() 
		{
			$('#location').change(function() //Starts the script when the user select a package from the package selection field
			{
				$('#cust_id').val("");
				$('#rent_id').val("");
				$.ajax(
				{
					url: "../ItemTranSection/Location_HomePage_helper.php", //The file where the php select query is at
					type: "post",
					data: 
					{
						'loc_id': $(this).val() //assigning the value of the selected package to "pack_value"
					},
					success: function(data) //When the AJAX call is successful, the script does the following
					{
						console.log("Data: " + data);
						var json_object = JSON.parse(data); //Grabs the data that is in JSON format and parse it so it is usable
						
						var late_array = json_object['late'];
						var reserve_array = json_object['reserve'];
						var trips_array = json_object['trip'];
						
						$('#late_empty').empty();
						$('#reserved_empty').empty();
						
						var late_empty = document.getElementById('late_empty');
						var reserved_empty = document.getElementById('reserved_empty');
						
						if(late_array.length != 0)
						{
							for(var i = 0; i < late_array.length; i++)
							{
								var obj = late_array[i]; //First it grabs the current item in the data
							
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
								
								due_date = d_names[curr_day] + ", " + curr_date + " " +  m_names[curr_month] + " " + curr_year;
								
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
							tr.innerHTML = "<td colspan='5'> No Late Rentals </td>";
								
							//Add the tr tag to the tbody of the item selection list
							late_empty.appendChild(tr);
						}
						
						if(reserve_array.length == 0 && trips_array.length == 0)
						{
							//Create a tr tag
							var tr = document.createElement('tr');
							tr.innerHTML = "<td colspan='5'> No Pick-ups </td>";
								
							//Add the tr tag to the tbody of the item selection list
							reserved_empty.appendChild(tr);
						}
						else if(reserve_array.length != 0 && trips_array.length == 0)
						{
							console.log('There is rentals but no trips');
							for(var i = 0; i < reserve_array.length; i++)
							{
								var obj = reserve_array[i]; //First it grabs the current item in the data
							
								//Sets all the item data to its corresponding fields
								rent_id = obj['rent_id'];
								f_name = obj['f_name'];
								l_name = obj['l_name'];
								c_phone = obj['c_phone'];
								c_email = obj['c_email'];
								request_date = obj['request_date'];
								
								var d_names = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

								var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
								
								var d = new Date(request_date.replace(/-/g, '\/'));
								var curr_day = d.getDay();
								var curr_month = d.getMonth();
								var curr_date = d.getDate();
								var curr_month = d.getMonth();
								var curr_year = d.getFullYear();
								
								request_date = d_names[curr_day] + ", " + curr_date + " " +  m_names[curr_month] + " " + curr_year;
								
								//Create a tr tag
								var tr = document.createElement('tr');
								
								//Populate the tr tag
								tr.innerHTML = "<td id='hide_me'><input id ='radio_in' type='radio'  name='item_id[]' value=" + rent_id + "></input></td>" + 
												"<td>" + f_name + "</td>" + 
												"<td>" + l_name + "</td>" + 
												"<td>" + c_email + "</td>" + 
												"<td>" + c_phone + "</td>"  + 
												"<td>" + request_date + "</td>" ;
								
								//Add the tr tag to the tbody of the item selection list
								reserved_empty.appendChild(tr);
							}
						}
						else if(reserve_array.length == 0 && trips_array.length != 0)
						{
							console.log('There is trips but no rentals');
							for(var i = 0; i < trips_array.length; i++)
							{
								var obj = trips_array[i]; //First it grabs the current item in the data
							
								//Sets all the item data to its corresponding fields
								rent_id = obj['rent_id'];
								note = obj['note'];
								request_date = obj['request_date'];
								
								var d_names = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

								var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
								
								var d = new Date(request_date.replace(/-/g, '\/'));
								var curr_day = d.getDay();
								var curr_month = d.getMonth();
								var curr_date = d.getDate();
								var curr_month = d.getMonth();
								var curr_year = d.getFullYear();
								
								request_date = d_names[curr_day] + ", " + curr_date + " " +  m_names[curr_month] + " " + curr_year;
								
								//Create a tr tag
								var tr = document.createElement('tr');
								
								//Populate the tr tag
								tr.innerHTML = "<td id='hide_me'><input id ='radio_in' type='radio'  name='item_id[]' value=" + rent_id + "></input></td>" + 
												"<td colspan='4'>" + note + "</td>" + 
												"<td>" + request_date + "</td>" ;
								
								//Add the tr tag to the tbody of the item selection list
								reserved_empty.appendChild(tr);
							}
						}
						else
						{
							var trip_count = 0;
							var rental_count = 0;
							var at_end_for_trip = false;
							var at_end_for_rental = false;
							
							while(trip_count < trips_array.length  || rental_count < reserve_array.length)
							{
								if((trips_array[trip_count]['request_date'] < reserve_array[rental_count]['request_date'] && at_end_for_trip == false) || (at_end_for_rental == true && at_end_for_trip == false))
								{
									rent_id = trips_array[trip_count]["rent_id"];
									note = trips_array[trip_count]["note"];
									request_date = trips_array[trip_count]["request_date"];
									
									var d_names = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

									var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
									
									var d = new Date(request_date.replace(/-/g, '\/'));
									var curr_day = d.getDay();
									var curr_month = d.getMonth();
									var curr_date = d.getDate();
									var curr_month = d.getMonth();
									var curr_year = d.getFullYear();
									
									request_date = d_names[curr_day] + ", " + curr_date + " " +  m_names[curr_month] + " " + curr_year;						
									
									var tr = document.createElement('tr');
									
									tr.innerHTML = "<td id='hide_me'><input id ='radio_in' type='radio'  name='item_id[]' value=" + rent_id + "></input></td>" + 
												"<td colspan='4'>" + note + "</td>" + 
												"<td>" + request_date + "</td>" ;
												
									//Add the tr tag to the tbody of the item selection list
									reserved_empty.appendChild(tr);
									
									if(trip_count >= (trips_array.length - 1))
									{
										at_end_for_trip = true;
									}
									else
									{
										trip_count++;
									}
								}
								else if((trips_array[trip_count]['request_date'] > reserve_array[rental_count]['request_date'] && at_end_for_rental == false) || (at_end_for_trip == true && at_end_for_rental == false))
								{
									rent_id = reserve_array[rental_count]['rent_id'];
									f_name = reserve_array[rental_count]['f_name'];
									l_name = reserve_array[rental_count]['l_name'];
									c_phone = reserve_array[rental_count]['c_phone'];
									c_email = reserve_array[rental_count]['c_email'];
									request_date = reserve_array[rental_count]['request_date'];
									
									var d_names = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

									var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
									
									var d = new Date(request_date.replace(/-/g, '\/'));
									var curr_day = d.getDay();
									var curr_month = d.getMonth();
									var curr_date = d.getDate();
									var curr_month = d.getMonth();
									var curr_year = d.getFullYear();
									
									request_date = d_names[curr_day] + ", " + curr_date + " " +  m_names[curr_month] + " " + curr_year;
									
									//Create a tr tag
									var tr = document.createElement('tr');
									
									//Populate the tr tag
									tr.innerHTML = "<td id='hide_me'><input id ='radio_in' type='radio'  name='item_id[]' value=" + rent_id + "></input></td>" + 
													"<td>" + f_name + "</td>" + 
													"<td>" + l_name + "</td>" + 
													"<td>" + c_email + "</td>" + 
													"<td>" + c_phone + "</td>"  + 
													"<td>" + request_date + "</td>" ;
									
									//Add the tr tag to the tbody of the item selection list
									reserved_empty.appendChild(tr);
									
									if(rental_count >= (reserve_array.length - 1))
									{
										at_end_for_rental = true;
									}
									else
									{
										rental_count++;
									}
								}
								else
								{
									break;
								}
							}
							console.log("Number of trips counted (" + trips_array.length + "): " + trip_count);
							console.log("Number of rentals counted(" + reserve_array.length + "): " + rental_count);
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
