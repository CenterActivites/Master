<?php
/*
This is the global navigation bar for the website that you see at the top of the webpage.

*/

?>
<div style="height:53px !important; overflow: hidden; background-color: #265415;">
	<?php  if(!isset($_SESSION['logged_in'])) { ?>
		<ul id="navbar">
			<li id="navbar"><a href="<?= domain?>/index.php">Home</a></li>
		</ul>
	<?php }
	else if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'])) { ?>

	<ul id="navbar">
	  <li id="navbar"><a href="<?= domain?>/index.php?page=rentals">Rentals</a></li>
	  <li id="navbar"><a href="<?= domain?>/index.php?page=vendors">Vendors</a></li>
	  <li id="navbar" class="dropdown">
	    <a href="javascript:void(0)" class="dropbtn">History</a>
	    <div class="dropdown-content">
	      <a href="#">Customer</a>
	      <a href="#">Employee</a>
	      <a href="#">Administrator</a>
	    </div>
	  <li id="navbar" class="dropdown">
	    <a href="javascript:void(0)" class="dropbtn">Administrator</a>
	    <div class="dropdown-content">
	      <a href="<?= domain?>/index.php?page=create_account">Create Account</a>
	      <a href="#">Reports</a>
	      <a href="#">Exports</a>
	      <a href="<?= domain?>/index.php?page=add_vendors">Vendors</a>
		  <a href="<?= domain?>/index.php?page=add_packages">Packages</a>
	      <a href="#">---------------------</a>
	      <a href="<?= domain?>/index.php?page=broken_fingers">Permissions</a>
	    </div>
	  </li>
	  <li id="navbar"><a href="<?= domain?>/index.php?page=logout">Logout</a></li>
	  <li id="navbar"><a href="<?= domain?>/index.php?page=help">Help</a></li>
	</ul>

	<?php } ?>

	<img style="float:right; margin-top:15px; height:20px;" src="images/center-activities.png" height="20px">
</div>

