<?php
/*
Last Modified: 12/7/2017

This is the rentals-item-select page.  It handles the first stage in the
	Item Select >> Customer Select >> Final Checkout Page.
The checkout was the last thing being worked on.  Some of the javascript is in rentals.js.

The price updates when a product is added, but not removed.
The issue with an item being removed is that the item has to be 'tracked'.  Currently the Checkout trackss items, but it is a work in progress.  The checkout creates inputs type hidden to the form and adds them invisibly.  This is one way to do it, but it is kind of a hassle.  It may be better to go a different route and just show a price instead on this page.

A better way may be to copy the popout text from the inventory page and use it here as a checkout page -- similar to a store like amazon maybe.  On the popup more information would be displayed that way having to track things invisibly may not be required.
*/
	require_once("php-funcs.php");
	require_once("php-database.php");
	require_once("php-cache.php");

	if ( sizeof($_GET) > 1 )
	{
		$arr = array('ITEM_NAME' => NULL,  // setup names only
					 'ITEM_SIZE' => NULL,
					 'PACK_ID'   => NULL);

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
		return rentals_items_wrapper_fill($contents, $size);
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

	function rentals_items_wrapper_fill($contents, $size)
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
<link href="<?= domain?>/css/rentals.css" type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/general.css" type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/forms.css"   type="text/css" rel="stylesheet" />
<!--  JS   -->
<script type="text/javascript" src="<?= domain?>/js/rentals.js" ></script>
<center>
<div id="rentals-header-wrapper">
	<div id="rentals-nav-wrapper">
		<ul id="rentals-sidebar">
		  <li id="rs"><a class="active" href="<?= domain ?>/index.php?page=rentals">Rentals</a></li>
		  <li id="rs"><a href="<?= domain ?>/index.php?page=returns">Returns</a></li>
		  <li id="rs"><a href="<?= domain ?>/index.php?page=inventory">Inventory</a></li>
		  <li id="rs"><a href="<?= domain ?>/index.php?page=history">Item History</a></li>
		</ul>
	</div>

	<div id="main-top-bar">
	<span id="title"><center>Item Select</center></span>
	</div>

	<div id="search-rentals">
		<span style="position: relative; top:-8%;"><center><span id="title"><strong>Search</strong></span></center></span>
			<center>
			<div id="search-div">
				<button style="font-size:1.5em; margin-bottom: 3%;" type="button" onclick="search_rentals()" name="search" value="Search" />Search Items</button>
			</div>
			<div id="search-div">
				<input style="margin-top:3%;" type="text" id="txtname" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="name.."/><br>
			</div>
			<div id="search-div">
				<input style="margin-top:3%;" type="text" id="txtsize" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="size.."/><br>
			</div>
			<div id="search-div">
				<input style="margin-top:3%;" type="text" id="txtpackage" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="package.."/><br>
			</div>
			<div id="search-div">
				<button style="font-size:1.5em; margin-bottom: 3%; margin-left: 3%;" onclick="clearSearchAll()" type="button" name="clear"  value="Clear Search" />Clear Search</button>
			</div>
			</center>
		<br>
	</div>
</div>
<p style="clear: both;">


<div id="item-select">
	<br>
	<center><span id="title"><strong>Item Select:</strong></span></center>

        <div style="float:left; width:49%;"><center>
			<span id="title">Date From:</span>
			<input type="date" name="date_from"/><br></center>
		</div>
		<div style="float:left; width:49%;"><center>
			<span id="title">Date To:</span>
			<input type="date" name="date_to"/><br></center>
		</div>

		<br>
		<br>
	<center>
		<?php rentals_items_wrapper_fill($contents, $size); ?>
	</center>
<br>
		<div style="margin-top: 3em !important; clear: both;">
		<center>
			<input style="margin-top: 1em !important;" type="submit" name="AddItem"  onclick="addCheckoutItem()" value="Add Item" />
			<input style="margin-top: 1em !important;" type="submit" name="ViewSelect"  value="View Item" />
			<input style="margin-top: 1em !important;" type="submit" name="CustomerHistory"  value="Customer History" />
		</center>
		</div>
</div>

<br>
<br>

<div id="rentals-checkout">
	<br>
	<center><span id="title"><strong>Checkout: $<span id="total">0.00</span></strong></center>
	<br>
	<form name="checkout_form" id="checkout_form" action="/action_page.php">
			<select style="width:100%; height: 300px;" id="checkout_select" multiple>
			</select>
			<br><br>
			<center>
				<input type="button" name="remove item" onclick="remove_checkout_item()" value="Remove Item" /><br><br>
				<input type="submit" name="CustomerSelect"  value="Next: Customer Select" />
			</center>
	</form>
</div>
</center>
</html>