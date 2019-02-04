<?php

	function EditCustomer()
	{
		$cust_id = strip_tags($_POST['cust_id']);
		$cust_fname = strip_tags($_POST['cust_fname']);
		$cust_lname = strip_tags($_POST['cust_lname']);
		$cust_phone = strip_tags($_POST['cust_phone']);
		$cust_email = strip_tags($_POST['cust_email']);
		$cust_emerg_contact = strip_tags($_POST['cust_emerg_contact']);
		$cust_address = strip_tags($_POST['cust_address']);
		$cust_is_student = strip_tags($_POST['cust_is_student']);
		$cust_stu_id = strip_tags($_POST['cust_stu_id']);
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
    <div id="pageHeader"> Edit <?= $cust_fname ?> <?= $cust_lname ?>'s Information</div>
	</br>
    <div id ='edit_cust'>
				<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="edit_cust_form">
					<fieldset id='first_name_feild'>
						<lable id='all_lable'>First Name:</lable></br><input type = "text" name = "cust_fname" id = "cust_fname" value ="" /><br/>
					</fieldset>
					<fieldset id='last_name_field'>
						<lable id='all_lable'>Last Name:</lable></br><input type = "text" name = "cust_lname" id = "cust_lname" value ="" /><br/>
					</fieldset></br>
					<fieldset id='stu_stat_field'>
						<lable id='all_lable'>Student Status:</lable></br><select name = "is_student" id="is_student" size="1" required>
																<option value = "No"> No </option>
																<option value = "Yes"> Yes </option>
														</select><br/>
					</fieldset>
					<fieldset id='empl_stat_field'>
						<lable id='all_lable'>Employee Status:</lable></br><select name = "empl_stat" id="empl_stat" size="1" required>
																<option value = "No"> No </option>
																<option value = "Yes"> Yes </option>
														</select>
					</fieldset></br>
					<fieldset id='dob_field'>
						<lable id='all_lable'>Student ID:</lable></br><input type = "text" name = "cust_stu_id" id = "cust_stu_id" value ="" /><br/>
					</fieldset>
					<fieldset id='phone_num_field'>
						<lable id='all_lable'>Phone Number:</lable></br><input type = "text" name = "cust_phone" id = "cust_phone" value ="" /><br/>
					</fieldset></br>
					<fieldset id='email_field'>
						<lable id='all_lable'>Email Address:</lable></br><input type = "text" name = "cust_email" id = "cust_email" value ="" /><br/>
					</fieldset>
					<fieldset id='emerg_contact_field'>
						<lable id='all_lable'>Emergency Contact Number:</lable></br><input type = "text" name = "emerg_contact" id = "emerg_contact" value ="" /><br/>
					</fieldset></br>
					<fieldset id='address_field'>
						<lable id='all_lable'>Address:</lable></br><input type = "text" name = "cust_address" id = "cust_address" value ="" /><br/>
					</fieldset>


				</br>

					<feildset id='buttons'>
					<input type="submit" name="updateCust" id="updateCust" value="Update Customer" />
					<input type="submit" name="removeCust" id="removeCust" value="Remove Customer" onclick="return remove()" /><br />
					<input type="submit" name="cancelOnEditCust" id="cancelOnEditCust" value="Cancel" onclick="back()"/><br />
				</feildset>
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
			$(document).ready(function(){
				var stu_stat = "<?php echo $cust_is_student?>";
					$("#is_student").val(stu_stat);
			});
		</script>


		<script type="text/javascript">
			var cust_fname = "<?php echo $cust_fname ?>";
			var cust_lname = "<?php echo $cust_lname ?>";
			var cust_phone = "<?php echo $cust_phone ?>";
			var cust_email = "<?php echo $cust_email ?>";
			var cust_emerg_contact = "<?php echo $cust_emerg_contact ?>";
			var cust_address = "<?php echo $cust_address ?>";
			var cust_stu_id = "<?php echo $cust_stu_id ?>";

			$("#cust_fname").val(cust_fname);
			$("#cust_lname").val(cust_lname);
			$("#cust_phone").val(cust_phone);
			$("#cust_email").val(cust_email);
			$("#emerg_contact").val(cust_emerg_contact);
			$("#cust_address").val(cust_address);
			$("#cust_stu_id").val(cust_stu_id);
		</script>


</body>
</html>
<?php
}
    ?>
