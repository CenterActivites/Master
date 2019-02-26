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
							Title: <input type = "text" name = "title" id = "title" maxlength="15" value ="" required/>
						</td>
					</tr>
					
					<tr>
						<td>
							Phone Number: <input type = "text" name = "Phone" id = "Phone" maxlength="12" value ="" required/>
						</td>
						<td>
							Level of Access Given: <select name = "access_lvl" id="access_lvl" size="1" required>
								<option hidden></option>
								<option value = "1"> 1 </option>
								<option value = "2"> 2 </option>
								<option value = "3"> 3 </option>
								<option value = "4"> 4 </option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td colspan="2">
							Email Address: <input type = "text" name = "email" id = "email" maxlength="50"  value ="" required/>
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
</html>
<?php
}
?>
