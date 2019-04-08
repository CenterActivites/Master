<?php
/*
This is the vendors page for the website.  It displays things to the user pertaining to vendors.

*/
require_once("php-funcs.php");
?>

<link href="<?= domain?>/css/vendors.css" type="text/css" rel="stylesheet" />
<h1>Vendors List</h1>
<hr>

<?php
	// To use, just set tableArr with values you want and that is it.
	$select  = '*';
	$from    = 'Vendors';
	$where   = '1=1';

	//var_dump($result);  // this line is for testing to check what data is passed

	$contents = db_query($select, $from, $where);
	$tableArr = array('VEN_NAME', 'VEN_PHONE', 'VEN_EMAIL', 'VEN_LOCATION');

?>

<div id="Vendor_select" >
	<table id= "vend_table" align="center" cellspacing = "20" style="text-align:center;">
		<tr>
			<th>Vendor Name</th>
			<th>Vendor Phone Number</th>
			<th>Vendor Email</th>
			<th>Vendor Adress</th>
		</tr>
		<?php table_fill($contents, $tableArr, sizeof($contents[$tableArr[0]]), sizeof($tableArr)); ?>
	</table>
</div>

<!-- just chekcing the format of the form for when it is implmented in add vendors. Everything down is meant for that page.-->


<?php // <-- added to make sure it commented
/*
// Erics Version
	function table_fill($index, $contents, $size)
	{
		for($i = 0; $i < $size; $i++)
		{
			if (is_null($contents[$index][$i])) echo '-- ';
			else {
				echo $contents[$index][$i].'<br>';
			}
		}
	}

<div id="Vendor_select" >
	<table id= "vend_table" align="center" cellspacing = "20" style="text-align:center;">
		<tr>
			<th>Vendor Name</th>
			<th>Vendor Phone Number</th>
			<th>Vendor Email</th>
			<th>Vendor Adress</th>
		</tr>
		<tr>
			<td><?php table_fill('VEN_NAME', $contents, $size); ?> </td>
			<td><?php table_fill('VEN_PHONE', $contents, $size); ?> </td>
			<td><?php table_fill('VEN_EMAIL', $contents, $size); ?> </td>
			<td><?php table_fill('VEN_LOCATION', $contents, $size); ?> </td>
		</tr>
	</table>
</div>

*/
?>



