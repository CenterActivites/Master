<?php

	function AddItems()
	{
		// connection to database
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$conn = hsu_conn_sess($username, $password);

?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/add_item2.css"/>

	<script type="text/javascript">
	//Creation of input object which holds stat_id value
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'stat_id',
				name: 'stat_id'
			}).appendTo('#item_input');
		});
	</script>


	<script type="text/javascript">
	//Creation of input object which holds inv_id value
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'inv_id',
				name: 'inv_id'
			}).appendTo('#item_input');
		});
	</script>

	<script type="text/javascript">
	//appends inventory id to inv_id object when the page loads
		$(document).ready(function(){
			$('#inventory').ready(function(){
				var inv = $('#inventory').val();
				$("#inv_id").val(inv);
			});
		});
	</script>


	<script type="text/javascript">
	//appends value to inv_id object when a click action happens
		$(document).ready(function(){
			$('#inventory').click(function(){
				var inv = $('#inventory').val();
				$("#inv_id").val(inv);
			});
		});
	</script>


	<script type="text/javascript">
	//appends inventory id to stat_id object when the page loads
		$(document).ready(function(){
			$('#status').ready(function(){
				var stat = $('#status').val();
				$("#stat_id").val(stat);
			});
		});
	</script>


	<script type="text/javascript">
	//appends value to stat_id object when a click action happens
		$(document).ready(function(){
			$('#status').click(function(){
				var stat = $('#status').val();
				$("#stat_id").val(stat);
			});
		});
	</script>


	<script type="text/javascript">
	//Creation of input object which holds ven_id value
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'ven_id',
				name: 'ven_id'
			}).appendTo('#item_input');
		});
	</script>


	<script type="text/javascript">
	//appends value to ven_id object the page loads
		$(document).ready(function(){
			$('#ven').ready(function(){
				var ven = $('#ven').val();
				$("#ven_id").val(ven);
			});
		});
	</script>


	<script type="text/javascript">
	//appends value to ven_id object when a click action happens
		$(document).ready(function(){
			$('#ven').click(function(){
				var ven = $('#ven').val();
				$("#ven_id").val(ven);
			});
		});
	</script>

	<script type="text/javascript">
	// creates an input field to hold DBW value
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'dbw',
				name: 'dbw'
			}).appendTo('#item_input');
		});
	</script>


	<script type="text/javascript">
	// on load appends of DBW to the dbw object
		$(document).ready(function(){
			$('#dbw_own').ready(function(){
				var dbw = $('#dbw_own').val();
				$("#dbw").val(dbw);
			});
		});
	</script>


	<script type="text/javascript">
	// on click appends the new selected value to the dbw object
		$(document).ready(function(){
			$('#dbw_own').click(function(){
				var dbw = $('#dbw_own').val();
				$("#dbw").val(dbw);
			});
		});
	</script>


	<script type="text/javascript">
	// creates an input field for pub value
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'pub',
				name: 'pub'
			}).appendTo('#item_input');
		});
	</script>


	<script type="text/javascript">
	// on load appends the value of pub to the pub object
		$(document).ready(function(){
			$('#pub_use').ready(function(){
				var dbw = $('#pub_use').val();
				$("#pub").val(dbw);
			});
		});
	</script>


	<script type="text/javascript">
	// on click updates the pub value with a new value
		$(document).ready(function(){
			$('#pub_use').click(function(){
				var dbw = $('#pub_use').val();
				$("#pub").val(dbw);
			});
		});
	</script>

</head>
<body>

    <div id="pageHeader"> Adding New Items </div>
    <div>
        <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id = "item_input">
	        <input type = "text" name = "new_front_id" id = "new_front_id" placeholder="Item Front Desk ID"/>
					<input type = "text" name = "new_item_name" id = "new_item_name" placeholder="Item Model"/>
					<input type = "text" name = "new_size" id = "new_size" placeholder="Item's Size"/><br/>
					<select name="inventory" id="inventory" size="1" required placeholder="Inventory Classification" >
								 <option id="blank" value = "" disabled="disabled">Select An Inventory Class</option>
					<?php
						//inventory query
									foreach($conn->query("SELECT  inv_id, inv_name
															FROM Inventory") as $row)
									{
										$cur_inv_name = $row["inv_name"];
										$cur_inv_id = $row["inv_id"];
					?>

								<option id ='invinf' value ="<?= $cur_inv_id ?>"> <?=$cur_inv_name?> </option>

					<?php
									}
					?>
									</select>
					  <select name="status" id="status" size="1" required>
						 <option id="blank2" value = "" disabled="disabled">Select Item Status</option>
					<?php
						// status query
									foreach($conn->query("SELECT  stat_id, stat_name
															FROM Status") as $row)
									{
										$cur_stat_name = $row["stat_name"];
										$cur_stat_id = $row["stat_id"];
					?>
								<option id ='statinf' value ="<?= $cur_stat_id ?>"> <?=$cur_stat_name?> </option>

					<?php
									}
					?>
									</select>
				  <input type = "text" name = "new_location" id = "new_location" placeholder="Location of Item"/><br/>
					<input type = "text" name = "new_purchase_price" id = "new_purchase_price" placeholder="Purchase Price"/>
					<select name="ven" id="ven" size="1"  required>
						<option id="blank3" value=""disabled="disabled">Select Item Vendor</option>
					<?php
					//vendor query
									foreach($conn->query("SELECT  ven_id, ven_name
															FROM Vendor") as $row)
									{
										$cur_ven_name = $row["ven_name"];
										$cur_ven_id = $row["ven_id"];
					?>
								<option id ='statinf' value ="<?= $cur_ven_id ?>"> <?=$cur_ven_name?> </option>

					<?php
									}
					?>
									</select>
					<select name = "dbw_own" id="dbw_own" size="1" required >
														<option value = "" disabled="disabled">Owned by DBW</option>
														<option value = "0"> No </option>
														<option value = "1"> Yes </option>
												</select></br>
					<input type="text" name ="new_purchase_date" id = "new_purchase_date" placeholder="Purchase Date" onfocus="(this.type='date')" onblur="(this.type='text')" />
					<input type = "text" name = "new_vin" id = "new_vin" placeholder="Vin Number"/>
	        <select name = "pub_use" id="pub_use" size="1" required>
																			<option value="" disabled="disabled">Select Public Usage</option>
																			<option value = "0"> No </option>
																			<option value = "1"> Yes </option>
																	</select></br>
	        <input type = "text" name = "new_notes" id = "new_notes" placeholder="Notes"/>
			<fieldset style="border:none">
				<input type="submit" name="add2" id="add2" value="Add" onclick="return is_blank()"/>

		</form>
		<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id = "item_input">
			<input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
		</form>
		</fieldset>
    </div>
</body>
</html>


<?php
// cloes the database connection
	$conn = null;
	}
?>
