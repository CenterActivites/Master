<?php

	function Itemselection()
	{
?>
<html>
<body>
    <div id="pageHeader"> Item Selection </div>
    <div>
   <div>
<?php
        $username = $_SESSION['username'];
		$password = $_SESSION['password'];
        $conn = hsu_conn_sess($username, $password);
        
        $select_item = 'select item_Backid, item_Frontid, inv_name, cat_name '.
                       'from Item a, Category b, Inventory c '.
					   'where a.inv_id = c.inv_id and b.cat_id = c.cat_id';
        $stmt = oci_parse($conn, $select_item);
        oci_execute($stmt, OCI_DEFAULT);
 ?>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
			<fieldset>
				<legend> Select A Item </legend>

					<select name="item" size="6" required>
<?php
						while (oci_fetch($stmt))
						{
							$curr_item_backid = oci_result($stmt, "ITEM_BACKID");
							$curr_item_frontid = oci_result($stmt, "ITEM_FRONTID");
							$curr_inv_name = oci_result($stmt, "INV_NAME");
							$curr_cat_name = oci_result($stmt, "CAT_NAME")
?>
							<option value="<?= $curr_item_backid ?>"> 
								<?= $curr_item_frontid ?> <?= $curr_inv_name ?> <?= $curr_cat_name ?> 
							</option>
<?php
						}
?>
					</select>
			</fieldset>
	    <fieldset >
    </div>
	Search: <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	<div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="moreinfo" id="moreinfo" value="Item Info" /><br />
	        <input type="submit" name="additem" id="additem" value="Add Item" /><br />
	    </fieldset>
	</form>
	<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
				<input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
	</form>
    </div>
</body>
</html>


<?php
	}
?>