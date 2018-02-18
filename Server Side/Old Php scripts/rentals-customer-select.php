<?php
/*
Last Modified: 12/7/2017
This page handles the second section of the rentals page.

Rentals is a 3 part page 
Itemm Select >> Customer Select >> Final Checkout Page.

This page was not modified heavily and was initially a copy of rentals-item-select.. 
It has to be changed heavily still.
*/
?>

<link href="<?= domain?>/css/rentals.css" type="text/css" rel="stylesheet" />

<!-- submenu -->
<ul id="rentals-sidebar">
  <li id="rs"><a class="active" href="<?= domain ?>/index.php?page=rentals">Rentals</a></li>
  <li id="rs"><a href="<?= domain ?>/index.php?page=returns">Returns</a></li>
  <li id="rs"><a href="<?= domain ?>/index.php?page=inventory">Inventory</a></li>
  <li id="rs"><a href="<?= domain ?>/index.php?page=history">Item History</a></li>
</ul>

<!--item select-->
<div>
<!--date-->
<div>
<input type="text" name="date_from" />
<input type="text" name="date_to" />
</div>

<!--search-->
<div>
By Name:<br>
<input id="w95" type="text" name="search_name" /><br>
By Size:<br>
<input id="w95" type="text" name="search_size" /><br>
By Pack:<br>
<input id="w95" type="text" name="search_pack" /><br>
<input type="reset" name="Clear Search"  value="Clear" />
</div>

<!--items-->
<div>

</div>
</html>