<?php

	function CustomerTran()
	{
?>
		<html>
		<head>
		
			<link rel="stylesheet" type="text/css" href="../CustomerselectionSection/cust_css/cust_selection.css"/>
			
		</head>
		<body>
			<div id="pageHeader" style="font-size: 35px; text-align: center;"> Customer Rentals </div>
			<div>
				<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
					<fieldset style="border: none;">
						<legend style="font-size: 20px;"> All Rentals: </legend>
							<!-- TimeStamp Select Table -->
							<select name="time_stamp_select" id="time_stamp_select" size="6" class="time_stamp_select">
<?php
								//Connecting to the Database
								$connctn = hsu_conn_sess();
								
								//Grab the selected customer id
								$cust_id = (int)$_SESSION['cust_id'];
								
								//Does a select sql statement to grab all transactions that is involved with the selected customer
								$trans = $connctn->prepare("SELECT rent_id, request_date, due_date
															FROM Rental
															WHERE cust_id = :a
															ORDER BY request_date desc");
															
								$trans->bindValue(':a', $cust_id, PDO::PARAM_INT);
								$trans->execute();
								$trans_display = $trans->fetchAll();
								//echo $trans -> errorCode();
								
								//Grabs the number of transactions for the following "FOR" loop
								$array_size = count($trans_display);

								//Loops through the array of data that came from the select 
								for($i=0; $i<$array_size; $i++)
								{
									//Set the data to the correct fields
									$curr_rent_id = $trans_display[$i]['rent_id'];
									$curr_request_date = $trans_display[$i]['request_date'];
									$curr_due_date = $trans_display[$i]['due_date'];
									
									//Format the timestamp that was given from the database into a more readable timestamp
									$curr_new_format_request_date = date('F d, Y', strtotime($curr_request_date));
									$curr_new_format_due_date = date('F d, Y', strtotime($curr_due_date));
?>
									<!-- Display the fields -->
									<option value="<?= $curr_rent_id ?>">
										<?= $curr_new_format_request_date ?> &nbsp; -- &nbsp; <?= $curr_new_format_due_date ?> 
									</option>
<?php
								}
								//Always to remember to disconnect from the database
								$connctn = null;
?>
							</select>
							
						<!-- Comments header and the actual comments themselves  -->
						<table id="comment_table">
						</table>
					</fieldset>
					
					<!-- Item Information Table -->
					<div id='item_info_label' style="font-size: 25px; text-align: center;"></div>
					<table id='tran_infor_table'>
						<thead>
							<tr>
								<th>Front Id</th>
								<th>Item Name</th>
								<th>Item Size</th>
								<th>Item Model</th>
							</tr>
						</thead>
						<tbody id='empty'>
							<tr> <td colspan="4"> Please Select a TimeStamp to See Items Involved With the Rental </td> </tr>
						</tbody>
					</table>
			</div>
					
					<!-- Bottom Buttons -->
					<div>
						<input type="hidden" name="cust_id" id="cust_id" value="<?= $cust_id ?>"/> 
						<input type="submit" name="viewReceipt" id="viewReceipt" value="View Receipt of Rental" /> &nbsp;
						<input type="submit" name="backOnCustTran" id="backOnCustTran" value="Back" onclick="back()"/> &nbsp;
					</div>
				</form>

		</body>
			
			<!-- Start of Javacript -->
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
			
			<!-- Little script that lets users know what type of tranaction that they have selected and are seeing at the moment -->
			<script type="text/javascript">
				$(function()
				{
					//Funation is called once the user have selected a timestamp
					$('.time_stamp_select').change(function() 
					{
						//Grabs the text of the selected option
						var selected_text = $("#time_stamp_select option:selected").text();
						
						//Split it and turns it into a object of string
						selected_text = selected_text.split(" ");
						
						//Then set the first string to the div tab "item_info_label" which will be displayed for the user to see
						document.getElementById('item_info_label').innerHTML = "Request Date: " + selected_text[0] + " " + selected_text[1] + " " + selected_text[2] + "</br>" +
																				"Due Date: " + selected_text[6] + " " + selected_text[7] + " " + selected_text[8] + "</br>";
					});
				});
			</script>
			
			<script type="text/javascript">
				$(function()
				{
					//When user select a timestamp tranaction from the select table
					$('.time_stamp_select').change(function() 
					{
						//Fires a AJAX call to grab all the items that was involved with the tranaction
						$.ajax(
						{ 
							url: "../CustomerselectionSection/transaction_helper.php",
							type: "post",
							data: 
							{
								//Sends the cust_id which is from the hidden input that holds the selected customer id and 
								//the trans_id that is connected to every option in the "TimeStamps" select
								'cust_id': document.getElementById('cust_id').value,
								'trans_id': $(this).val()
							},
							success: function(data)
							{
								//Onces the AJAX call is successful
								
								//Grabs the data that is in JSON format and parse it so it is usable
								var json_object = JSON.parse(data);
								
								//Log the data
								console.log("data: " + data);
								
								//We empty the table of previous item information from last timestamp tranaction
								$('#empty').empty();

								//Grab the tbody tag for inserting new item information
								var tbody = document.getElementById('empty'); //Grabs the "tbody" select tag
								
								//Process all the item data it got from the AJAX call by looping through it in a FOR loop
								for(var i = 0; i < json_object.length; i++)
								{
									var obj = json_object[i]; //First grabs the current item in the data
									
									//Sets all the item data to its corresponding fields
									inv_name = obj['inv_name'];
									item_size = obj['item_size'];
									item_Frontid = obj['item_Frontid'];;
									item_modeltype = obj['item_modeltype'];
									
									//Does checks if the item_modeltype and item_size fields are Null.
									//If so then it sets the fields to a empty string
									if(item_modeltype == null)
									{
										item_modeltype = "";
									}
								
									if(item_size == null)
									{
										item_size = "";
									}
									
									//Create a new row for the table that will contain all the new item information
									var tr = document.createElement('tr');

									//Set the item information to the row in the correct order according to the set columns
									tr.innerHTML = "<td>" + item_Frontid + "</td>"  + 
													"<td>" + inv_name + "</td>" + 
													"<td>" + item_size + "</td>" + 
													"<td>" + item_modeltype + "</td>";
							
									//Adds the new row to the table
									tbody.appendChild(tr);
								}
								
								//Little script that will populate the empty comment div with comments made about the transaction
								if(json_object[0]['comments'] == null || json_object[0]['comments'].length == 0)
								{
									//We empty the table of previous item information from last timestamp tranaction
									$('#comment_table').empty();
								
									var comment_table = document.getElementById('comment_table');
									
									//Create a new row for the table that will contain all the new item information
									var th = document.createElement('tr');
									var td = document.createElement('tr');
									
									//Set the item information to the row in the correct order according to the set columns
									th.innerHTML = "<th>" + "Comments about the Tranaction:" + "</th>";
									td.innerHTML = "<td>" + "No Comments were made for this Transaction" + "</td>";
									
									//Adds the new row to the table
									comment_table.appendChild(th);
									comment_table.appendChild(td);
								}
								else
								{
									//We empty the table of previous item information from last timestamp tranaction
									$('#comment_table').empty();
									
									var comment_table = document.getElementById('comment_table');
									
									//Create a new row for the table that will contain all the new item information
									var th = document.createElement('tr');
									var td = document.createElement('tr');
									
									//Set the item information to the row in the correct order according to the set columns
									th.innerHTML = "<th>" + "Comments about the Tranaction:" + "</th>";
									td.innerHTML = "<td>" + json_object[0]['comments'] + "</td>";
									
									//Adds the new row to the table
									comment_table.appendChild(th);
									comment_table.appendChild(td);
								}
							},
							//If there is ever a error with the AJAX call, it will logs the errors that it found with the AJAX call to the brower's console
							error: function(XMLHttpRequest, textStatus, errorThrown) 
							{ 
								console.log("Status: " + textStatus); 
								console.log("Error: " + errorThrown); 
							}
					
						});
					});
				});
			</script>
			
		</html>
<?php
	} 
?>
