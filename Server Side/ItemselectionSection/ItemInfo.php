<?php

	function ItemInfo()
	{
		$item_backid = strip_tags($_POST["item_id"]);

?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/item_info.css"/>
	
<?php
	$lvl_access = strip_tags($_SESSION['lvl_access']);
	if($lvl_access == "4" || $lvl_access == "3")
	{
		$lvl_3 = "type = 'submit'";
		$disabled_3="";
	}
	else
	{
		$lvl_3 = "type = 'hidden'";
		$disabled_3="disabled";
	}
	
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
		<div id='page_header'>Item's Information</div>
	</br>
    <div id="main_div">
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="inv">
			<fieldset id = "holds_item_info">
				<div id="item_info">
<?php
					//Connecting to the Database
					$conn = hsu_conn_sess();
					
					//Item query
					foreach($conn->query("SELECT item_Backid, A.inv_id, item_modeltype, inv_name, cat_name, item_Frontid, item_size, stat_name, loc_name, pur_price,pur_date,public,vin_num,dbw_own
											FROM Item A, Inventory B, Category C, Status D, Location E
											WHERE A.inv_id = B.inv_id and B.cat_id = C.cat_id and A.stat_id = D.stat_id and A.loc_id = E.loc_id and item_Backid = '$item_backid'") as $row)
					{
						$curr_item_backid = $row["item_Backid"];
						$curr_inv_id = $row["inv_id"];
						$curr_inv_name = $row["inv_name"];
						$curr_cat_name = $row["cat_name"];
						$curr_item_name = $row["item_modeltype"];
						$curr_item_frontid = $row["item_Frontid"];
						$curr_item_size = $row["item_size"];
						$curr_item_status = $row["stat_name"];
						$curr_item_location = $row["loc_name"];
						$curr_item_pur_price = $row["pur_price"];
						$curr_item_pur_date = $row["pur_date"];
						$curr_item_public=$row["public"];
						$curr_item_vin_num=$row["vin_num"];
						$curr_item_dbw_own=$row["dbw_own"];

						$number_of_use = $conn->prepare("select count(itemtran_id)
															from Item A, Transaction B, ItemTran C
															where A.item_Backid = C.item_Backid and B.trans_id = C.tran_id and B.trans_type = 'return' and C.item_Backid = :a");
						$number_of_use->bindValue(':a', $item_backid, PDO::PARAM_INT);
						$number_of_use->execute();
						$number_of_use = $number_of_use->fetchAll();
						$curr_number_of_use = $number_of_use[0][0];
						
						$notes = $conn->prepare("select note
													from Notes a, NotesItem b
													where a.note_id = b.note_id and b.item_Backid = :a");
						$notes->bindValue(':a', $item_backid, PDO::PARAM_INT);
						$notes->execute();
						$notes = $notes->fetchAll();


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
							<table id = "Item_Status" style="float: left;">
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
									<th>Number of Usage:</th>
										<td class="editcol"><?= $curr_number_of_use?></td>
								</tr>
								<tr>
									<th>Notes:</th>
										<td class="editcol">
<?php
											if($notes != null || $notes != "")
											{
												foreach($notes as $note)
												{
													echo $note["note"];
													echo "</br>";
												}
											}
?>
										</td>
								</tr>
							</table>
						</div>
<?php
					}
					$comments = $conn->prepare("select note, timestamp
												from Notes A, NotesItem B
												where A.note_id = B.note_id and
														B.item_Backid = :a");
					$comments->bindValue(':a', $item_backid, PDO::PARAM_INT);
					$comments->execute();
					$comments = $comments->fetchAll();
					
					$customer = $conn->prepare("select pick_up_date, return_date, l_name, f_name
												from Rental A, Customer B, CheckIn C
												where A.cust_id = B.cust_id and 
														A.rent_id = C.rent_id and 
														C.item_Backid = :a
												group by time_stamp, l_name, f_name");
					$customer->bindValue(':a', $item_backid, PDO::PARAM_INT);
					$customer->execute();
					$customer = $customer->fetchAll();
?>
					<table id="Item_comment" class="Item_comment" style="float: right;">
						<thead>
							<th>Time Stamp:</th>
							<th>Comments:</th>
						</thead>
						<tbody id="comment_tbody">
<?php
							if($comments == null)
							{
								echo "<tr>";
								echo "<td colspan='2'>";
								echo "No comments were ever made about this item";
								echo "</td>";
								echo "</tr>";
							}
							else
							{
								foreach($comments as $row)
								{
									if($row['comments'] != "")
									{
										echo "<tr>";
										echo "<td>";
										echo $row['timestamp'];
										echo "</td>";
										echo "<td>";
										echo $row['note'];
										echo "</td>";
										echo "</tr>";
										
										//If there is any comments, then this is true
										$any_comments = true;
									}
								}

							}
?>
						</tbody>
					</table>
					
					<br></br>
					</br>
					
					<table id="Cust_usage" style="float: right;">
						<th>Time Stamp:</th>
						<th>Customer who used the Item:</th>
<?php
						if($customer[0] != null)
						{
							echo "<tr>";
							echo "<td>";
							echo $customer[0]['pick_up_date'] . " - " . $customer[0]['return_date'];
							echo "</td>";
							echo "<td>";
							echo $customer[0]['f_name'] . " " . $customer[0]['l_name'];
							echo "</td>";
							echo "</tr>";
						}
						else
						{
							echo "<tr>";
							echo "<td colspan='2'>";
							echo "Item haven't been rented out yet";
							echo "</td>";
							echo "</tr>";
						}
						if($customer[1] != null)
						{
							echo "<tr>";
							echo "<td>";
							echo $customer[1]['pick_up_date'] . " - " . $customer[1]['return_date'];
							echo "</td>";
							echo "<td>";
							echo $customer[1]['f_name'] . " " . $customer[1]['l_name'];
							echo "</td>";
							echo "</tr>";
						}
						if($customer[2] != null)
						{
							echo "<tr>";
							echo "<td>";
							echo $customer[2]['pick_up_date'] . " - " . $customer[2]['return_date'];
							echo "</td>";
							echo "<td>";
							echo $customer[2]['f_name'] . " " . $customer[2]['l_name'];
							echo "</td>";
							echo "</tr>";
						}
?>
					</table>
				</div>
			</fieldset>
		</form>
	</br>

	<div id = "button_div">
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="button">
	    <fieldset id="info_buttons">
			<input <?= $lvl_2 ?> name="editItem" id="editItem" value="Edit Item" <?= $disabled_2 ?>/>
			<input <?= $lvl_3 ?> name="editInv" id="editInv" value="Edit Inventory" <?= $disabled_3 ?>/><br />
            <input type="submit" name="backoniteminfo" id="backoniteminfo" value="Back" /><br />
	    </fieldset>
	</form>
    </div>
	</div>
</body>

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
</html>

<?php
$conn=null;
	}
?>
