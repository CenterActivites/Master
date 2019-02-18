<?php
  function addcust(){
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../CustomerselectionSection/cust_css/cust_selection.css"/>
		
		<!-- Modal script got from online with little adjustments for this page purpose -->
		<script type="text/javascript">
			$(document).ready(function()
			{
				//Once the Rental button is clicked
				$("#Addcust").click(function(){
					//Does the check if a customer have been selected
					if (document.getElementById('cust_name').value.length == 0 
					|| document.getElementById('stu_id').value.length == 0 
					|| document.getElementById('address').value.length == 0 
					|| document.getElementById('Phone').value.length == 0 
					|| document.getElementById('email').value.length == 0 
					|| document.getElementById('is_student').value.length == 0 
					|| document.getElementById('emerName').value.length == 0 
					|| document.getElementById('emerPhone').value.length == 0)
					{
						alert("Fill out all the fields");
						return false;
					}
				});
			});
		</script>
	</head>
  <body>
    <div>
		<!-- had to figure out the domain so that we could navigate to our posthandler. The domain exisits in the index.php file. -->
		<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id='new_cust'>
			<fieldset >
				Name: <input type = "text" name = "cust_name" id = "cust_name" maxlength="38" value ="" required/><br/>
				Student ID: <input type = "text" name = "stu_id" id = "stu_id" maxlength="9" value ="" required/><br/>
				Address: <input type = "text" name = "address" id = "address" maxlength="100" value ="" required/><br/>
				Phone Number: <input type = "text" name = "Phone" id = "Phone" maxlength="12" value ="" required/><br/>
				Email Adress: <input type = "text" name = "email" id = "email" maxlength="50"  value ="" required/><br/>
				Student Status: <select name = "is_student" id="is_student" size="1" required>
									<option hidden></option>
									<option value = "No"> No </option>
									<option value = "Yes"> Yes </option>
								</select><br/>
				Employee Status: <select name = "empl_stat" id="empl_stat" size="1" required>
									<option hidden></option>
									<option value = "No"> No </option>
									<option value = "Yes"> Yes </option>
								</select><br/>
				Emergency Contact Name: <input type = "text" name = "emerName" id = "emerName" maxlength="38" value =""/><br />
				Emergency Contact Phone Number: <input type = "text" name = "emerPhone" id = "emerPhone" maxlength="12" value =""/><br />
				<br/>
				<input type="submit" name="Addcust" id="Addcust" value="Add New Customer"/>
			</fieldset>
	</div>

    <div id ='back_button'>
      <form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method = 'post'>
          <fieldset id= 'backButton'>
            <input type="submit" name="back" id="back" value="Back" />
          </fieldset>
      </form>
    </div>
  </body>
</html>
<?php
}
?>
