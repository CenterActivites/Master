<?php
    function Receipt()
     {
		/*if ( (! array_key_exists("item_id", $_POST)) or
         ($_POST["item_id"] == "") or
         (! isset($_POST["item_id"])) )
		{
			destroy_and_exit("No items reserved!");
		}*/
		
		$username = $_SESSION["username"];
		$password = $_SESSION["password"];
		
		$conn = hsu_conn_sess($username, $password);
		
		$sel_item_front_id = implode(($_POST['item_id']));
		
		$item_query = "select item_name, item_Frontid, sysdate
					   from Item i, ItemReservation r
					   where i.item_Backid = r.item_Backid and
					         i.item_Frontid = :item_id";
					   
		$item_query_stmt = oci_parse($conn, $item_query);
		
		

		oci_bind_by_name($item_query_stmt, ":item_id", $sel_item_front_id);
		
		oci_execute($item_query_stmt, OCI_DEFAULT);
		
		$time = date_default_timezone_set('America/Los_Angeles');
		
		?>
		

		<p> test <?= $sel_item_front_id ?> </p>


		<form method="post"
          action="<?= htmlentities($_SERVER['PHP_SELF'], 
                                   ENT_QUOTES) ?>">
								   
		<div>
			<table>
				<caption> <?php echo date("M-D-Y");?> </caption>
					<tr>
						<th scope="col"> Item Name </th>
						<th scope="col"> Item ID </th>
						<th scope="col"> Date </th>
					</tr>
		<?php
		
		while (oci_fetch($item_query_stmt))
		{
			$curr_c_item = oci_result($item_query_stmt, "ITEM_NAME");
			$curr_c_item_id = oci_result($item_query_stmt, "ITEM_FRONTID");
			$curr_date = oci_result($item_query_stmt, "SYSDATE");
			?>
			
			<tr>
				<td> <?= $curr_c_item ?> </td>
				<td> <?= $curr_c_item_id ?> </td>
				<td> <?= $curr_date ?> </td>
			</tr>
			
			<?php
		}
		?>
			</table>
		</div>	
			<div>
			<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
				<fieldset >
					<input type="submit" name="PrintReceipt" id="PrintReceipt" value="PrintReceipt" /><br />
					<input type="submit" name="cancelOnReceipt" id="cancelOnReceipt" value="Cancel" /><br />
					<input type="submit" name="mainmenu" id="mainmenu" value="MainMenu" /><br />
				</fieldset>
			</form>
			</div>
</body>
</html>


<?php
	oci_free_statement($item_query_stmt);
    oci_close($conn);
	
    }
?>