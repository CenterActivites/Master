<?php

	function EditItem()
	{
?>
<html>
<body>
    <div id="pageHeader"> Editing Item</div>
    <div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
<?php
		$item_info = 'select inv_name, cat_name, item_name, item_size, item_status '.
                       'from Item a, Category b, Inventory c '.
					   'where a.inv_id = c.inv_id and b.cat_id = c.cat_id and a.item_Backid = :sel_item';				
		$conn = hsu_conn_sess($_SESSION['username'], $_SESSION['password']);
		
		
		$sel_item = $_SESSION['sel_item'];
		$stmt = oci_parse($conn, $item_info);
		oci_bind_by_name($stmt, ":sel_item", $sel_item);
		oci_execute($stmt, OCI_DEFAULT);
		while(oci_fetch($stmt))
		{
			$curr_inv_name = oci_result($stmt, "INV_NAME");
			$curr_cat_name = oci_result($stmt, "CAT_NAME");
			$curr_item_name = oci_result($stmt, "ITEM_NAME");
			$curr_item_size = oci_result($stmt, "ITEM_SIZE");
			$curr_item_status = oci_result($stmt, "ITEM_STATUS");
?>		
			Item Category: <input type = "text" name = "curr_cat_name" id = "curr_cat_name" value ="<?= $curr_cat_name ?>" /><br/>           
			Item Name: <input type = "text" name = "curr_inv_name" id = "curr_inv_name" value ="<?= $curr_inv_name ?>" /><br/>
			Item Model: <input type = "text" name = "curr_item_name" id = "curr_item_name" value ="<?= $curr_item_name ?>" /><br/> 
			Item Size: <input type = "text" name = "curr_item_size" id = "curr_item_size" value ="<?= $curr_item_size ?>" /><br/> 
			Status of Item: <input type = "text" name = "curr_item_status" id = "curr_item_status" value ="<?= $curr_item_status ?>" /><br/>  
<?php
		}
?>
	    <fieldset >
            <input type="submit" name="updateItem" id="updateItem" value="Update Item" /><br />
	        <input type="submit" name="removeItem" id="removeItem" value="Remove Item" /><br />
            <input type="submit" name="cancelEdit" id="cancelEdit" value="Cancel" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>

