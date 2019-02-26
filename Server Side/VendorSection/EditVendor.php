<?php

	function EditVendor()
	{
		$edit_ven_name = strip_tags($_POST['edit_ven_name']);
		$edit_ven_phone = strip_tags($_POST['edit_ven_phone']);
		$edit_ven_address = strip_tags($_POST['edit_ven_address']);
		$edit_ven_id = strip_tags($_POST['edit_ven_id']);
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
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'change_ven_id',
					name: 'change_ven_id'
				}).appendTo('#ven_info_change');
			});
		</script>

		<script type="text/javascript">
			var ven_name = "<?php echo $edit_ven_name?>";
			var ven_phone = "<?php echo $edit_ven_phone?>";
			var ven_address = "<?php echo $edit_ven_address?>";
			var ven_id = "<?php echo $edit_ven_id?>";

			$(document).ready(function(){
				$('#ven_name_edit').val(ven_name);
				$('#ven_loc_edit').val(ven_address);
				$('#ven_phone_edit').val(ven_phone);
				$('#change_ven_id').val(ven_id);
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
							<input type = "text" name = "ven_name_edit" id = "ven_name_edit" value ="" />
						</td>
					</tr>
					
					<tr>
						<th>
							Phone Number:
						</th>
						<td>
							<input type = "text" name = "ven_loc_edit" id = "ven_loc_edit" value ="" />
						</td>
					</tr>
					
					<tr>
						<th>
							Location: 
						</th>
						<td>
							<input type = "text" name = "ven_phone_edit" id = "ven_phone_edit" value ="" />
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
