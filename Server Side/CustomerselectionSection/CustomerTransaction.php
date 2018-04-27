<?php

	function CustomerTran()
	{
?>
<html>
<body>
    <div id="pageHeader"> Customer Transactions </div>
    <div>
<?php
            $username = $_SESSION['username'];
			$password = $_SESSION['password'];
			$conn = hsu_conn_sess($username, $password);
        
			$select_cust = 'select time_stamp, trans_type '.
                       'from Customer c, Transaction t '.
					   'where c.cust_id = t.cust_id and c.cust_id = :sel_user';
			$sel_user = $_SESSION['sel_user'];
			$stmt = oci_parse($conn, $select_cust);
			oci_bind_by_name($stmt, ":sel_user", $sel_user);
			oci_execute($stmt, OCI_DEFAULT);
 ?>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
			<fieldset>
				<legend> TimeStamps: </legend>

					<select name="time_stamp" size="6" required>
<?php
						while (oci_fetch($stmt))
						{
							$curr_time_stamp = oci_result($stmt, "TIME_STAMP");
							$curr_trans_type = oci_result($stmt, "TRANS_TYPE");
?>
							<option value="<?= $curr_rental_id ?>"> <?= $curr_time_stamp ?> <?= $curr_trans_type ?> </option>
<?php
						}
?>
						<option value="test"> test </option>
					</select>
			</fieldset>
		<textarea rows="10" cols="60">
			Information about that transaction
			.....
			.....
			.....
			.....
			.....
			.....
			.....
			.....
		</textarea>
    </div>
		<div>
            <input type="submit" name="viewReceipt" id="viewReceipt" value="View Receipt of Transactions" /><br />
            <input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
			<input type="submit" name="backOnCustTran" id="backOnCustTran" value="Back" /><br />
		</div>
	</form>

</body>
</html>


<?php
	oci_free_statement($stmt);
    oci_close($conn);
	}
?>