<?php
/*
Rentals >> Inventory Page

*/

	require_once("php-funcs.php");
	require_once("php-database.php");
	require_once("php-cache.php");

	if ( sizeof($_GET) > 1 )
	{
		$arr = array('ITEM_BACK_ID' => NULL,  // setup names only
					 'ITEM_NAME' => NULL,
					 //'ITEM_SIZE'   => NULL,
					 'PACK_ID'   => NULL,
					 /*'STATUS'   => NULL*/);

		// sets array to vars, deletes empty strings
		foreach ($arr as $key => $value) {
		    if ($_GET[$key] != '') { $arr[$key] = $_GET[$key]; }
		    	else { unset($arr[$key]); }
		}

		///// sets up sql query
		$sql = array('select' => '*', 'from' => 'item', 'where' => '(');
		$counter = 0;

		foreach ($arr as $key => $value) {
			if ($counter == 0) { $sql['where'] = $sql['where'].$key.' = \''.$arr[$key].'\' ';        $counter++; continue; }
			if ($counter != 0) { $sql['where'] = $sql['where'].' AND '.$key.' = \''.$arr[$key].'\''; $counter++; continue; }
		}

		$sql['where'] = $sql['where'].')';

		//echo 'sql = SELECT '.$sql['select'].' FROM '.$sql['from'].' WHERE '.$sql['where'].'<br>';
		//$contents = db_query_with_cache($sql['select'], $sql['from'], $sql['where'], 1);
		//var_dump($contents);
		//exit;

		$contents = db_query($sql['select'], $sql['from'], $sql['where']);
		$id_row = 'ITEM_BACK_ID';
		$size = sizeof($contents[$id_row]);
		return inventory_items_wrapper_fill($contents, $size);
	}
	else {
		$select = '*';
		$from   = 'item';
		$where  = '1=1';
		$debug  = 0;
		//$contents = db_query_with_cache($select, $from, $where, $debug);
		$contents = db_query($select, $from, $where, $debug);
		$id_row = 'ITEM_BACK_ID';
		$size = sizeof($contents[$id_row]);
	}

	//creates the inventory window
	function inventory_items_wrapper_fill($contents, $size)
	{
		echo "<div id=\"rentals_wrapper\">";
		echo "<div id=\"rentals-div\">
				<span id=\"item-sel-title\">ID</span><br>
				<div id=\"rentals-id\" class=\"whiteBackground\">
	            <select size=\"16\" id=\"Id\" class=\"selectBoxesRental hideScroll\" name=\"id\" onchange=\"scroll_select(this.id)\" multiple>";
	            	select_fill('ITEM_BACK_ID', $contents, $size);
	    echo "  </select>
			</div>
        	</div>
			<div id=\"rentals-div\">
        		<span id=\"item-sel-title\">Name</span><br>
				<div id=\"rentals-name\" class=\"whiteBackground\">
	            <select size=\"16\" id=\"Name\" class=\"selectBoxesRental hideScroll\" name=\"name\" onscroll=\"scroll_together()\" onchange=\"scroll_select(this.id)\" multiple>";
	            	select_fill('ITEM_NAME', $contents, $size);
	    echo "  </select>
			</div>
            </div>
            <div id=\"rentals-div\">
            	<span id=\"item-sel-title\">Size</span><br>
				<div id=\"rentals-size\" class=\"whiteBackground\">
	            <select size=\"16\" id=\"Size\" class=\"selectBoxesRental hideScroll\" name=\"size\" onscroll=\"scroll_together()\" onchange=\"scroll_select(this.id)\" multiple>";
	            	select_fill('ITEM_SIZE', $contents, $size);
	    echo "  </select>
			</div>
            </div>
            <div id=\"rentals-div\">
            	<span id=\"item-sel-title\">Type</span><br>
				<div id=\"rentals-type\" class=\"whiteBackground\">
	            <select size=\"16\" id=\"Type\" class=\"selectBoxesRental hideScroll\" name=\"type\" onscroll=\"scroll_together()\" onchange=\"scroll_select(this.id)\" multiple>";
	            	select_fill('ITEM_TYPE', $contents, $size);
	    echo "  </select>
			</div>
            </div>
            <div id=\"rentals-div\">
            	<span id=\"item-sel-title\">Model</span><br>
				<div id=\"rentals-div-select-background\">
	            <select size=\"16\" id=\"Attribute\" class=\"selectBoxesRental hideScroll\" name=\"attribute\" onscroll=\"scroll_together()\" onchange=\"scroll_select(this.id)\" multiple>";
	            	select_fill('MODEL', $contents, $size);
	    echo "  </select>
			</div>
            </div>
            <div id=\"rentals-div\">
            	<span id=\"item-sel-title\">Price</span><br>
				<div id=\"rentals-div-select-background\">
	            <select size=\"16\" id=\"Price\" class=\"selectBoxesRental hideScroll\" name=\"price\" onscroll=\"scroll_together()\" onchange=\"scroll_select(this.id)\" multiple>";
	            	select_fill('PRICE', $contents, $size);
	    echo "  </select>
			</div>
            </div>
            <div id=\"rentals-div\">
            	<span id=\"item-sel-title\">PID</span><br>
				<div id=\"rentals-div-select-background\">
	            <select size=\"16\" id=\"PID\" class=\"selectBoxesRental hideScroll\" name=\"pack_id\" onscroll=\"scroll_together()\" onchange=\"scroll_select(this.id)\" multiple>";
	            	select_fill('PACK_ID', $contents, $size);
	    echo "  </select>
			</div>
            </div>
            <div id=\"rentals-location\">
            	<span id=\"item-sel-title\">Location</span><br>
				<div id=\"rentals-div-select-background\">
	            <select size=\"16\" id=\"Location\" class=\"selectBoxesRental  hideScroll\" name=\"location\" onscroll=\"scroll_together()\" onload=\"sizefixloc()\" onchange=\"scroll_select(this.id)\" multiple>";
	            	select_fill('LOCATION', $contents, $size);
	    echo "  </select>
			</div>
			</div>";
		echo "</div>";
	}
