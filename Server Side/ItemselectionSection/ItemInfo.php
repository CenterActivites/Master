<?php

	function ItemInfo()
	{
?>
<html>
<body>
    <div id="pageHeader"> Item Information </div>
    <div>
		<p>
<?php
			$conn = hsu_conn_sess($_SESSION['username'], $_SESSION['password']);
			if(isset($_POST["moreinfo"]))
			{
				$item_info = 'select c.inv_id, item_Frontid, inv_name, cat_name, item_name, item_size, item_status '.
                       'from Item a, Category b, Inventory c '.
					   'where a.inv_id = c.inv_id and b.cat_id = c.cat_id and a.item_Backid = :sel_item';
				$sel_item = htmlspecialchars(strip_tags($_POST["item"]));
				$_SESSION['sel_item'] = $sel_item;
				$stmt = oci_parse($conn, $item_info);
				oci_bind_by_name($stmt, ":sel_item", $sel_item);
				oci_execute($stmt, OCI_DEFAULT);
				while(oci_fetch($stmt))
				{
					$curr_inv_id = oci_result($stmt, "INV_ID");
					$curr_item_frontid = oci_result($stmt, "ITEM_FRONTID");
					$curr_inv_name = oci_result($stmt, "INV_NAME");
					$curr_cat_name = oci_result($stmt, "CAT_NAME");
					$curr_item_name = oci_result($stmt, "ITEM_NAME");
					$curr_item_size = oci_result($stmt, "ITEM_SIZE");
					$curr_item_status = oci_result($stmt, "ITEM_STATUS");
					$_SESSION['inv_id'] = $curr_inv_id;
?>		
					Item Category: <?= $curr_cat_name ?><br />           
					Item Name: <?= $curr_inv_name ?><br />                       
					Item ID: <?= $curr_item_frontid ?><br /> 
					Item Model: <?= $curr_item_name ?><br /> 
					Item Size: <?= $curr_item_size ?><br /> 
					Status of Item: <?= $curr_item_status ?> 
<?php
				}
				$_SESSION['inv_id'] = $curr_inv_id;
			}
			else
			{
				$item_info = 'select item_Frontid, inv_name, cat_name, item_name, item_size, item_status '.
                       'from Item a, Category b, Inventory c '.
					   'where a.inv_id = c.inv_id and b.cat_id = c.cat_id and a.item_Backid = :sel_item';
				$sel_item = $_SESSION['sel_item'];
				$stmt = oci_parse($conn, $item_info);
				oci_bind_by_name($stmt, ":sel_item", $sel_item);
				oci_execute($stmt, OCI_DEFAULT);
				while(oci_fetch($stmt))
				{
					$curr_item_frontid = oci_result($stmt, "ITEM_FRONTID");
					$curr_inv_name = oci_result($stmt, "INV_NAME");
					$curr_cat_name = oci_result($stmt, "CAT_NAME");
					$curr_item_name = oci_result($stmt, "ITEM_NAME");
					$curr_item_size = oci_result($stmt, "ITEM_SIZE");
					$curr_item_status = oci_result($stmt, "ITEM_STATUS");
?>		
					Item Category: <?= $curr_cat_name ?><br />           
					Item Name: <?= $curr_inv_name ?><br />                       
					Item ID: <?= $curr_item_frontid ?><br /> 
					Item Model: <?= $curr_item_name ?><br /> 
					Item Size: <?= $curr_item_size ?><br /> 
					Status of Item: <?= $curr_item_status ?> 
<?php
				}
			}
?>
		</p>
    </div>
	<div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="backoniteminfo" id="backoniteminfo" value="Back" /><br />
	        <input type="submit" name="editItem" id="editItem" value="Edit Item" /><br />
            <input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>
