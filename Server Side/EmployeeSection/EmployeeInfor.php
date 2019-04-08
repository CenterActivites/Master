<?php

	function EmployeeInfo()
	{
		$empl_id = (int)$_SESSION['empl_id'];
?>
<html>
	<head>

		<link rel="stylesheet" type="text/css" href="../EmployeeSection/empl_css/empl_info.css"/>

	</head>
	<body>
	    <fieldset id='fieldset_label' style="text-align: center; border:none;">
			<label id='header_for_table' style="font-size: 20px"> Employee's Information </label>
		</fieldset>
		<table id='empl_info_table'>
<?php
			//Connecting to the Database
			$conn = hsu_conn_sess();

			foreach($conn->query("SELECT empl_fname, empl_lname, phone_num, empl_email, access_lvl, title, user_n, pass_w
									FROM Employee
									WHERE empl_id = '$empl_id'") as $row)
			{
				$curr_empl_fname = $row["empl_fname"];
				$curr_empl_lname = $row["empl_lname"];
				$curr_empl_access_lvl = $row["access_lvl"];
				$curr_empl_title = $row["title"];
				$curr_empl_phone = $row["phone_num"];
				$curr_empl_email = $row["empl_email"];
				$curr_empl_user = $row["user_n"];
				$curr_empl_pass = $row["pass_w"];
?>
				<tr>
					<th>Employee First Name:</th>
					<td class="editcol"><?=$curr_empl_fname ?></td>
				</tr>
				<tr>
					<th>Employee Last Name:</th>
					<td class="editcol"><?=$curr_empl_lname ?></td>
				</tr>
				<tr>
					<th>Employee Phone Number</th>
					<td class="editcol"><?= $curr_empl_phone?></td>
				</tr>
				<tr>
					<th>Employee Email:</th>
					<td class="editcol"><?= $curr_empl_email?></td>
				</tr>
				<tr>
					<th>Employee Title:</th>
					<td class="editcol"><?=$curr_empl_title?></td>
				</tr>
				<tr>
					<th>Employee Access Level:</th>
					<td class="editcol"><?= $curr_empl_access_lvl?></td>
				</tr>
				<tr>
					<th>Employee Username:</th>
					<td class="editcol"><?= $curr_empl_user?></td>
				</tr>
				<tr>
					<th>Employee Password:</th>
					<td class="editcol"><?= $curr_empl_pass?></td>
				</tr>
<?php
			}
?>
		</table>
		</br>
		<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="button">
			<fieldset style="border:none">
				<input type="submit" name="viewAct" id="viewAct" value="View Employee's Actions" /><br />
				<input type="submit" name="editEmpl" id="editEmpl" value="Edit Employee" /><br />
				<input type="submit" name="back" id="back" value="Back" /><br />
			</fieldset>
		</form>
	</body>
	
		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'empl_id',
					name: 'empl_id'
				}).appendTo('#button');
				var empl_id_infor = "<?php echo $empl_id ?>";
				$("#empl_id").val(empl_id_infor);
			});
		</script>
</html>
<?php
		$conn = null;
	}
?>
