<?php

	function ItemInfo()
	{
		$item_backid = strip_tags($_POST["item_id"]);

?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/item_info.css"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<script type="text/javascript">
	// creates an input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'item_id',
				name: 'item_id'
			}).appendTo('#button');
			var item_id = "<?php echo $item_backid ?>"
			$('#item_id').val(item_id);
		});
	</script>

	<script type="text/javascript">
	// creates an input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'inv_name',
				name: 'inv_name'
			}).appendTo('#button');
		});
	</script>

	<script type="text/javascript">
	// creates an input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'cat_name',
				name: 'cat_name'
			}).appendTo('#button');
		});
	</script>

	<script type="text/javascript">
	// creates an input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'item_name',
				name: 'item_name'
			}).appendTo('#button');
		});
	</script>

	<script type="text/javascript">
	// creates an input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'item_Frontid',
				name: 'item_Frontid'
			}).appendTo('#button');
		});
	</script>

	<script type="text/javascript">
	// creates an input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'item_size',
				name: 'item_size'
			}).appendTo('#button');
		});
	</script>

	<script type="text/javascript">
	// creates an input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'item_status',
				name: 'item_status'
			}).appendTo('#button');
		});
	</script>

	<script type="text/javascript">
	// creates an input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'inv_id',
				name: 'inv_id'
			}).appendTo('#button');
		});
	</script>

	<script type="text/javascript">
	// creates an input object
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'notes',
				name: 'notes'
			}).appendTo('#button');
		});
	</script>

</head>
<body>
		<div id='page_header'>Item's Infromation</div>
	</br>
    <div id="main_div">
			<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="inv">
				<fieldset id = "holds_item_info">
						<div id="item_info">
	<?php
													$username = $_SESSION['username'];
													$password = $_SESSION['password'];
													$conn = hsu_conn_sess($username, $password);
													//Item query
													foreach($conn->query("SELECT item_Backid, A.inv_id, item_modeltype, inv_name, cat_name, item_Frontid, item_size, stat_name, location, notes, pur_price,pur_date,public,vin_num,dbw_own
																			FROM Item A, Inventory B, Category C, Status D
																			WHERE A.inv_id = B.inv_id and B.cat_id = C.cat_id and A.stat_id = D.stat_id and item_Backid = '$item_backid'") as $row)
													{
														$curr_item_backid = $row["item_Backid"];
														$curr_inv_id = $row["inv_id"];
														$curr_inv_name = $row["inv_name"];
														$curr_cat_name = $row["cat_name"];
														$curr_item_name = $row["item_modeltype"];
														$curr_item_frontid = $row["item_Frontid"];
														$curr_item_size = $row["item_size"];
														$curr_item_status = $row["stat_name"];
														$curr_item_location = $row["location"];
														$curr_item_pur_price = $row["pur_price"];
														$curr_item_pur_date = $row["pur_date"];
														$curr_item_public=$row["public"];
														$curr_item_vin_num=$row["vin_num"];
														$curr_item_dbw_own=$row["dbw_own"];
														$curr_item_notes = $row["notes"];


														if($curr_item_public == 1){
															$curr_item_public = "Yes";
														}else{
															$curr_item_public = "No";
														}

														if($curr_item_dbw_own == 1){
															$curr_item_dbw_own = "Yes";
														}else{
															$curr_item_dbw_own = "No";
														}
	?>
														<div id="scroll_me">
														 <table id = "Item_Status">
															  <tr>
															    <th>Item Category:</th>
															    <td class="editcol"><?=$curr_cat_name ?></td>
															  </tr>
															  <tr>
															    <th>Item Name:</th>
															    <td class="editcol"><?=$curr_inv_name?></td>
															  </tr>
															  <tr>
															    <th>Item ID:</th>
															    <td class="editcol"><?= $curr_item_frontid?></td>
															  </tr>
																<tr>
																 <th>Item Model:</th>
																 <td class="editcol"><?= $curr_item_name?></td>
															 </tr>
															 <tr>
																 <th>Item Size:</th>
																 <td class="editcol"><?= $curr_item_size?></td>
															 </tr>
															 <tr>
																 <th>Status Of Item:</th>
																 <td class="editcol"><?= $curr_item_status?></td>
															 </tr>
															 <tr>
																 <th>Location Of Item:</th>
																 <td class="editcol"><?= $curr_item_location?></td>
															 </tr>
															 <tr>
																 <th>Purchase Date:</th>
																 <td class="editcol"><?= $curr_item_pur_date?></td>
															 </tr>
															 <tr>
																 <th>Purchase Price:</th>
																 <td class="editcol"><?= $curr_item_pur_price?></td>
															 </tr>
															 <tr>
																 <th>Public Use:</th>
																 <td class="editcol"><?= $curr_item_public?></td>
															 </tr>
															 <tr>
																 <th>Vin Number:</th>
																 <td class="editcol"><?= $curr_item_vin_num?></td>
															 </tr>
															 <tr>
																 <th>Owned By DBW:</th>
																 <td class="editcol"><?= $curr_item_dbw_own?></td>
															 </tr>
															 <tr>
																 <th>Notes:</th>
																 <td class="editcol"><?= $curr_item_notes?></td>
															 </tr>
															</table>
														</div>
<?php
													}
	?>
				</div>

				</fieldset>
			</form>
		</br>

	<div id = "button_div">
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="button">
	    <fieldset id="info_buttons">
					  <input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" />
            <input type="submit" name="backoniteminfo" id="backoniteminfo" value="Back" /><br />
	        	<input type="submit" name="editItem" id="editItem" value="Edit Item" />
						<input type="submit" name="editInv" id="editInv" value="Edit Inventory" /><br />
	    </fieldset>
	</form>
    </div>
		</div>


		<script type="text/javascript">
		// appends all information from query to input objects
			$(document).ready(function(){
				var inv_name = "<?php echo $curr_inv_name ?>"
				var cat_name = "<?php echo $curr_cat_name?>"
				var item_name = "<?php echo $curr_item_name ?>"
				var front_id = "<?php echo $curr_item_frontid ?>"
				var item_size= "<?php echo $curr_item_size ?>"
				var item_status= "<?php echo $curr_item_status ?>"
				var inv_id= "<?php echo $curr_inv_id ?>"
				var notes= "<?php echo $curr_item_notes ?>"


				$('#inv_name').val(inv_name);
				$('#cat_name').val(cat_name);
				$('#item_name').val(item_name);
				$('#item_Frontid').val(front_id);
				$('#item_size').val(item_size);
				$('#item_status').val(item_status);
				$('#inv_id').val(inv_id);
				$('#notes').val(notes);
			});
		</script>
</body>
</html>


<?php
$conn=null;
	}
?>
