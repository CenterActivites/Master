<?php
	//First page on the CustomerSelection section. This would be the section main page, the page where most of the back and cancel button in the section
	//	will go to
	function HomePage()
	{
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../CustomerselectionSection/cust_css/cust_selection.css"/>

</head>
<body>
    <div id="pageHeader" style="font-size: 35px; text-align: center;"> Home Page </div>
    </br>
	</br>
<div>
<?php
		//Connecting to the Database
        $conn = hsu_conn_sess();
		
 ?>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id='button' >
			<div id='table_div'>
				<fieldset style="border: none;">
					<fieldset id='fieldset_label' style="background-color: #D3D3D3;">
						<label id='header_for_table' style="padding-left: 5%; font-size: 20px"> Late Rentals </label>
					</fieldset>
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
							<tbody>
<?php							
								//Grabs the current date to correspond to the database
								$current_date = date("Y-m-d");
								
								//"Due rental" query
								$select_item = $conn->prepare("SELECT b.cust_id, f_name, l_name, c_phone,c_email, due_date
																	FROM Customer a, Rental b
																	WHERE a.cust_id = b.cust_id and b.pick_up_date IS NOT NULL and 
																			b.return_date IS NULL and b.due_date < :a and 
																			b.rental_status = 'On-Going'
																	GROUP BY b.cust_id
																	ORDER BY due_date");
								$select_item->bindValue(':a', $current_date, PDO::PARAM_STR);
								$select_item->execute();
								$display_array = $select_item->fetchAll();
								
								if(!empty($display_array))
								{
									foreach($display_array as $row)
									{
										$curr_f_name = $row["f_name"]; //each row is a object that has a f_name, l_name, cust_id, c_email, and a due_date
										$curr_l_name = $row["l_name"];
										$curr_cust_id = $row["cust_id"];
										$curr_c_email = $row["c_email"];
										$curr_c_phone = $row["c_phone"];
										$curr_due_date = $row["due_date"];
										
										//The following two lines is for formatting reasons. Basically to make the date we get from the database more readable for users
										$curr_due_date = strtotime($curr_due_date);
										$curr_due_date = date('M d, Y', $curr_due_date);
?>
										<tr>
											<td id = "hide_me"><input id ="radio_in" type="radio"  name="item_id[]" value = "<?= $curr_cust_id ?>"/></td>
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
				</fieldset>

				</br>
			
				<fieldset style="border: none;">
					<fieldset id='fieldset_label' style="background-color: #D3D3D3;">
						<label id='header_for_table' style="padding-left: 5%; font-size: 20px"> Pick Ups </label>
					</fieldset>
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
							<tbody>
<?php
								//"Customer who are picking up their rental soon" query
								$select_item = $conn->prepare("SELECT f_name, l_name, c_phone,c_email, request_date, rent_id
																	FROM Customer a, Rental b
																	WHERE a.cust_id = b.cust_id and b.pick_up_date IS NULL and b.rental_status = 'On-Going'
																	ORDER BY request_date, l_name, f_name");
								$select_item->execute();
								$display_array = $select_item->fetchAll();
								
								if(!empty($display_array))
								{
									foreach($display_array as $row)
									{
										$curr_f_name = $row["f_name"]; //each row is a object that has a f_name, l_name, cust_id, c_email, and request_date
										$curr_l_name = $row["l_name"];
										$curr_rent_id = $row["rent_id"];
										$curr_c_email = $row["c_email"];
										$curr_c_phone = $row["c_phone"];
										$curr_request_date = $row["request_date"];
										
										//Again same for the Due rental table, the next two lines is for allowing users to read the dates parts more easy
										$curr_request_date = strtotime($curr_request_date);
										$curr_request_date = date('M d, Y', $curr_request_date);
?>
										<tr>
											<td id = "hide_me"><input id ="rent_id" type="radio"  name="rent_id" value = "<?= $curr_rent_id ?>"/></td>
											<td><?= $curr_f_name ?></td>
											<td><?= $curr_l_name ?></td>
											<td><?= $curr_c_email ?></td>
											<td><?= $curr_c_phone ?></td>
											<td><?= $curr_request_date ?></td>
										</tr>
<?php
									}
								}
								else
								{
?>
									<tr> <td colspan="5"> No Pick-ups </td> </tr>
<?php
								}
?>
							</tbody>
						</table>
					
					</br>
					</br>
					</br>
						
					<input type="submit" name="select" id="select" value="Select"/><br />
				</fieldset>
			</div>
			
			<!-- Hidden input value for seeing which of the two tables the selected row is from  -->
			<input type="hidden" id="which_table" name="which_table" />
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
				if(document.getElementById('cust_id').value.length == 0 || document.getElementById('cust_id').value.length == null)
				{
					alert("please select a customer");
					return false;
				}
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			//this script goes off when a table row is clicked, it checks the hidden radio button correlating to that table row
			$("#cust_table_info_late tr, #cust_table_info_pick tr").click(function(){
					$(this).find('td input:radio').prop('checked',true);
			});

			//The next following lines sets the hidden input "which_table" to values of either "Late" or "Pick". 
			//This allows the program to know which table was the row selected from so that program will know where to sent the user next to
			$("#cust_table_info_late tr").click(function(){
				$('#which_table').val("Late");
				console.log("Late table was selected");
			});	
			$("#cust_table_info_pick tr").click(function(){
				$('#which_table').val("Pick");
				console.log("Pick-up table was selected");
			});	
		});
	</script>

	<script type = "text/javascript">
		// this script calls a CSS class called .highlight in the CSS file
		// So that when a click happens It hightlights the row letting the user know that they've selected it.
		$(document).ready(function(){
			$("#cust_table_info_late tr, #cust_table_info_pick tr").click(function(){
				$("#cust_table_info_late tr").removeClass("highlight");
				$("#cust_table_info_pick tr").removeClass("highlight");
				$(this).addClass("highlight");
			});
		});
	</script>
	
</html>


<?php
	$conn = null;   //also remember to close the connection to the database
}
?>
