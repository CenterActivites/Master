<?php
/*
I believe this was a testing page for vendors eric was working with

*/
?>
<?php
require_once("php-funcs.php");
?>

<link href="<?= domain?>/css/vendors.css" type="text/css" rel="stylesheet" />
<h1>Users</h1>
<hr>

<?php
	// To use, just set tableArr with values you want and that is it.
	$select  = '*';
	$from    = 'Users';
	$where   = '1=1';

	//var_dump($result);  // this line is for testing to check what data is passed

	$contents = db_query_with_cache($select, $from, $where);
	$tableArr = array('USERNAME', 'PASSWORD', 'EMPL_FNAME', 'EMPL_LNAME','POWER_LEVEL');

?>

<div id="Vendor_select" >
	<table id= "vend_table" align="center" cellspacing = "20" style="text-align:center;">
		<tr>
			<th>Username</th>
			<th>Password</th>
			<th>Employee First Name</th>
			<th>Employee Last Name</th>
			<th>Prmissions Level</th> 
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



