<?php

	function EditEmployee()
	{
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../EmployeeSection/empl_css/empl_edit.css"/>

<?php
	$empl_id = $_POST['empl_id'];
	
	//Connecting to the Database
	$conn = hsu_conn_sess();
	
	//Does a select sql statement to grab all transactions that is involved with the selected customer
	$empl_infor = $conn->prepare("SELECT empl_fname, empl_lname, phone_num, empl_email, access_lvl, title
								FROM Employee
								WHERE empl_id = :a");
					
	$empl_infor->bindValue(':a', $empl_id, PDO::PARAM_INT);
	$empl_infor->execute();
	$empl_infor_display = $empl_infor->fetchAll();
	
?>
</head>
<body>
	<fieldset id='fieldset_label' style="border:none; text-align: center;">
		<label id='header_for_table' style="font-size: 25px">  Edit <?= $$empl_infor_display[0]['empl_fname'] ?> <?= $$empl_infor_display[0]['empl_lname'] ?>'s Information </label>
	</fieldset>
	</br>

    <div id ='edit_cust'>
		<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="edit_cust_form">
			<fieldset id='first_name_feild'>
				<lable id='all_lable'>First Name:</lable></br>
				<input type = "text" name = "empl_fname" id = "empl_fname" value ="<?= $empl_infor_display[0]['empl_fname'] ?>" /><br/>
			</fieldset>
	
			<fieldset id='last_name_field'>
				<lable id='all_lable'>Last Name:</lable></br>
				<input type = "text" name = "empl_lname" id = "empl_lname" value ="<?= $empl_infor_display[0]['empl_lname'] ?>" /><br/>
			</fieldset></br>

			<fieldset id='phone_num_field'>
				<lable id='all_lable'>Phone Number:</lable></br>
				<input type = "text" name = "phone_num" id = "phone_num" value ="<?= $empl_infor_display[0]['phone_num'] ?>" /><br/>
			</fieldset>

			<fieldset id='email_field'>
				<lable id='all_lable'>Email:</lable></br>
				<input type = "text" name = "empl_email" id = "empl_email" value ="<?= $empl_infor_display[0]['empl_email'] ?>" /><br/>
			</fieldset></br>

			<fieldset id='title_field'>
				<lable id='all_lable'>Title:</lable></br>
				<input type = "text" name = "title" id = "title" value ="<?= $empl_infor_display[0]['title'] ?>" /><br/>
			</fieldset>

			<fieldset id='access_lvl_field'>
				<lable id='all_lable'>Level of Access:</lable></br>
				<select name = "access_lvl" id="access_lvl" size="1" required>
					<option value = "1"> 1 </option>
					<option value = "2"> 2 </option>
					<option value = "3"> 3 </option>
					<option value = "4"> 4 </option>
				</select>
			</fieldset></br>
					
				</br></br></br></br></br></br></br></br></br></br></br></br></br></br>

			<fieldset id='buttons' style="border:none;">
				<input type="hidden" name="selected_empl_id" id="selected_empl_id" value="<?= $empl_id ?>" />
				<input type="submit" name="updateEmpl" id="updateEmpl" value="Update Employee" />
				<input type="submit" name="removeEmpl" id="removeEmpl" value="Remove Employee" onclick="return remove()" /><br />
				<input type="submit" name="cancelOnEditEmpl" id="cancelOnEditEmpl" value="Cancel" onclick="back()"/><br />
			</fieldset>
		</form>
	</div>
	
</body>

	<script type="text/javascript">
			function back(){
				var historyObj = window.history;
				historyObj.back();
			}
	</script>

	<script type="text/javascript">
	function remove(){
		if(confirm("You are about to remove a Employee")){
			return true;
		}else{
			return false;
		}
	}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			var access_lvl = "<?php echo $empl_infor_display[0]['access_lvl']?>";
			$("#access_lvl").val(access_lvl);
		});
	</script>

</html>
<?php
}
    ?>
