<?php

	function EditItem()
	{
		//Connecting to the Database
		$conn = hsu_conn_sess();
	
		$item_backid = strip_tags($_POST["item_id"]);
		$item_name = strip_tags($_POST["item_name"]);
		$item_frontid = strip_tags($_POST["item_Frontid"]);
		$item_size = strip_tags($_POST["item_size"]);
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/item_edit.css"/>

</head>
<body>



<?php
//query for selevted data in Items table
foreach($conn->query("SELECT stat_id, loc_name, pur_price, ven_id, dbw_own, pur_date, vin_num, public, inv_id
						FROM Item A, Location B
						WHERE A.loc_id = B.loc_id and item_Backid = '$item_backid'") as $row)

						{
							$curr_stat_id = $row["stat_id"];
							$curr_item_location = $row["loc_name"];
							$curr_item_pur_price = $row["pur_price"];
							$curr_item_ven_id = $row["ven_id"];
							$curr_dbw_own = $row["dbw_own"];
							$curr_item_pur_date = $row["pur_date"];
							$curr_item_vin_num = $row["vin_num"];
							$curr_pub_use = $row["public"];
							$curr_inv_id = $row["inv_id"];
						}


?>
		<h1>Edit Item Information</h1>
		<div id = "form_div">
			<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="edit_inv_form">
	
				<table id='edit_table' name='edit_table'>
				
					<tr>
						<td>
							<label>Front ID</label></br>
							<input type = "text" name = "curr_item_Frontid" id = "curr_item_Frontid" value ="<?= $item_frontid ?>" />
						</td>
						<td>
							<label>Item Model</label></br>
							<input type = "text" name = "curr_item_name" id = "curr_item_name" value ="<?= $item_name ?>" />
						</td>
					</tr>
					
					<tr>
						<td>
							<label>Item Size</label></br>
							<input type = "text" name = "curr_item_size" id = "curr_item_size" value ="<?= $item_size ?>" />
						</td>
						<td>
							<label>Status of Item</label></br>
							<select name="status" id="status" size="1"  required >
<?php
							foreach($conn->query("SELECT  stat_id, stat_name
													FROM Status
													ORDER BY stat_name") as $row)
							{
								$cur_stat_name = $row["stat_name"];
								$cur_stat_id = $row["stat_id"];
								
								$item_status = "";
								if($curr_stat_id == $cur_stat_id)
								{
									$item_status = "selected";
								}
								// what I need to do is get the original status of the item to fill this box.
?>
								<option id ='statinf' value ="<?= $cur_stat_id ?>" <?=$item_status?>> <?=$cur_stat_name?> </option>
<?php
							}
?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							<label>Item Classification</label></br>
							<select name="Classification" id="Classification" size="1" required>
<?php
								foreach($conn->query("SELECT  inv_id, inv_name
														FROM Inventory
														ORDER BY inv_name") as $row)
								{
									$cur_inv_name = $row["inv_name"];
									$cur_inv_id = $row["inv_id"];
									
									$inv_selection = "";
									if($curr_inv_id == $cur_inv_id)
									{
										$inv_selection = "selected";
									}
?>
									<option id ='Classification_op' value ="<?= $cur_inv_id ?>" <?=$inv_selection?>> <?=$cur_inv_name?> </option>
<?php
								}
?>
							</select>
						</td>
						<td>
							<label>Location</label></br>
							<select name="curr_item_loc" id="curr_item_loc" size="1" required>
<?php
								foreach($conn->query("SELECT  loc_id, loc_name
														FROM Location") as $row)
								{
									$cur_loc_name = $row["loc_name"];
									$cur_loc_id = $row["loc_id"];
									if($curr_item_location == $cur_loc_name)
									{
?>
										<option value ="<?= $cur_loc_id ?>" selected='selected'> <?=$cur_loc_name?> </option>
<?php
									}
									else
									{
?>
										<option value ="<?= $cur_loc_id ?>"> <?=$cur_loc_name?> </option>
<?php
									}
								}
?>
							</select>
						</td>
					
					</tr>
					
					<tr>
						<td>
							<label>Purchase Price/Deposit</label></br>
							<input type = "text" name = "curr_item_pur_price" id = "curr_item_pur_price" value ="<?=$curr_item_pur_price ?>" />
						</td>
						<td>
							<label>Purchased From Vendor</label></br>
							<select name = "ven" id="ven" size="1" required>
<?php
								// Vendor info query
								foreach($conn->query("SELECT  ven_id, ven_name
														FROM Vendor") as $row)
								{
									$cur_ven_name = $row["ven_name"];
									$cur_ven_id = $row["ven_id"];
									
									$ven_selection = "";
									if($curr_item_ven_id == $cur_ven_id)
									{
										$ven_selection = "selected";
									}
?>
									<option id ='statinf' value ="<?= $cur_ven_id ?>" <?=$ven_selection?>> <?=$cur_ven_name?> </option>
<?php
								}
?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>
							<label>Owned by DBW</label></br>
							<select name = "dbw_own" id="dbw_own" size="1" required>
<?php
								if($curr_dbw_own == 1)
								{
									$yes_DBW_own = "selected";
									$no_DBW_own = "";
								}
								else
								{
									$no_DBW_own = "selected";
									$yes_DBW_own = "";
								}
?>														
								<option value = "0"> No </option>
								<option value = "1"> Yes </option>
							</select>
						</td>
						<td>
							<label>Date Bought</label></br>
							<input type = "text" name = "curr_item_pur_data" id = "curr_item_pur_date" value ="<?= $curr_item_pur_date ?>"  onfocus="(this.type='date')" onblur="(this.type='text')" />
						</td>
					</tr>
					
					<tr>
						<td>
							<label>Vin Number</label></br>
							<input type = "text" name = "curr_item_vin_num" id = "curr_item_vin_num" value ="<?= $curr_item_vin_num ?>" />
						</td>
						<td>
							<label>Public Use</label></br>
							<select name = "pub_use" id="pub_use" size="1" required>
<?php
								if($curr_pub_use == 1)
								{
									$yes_pub_use = "selected";
									$no_pub_use = "";
								}
								else
								{
									$no_pub_use = "selected";
									$yes_pub_use = "";
								}
?>														
								<option value = "0" <?=$yes_pub_use?>> No </option>
								<option value = "1" <?=$no_pub_use?>> Yes </option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td colspan="2">
							<label>Notes</label></br>
							<input type = "text" name = "curr_item_notes" id = "curr_item_notes" value ="" />
						</td>
					</tr>
				
				</table>
				
				<div id = "button_div">
					<fieldset id=sub_buttons>
						<input type="submit" name="updateItem" id="updateItem" value="Update Item" />
						  <input type="submit" name="removeItem" id="removeItem" value="Remove Item" onclick="return remove()" /><br />
						<input type="submit" name="cancelEdit" id="cancelEdit" value="Cancel"/><br />
					</fieldset>
			</form>
				</div>
		</div>
</body>

	<script type="text/javascript">
	//creates an object for item_backid
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'item_Backid',
				name: 'item_Backid'
			}).appendTo('#edit_inv_form');
		});
	</script>

	<script type="text/javascript">
	// When the document is ready this fucntion appends the value of the item_backid to item_backid object
		$(document).ready(function(){
			var item_Backid = "<?php echo $item_backid ?>";
			$('#item_Backid').val(item_Backid);
		});
	</script>


	<script type="text/javascript">
	//creates an input object for stat_id
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'stat_id',
				name: 'stat_id'
			}).appendTo('#edit_inv_form');
		});
	</script>

	<script type="text/javascript">
	// when doc is ready append the value to stat_id object
		$(document).ready(function(){
			$('#status').ready(function(){
				var stat_id = $('#status').val();
				$("#stat_id").val(stat_id);
			});
		});
	</script>


	<script type="text/javascript">
	//when value is changed apply that changed vlaue to the input object
		$(document).ready(function(){
			$('#status').click(function(){
				var stat_id = $('#status').val();
				$("#stat_id").val(stat_id);
			});
		});
	</script>

	<script type="text/javascript">
	// creates an input object for dbw_id
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'dbw_id',
				name: 'dbw_id'
			}).appendTo('#edit_inv_form');
		});
	</script>

	<script type="text/javascript">
	// when doc is ready appends current value to the input for dbw_own
		$(document).ready(function(){
			$('#dbw_own').ready(function(){
				var dbw_own = $('#dbw_own').val();
				$("#dbw_id").val(dbw_own);
			});
		});
	</script>


	<script type="text/javascript">
	//on click when value has changed append the new value to the dbw_own object
		$(document).ready(function(){
			$('#dbw_own').click(function(){
				var dbw_own = $('#dbw_own').val();
				$("#dbw_id").val(dbw_own);
			});
		});
	</script>

	<script type="text/javascript">
	// creates a pub_id input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'pub_id',
				name: 'pub_id'
			}).appendTo('#edit_inv_form');
		});
	</script>

	<script type="text/javascript">
	// when doc is ready append current value to the pub_id object
		$(document).ready(function(){
			$('#pub_use').ready(function(){
				var pub_use = $('#pub_use').val();
				$("#pub_id").val(pub_use);
			});
		});
	</script>

	<script type="text/javascript">
	//onclick when value has changed append the new value to pub_id object
		$(document).ready(function(){
			$('#pub_use').click(function(){
				var pub_use = $('#pub_use').val();
				$("#pub_id").val(pub_use);
			});
		});
	</script>

	<script type="text/javascript">
	//makes ven_id input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'ven_id',
				name: 'ven_id'
			}).appendTo('#edit_inv_form');
		});
	</script>

	<script type="text/javascript">
	//when doc is ready append value to ven_id object
		$(document).ready(function(){
			$('#ven').ready(function(){
				var ven_id = $('#ven').val();
				$("#ven_id").val(ven_id);
			});
		});
	</script>

	<script type="text/javascript">
	//on click when value has changed append value to the ven_id object
		$(document).ready(function(){
			$('#ven').click(function(){
				var ven_id = $('#ven').val();
				$("#ven_id").val(ven_id);
			});
		});
	</script>

	<script type="text/javascript">
	//makes ven_id input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'inv_id',
				name: 'inv_id'
			}).appendTo('#edit_inv_form');
		});
	</script>

	<script type="text/javascript">
	//when doc is ready append value to ven_id object
		$(document).ready(function(){
			$('#Classification').ready(function(){
				var inv_id = $('#Classification').val();
				$("#inv_id").val(inv_id);
			});
		});
	</script>

	<script type="text/javascript">
	//on click when value has changed append value to the ven_id object
		$(document).ready(function(){
			$('#Classification').click(function(){
				var inv_id = $('#Classification').val();
				$("#inv_id").val(inv_id);
			});
		});
	</script>

	<script type="text/javascript">
		// purpose: check and set the option to it's correct setting
		$(document).ready(function(){
			var curr_pub = "<?php echo $curr_pub_use ?>";
			if(curr_pub == 0){
				$("#pub_use").val(curr_pub);
			}else if(curr_pub == 1){
				$("#pub_use").val(curr_pub);
			}
		});
	</script>

	<script type="text/javascript">
		// purpose: check and set the option to it's correct setting
		$(document).ready(function(){
			var curr_dbw = "<?php echo $curr_dbw_own ?>";
			if(curr_dbw == 0){
				$("#dbw_own").val(curr_dbw);
			}else if(curr_dbw == 1){
				$("#dbw_own").val(curr_dbw);
			}
		});
	</script>

	<script type="text/javascript">
		// purpose: appends current value to the curr_stat object
		$(document).ready(function(){
			var curr_stat = "<?php echo $curr_stat_id ?>";
			$("#status").val(curr_stat);
		});
	</script>

	<script type="text/javascript">
		// purpose: appends current value to the curr_ven object
		$(document).ready(function(){
			var curr_ven = "<?php echo $curr_ven_id ?>";
			$("#ven").val(curr_ven);
		});
	</script>

	<script type="text/javascript">
		// purpose: appends current value to the curr_ven object
		$(document).ready(function(){
			var curr_inv = "<?php echo $curr_inv_id ?>";
			$("#Classification").val(curr_inv);
		});
	</script>

	<script type="text/javascript">
		function remove(){
			var item_name = "<?php echo $item_name ?>";
			if(confirm("You're about to delete " + item_name + ". Continue?")){
				return true;
			}else{
				return false;
			}
		}
	</script>
	
	<!-- Hover function for the selects -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#dbw_own, #pub_use, #ven, #Classification, #status").hover(function(){
				$(this).attr('size', 
			  $('option').length);
			}, function() {
				$(this).attr('size', 1);
			});
		});
	</script>

</html>

<?php
// closes connection the the database
$conn = null;
	}
?>
