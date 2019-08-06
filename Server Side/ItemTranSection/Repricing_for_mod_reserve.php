<?php
	session_start();
	require('/home/centerac/public_html/RentalSection/CalculateFunction.php');
	
	//Grabs the new cart value sent by the AJAX call
	$new_cart = $_REQUEST['new_cart'];
	$request_date = $_REQUEST['request_date'];
	$due_date = $_REQUEST['due_date'];
	$cust_id = $_REQUEST['cust_id'];

	$item_array = explode(',', $new_cart); //First we grab the item string, and explode it into a array of ints
	$empty_index = array_filter($item_array); //We then filter out any empty spots in the array just in case
	$array_of_string_items = array_values($empty_index); //Once after the filter, we reset the array.
	
	$calcuated = priceCal($request_date, $due_date, $array_of_string_items, $cust_id);
	
	$_SESSION['mod_reserved'] = $calcuated;
	$_SESSION['mod_item_array'] = $array_of_string_items;
	
	print json_encode($calcuated);
?>
