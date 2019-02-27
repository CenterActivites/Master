<?php

	function EditVendor()
	{
		$edit_ven_name = strip_tags($_POST['edit_ven_name']);
		$edit_ven_phone = strip_tags($_POST['edit_ven_phone']);
		$ven_id = strip_tags($_POST['edit_ven_id']);
		$_SESSION['ven_id'] = $ven_id;
		
		//We grab the username and password the user input and logs the user in with the inputs
		$username = strip_tags($_SESSION['username']);
        $password = strip_tags($_SESSION['password']);
        $conn = hsu_conn_sess($username, $password);
		
		$ven_address = $conn->prepare("SELECT ven_street_address, ven_city, ven_state, ven_zip_code
										FROM Vendor
										WHERE ven_id = :a");
		$ven_address->bindValue(':a', $ven_id, PDO::PARAM_INT);
		$ven_address->execute();
		$ven_address = $ven_address->fetchAll();
		
		$ven_street_address = $ven_address[0]['ven_street_address'];
		$ven_city = $ven_address[0]['ven_city'];
		$ven_state = $ven_address[0]['ven_state'];
		$ven_zip = $ven_address[0]['ven_zip_code'];
		
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../VendorSection/ven_css/ven_main_menu.css"/>

		<script>
			function remove(){
				if(confirm("You are about to delete a Vendor")){
					return true;
				}else{
					return false;
				}
			}
		</script>

		<script type="text/javascript">
			var ven_name = "<?php echo $edit_ven_name?>";
			var ven_phone = "<?php echo $edit_ven_phone?>";
			var ven_street_address = "<?php echo $ven_street_address?>";
			var ven_city = "<?php echo $ven_city?>";
			var ven_state = "<?php echo $ven_state?>";
			var ven_zip = "<?php echo $ven_zip?>";
			
			var ven_id = "<?php echo $edit_ven_id?>";

			$(document).ready(function(){
				$('#ven_name_edit').val(ven_name);
				$('#ven_loc_edit').val(ven_street_address);
				$('#ven_phone_edit').val(ven_phone);
				$('#ven_city').val(ven_city);
				$('#ven_state').val(ven_state);
				$('#ven_zip').val(ven_zip);
			});
		</script>


	</head>
<body>
    <fieldset id='fieldset_label' style="margin-left:auto; margin-right:auto; border:none;">
		<label id='header_for_table' style="font-size: 30px;">Editing Vendor Information</label>
	</fieldset> </br>
    <div id='ven_info_change_stuff'>
		<fieldset style="border:none;">
			<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id='ven_info_change'>
			
				<table id="editing_vendor">
					<tr>
						<th>
							Vendor:
						</th>
						<td>
							<input type = "text" name = "ven_name_edit" id = "ven_name_edit" value ="" maxlength="50" />
						</td>
					</tr>
					
					<tr>
						<th>
							Phone Number:
						</th>
						<td>
							<input type = "text" name = "ven_phone_edit" id = "ven_phone_edit" value ="" maxlength="16" />
						</td>
					</tr>
					
					<tr>
						<th>
							Street Address: 
						</th>
						<td>
							<input type = "text" name = "ven_loc_edit" id = "ven_loc_edit" value ="" maxlength="50" />
						</td>
					</tr>
					
					<tr>
						<th>
							City: 
						</th>
						<td>
							<input type = "text" name = "ven_city" id = "ven_city" value ="" maxlength="30" />
						</td>
					</tr>
					
					<tr>
						<th>
							State: 
						</th>
						<td>
							<input type = "text" name = "ven_state" id = "ven_state" value ="" maxlength="13" />
						</td>
					</tr>
					
					<tr>
						<th>
							ZIP Code: 
						</th>
						<td>
							<input type = "text" name = "ven_zip" id = "ven_zip" value ="" maxlength="10" />
						</td>
					</tr>
						
				</table>
				
				<input type="submit" name="updateVen" id="updateVen" value="Update Vendor" />
				<input type="submit" name="removeVen" id="removeVen" value="Remove Vendor" onclick="return remove()" /><br />
			</form>
			
			<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
				<input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
			</form>
		</fieldset>
    </div>
</body>
</html>


<?php
	}
?>
