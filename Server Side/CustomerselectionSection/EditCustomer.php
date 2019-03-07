<?php

	function EditCustomer()
	{
		$cust_id = strip_tags($_POST['cust_id']);
		$cust_fname = strip_tags($_POST['cust_fname']);
		$cust_lname = strip_tags($_POST['cust_lname']);
		$cust_phone = strip_tags($_POST['cust_phone']);
		$cust_email = strip_tags($_POST['cust_email']);
		$cust_address = strip_tags($_POST['cust_address']);
		$cust_city = strip_tags($_POST['cust_city']);
		$cust_state = strip_tags($_POST['cust_state']);
		$cust_zip = strip_tags($_POST['cust_zip']);
		$cust_stu_id = strip_tags($_POST['cust_stu_id']);
		$cust_driver_id = strip_tags($_POST['cust_driver_id']);
		$is_employee = strip_tags($_POST['cust_is_employee']);
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../CustomerselectionSection/cust_css/cust_edit.css"/>

	<script type="text/javascript">
			function back(){
				var historyObj = window.history;
				historyObj.back();
			}
	</script>

	<script type="text/javascript">
	function remove(){
		if(confirm("You are about to delet a Customer")){
			return true;
		}else{
			return false;
		}
	}
	</script>

</head>
<body>
	<fieldset id='fieldset_label' style="border:none; text-align: center;">
		<label id='header_for_table' style="font-size: 25px">  Edit <?= $cust_fname ?> <?= $cust_lname ?>'s Information </label>
	</fieldset>
	</br>
    <div id ='edit_cust'>
				<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="edit_cust_form">
					<fieldset id='first_name_feild'>
						<lable id='all_lable'>First Name:</lable></br><input type = "text" name = "cust_fname" id = "cust_fname" value ="" maxlength="25"/><br/>
					</fieldset>
					<fieldset id='last_name_field'>
						<lable id='all_lable'>Last Name:</lable></br><input type = "text" name = "cust_lname" id = "cust_lname" value ="" maxlength="25"/><br/>
					</fieldset></br>
					<fieldset id='driver_id_field'>
						<lable id='all_lable'>Driver License:</lable></br><input type = "text" name = "driver_id" id = "driver_id" value ="" maxlength="8"/><br/>
					</fieldset>
					<fieldset id='stu_id_field'>
						<lable id='all_lable'>Student ID:</lable></br><input type = "text" name = "cust_stu_id" id = "cust_stu_id" value ="" maxlength="10"/><br/>
					</fieldset>
					<fieldset id='empl_stat_field'>
						<lable id='all_lable'>Employee Status:</lable></br><select name = "empl_stat" id="empl_stat" size="1" required>
																<option value = "No"> No </option>
																<option value = "Yes"> Yes </option>
														</select>
					</fieldset></br>
					<fieldset id='phone_num_field'>
						<lable id='all_lable'>Phone Number:</lable></br><input type = "text" name = "cust_phone" id = "cust_phone" value ="" maxlength="12"/><br/>
					</fieldset></br>
					<fieldset id='email_field'>
						<lable id='all_lable'>Email Address:</lable></br><input type = "text" name = "cust_email" id = "cust_email" value ="" maxlength="50"/><br/>
					</fieldset>
					<fieldset id='street_address'>
						<lable id='all_lable'>Address:</lable></br><input type = "text" name = "cust_address" id = "cust_address" value ="" maxlength="100"/><br/>
					</fieldset>
					</br></br></br></br></br></br></br></br></br></br></br></br></br></br>
					
					<fieldset id='address_field'>
						<div id="city">
							<lable id='all_lable'>City:</lable></br><input type = "text" name = "cust_city" id = "cust_city" value ="" maxlength="30"/>
						</div>
						<div id="state">
							<lable id='all_lable'>State:</lable></br><input type = "text" name = "cust_state" id = "cust_state" value ="" maxlength="13"/>
						</div>
						<div id="zip">
							<lable id='all_lable'>ZIP Code:</lable></br><input type = "text" name = "cust_zip" id = "cust_zip" value ="" maxlength="13"/>
						</div>
					</fieldset>


				</br>

				<fieldset id='buttons' style="border:none;">
					<input type="submit" name="updateCust" id="updateCust" value="Update Customer" />
					<input type="submit" name="removeCust" id="removeCust" value="Remove Customer" onclick="return remove()" /><br />
					<input type="submit" name="cancelOnEditCust" id="cancelOnEditCust" value="Cancel" onclick="back()"/><br />
				</fieldset>
			</form>
		</div>



		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_id',
					name: 'cust_id'
				}).appendTo('#edit_cust_form');
				var cust_id_infor = "<?php echo $cust_id ?>";
				$("#cust_id").val(cust_id_infor);
			});
		</script>


		<script type="text/javascript">
			$(document).ready(function(){
				var empl_stat = "<?php echo $is_employee?>";
					$("#empl_stat").val(empl_stat);
			});
		</script>

		<script type="text/javascript">
			var cust_fname = "<?php echo $cust_fname ?>";
			var cust_lname = "<?php echo $cust_lname ?>";
			var cust_phone = "<?php echo $cust_phone ?>";
			var cust_email = "<?php echo $cust_email ?>";
			var cust_address = "<?php echo $cust_address ?>";
			var cust_stu_id = "<?php echo $cust_stu_id ?>";
			var cust_driver_id = "<?php echo $cust_driver_id ?>";
			var cust_city = "<?php echo $cust_city ?>";
			var cust_state = "<?php echo $cust_state ?>";
			var cust_zip = "<?php echo $cust_zip ?>";

			$("#cust_fname").val(cust_fname);
			$("#cust_lname").val(cust_lname);
			$("#cust_phone").val(cust_phone);
			$("#cust_email").val(cust_email);
			$("#cust_address").val(cust_address);
			$("#cust_stu_id").val(cust_stu_id);
			$("#driver_id").val(cust_driver_id);
			$("#cust_city").val(cust_city);
			$("#cust_state").val(cust_state);
			$("#cust_zip").val(cust_zip);
		</script>


</body>
</html>
<?php
}
    ?>
