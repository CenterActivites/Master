<?php
	//Item Selection Page. Where users are going to select the items the customers want to rent out 
	function Report()
	{
		
		//Connecting to the Database
		$conn = hsu_conn_sess();
?>
		<html>
			<head>
				<link rel="stylesheet" type="text/css" href="../ReportSection/Report_css.css"/>
				<link rel="stylesheet" type="text/css" href="../ReportSection/select_style.css"/>
				
			</head>
			<body>

				<fieldset id='fieldset_label' style="border:none; text-align: center;">
					<label id='header_for_table' style="font-size: 25px"> Report </label>
				</fieldset>
				<div> 
				
					<table id="search_table">
						<!-- Searchable functionals for a more narrower search in a table for styling purposes -->
						<tr>
							<th>Status</th>
							<th>Category</th>
							<th>Location</th>
							<th>Public</th>
							<th>DBW</th> 
						</tr>
						<tr>
							<!-- A status select where users can select a certain status of the items they just want to see -->
							<td>
								<div class="select_status">
									<select id='status' name='status'>
										<option value=0 selected="selected"> None </option>
<?php
										//Query for status name
										foreach($conn->query("SELECT * FROM Status") as $row)
										{
											$curr_stat_name = $row['stat_name'];
											$curr_stat_id = $row['stat_id'];
?>
											<option value="<?= $curr_stat_id ?>">		<!-- Pushing the fetch information to the screen -->
												<?= $curr_stat_name ?>
											</option>
<?php
										}
?>
									</select>
								</div>
							</td>
							
							<!-- Category sort option -->
							<td>
								<div class="select_cat">
									<select id='cat'  name='cat'>
										<option value=0 selected="selected"> All </option>
<?php
										//Query for status name
										foreach($conn->query("SELECT * FROM Category") as $row)
										{
											$curr_cat_name = $row['cat_name'];
											$curr_cat_id = $row['cat_id'];
?>
											<option value="<?= $curr_cat_id ?>">
												<?= $curr_cat_name ?>
											</option>
<?php
										}
?>
									</select>
								</div>
							</td>
							
							<!-- A simple location search select where user can see items according to one location to another, or all locations -->
							<td>
								<div class="select">
									<select id="location" name="location">
										<option value="none" selected="selected">
											Both
										</option>
										<option value="ca">
											Center Activites
										</option>
										<option value="hbac">
											Humboldt Bay Aquatic Center
										</option>
									</select>
								</div>
							</td>

							<!-- A public search where users can see either only items rentable to the public, non-public-rentable items, or both public-rentable and non-public-rentable items -->
							<td>
								<div class="select">
									<select id="public" name="public">
										<option value="none" selected="selected">
											Include both
										</option>
										<option value="yes">
											Is Public
										</option>
										<option value="no">
											Not Public
										</option>
									</select>
								</div>
							</td>
							
							<!-- A DBW search where users can see either only DBW items, non-DBW items, or both DBW and non-DBW items -->
							<td>
								<div class="select">
									<select id="dbw" name="dbw"> 
										<option value="none" selected="selected">
											Include both
										</option>
										<option value="yes">
											Is DBW
										</option>
										<option value="no">
											Non DBW
										</option>
									</select>
								</div>
							</td>
						</tr>
						
						<tr id="dates" name="dates">
						
							<td></td>
						
							<td>
								<label for="from_date" style="font-weight: bold;"> From: </label>
								<input type="date" name="from_date" id="from_date"/>
							</td>
						
							<td></td>
							
							<td>
								<label for="to_date" style="font-weight: bold;"> To: </label>
								<input type="date" name="to_date" id="to_date"/>
							</td>
						
							<td></td>
						
						</tr>
					</table>
				
					<table id="report_option_selection" name="report_option_selection">
					
						<tbody>
							<tr>
								<th>Overdue Equipment:</th>
								<td>
									<input type="button" name="overdue_equ_button" id="overdue_equ_button"/>
									<input type="hidden" name="overdue_equ" id="overdue_equ" value="over_due" />
								</td>
							</tr>
							
							<tr>
								<th>All Equipment Information:</th>
								<td>
									<input type="button" name="all_equ_button" id="all_equ_button"/>
									<input type="hidden" name="all_equ" id="all_equ" value="all_equ" />
								</td>
							</tr>
							
							<tr>
								<th>Upcoming Reservations:</th>
								<td>
									<input type="button" name="upcoming_re_button" id="upcoming_re_button"/>
									<input type="hidden" name="upcoming_re" id="upcoming_re" value="upcoming" />
								</td>
							</tr>
							
							<tr>
								<th>Equipment Count:</th>
								<td>
									<input type="button" name="equ_count_button" id="equ_count_button"/>
									<input type="hidden" name="equ_count" id="equ_count" value="equ_count" />
								</td>
							</tr>
							
							<tr>
								<th>Revenue:</th>
								<td>
									<input type="button" name="revenue_button" id="revenue_button"/>
									<input type="hidden" name="revenue" id="revenue" value="revenue" />
								</td>
							</tr>
							
							<tr>
								<th>Employee Information:</th>
								<td>
									<input type="button" name="empl_infor_button" id="empl_infor_button"/>
									<input type="hidden" name="empl_infor" id="empl_infor" value="empl_infor" />
								</td>
							</tr>
							
							<!--  MIGHT DELETE THIS OPTION
							<tr>
								<th>Items with Purchase Date and Purchase Price:</th>
								<td>
									<input type="button" name="purchase_date_price_button" id="purchase_date_price_button"/>
									<input type="hidden" name="purchase_date_price" id="purchase_date_price" value="equ_pur" />
								</td>
							</tr>
							-->
							
							<tr>
								<th>Number Rentals:</th>
								<td>
									<input type="button" name="num_rentals_button" id="num_rentals_button"/>
									<input type="hidden" name="num_rentals" id="num_rentals" value="num_rent" />
								</td>
							</tr>
							
							<!--  **TODO** Create a way users can create custom reports
							<tr>
								<th>Custom Report:</th>
								<td>
									<input type="button" name="custom_report" id="custom_report" value="" />
								</td>
							</tr>
							-->
						</tbody>
					</table>
						
					<table id="create_print" name="create_print">
						<tr>
							<td>
								<input type="button" name="create_report" id="create_report" value="Create Report"/>
							</td>
						</tr>
						
						<tr>
							<td>
								<input type="button" name="print" id="print" value="Print Report" onclick="printfunction()"/>
							</td>
						</tr>
						
						<tr>
							<td>
								<form method= "post" action="../ReportSection/Report_ExcelPrint.php">
									<input type="hidden" id="status_hidden" name="status_hidden" value="0"/>
									<input type="hidden" id="dbw_hidden" name="dbw_hidden" value=""/>
									<input type="hidden" id="public_hidden" name="public_hidden" value=""/>
									<input type="hidden" id="location_hidden" name="location_hidden" value=""/>
									<input type="hidden" id="cat_hidden" name="cat_hidden" value="0"/>
									<input type="hidden" name="chosen_report" id="chosen_report" value=""/>
									<input type="hidden" name="report_label" id="report_label" value=""/>
									<input type="submit" id="excel_download" id="excel_download" value="Export Report to Excel" />
								</form>
							</td>
						</tr>
						
					</table>
					
					<table id="report_view_table" name="report_view_table">
						<thead id="report_view_table_header" name="report_view_table_header">
					
						</thead>
						<tbody id="report_view_table_body" name="report_view_table_body">
							<tr>
								<td>
									Please select a report on side to view
								</td>
							</tr>
						</tbody>
					</table>
					
					
					<div class="container" id="section_to_print">
						
						<fieldset id='fieldset_label' style="font-size: 20px; visibility: hidden;">
							<label id='print_header' style="font-size: 25px"> Report </label>
						</fieldset>
						
						<table id="print_report_view_table" name="print_report_view_table">
							<thead id="print_report_view_table_header" name="print_report_view_table_header">
							
							</thead>
							<tbody id="print_report_view_table_body" name="print_report_view_table_body">
								
							</tbody>
						</table>
					</div>
				</div>
				
			</body>
			
			
			<!-- The General All Equipment Report AJAX -->
			<script type="text/javascript">
				$(function() 
				{
					$('#all_equ_button').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						$('#chosen_report').val($('#all_equ').val());
						$('#report_label').val("All Equipment Report");
						$("#dates").css("display", "");
						$('#from_date').val("");
						$('#to_date').val("");
						
					});
					
					$('#overdue_equ_button').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						$('#chosen_report').val($('#overdue_equ').val());
						$('#report_label').val("OverDue Equipment Report");
						$("#dates").css("display", "none");
						$('#from_date').val("");
						$('#to_date').val("");
					});
					
					$('#upcoming_re_button').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						$('#chosen_report').val($('#upcoming_re').val());
						$('#report_label').val("Upcoming Reservations Report");
						$("#dates").css("display", "none");
						$('#from_date').val("");
						$('#to_date').val("");
					});
					
					$('#empl_infor_button').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						$('#chosen_report').val($('#empl_infor').val());
						$('#report_label').val("Empolyee's Information Report");
						$("#dates").css("display", "none");
						$('#from_date').val("");
						$('#to_date').val("");
					});
					
					$('#equ_count_button').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						$('#chosen_report').val($('#equ_count').val());
						$('#report_label').val("Equipment Count Report");
						$("#dates").css("display", "none");
						$('#from_date').val("");
						$('#to_date').val("");
					});
					
					$('#num_rentals_button').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						$('#chosen_report').val($('#num_rentals').val());
						$('#report_label').val("Rental Amounts Report");
						$("#dates").css("display", "");
						$('#from_date').val("");
						$('#to_date').val("");
					});
					
					/* **MIGHT DELETE THIS
					$('#purchase_date_price_button').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						//$('#chosen_report').val($('#purchase_date_price').val());
						$('#report_label').val("Purchase Dates and Prices Report");
						$("#dates").css("display", "");
					});
					*/
					
					$('#revenue_button').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						$('#chosen_report').val($('#revenue').val());
						$('#report_label').val("Revenue Report");
						$("#dates").css("display", "");
						$('#from_date').val("");
						$('#to_date').val("");
					});
					
					$('#public').change(function()
					{
						var box_value = $(this).val();
						$('#public_hidden').val(box_value);
						console.log("Public Hidden value changed to :" + box_value);
					});
					
					$('#dbw').change(function()
					{
						var box_value = $(this).val();
						$('#dbw_hidden').val(box_value);
						console.log("DBW Hidden value changed to :" + box_value);
					});

					$('#status').change(function()
					{
						var box_value = $(this).val();
						$('#status_hidden').val(box_value);
						console.log("Status Hidden value changed to :" + box_value);
					});
					
					$('#cat').change(function()
					{
						var box_value = $(this).val();
						$('#cat_hidden').val(box_value);
						console.log("Category Hidden value changed to :" + box_value);
					});
					
					$('#location').change(function()
					{
						var box_value = $(this).val();
						$('#location_hidden').val(box_value);
						console.log("Location Hidden value changed to :" + box_value);
					});
					
					$('#excel_download').click(function()
					{
						if(document.getElementById('chosen_report').value.length == 0){
							alert("Please select a report to export to excel");
							return false;
						}
					});
				});
			</script>
			
			
			<!-- The General All Equipment Report AJAX -->
			<script type="text/javascript">
				$(function() 
				{
					$('#create_report').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						if(document.getElementById('chosen_report').value.length == 0)
						{
							alert("Please select a report to create");
							return false;
						}
						else
						{
							$('#header_for_table').text($('#report_label').val());
							$('#print_header').text($('#report_label').val());
							
							//Start of the AJAX call
							$.ajax(
							{
								url: "../ReportSection/Report_Helper.php", //The file where the php select query is at
								type: "post",
								data: 
								{
									'chosen_report': $('#chosen_report').val(),
									'status': $('#status').val(),
									'cat': $('#cat').val(),
									'location': $('#location').val(),
									'public': $('#public').val(),
									'dbw': $('#dbw').val(),
									'from_date': $('#from_date').val(),
									'to_date': $('#to_date').val()
								},
								success: function(data) //When the AJAX call is successful, the script does the following
								{
									console.log("Report AJAX Call Successful"); //Tells the console log that the AJAX call was good
									
									console.log("After Parsing the data: " + data);
									
									var json_object = JSON.parse(data); //Grabs the data that is in JSON format and parse it so it is usable
									
									console.log("After Parsing the data: " + data);
									
									//Preparing the report view table for a the new selected report
									$('#report_view_table_body').empty();
									$('#report_view_table_header').empty();
									$('#print_report_view_table_body').empty();
									$('#print_report_view_table_header').empty();
									
									// Grabs the report_view_table_body view for the report
									var report_view_table_body = document.getElementById('report_view_table_body');
									var report_view_table_header = document.getElementById('report_view_table_header');
									var print_report_view_table_body = document.getElementById('print_report_view_table_body');
									var print_report_view_table_header = document.getElementById('print_report_view_table_header');
								
									if($('#chosen_report').val() == "all_equ")
									{
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
										
										//Populate the tr tag
										tr.innerHTML = "<th> Item's ID </th>" + 
														"<th> Item Model/Brand </th>" + 
														"<th> Item Name </th>" + 
														"<th> Item Size </th>" + 
														"<th> Category </th>" + 
														"<th> Public Access </th>"  + 
														"<th> Current Status </th>" + 
														"<th> Purchase Price </th>"  + 
														"<th> Purchase Date </th>";
								
										//Add the tr tag to the tbody of the item selection list
										print_report_view_table_header.appendChild(tr);
										
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Item's ID </th>" + 
														"<th> Item Model/Brand </th>" + 
														"<th> Item Name </th>" + 
														"<th> Item Size </th>" + 
														"<th> Category </th>" + 
														"<th> Public Access </th>"  + 
														"<th> Current Status </th>" + 
														"<th> Purchase Price </th>"  + 
														"<th> Purchase Date </th>";
														
										report_view_table_header.appendChild(tr);
										
										//Here the script starts processing all the item data it got from the AJAX call by looping through it in a FOR loop
										for(var i = 0; i < json_object.length; i++)
										{
											var obj = json_object[i]; //First it grabs the current item in the data
											
											//Sets all the item data to its corresponding fields
											item_size = obj['item_size'];
											item_modeltype = obj['item_modeltype'];
											inv_name = obj['inv_name'];
											cat_name = obj['cat_name'];
											item_Frontid = obj['item_Frontid'];
											public_access = obj['public'];
											status = obj['stat_name'];
											pur_price = obj['pur_price'];
											pur_date = obj['pur_date'];
											
											if(item_size == null)
											{
												item_size = "";
											}
											
											if(item_modeltype == null)
											{
												item_modeltype = "";
											}
											
											if(public_access == "1")
											{
												public_access = "Yes";
											}
											else
											{
												public_access = "No";
											}
											
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + item_Frontid + "</td>" + 
															"<td>" + item_modeltype + "</td>" + 
															"<td>" + inv_name + "</td>" + 
															"<td>" + item_size + "</td>"  + 
															"<td>" + cat_name + "</td>" + 
															"<td>" + public_access + "</td>" + 
															"<td>" + status + "</td>" + 
															"<td>" + pur_price + "</td>" + 
															"<td>" + pur_date + "</td>";
								
											//Add the tr tag to the tbody of the item selection list
											print_report_view_table_body.appendChild(tr);
											
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + item_Frontid + "</td>" + 
															"<td>" + item_modeltype + "</td>" + 
															"<td>" + inv_name + "</td>" + 
															"<td>" + item_size + "</td>"  + 
															"<td>" + cat_name + "</td>"  + 
															"<td>" + public_access + "</td>" + 
															"<td>" + status + "</td>"  + 
															"<td>" + pur_price + "</td>" + 
															"<td>" + pur_date + "</td>";
											
											report_view_table_body.appendChild(tr);
										}
									}
									else if($('#chosen_report').val() == "empl_infor")
									{
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Employee's Name </th>" + 
														"<th> Phone Number </th>" + 
														"<th> Email </th>"  + 
														"<th> Location Employ </th>" + 
														"<th> Title </th>"  + 
														"<th> Access Level </th>";
								
										//Add the tr tag to the tbody of the item selection list
										print_report_view_table_header.appendChild(tr);
										
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Employee's Name </th>" + 
														"<th> Phone Number </th>" + 
														"<th> Email </th>"  + 
														"<th> Location Employ </th>" + 
														"<th> Title </th>"  + 
														"<th> Access Level </th>";
														
										report_view_table_header.appendChild(tr);
										
										//Here the script starts processing all the item data it got from the AJAX call by looping through it in a FOR loop
										for(var i = 0; i < json_object.length; i++)
										{
											var obj = json_object[i]; //First it grabs the current item in the data
											
											//Sets all the item data to its corresponding fields
											empl_fname = obj['empl_fname'];
											empl_lname = obj['empl_lname'];
											phone_num = obj['phone_num'];
											title = obj['title'];
											access_lvl = obj['access_lvl'];
											empl_email = obj['empl_email'];
											loc_name = obj['loc_name'];
											
											if(access_lvl == '1')
											{
												access_lvl = "Front Desk Access Level";
											}
											
											if(access_lvl == '2')
											{
												access_lvl = "Inventory Room Access Level";
											}
											
											if(access_lvl == '3')
											{
												access_lvl = "Supervisor Access Level";
											}
											
											if(access_lvl == '4')
											{
												access_lvl = "Admin Level";
											}
											
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + empl_fname + " " + empl_lname + "</td>" + 
															"<td>" + phone_num + "</td>" + 
															"<td>" + empl_email + "</td>" + 
															"<td>" + loc_name + "</td>"  + 
															"<td>" + title + "</td>"  + 
															"<td>" + access_lvl + "</td>";
								
											//Add the tr tag to the tbody of the item selection list
											print_report_view_table_body.appendChild(tr);
											
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + empl_fname + " " + empl_lname + "</td>" + 
															"<td>" + phone_num + "</td>" + 
															"<td>" + empl_email + "</td>" + 
															"<td>" + loc_name + "</td>"  + 
															"<td>" + title + "</td>"  + 
															"<td>" + access_lvl + "</td>";
											
											report_view_table_body.appendChild(tr);
										}
									}
									else if($('#chosen_report').val() == "equ_count")
									{
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Item </th>" + 
														"<th> Category </th>" + 
														"<th> Amount </th>";
								
										//Add the tr tag to the tbody of the item selection list
										report_view_table_header.appendChild(tr);
										
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Item </th>" + 
														"<th> Category </th>" + 
														"<th> Amount </th>";
									
										print_report_view_table_header.appendChild(tr);
										
										//Here the script starts processing all the item data it got from the AJAX call by looping through it in a FOR loop
										for(var i = 0; i < json_object.length; i++)
										{
											var obj = json_object[i]; //First it grabs the current item in the data
											
											//Sets all the item data to its corresponding fields
											inv_name = obj['inv_name'];
											cat_name = obj['cat_name'];
											count = obj['count(inv_name)'];
										
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + inv_name + "</td>" + 
															"<td>" + cat_name + "</td>" + 
															"<td>" + count + "</td>";
								
											//Add the tr tag to the tbody of the item selection list
											report_view_table_body.appendChild(tr);
											
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + inv_name + "</td>" + 
															"<td>" + cat_name + "</td>" + 
															"<td>" + count + "</td>";
											
											print_report_view_table_body.appendChild(tr);
										}
									}
									else if($('#chosen_report').val() == "upcoming")
									{
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Customer's Name </th>" + 
														"<th> Customer's Phone Number </th>" + 
														"<th> Customer's Email </th>" + 
														"<th> The Request Date </th>";
								
										//Add the tr tag to the tbody of the item selection list
										report_view_table_header.appendChild(tr);
										
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Customer's Name </th>" + 
														"<th> Customer's Phone Number </th>" + 
														"<th> Customer's Email </th>" + 
														"<th> The Request Date </th>";
								
										print_report_view_table_header.appendChild(tr);
										
										//Here the script starts processing all the item data it got from the AJAX call by looping through it in a FOR loop
										for(var i = 0; i < json_object.length; i++)
										{
											var obj = json_object[i]; //First it grabs the current item in the data
											
											//Sets all the item data to its corresponding fields
											f_name = obj['f_name'];
											l_name = obj['l_name'];
											c_phone = obj['c_phone'];
											c_email = obj['c_email'];
											request_date = obj['request_date'];
										
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + f_name + " " + l_name + "</td>" + 
															"<td>" + c_phone + "</td>" + 
															"<td>" + c_email + "</td>" + 
															"<td>" + request_date + "</td>";
								
											//Add the tr tag to the tbody of the item selection list
											report_view_table_body.appendChild(tr);
										
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + f_name + " " + l_name + "</td>" + 
															"<td>" + c_phone + "</td>" + 
															"<td>" + c_email + "</td>" + 
															"<td>" + request_date + "</td>";
															
											print_report_view_table_body.appendChild(tr);
										}
									}
									else if($('#chosen_report').val() == "over_due")
									{
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Item's ID </th>" + 
														"<th> Item's Model </th>" + 
														"<th> Item's Name </th>" + 
														"<th> Item's Category </th>" + 
														"<th> Renter's Name </th>" + 
														"<th> Renter's Phone </th>" + 
														"<th> Renter's Email </th>" + 
														"<th> Date the item is suppose to be back by </th>";
								
										//Add the tr tag to the tbody of the item selection list
										report_view_table_header.appendChild(tr);
										
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Item's ID </th>" + 
														"<th> Item's Model </th>" + 
														"<th> Item's Name </th>" + 
														"<th> Item's Category </th>" + 
														"<th> Renter's Name </th>" + 
														"<th> Renter's Phone </th>" + 
														"<th> Renter's Email </th>" + 
														"<th> Date the item is suppose to be back by </th>";
								
										print_report_view_table_header.appendChild(tr);
										
										//Here the script starts processing all the item data it got from the AJAX call by looping through it in a FOR loop
										for(var i = 0; i < json_object.length; i++)
										{
											var obj = json_object[i]; //First it grabs the current item in the data
											
											//Sets all the item data to its corresponding fields
											due_date = obj['due_date'];
											item_Frontid = obj['item_Frontid'];
											item_modeltype = obj['item_modeltype'];
											inv_name = obj['inv_name'];
											cat_name = obj['cat_name'];
											f_name = obj['f_name'];
											l_name = obj['l_name'];
											c_phone = obj['c_phone'];
											c_email = obj['c_email'];
											
											if(item_modeltype == null)
											{
												item_modeltype = "";
											}
										
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + item_Frontid + "</td>" + 
															"<td>" + item_modeltype + "</td>" + 
															"<td>" + inv_name + "</td>" + 
															"<td>" + cat_name + "</td>" + 
															"<td>" + f_name + " " + l_name + "</td>" + 
															"<td>" + c_phone + "</td>" + 
															"<td>" + c_email + "</td>" + 
															"<td>" + due_date + "</td>";
								
											//Add the tr tag to the tbody of the item selection list
											report_view_table_body.appendChild(tr);
											
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + item_Frontid + "</td>" + 
															"<td>" + item_modeltype + "</td>" + 
															"<td>" + inv_name + "</td>" + 
															"<td>" + cat_name + "</td>" + 
															"<td>" + f_name + " " + l_name + "</td>" + 
															"<td>" + c_phone + "</td>" + 
															"<td>" + c_email + "</td>" + 
															"<td>" + due_date + "</td>";
								
											print_report_view_table_body.appendChild(tr);
										}
									}
									else if($('#chosen_report').val() == "num_rent")
									{
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Item's ID </th>" + 
														"<th> Item's Model </th>" + 
														"<th> Item's Name </th>" + 
														"<th> Number of Usage </th>";
								
										//Add the tr tag to the tbody of the item selection list
										report_view_table_header.appendChild(tr);
										
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Item's ID </th>" + 
														"<th> Item's Model </th>" + 
														"<th> Item's Name </th>" + 
														"<th> Number of Usage </th>";
								
										print_report_view_table_header.appendChild(tr);
										
										//Here the script starts processing all the item data it got from the AJAX call by looping through it in a FOR loop
										for(var i = 0; i < json_object.length; i++)
										{
											var obj = json_object[i]; //First it grabs the current item in the data
											
											//Sets all the item data to its corresponding fields
											item_Frontid = obj['item_Frontid'];
											item_modeltype = obj['item_modeltype'];
											inv_name = obj['inv_name'];
											usage = obj['count(d.rent_id)'];
											
											if(item_modeltype == null)
											{
												item_modeltype = "";
											}
											
											if(item_Frontid == null)
											{
												item_Frontid = "";
											}
										
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + item_Frontid + "</td>" + 
															"<td>" + item_modeltype + "</td>" + 
															"<td>" + inv_name + "</td>" + 
															"<td>" + usage + "</td>" ;
								
											//Add the tr tag to the tbody of the item selection list
											report_view_table_body.appendChild(tr);
											
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + item_Frontid + "</td>" + 
															"<td>" + item_modeltype + "</td>" + 
															"<td>" + inv_name + "</td>" + 
															"<td>" + usage + "</td>" ;
								
											print_report_view_table_body.appendChild(tr);
										}
									}
									else if($('#chosen_report').val() == "revenue")
									{
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Item's ID </th>" + 
														"<th> Item's Model </th>" + 
														"<th> Item's Name </th>" + 
														"<th> Revenue From the Item </th>";
								
										//Add the tr tag to the tbody of the item selection list
										report_view_table_header.appendChild(tr);
										
										//Create the tr tag for the header of the table
										var tr = document.createElement('tr');
									
										//Populate the tr tag
										tr.innerHTML = "<th> Item's ID </th>" + 
														"<th> Item's Model </th>" + 
														"<th> Item's Name </th>" + 
														"<th> Revenue From the Item </th>";
								
										print_report_view_table_header.appendChild(tr);
										
										total_revenue = 0;
										//Here the script starts processing all the item data it got from the AJAX call by looping through it in a FOR loop
										for(var i = 0; i < json_object.length; i++)
										{
											var obj = json_object[i]; //First it grabs the current item in the data
											
											//Sets all the item data to its corresponding fields
											item_Frontid = obj['item_Frontid'];
											item_modeltype = obj['item_modeltype'];
											inv_name = obj['inv_name'];
											revenue_by_item = obj['SUM(cost_at_time)'];
											
											total_revenue = total_revenue + Number(revenue_by_item);
											
											if(item_modeltype == null)
											{
												item_modeltype = "";
											}
											
											if(item_Frontid == null)
											{
												item_Frontid = "";
											}
										
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + item_Frontid + "</td>" + 
															"<td>" + item_modeltype + "</td>" + 
															"<td>" + inv_name + "</td>" + 
															"<td>" + revenue_by_item + "</td>" ;
								
											//Add the tr tag to the tbody of the item selection list
											report_view_table_body.appendChild(tr);
											
											//Create a tr tag
											var tr = document.createElement('tr');
											
											//Populate the tr tag
											tr.innerHTML = "<td>" + item_Frontid + "</td>" + 
															"<td>" + item_modeltype + "</td>" + 
															"<td>" + inv_name + "</td>" + 
															"<td>" + revenue_by_item + "</td>" ;
								
											print_report_view_table_body.appendChild(tr);
										}
										
										//Create a tr tag
										var tr = document.createElement('tr');
										
										//Populate the tr tag
										tr.innerHTML = "<td></td>" + 
														"<td></td>" + 
														"<td> Total Revenue Generated: </td>" + 
														"<td>" + total_revenue + "</td>" ;
								
										//Add the tr tag to the tbody of the item selection list
										report_view_table_body.appendChild(tr);
										
										//Create a tr tag
										var tr = document.createElement('tr');
										
										//Populate the tr tag
										tr.innerHTML = "<td></td>" + 
														"<td></td>" + 
														"<td> Total Revenue Generated: </td>" + 
														"<td>" + total_revenue + "</td>" ;
								
										print_report_view_table_body.appendChild(tr);
									}
									else
									{
										console.log("OOOOH NOOOO, Something went wrong in the Javascript");
										
									}
									
									
								}
							});
						}
					});
				});
			</script>
			
			
			<!--<script type="text/javascript">
				$(function() 
				{
					$('#create_report').click(function() //Starts the script when the user click one of the option buttons on the side
					{
						//Start of the AJAX call
						$.ajax(
						{
							url: "../ReportSection/Report_ExcelPrint.php", //The file where the php select query is at
							type: "post",
							data: 
							{
								'chosen_report': $('#chosen_report').val(),
								'status': $('#status').val(),
								'cat': $('#cat').val(),
								'location': $('#location').val(),
								'public': $('#public').val(),
								'dbw': $('#dbw').val(),
								'from_date': $('#from_date').val(),
								'to_date': $('#to_date').val()
							},
							success: function(data) //When the AJAX call is successful, the script does the following
							{
								console.log("Export to Excel AJAX Call Successful"); //Tells the console log that the AJAX call was good
							},
							error: function(XMLHttpRequest, textStatus, errorThrown) 
							{ 
								console.log("Export to Excel went wrong");
							}  
						});
					});
				});
			</script>-->
			
			
			<script type = "text/javascript">
				// this script calls a CSS class called .highlight in the CSS file
				// So that when a click happens It hightlights the row letting the user know that they've selected it.
				$(document).ready(function(){
					$("#report_option_selection tr").click(function(){
						$("#report_option_selection tr").removeClass("highlight");
						$(this).addClass("highlight");
					});
				});
			</script>


				<!-- CSS trick to get the print to only print the receipt and nothing else -->
			<style>
				@media print {
				  body * {
					visibility: hidden;
				  }
				  #section_to_print, #section_to_print *, #pring_header {
					visibility: visible;
				  }
				  #section_to_print {
					position: absolute;
					top: 15;
					width: 100%;
					left:5;
				  }
				  .background
					{
						visibility: hidden;
					}
				}
			</style>
		
			<!-- Printing script for the print receipt button -->
			<script type="text/javascript">
				function printfunction() 
				{
					if(document.getElementById('chosen_report').value.length == 0)
					{
						alert("Please select a report to print");
						return false;
					}
					else
					{
						window.print();
					}
				}
			</script>
	
		</html>
<?php
		$conn=null;
	}
?>