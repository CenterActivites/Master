<?php
	//First page on the CustomerSelection section. This would be the section main page, the page where most of the back and cancel button in the section
	//	will go to
	function Employee()
	{
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../EmployeeSection/empl_css/empl_selection.css"/>
	
</head>
<body>
	<div id="pageHeader" style="font-size: 35px; text-align: center;"> Employee List </div>
<div>
<?php
		//Connecting to the Database
		$conn = hsu_conn_sess();
 ?>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id='button' >
			<fieldset style="border:none">
				<div id='table_div'>
					<!-- Customer table creation starts here -->
					<table id='empl_table_info'>
						<thead>
							<!-- Labels for each column  -->
							<tr>
								<!-- The hidden column for the hidden radio buttons for the selection purposes since tables don't really have selecting capabilities -->
								<th id='hide_me'></th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Phone Number</th>
							</tr>
						</thead>
						<!-- The body of the table. Basically where all the customer's information is going to be -->
						<tbody>
<?php
							//The Customer Section 
							
							//MYSQL select. Grab all customers in the data with the following information about them
							//Their id, first and last name, phone number, and email
							foreach($conn->query("SELECT empl_id, empl_fname, empl_lname, phone_num, empl_email
													FROM Employee
													ORDER BY empl_lname, empl_fname") as $row)
							{
								$curr_f_name = $row["empl_fname"]; //each row is a object that has a f_name, l_name, and a cust_id
								$curr_l_name = $row["empl_lname"];
								$curr_cust_id = $row["empl_id"];
								$curr_c_email = $row["empl_email"];
								$curr_c_phone =$row["phone_num"];
?>
								<!-- Placing the data into their correct columns -->
								<tr>
									<!-- Since tables really doesn't have a select capabilities to it, We just add a hidden radio button that will allow us to see which customer have been selected -->
									<td id = "hide_me"><input id ="radio_in" type="radio"  name="empl_id" value = "<?= $curr_cust_id ?>"/></td>
									<td><?= $curr_f_name ?></td>
									<td><?= $curr_l_name ?></td>
									<td><?= $curr_c_email ?></td>
									<td><?= $curr_c_phone ?></td>
								</tr>
<?php
							}
?>
						</tbody>
					</table>
				</div>
			</fieldset>
			
			<fieldset style="border:none;">
				<!-- The Search bar -->
				<label id='search_lable'>Search:</label> <input type = "text" name = "searchCust" id = "searchCust" placeholder="Search for names..." /> <br/>   <!-- Search bar -->
				</br>
				</br>
				<input type="submit" name="emplInfo" id="emplInfo" value="Employee Information" onclick="return is_blank()"/> &nbsp; &nbsp;
				<input type="submit" name="newEmpl" id="newEmpl" value="New Employee" />
			</fieldset>
		</form>
</div>
</body>

	<!-- JavaScript Starts here -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
	<script type="text/javascript" src="jquery.quicksearch.js"></script>  <!-- Plugin for the item Search function -->

	<!-- Creation of a hidden input called empl_id to grab the selected employee id -->
	<script type="text/javascript">
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'empl_id',
				name: 'empl_id'
			}).appendTo('#button');
		});
	</script>
	
	<!-- A "check" function for the button "Employee Information" that sees if a employee have been selected or not -->
	<!-- A employee must be selected to move on -->
	<script type="text/javascript">
		function is_blank(){
			if(document.getElementById('empl_id').value.length == 0){
				alert("please select a employee");
				return false;
			}
		}
	</script>

	<!-- Function for saving the selected employee's id to the hidden input "cust_id" -->
	<script type="text/javascript">
	$(document).ready(function(){
		$("#table_div").click(function(){
			$('input[type="radio"]:checked').each(function(){
				var box_value = $(this).val();
				$('#empl_id').val(box_value);
				console.log($('#empl_id').val());
			});
		});
	});
	</script>

	<script type="text/javascript">
	//this script goes off when a table row is clicked it checks the radio button
		$(document).ready(function(){
			$("#empl_table_info tr").click(function(){
					$(this).find('td input:radio').prop('checked',true);
				});
			});
	</script>

	<script type = "text/javascript">
		// this script calls a CSS class called .highlight in the CSS file
		// So that when a click happens It hightlights the row letting the user know that they've selected it.
		$(document).ready(function(){
			$("#empl_table_info tr").click(function(){
				$("#empl_table_info tr").removeClass("highlight");
				$(this).addClass("highlight");
			});
		});
	</script>

	<!-- Search functionally for the employee table -->
	<script type="text/javascript">
		$(function ()
		{
			$('input#searchCust').quicksearch('#empl_table_info tbody tr'); //On key search for employee names here
		});
	</script>
	
</html>


<?php
	$conn = null;   //also remember to close the connection to the database
}
?>
