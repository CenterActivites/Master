<?php
/*
File: Admin Add Users Page

*/
?>

<center>
<!-- Add User function uses the inserted infromation below -->
<!--<link href="<?= domain?>/css/input.css" 	    type="text/css" rel="stylesheet" />-->

<p> Add Users </p>
<hr>

<form onsubmit="return validateForm();" method="post" 
    action="<?=domain?>/php-inputhandler.php"
	name="Adduser">
	<!-- Creating a field set to seperate the buttons and forms -->
	<!-- anyinformation typed into the input fields will be inputed when the add button is hit -->
	<!-- eventually this will include a delete funtionality and an edit functionaly such as vendors -->
	<fieldset>
		<table>
			<tr>
				<td>User Name:</td>
				<td><input type="text" name="username" ><br></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="text" name="password"><br></td>
			</tr>
			<tr>
				<td>Employee First Name:</td>
				<td><input type="text" name="empl_fname"><br></td>
			</tr>
			<tr>
				<td>Employee Last Name:</td>
				<td><input type="text" name="empl_lname"><br></td>
			</tr>
			<tr>
			<!-- making this a drop down selection to avoid a level which cant be entered -->
				<td>User Admin level:</td>
				<td><select name = "power_level">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select><br>
				</td>
			</tr>
		</table>
	</fieldset>
	<!-- Creating a field set to seperate the buttons and forms -->
        <fieldset>
            <div>
				<input type="hidden" name = "Vendors_Input" value = "1"/>
				<input type="submit" name="submit" value="Add User" onclick="return validateForm();"/>
            </div>
        </fieldset>


</form>

</center>