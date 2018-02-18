<?php
/*
Rentals >> Item History

*/
?>
<link href="<?= domain?>/css/rentals.css" type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/general.css" type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/forms.css" type="text/css" rel="stylesheet" />
<link href="<?= domain?>/css/history.css" type="text/css" rel="stylesheet" />

<?php
	require_once("php-funcs.php");
	require_once("php-database.php");
	require_once("php-cache.php");
?>

<script src="<?= domain?>/js/history.js"></script> 
<!--document.getElementById('realtxt').onkeyup = searchSel;
function searchSel() 
    {
      var input = document.getElementById('realtxt').value.toLowerCase();
       
          len = input.length;
          output = document.getElementById('item_selection').options;
		  //document.write(output[2].value);
      for(var i=0; i<output.length; i++){
		  //document.write(output[i].value);
          if (output[i].text.toLowerCase().indexOf(input) != -1 ){
              output[i].selected = true;
              break;
              }
	  }
	  //document.write('We are in');
      //if (input == '')
      //  output[0].selected = true;
    }
</script>
-->
<div id="rentals-nav-wrapper">
	<ul id="rentals-sidebar">
	  <li id="rs"><a href="<?= domain ?>/index.php?page=rentals">Rentals</a></li>
	  <li id="rs"><a href="<?= domain ?>/index.php?page=returns">Returns</a></li>
	  <li id="rs"><a href="<?= domain ?>/index.php?page=inventory">Inventory</a></li>
	  <li id="rs"><a class="active" href="<?= domain ?>/index.php?page=history">Item History</a></li>
	</ul>

<br>
<br>
<div id="search-wrapper">
	<div id="search">
	<center>
		<strong>Search</strong><br><br>
		Name:<br>
		<input type="text" id="txtname" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="Search Name..."/><br>
		Inventory ID:<br>
		<input type="text" id="txtid" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="Search ID..."/><br>
		Size:<br>
		<input type="text" id="txtsize" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="Search Size..."/><br>
		Package:<br>
		<input type="text" id="txtpackage" onmouseover="clearSearch(this.id)" onfocusout="rentalsSearchRefill(this.id)" onmouseout="rentalsSearchRefill(this.id)" value="Search Package..."/><br>
	</center><br>
	<center>
		<button type="button" onclick="search_rentals()" name="search" value="Search" />Search</button>
		<button onclick="clearSearchAll()" type="button" name="clear"  value="Clear Search" /> Clear Search</button>
	</center><br>
	</div>
</div>
</div>



<div id="main-top-bar">
<center>Item's History</center>
</div>


<div id="just-for-history1">
	<?php 
		$contents = db_query('*', 'item', '1=1');
		$size = sizeof($contents['ITEM_BACK_ID']);
	?>
	<center><strong>Select Item</strong></center>
	<form action='' method='POST'>
		<select id="item_selection" style="width:100%;height: 40%;" name="items" multiple>
			<?php select_fill('ITEM_NAME', $contents, $size); ?>
		</select>
	</form>
</div>

<div id="just-for-history2">
	<center><strong>History</strong></center>
	<form action="/action_page.php">
		<textarea style="width:100%;height: 40%;" rows="14" cols="62" id="TITLE">
		...
        </textarea>
	</form>
</div>



<div id="returns-item">
	<center><strong>Item:</strong></center>
		<br>
	<form>
		Item Name:<input type="text" name="item_name" value="">
		<br><br>
		Last Note:<input type="text" name="last_note" value="">
	</form>
	<center>
	<input type="submit" name="viewItem"  value="View Item" />
	<center>
</div>

<div id="returns-customer">
	<center><strong>Last Customer to Rent the Item:</strong></center>
		<br>
	<form>
		Name:<input type="text" name="cus_name" value="">
		<br><br>
		Phone:<input type="text" name="cus_phone" value="">
		<br><br>
		Email:<input type="text" name="cus_email" value="">
		<br><br>
		Preferred Method of Contact:<input type="text" name="cus_contact" value="">
	</form>
	<center>
		<input type="submit" name="CustomerHistory"  value="View Customer History" />
	</center>
</div>

</html>