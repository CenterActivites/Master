<?php

	function RentalItemSelect()
	{
?>
<html>
<body>
    <div id="pageHeader"> Selection of Items </div>
    <div> 
<?php
        $username = $_SESSION['username'];
		$password = $_SESSION['password'];
        $conn = hsu_conn_sess($username, $password);
		
        $select_item = "select item_Backid, inv_name, item_size ".
                       "from Item a, Inventory c ".
					   "where a.inv_id = c.inv_id and a.item_status = 'ready'";
					   
		$select_pack = "select pack_name ".
                       "from Packages ".
					   "group by pack_name";
					   
        $stmt = oci_parse($conn, $select_item);
        oci_execute($stmt, OCI_DEFAULT);
		
		$stmt1 = oci_parse($conn, $select_pack);
        oci_execute($stmt1, OCI_DEFAULT);
 ?>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
			Pick up Date: <input required  type = "date" name = "pickUpDate" id = "pickUpDate" min="<?php echo date('Y-m-d'); ?>"/>
			Return Date: <input required  type = "date" name = "returnDate" id = "returnDate" min="<?php echo date('Y-m-d'); ?>"/>
			<fieldset>
				<legend> Select A Item </legend>

					<select name="item" size="6" required>
<?php
						while (oci_fetch($stmt))
						{
							$curr_item_backid = oci_result($stmt, "ITEM_BACKID");
							$curr_inv_name = oci_result($stmt, "INV_NAME");
							$curr_item_size = oci_result($stmt, "ITEM_SIZE");
?>
							<option value="<?= $curr_item_backid ?>"> 
								<?= $curr_inv_name ?> :: <?= $curr_item_size ?> 
							</option>
<?php
						}
?>
					</select>
			</fieldset>
			<fieldset>
				<legend> Packages </legend>

					<select name="pack" size="3">
<?php
						while (oci_fetch($stmt1))
						{
							$curr_pack_name = oci_result($stmt1, "PACK_NAME");
?>
							<option> 
								<?= $curr_pack_name ?>
							</option>
<?php
						}
?>
					</select>
			</fieldset>
    </div>
	<div>
		Search: <input type = "text" name = "searchitem" id = "seatchitem" value ="Search Item Name" /><br/>
	</div>
	    <fieldset >
            <input type="submit" name="calPay" id="calPay" value="Continue to Payments" /><br />
            <input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
	    </fieldset>
	</form>
</body>
</html>


<?php
	}
?>