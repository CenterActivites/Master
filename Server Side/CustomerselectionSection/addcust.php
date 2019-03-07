<?php
  function addcust(){
?>
<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="../CustomerselectionSection/cust_css/cust_add.css"/>
		
		<!-- Little Javascript toggle that toggles between a student id input field or a driver license input field -->
		<script type="text/javascript">
			$(function()
			{
				//Once the user select the student status whether the customer is or is not a student. The input field will change accordingly
				$('#is_student').change(function() 
				{
					//Grab the selected text
					var is_stu = $("#is_student option:selected").text();
					
					//Checks if the selected text is Yes, customer is a student
					if(is_stu === " Yes ")
					{
						//Logs it in the console
						console.log("Student Status been changed to yes");
						
						//Change the label to the proper label according to the selected text
						document.getElementById("label_for_ids").innerHTML = "Student Id: ";
						
						//Grab the input field for change
						var id_input_field = document.getElementById("drive_id");
						
						//Changes the input field's 'id', 'name', and 'maxlength'
						id_input_field.setAttribute("id", "stu_id");
						id_input_field.setAttribute("name", "stu_id");
						id_input_field.setAttribute("maxlength", "10");
					}
					//If the customer is not a student then...
					else
					{
						//Logs it in the console
						console.log("Student Status been changed to no");
						
						//Change the label to the proper label according to the selected text
						document.getElementById("label_for_ids").innerHTML = "Driver License Number: ";
						
						//Grab the input field for change
						var id_input_field = document.getElementById("stu_id");
						
						//Changes the input field's 'id', 'name', and 'maxlength'
						id_input_field.setAttribute("id", "drive_id");
						id_input_field.setAttribute("name", "drive_id");
						id_input_field.setAttribute("maxlength", "8");
					}
				});
			});
		</script>

		
		
	</head>
  <body>
	<div id="pageHeader"> Adding New Customer </div>
    <div>
		<!-- had to figure out the domain so that we could navigate to our posthandler. The domain exisits in the index.php file. -->
		<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id='new_cust'>
			<fieldset style="border:none;">
			
				<!-- Input fields formated with a table -->
				<table>
					<tr>
						<!-- Customer input field -->
						<td colspan="3">
							Name: <input type = "text" name = "cust_name" id = "cust_name" maxlength="51" value ="" required/>
						</td>
						<!-- Student status select -->
						<td colspan="1">
							Student Status: 
							<select name = "is_student" id="is_student" size="1" required>
								<option value = "Yes"> Yes </option>
								<option value = "No"> No </option>
							</select>
						</td>
					</tr>
					
					<tr>
						<!-- Street address input field -->
						<td colspan="4">
							Street Address: <input type = "text" name = "street_address" id = "street_address" maxlength="100" value ="" required/>
						</td>
					</tr>
					
					<tr>
						<!-- City input field -->
						<td colspan="2">
							City: <input type = "text" name = "city" id = "city" maxlength="30" value ="" required/>
						</td>
						<!-- State input field -->
						<td colspan="1">
							State: <input type = "text" name = "state" id = "state" maxlength="13" value ="" required/>
						</td>
						<!-- Zip code input field -->
						<td colspan="1">
							ZIP Code: <input type = "text" name = "zip" id = "zip" maxlength="13" value ="" required/>
						</td>
					</tr>
					
					<tr>
						<!-- Phone number input field -->
						<td colspan="2">
							Phone Number: <input type = "text" name = "phone" id = "phone" maxlength="12" value ="" required/>
						</td>
						<!-- Email input field -->
						<td colspan="2">
							Email Address: <input type = "text" name = "email" id = "email" maxlength="50"  value ="" required/>
						</td>
					</tr>
					
					<tr>
						<!-- The toggle input field that would be either Student id or Driver license -->
						<td colspan="3">
							<label id="label_for_ids">Student ID:</label>
							<input type = "text" name = "stu_id" id = "stu_id" maxlength="10" value ="" required/>
						</td>
						<!-- Employee status select -->
						<td colspan="1">
							Employee Status: 
							<select name = "empl_stat" id="empl_stat" size="1" required>
								<option value = "No"> No </option>
								<option value = "Yes"> Yes </option>
							</select>
						</td>
					</tr>
					
				</table>
				<fieldset style="border:none;">
					<!-- The Add Customer button -->
					<input type="submit" name="Addcust" id="Addcust" value="Add New Customer"/>
		</form>
					<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method = 'post'>
						<!-- The Cancel button -->
						<input type="submit" name="cancel" id="cancel" value="Cancel" />
					</form>
				</fieldset>
		</fieldset>
	</div>
  </body>
</html>
<?php
}
?>
