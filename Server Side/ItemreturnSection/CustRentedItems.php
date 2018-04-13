
<?php
    function CustRentedItems()
    {
		if ( (! array_key_exists("cust_id", $_POST)) or
         ($_POST["cust_id"] == "") or
         (! isset($_POST["cust_id"])) )
		{
			destroy_and_exit("must select a Account Name!");
		}
		
		$username = $_SESSION["username"];
		$password = $_SESSION["password"];
		
		$conn = hsu_conn_sess($username, $password);
			
		$sel_user_id = htmlspecialchars(strip_tags($_POST["cust_id"]));
		
		//$sel_cust_f_name = htmlspecialchars(strip_tags($_POST["cust_fname"]));

		//$sel_phone = htmlspecialchars(strip_tags($_POST["cust_phone"]));
		
		$name_query = "select f_name, l_name, item_Frontid, item_name
					   from Customer c, ItemReservation r, Item i
					   where i.item_Backid = r.item_Backid and c.cust_id = r.cust_id and
					   r.cust_id = :cust_id and return_date is NULL";
					   
		$name_query_stmt = oci_parse($conn, $name_query);
		
		oci_bind_by_name($name_query_stmt, ":cust_id", $sel_user_id);		
		
		oci_execute($name_query_stmt, OCI_DEFAULT);
		
		$name_query2 = "select f_name, l_name
						from Customer
						where cust_id = :cust_id";
						
		$name_query_stmt2 = oci_parse($conn, $name_query2);
		oci_bind_by_name($name_query_stmt2, ":cust_id", $sel_user_id);
		oci_execute($name_query_stmt2, OCI_DEFAULT);
		
		oci_fetch($name_query_stmt2);
		$f_name = oci_result($name_query_stmt2, "F_NAME");
		$l_name = oci_result($name_query_stmt2, "L_NAME"); 
		
		?>
<html>
<body>
		
		<form method="post"
          action="<?= htmlentities($_SERVER['PHP_SELF'], 
                                   ENT_QUOTES) ?>">
		
		<div>
		<table>
			<caption> <?= $f_name ?>, <?= $l_name ?>  </caption>
				<tr>
					<th scope="col"> Item ID </th>
					<th scope="col"> Item Name </th>
				</tr>
			
		<?php
		
		while (oci_fetch($name_query_stmt))
		{
			$curr_f_name = oci_result($name_query_stmt, "F_NAME");
			$curr_l_name = oci_result($name_query_stmt, "L_NAME");
			$curr_c_item_id = oci_result($name_query_stmt, "ITEM_FRONTID");
			//$curr_c_item_back_id = oci_result($name_query_stmt, "ITEM_BACKID");
			$curr_c_item = oci_result($name_query_stmt, "ITEM_NAME");
					
			?>
							
			<tr>
				<td> <?= $curr_c_item_id ?> </td> 
				<td> <?= $curr_c_item ?> 
				<input id="checkbox" type="checkbox" name='item_id[]' value="<?= $curr_c_item_id ?>">
				</td>
			</tr>
			
			<?php
		}
		?>
		</table>
		</div>
		
		
			  
		<div>
		<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
			<fieldset >
				<input type="submit" name="Checkin" id="Checkin" value="Checkin" /><br />
				<input type="submit" name="Cancel" id="Cancel" value="Cancel Return" /><br />
					<input type="submit" name="Back" id="Back" value="Back" /><br />
			</fieldset>
		</form>
		</div>

<?php
	oci_free_statement($name_query_stmt);
    oci_close($conn);
    }
?>

</body>
</html>