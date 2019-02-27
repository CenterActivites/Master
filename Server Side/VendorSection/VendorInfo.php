<?php
	function InfoVendor()
	{
		$ven_name = strip_tags($_POST['ven_name']);
		$ven_id = strip_tags($_POST['ven_id']);
?>
<html>
	<head>

		<link rel="stylesheet" type="text/css" href="../VendorSection/ven_css/ven_main_menu.css"/>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'ven_names',
					name: 'edit_ven_name'
				}).appendTo('#ven_info_form');
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'ven_phone',
					name: 'edit_ven_phone'
				}).appendTo('#ven_info_form');
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'ven_id',
					name: 'edit_ven_id'
				}).appendTo('#ven_info_form');
			});
		</script>

		<script type="text/javascript">
				$(function(){
					var ven_id = "<?php echo $ven_id ?>";
					var table = document.getElementById('vendor_info').rows[1].cells.item(1).innerHTML;
					var table3 = document.getElementById('vendor_info').rows[1].cells.item(0).innerHTML;
					
					$("#ven_names").val(table3);
					$("#ven_phone").val(table);
					$("#ven_id").val(ven_id);
				});
		</script>
		
<?php
		$lvl_access = strip_tags($_SESSION['lvl_access']);
		if($lvl_access == "4" || $lvl_access == "3" || $lvl_access == "2")
		{
			$lvl_2 = "type = 'submit'";	
			$disabled_2="";
		}
		else
		{
			$lvl_2 = "type = 'hidden'";
			$disabled_2="disabled";
		}
?>

	</head>
	<body>
	    <fieldset id='fieldset_label' style="margin-left:auto; margin-right:auto; border:none;">
			<label id='header_for_table' style="font-size: 30px;">Vendor Information</label>
		</fieldset> </br>
			<form method ="post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="ven_table_form">
				<fieldset style="border:none;">
					<table name="vendor_info" id="vendor_info" required >
						<tr>
							<th>
								Vendor's Name
							</th>
							<th>
								Vendor's Phone
							</th>
							<th>
								Vendor's Address
							</th>
						</tr>
<?php
					$username = strip_tags($_SESSION['username']);  //We grab the username and password the user input and logs the user in with the inputs
					$password = strip_tags($_SESSION['password']);
					$conn = hsu_conn_sess($username, $password);
				
					foreach($conn->query("SELECT ven_name, ven_phone, ven_street_address, ven_city, ven_state, ven_zip_code
											FROM Vendor
											WHERE ven_id = '$ven_id'") as $row)
					{
						$cur_ven_name = $row["ven_name"];
						$cur_ven_phone = $row["ven_phone"];
						$cur_ven_street_address = $row["ven_street_address"];
						$cur_ven_city = $row["ven_city"];
						$cur_ven_state = $row["ven_state"];
						$cur_ven_zip = $row["ven_zip_code"];
?>
						<tr>
							<td> <?=$cur_ven_name?> </td>
							<td> <?=$cur_ven_phone?> </td>
							<td> <?=$cur_ven_street_address?>&nbsp;<?=$cur_ven_city?>,&nbsp;<?=$cur_ven_state?>
									&nbsp;<?=$cur_ven_zip?> </td>
						</tr>
<?php
					}
?>
						</table>
					</fieldset>
				</form>
		<div>
	    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="ven_info_form">
		    <fieldset style="border:none;">
	            <input type="submit" name="back" id="back" value="Back" /> &nbsp;&nbsp;
		        <input <?= $lvl_2 ?> name="editVen" id="editVen" value="Edit Vendor" <?= $disabled_2 ?>/>
		    </fieldset>
		  </form>
	  </div>
	</body>
</html>
<?php
	$conn = null;
	}
?>