?>

<!--  CSS   -->
<link href="<?= domain?>/css/rentals.css"   type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/general.css"   type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/forms.css"     type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/inventory.css" type="text/css" rel="stylesheet" />
<!--  JS   -->
<script src="<?= domain?>/js/inventory.js"></script>

<div id="rentals-nav-wrapper">
	<ul id="rentals-sidebar">
	  <li id="rs"><a href="<?= domain ?>/index.php?page=rentals">Rentals</a></li>
	  <li id="rs"><a href="<?= domain ?>/index.php?page=returns">Returns</a></li>
	  <li id="rs"><a class="active" href="<?= domain ?>/index.php?page=inventory">Inventory</a></li>
	  <li id="rs"><a href="<?= domain ?>/index.php?page=history">History</a></li>
	</ul>
<br>
<br>

</div>

<div id="main-top-bar">
<center>Inventory</center>
</div>

<!-- search bar -->
<div id="search-inventory">
		<span style="position: relative; top:-8%;"><center><span id="title"><strong>Search</strong></span></center></span>
			<center>
			<div id="search-div">
				<button style="font-size:1.5em; margin-bottom: 3%;" type="button" onclick="search_rentals()" name="search" value="Search" />Search Items</button>
			</div>
			<div id="search-div">
				<input style="margin-top:3%;" type="text" id="txtid" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="ID.."/><br>
				<input style="margin-top:3%;" type="text" id="txtname" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="name.."/><br>
			</div>
			<div id="search-div">
				<input style="margin-top:3%;" type="text" id="txtsize" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="size.."/><br>
				<input style="margin-top:3%;" type="text" id="txtpackage" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="package.."/><br>
			</div>
			<div id="search-div">
				<input style="margin-top:3%;" type="text" id="txtstatus" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="status.."/><br>
			</div>
			<div id="search-div">
				<button style="font-size:1.5em; margin-bottom: 3%; margin-left: 3%;" onclick="clearSearchAll()" type="button" name="clear"  value="Clear Search" />Clear Search</button>
			</div>
			</center>
		<br>
</div>

