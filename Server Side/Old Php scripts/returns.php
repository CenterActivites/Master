<?php
/*
This is the returns page for the website and has not been worked on yet.

*/
?>
<link href="<?= domain?>/css/rentals.css" type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/general.css" type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/forms.css" type="text/css" rel="stylesheet" />

<div id="rentals-nav-wrapper">
	<ul id="rentals-sidebar">
	  <li id="rs"><a href="<?= domain ?>/index.php?page=rentals">Rentals</a></li>
	  <li id="rs"><a class="active" href="<?= domain ?>/index.php?page=returns">Returns</a></li>
	  <li id="rs"><a href="<?= domain ?>/index.php?page=inventory">Inventory</a></li>
	  <li id="rs"><a href="<?= domain ?>/index.php?page=history">Item History</a></li>
	</ul>
<br>
<br>
<div id="search-wrapper">
<div id="search">
	<center><strong>Search</strong></center>
	Name<br>
	<input id="w95" type="text" name="name" /><br>
	Inventory ID<br>
	<input id="w95" type="text" name="inventory" /><br>
	Size<br>
	<input id="w95" type="text" name="size" /><br>
	Package<br>
	<input id="w95" type="text" name="package" /><br>
	Condition<br>
	<input id="w95" type="text" name="condition" /><br>
	<br>
	<center><input type="button" name="Clear Search"  value="Clear Search" /></center><br>
</div>
</div>
</div>

<div id="main-top-bar">
<center>Returns</center>
</div>

<div id="main-small">
	<center><strong>Overdue Items</strong></center>
	<br>
	<form action='' method='POST'>
		<select style="width:100%;height: 55%;" name="items" multiple>
		  <option value="">-------</option>
		</select>
		<br><br><br>
		<center>
			<input type="submit" name="AddItem"  value="Add Item" />
			<input type="submit" name="ViewSelect"  value="View Item" />
			<input type="submit" name="CustomerHistory"  value="Customer History" />
		</center>
	</form>
</div>


<div id="returns-item">
	<center><strong>Item:</strong></center>
	<p>Days Overdue:</p>
	<p>Last Note:</p>
	<center>
	<input type="submit" name="viewItem"  value="View Item" />
	<input type="submit" name="checkIn"  value="Set Checked In" />
	<input type="submit" name="ready2rent"  value="Set Ready To Rent" />
	<center>
</div>

<div id="returns-customer">
	<center><strong>Customer:</strong></center>
	<p>Name:</p>
	<p>Phone:</p>
	<p>Email:</p>
	<p>Preferred Method of Contact:</p>
</div>

</html>