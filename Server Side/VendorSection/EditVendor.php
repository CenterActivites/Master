<?php

	function EditVendor()
	{
		$ven_id = strip_tags($_POST['ven_id']);
		$_SESSION['ven_id'] = $ven_id;
		
		//Connecting to the Database
        $conn = hsu_conn_sess();
		
		$ven_info = $conn->prepare("SELECT ven_name, ven_phone, ven_street_address, ven_city, ven_state, ven_zip_code
										FROM Vendor
										WHERE ven_id = :a");
		$ven_info->bindValue(':a', $ven_id, PDO::PARAM_INT);
		$ven_info->execute();
		$ven_info = $ven_info->fetchAll();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../VendorSection/ven_css/ven_main_menu.css"/>
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
	<script>
	
		function remove(){
			if(confirm("You are about to delete a Vendor")){
				return true;
			}else{
				return false;
			}
		}
		
		var ven_name = "<?php echo $ven_info[0]['ven_name'] ?>";
		var ven_phone = "<?php echo $ven_info[0]['ven_phone'] ?>";
		var ven_street_address = "<?php echo $ven_info[0]['ven_street_address'] ?>";
		var ven_city = "<?php echo $ven_info[0]['ven_city'] ?>";
		var ven_state = "<?php echo $ven_info[0]['ven_state'] ?>";
		var ven_zip = "<?php echo $ven_info[0]['ven_zip_code'] ?>";
		
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


</html>


<?php
	}
?>