<!-- buttons to modify the inventory -->
<div id="inven-window">
	<div id="inventory_items_wrapper">
		<?php inventory_items_wrapper_fill($contents, $size); ?>
	</div>	
		<!-- Admin Stuff? -->
		<center>
		<div id="inventory-buttons">
			<center>
			<button id="popupA" onclick="add_div_show()">Add</button>&nbsp;&nbsp;
			<button id="popupE" onclick="edit_div_show()">Edit</button>&nbsp;&nbsp;
			<input type="submit" name="delete"  value="Delete" />
			</center>
		</div>
		</center>
</div>


<!-- will be changing this into the edit/view item button
<div id="inventory-item">
	<center><strong>Item:</strong></center>
	<p>Part No:</p>
	<p>Size:</p>
	<p>Condition:</p>
	<p>Vendor: 
	<p>
	<center>
	<input type="submit" name="vendor"  value="Vendor" />  <!--JS will change name to vendor name-->
	<!--<input type="submit" name="notes"  value="Notes" />&nbsp;&nbsp;
	<input type="submit" name="history"  value="History" />&nbsp;&nbsp;
	<input type="submit" name="viewItem"  value="View Item" />
	</center>
	</p>
</div>
-->

<!-- popup add item form -->
<div id="popA">
<!-- Popup Div Starts Here -->
<div id="popupAdd">
<!-- Add Item Form -->
<form action="<?=domain?>/php-inputhandler-casey.php" id="popformA" method="post" name="popform">
	
<h2>Add Item</h2>
<hr>
<div>Item ID:<input class="marg" id="id" name="id" type="text"><br></div>
<div>Item Name:<input class="marg" id="name" name="name" type="text"><br></div>
<div>Item Size:<input class="marg" id="size" name="size" type="text"><br></div>
<div>Item Type:<input class="marg" id="type" name="type" type="text"><br></div>
<div id="status">Item Status:<select class="marg" id="status" name="status" style="width: 11em">
						<option value="Ready for Rent">Ready for Rent</option>
						<option value="Repair">Repair</option>
						<option value="Checked-in">Checked-in</option>
						<option value="Checked-out">Checked-out</option>
				 </select><br></div>
<div>Item Model:<input class="marg" id="model" name="model" type="text"><br></div>
<div>Item Price:<input class="marg" id="price" name="price" type="text"><br></div>
<div>Item Package:<input class="marg" id="package" name="package" type="text"><br></div>
<div id="location">Item Location:<select class="marg" id ="location" name="location" style="width: 11em">
						<option value="School">School</option>
						<option value="Aquatic Center">Aquatic Center</option>
				 </select><br></div>
<input type="submit" name="submit" value="Confirm"/>
</form>
<button id="close" onclick ="add_div_hide()">Cancel</button>
</div>
<!-- Popup Div Ends Here -->
</div>

<!-- popup edit item form - currently not working -->
<div id="popE">
<!-- Popup Div Starts Here -->
<div id="popupEdit">
<!-- Edit Item Form -->
<form action="#" id="popformE" method="post" name="popform">

<h2>Edit Item</h2>
<hr>
<div>Item ID:<input class="marg" id="id" name="id" type="text"><br></div>
<div>Item Name:<input class="marg" id="name" name="name" type="text"><br></div>
<div>Item Size:<input class="marg" id="size" name="size" type="text"><br></div>
<div>Item Type:<input class="marg" id="type" name="type" type="text"><br></div>
<div id="status">Item Status:<select class="marg" id="status" name="status" style="width: 11em">
						<option value="Ready for Rent">Ready for Rent</option>
						<option value="Repair">Repair</option>
						<option value="Checked-in">Checked-in</option>
						<option value="Checked-out">Checked-out</option>
				 </select><br></div>
<div>Item Model:<input class="marg" id="model" name="model" type="text"><br></div>
<div>Item Price:<input class="marg" id="price" name="price" type="text"><br></div>
<div>Item Package:<input class="marg" id="package" name="package" type="text"><br></div>
<div id="location">Item Location:<select class="marg" id ="location" name="location" style="width: 11em">
						<option value="School">School</option>
						<option value="Aquatic Center">Aquatic Center</option>
				 </select><br></div>
<button id="edit" onclick ="edit_item()">Confirm</button>
</form>
<button id="close" onclick ="edit_div_hide()">Cancel</button>
</div>
<!-- Popup Div Ends Here -->
</div>


