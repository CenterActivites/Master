<?php
  function addempl(){
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../EmployeeSection/empl_css/empl_add.css"/>
	</head>
  <body>
	<div id="pageHeader"> Adding New Employee </div>
    <div>
		<!-- had to figure out the domain so that we could navigate to our posthandler. The domain exisits in the index.php file. -->
		<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id='new_cust'>
			<fieldset style="border:none;">
				<table>
					<tr>
						<td>
							Name: <input type = "text" name = "empl_name" id = "empl_name" maxlength="40" value ="" required/>
						</td>
						<td>
							Title: <input type = "text" name = "title" id = "title" maxlength="15" value =""/>
						</td>
					</tr>
					
					<tr>
						<td>
							Phone Number: <input type = "text" name = "Phone" id = "Phone" maxlength="12" value =""/>
						</td>
						<td>
							<label for="access_lvl"> Level of Access Given: </label>
							<select name = "access_lvl" id="access_lvl" size="1" required>
								<option hidden></option>
								<option value = "1"> Front Desk Access Level </option>
								<option value = "2"> Inventory Room Access Level </option>
								<option value = "3"> Supervisor Access Level </option>
								<option value = "4"> Admin Level </option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							Email Address: <input type = "text" name = "email" id = "email" maxlength="50"  value =""/>
						</td>
						<td>
							Username: <input type = "text" name = "user" id = "user" maxlength="20" minlength=3 value ="" required/>
						</td>
					</tr>
					
					<tr>
						<td colspan="2">
							Password need to be at least 4 characters long. Must have
							at least 1 upper case, 1 lower case, and 1 number in it.
							</br>
							Password: <input type = "text" name = "pass" id = "pass" maxlength="20" minlength=4 value ="" required/>
							</br>
							Random Password Generator <input type = "button" name = "gen_pass" id = "gen_pass" />
						</td>
					</tr>
					
				</table>
				<fieldset style="border:none;">
					<input type="submit" name="Addempl" id="Addempl" value="Add New Employee"/>
		</form>
					<form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method = 'post'>
						<input type="submit" name="cancel" id="cancel" value="Cancel" />
					</form>
				</fieldset>
		</fieldset>
	</div>
  </body>
  
  <!-- Random Password Generator -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#gen_pass").click(function(){
				ran_num = Math.floor(Math.random() * 9) + 4;
				ran_pass = "";
				possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

				for (var i = 0; i < ran_num; i++)
				{
					ran_pass += possible.charAt(Math.floor(Math.random() * possible.length));
				}
				
				if(!(/\d/.test(ran_pass)))
				{
					x = Math.floor((Math.random() * 10) + 1);
					ran_pass += x;
				}
				if(!(/[a-z]/.test(ran_pass)))
				{
					ran_pass += 'a';
				}
				if(!(/[A-Z]/.test(ran_pass)))
				{
					ran_pass += 'A';
				}
			
				$('#pass').val(ran_pass);
			});
		});
	</script>
	
	<!-- Little script for if the user didn't select an item, they get the "please select an item" alert -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#Addempl").click(function(){
				name = $('#empl_name').val();
				last_first_name = name.split(' ').filter(function(v){return v!==''});
				
				if(!(/\d/.test($('#pass').val())))
				{
					alert("Your password needs a number value in it");
					return false;
				}
				if(!(/[a-z]/.test($('#pass').val())))
				{
					alert("Your password needs a lower case in it");
					return false;
				}
				if(!(/[A-Z]/.test($('#pass').val())))
				{
					alert("Your password needs a upper case in it");
					return false;
				}
				if(last_first_name.length <= 1)
				{
					alert("We need the employee's first and last name");
					return false;
				}
				if(/[a-z]/.test($('#Phone').val()) || /[A-Z]/.test($('#Phone').val()))
				{
					alert("There are some letters in the phone number field....Why?");
					return false;
				}
			});
		});
	</script>
	
</html>
<?php
}
?>
