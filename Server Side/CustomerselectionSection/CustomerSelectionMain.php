<?php

	function CustomerSelection()
	{
?>
<html>
<body>
    <div id="pageHeader"> Customer Selection </div>
    <div>
   <div>
<?php
        $username = $_SESSION['username'];
		$password = $_SESSION['password'];
        $conn = hsu_conn_sess($username, $password);
        
        $select_cust = 'select cust_id, f_name, l_name '.
                       'from Customer';
        $stmt = oci_parse($conn, $select_cust);
        oci_execute($stmt, OCI_DEFAULT);
 ?>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
			<fieldset>
				<legend> Select A Customer </legend>

					<select name="customer" size="6" required>
<?php
						while (oci_fetch($stmt))
						{
							$curr_f_name = oci_result($stmt, "F_NAME");
							$curr_l_name = oci_result($stmt, "L_NAME");
							$curr_cust_id = oci_result($stmt, "CUST_ID")
?>
							<option value="<?= $curr_cust_id ?>"> <?= $curr_f_name ?> <?= $curr_l_name ?> </option>
<?php
						}
?>
					</select>
			</fieldset>
	    <fieldset >
			Search: <input type = "text" name = "searchCust" id = "searchCust" value ="Search Customer by name" /><br/>
            <input type="submit" name="select" id="select" value="Select" /><br />
	    </fieldset>
	</form>
	<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
				<input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
	</form>
    </div>
</body>
</html>


 <?php
    oci_free_statement($stmt);
    oci_close($conn);
}
    ?>
