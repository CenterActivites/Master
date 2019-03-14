<?php

	function CustomerInfo()
	{
		$cust_id = strip_tags($_POST['cust_id']);
?>
<html>
	<head>

		<link rel="stylesheet" type="text/css" href="../CustomerselectionSection/cust_css/cust_info.css"/>

	</head>
	<body>
	    <fieldset id='fieldset_label' style="text-align: center; border:none;">
			<label id='header_for_table' style="font-size: 20px"> Customer Information </label>
		</fieldset>
		<table id='cust_info_table'>
<?php
		//Connecting to the Database
		$conn = hsu_conn_sess();

			foreach($conn->query("SELECT f_name, l_name, c_phone, c_email, c_street_addr, c_stu_id, is_employee, c_city, c_state, c_zip_code, c_driver_id
									FROM Customer
									WHERE cust_id = '$cust_id'") as $row)
			{
				$curr_cust_fname = $row["f_name"];
				$curr_cust_lname = $row["l_name"];
				$curr_cust_stu_id = $row["c_stu_id"];
				$curr_cust_driver_id = $row["c_driver_id"];
				$curr_cust_phone = $row["c_phone"];
				$curr_cust_email = $row["c_email"];
				$curr_cust_address = $row["c_street_addr"];
				$curr_cust_employee = $row["is_employee"];
				$curr_cust_city = $row["c_city"];
				$curr_cust_state = $row["c_state"];
				$curr_cust_zip = $row["c_zip_code"];
?>
				<tr>
					<th>Customer First Name:</th>
					<td class="editcol"><?=$curr_cust_fname ?></td>
				</tr>
				<tr>
					<th>Customer Last Name:</th>
					<td class="editcol"><?=$curr_cust_lname ?></td>
				</tr>
				<tr>
					<th>Customer Student ID:</th>
					<td class="editcol"><?=$curr_cust_stu_id?></td>
				</tr>
				<tr>
					<th>Customer Driver License ID:</th>
					<td class="editcol"><?= $curr_cust_driver_id?></td>
				</tr>
				<tr>
					<th>Customers Phone Number</th>
					<td class="editcol"><?= $curr_cust_phone?></td>
				</tr>
				<tr>
					<th>Customer Email:</th>
					<td class="editcol"><?= $curr_cust_email?></td>
				</tr>
				<tr>
					<th>Customer's Address:</th>
					<td class="editcol">
						<?=$curr_cust_address?>&nbsp;<?=$curr_cust_city?>,&nbsp;<?=$curr_cust_state?>
						&nbsp;<?=$curr_cust_zip?> 
					</td>
				</tr>
				<tr>
					<th>Employee Of Center Activities:</th>
					<td class="editcol"><?= $curr_cust_employee?></td>
				</tr>
<?php
			}
?>
		</table>
		</br>
		<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="button">
			<fieldset style="border:none">
				<input type="submit" name="viewTran" id="viewTran" value="View Transactions" /><br />
				<input type="submit" name="editCust" id="editCust" value="Edit Customer" /><br />
				<input type="submit" name="back" id="back" value="Back" /><br />
			</fieldset>
		</form>
	</body>
	
		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_id',
					name: 'cust_id'
				}).appendTo('#button');
				var cust_id_infor = "<?php echo $cust_id ?>";
				$("#cust_id").val(cust_id_infor);
			});
		</script>
		
		<script type="text/javascript">
			//Just an FYI, I did get carried away with jquery object creation.
			$(document).ready(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_fname',
					name: 'cust_fname'
				}).appendTo('#button');
				var cust_fname ="<?php echo $curr_cust_fname ?>";
				$("#cust_fname").val(cust_fname);
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_lname',
					name: 'cust_lname'
				}).appendTo('#button');
				var cust_lname = "<?php echo $curr_cust_lname?>";
				$("#cust_lname").val(cust_lname);
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_phone',
					name: 'cust_phone'
				}).appendTo('#button');
				var cust_phone = "<?php echo $curr_cust_phone ?>";
				$("#cust_phone").val(cust_phone);
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_email',
					name: 'cust_email'
				}).appendTo('#button');
				var cust_email = "<?php echo $curr_cust_email?>";
				$("#cust_email").val(cust_email);
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_address',
					name: 'cust_address'
				}).appendTo('#button');
				var cust_address = "<?php echo $curr_cust_address ?>";
				$("#cust_address").val(cust_address);
			});
		</script>
		
		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_city',
					name: 'cust_city'
				}).appendTo('#button');
				var cust_city = "<?php echo $curr_cust_city ?>";
				$("#cust_city").val(cust_city);
			});
		</script>
		
		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_state',
					name: 'cust_state'
				}).appendTo('#button');
				var curr_cust_state = "<?php echo $curr_cust_state ?>";
				$("#cust_state").val(curr_cust_state);
			});
		</script>
			
		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_zip',
					name: 'cust_zip'
				}).appendTo('#button');
				var cust_zip = "<?php echo $curr_cust_zip ?>";
				$("#cust_zip").val(cust_zip);
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_driver_id',
					name: 'cust_driver_id'
				}).appendTo('#button');
				var cust_driver_id = "<?php echo $curr_cust_driver_id ?>";
				$("#cust_driver_id").val(cust_driver_id);
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_stu_id',
					name: 'cust_stu_id'
				}).appendTo('#button');
				var cust_stu_id = "<?php echo $curr_cust_stu_id ?>";
				console.log(cust_stu_id);
				$("#cust_stu_id").val(cust_stu_id);
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'cust_is_employee',
					name: 'cust_is_employee'
				}).appendTo('#button');
				var cust_is_employee = "<?php echo $curr_cust_employee ?>";
				$("#cust_is_employee").val(cust_is_employee);
			});
		</script>
	
</html>
<?php
		$conn = null;
	}
?>
