<?php

	function EditCustomer()
	{
?>
<html>
<body>
    <div id="pageHeader"> Edit Customer </div>
	
    <div>
	<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
<?php
		$cust_info = 'select f_name, l_name, c_dob, c_addr, c_phone, c_email, emerg_contact '.
						'from Customer '.
						'where cust_id = :sel_user';				
		$conn = hsu_conn_sess($_SESSION['username'], $_SESSION['password']);
		
		
		$sel_user = $_SESSION['sel_user'];
		$stmt = oci_parse($conn, $cust_info);
		oci_bind_by_name($stmt, ":sel_user", $sel_user);
		oci_execute($stmt, OCI_DEFAULT);
		while(oci_fetch($stmt))
		{
			$curr_f_name = oci_result($stmt, "F_NAME");
			$curr_l_name = oci_result($stmt, "L_NAME");
			$curr_dob = oci_result($stmt, "C_DOB");
			$curr_addr = oci_result($stmt, "C_ADDR");
			$curr_phone = oci_result($stmt, "C_PHONE");
			$curr_email = oci_result($stmt, "C_EMAIL");
			$curr_emg_contact = oci_result($stmt, "EMERG_CONTACT");
?>		
			Customer First Name: <input type = "text" name = "curr_f_name" id = "<?= $curr_f_name ?>" value ="<?= $curr_f_name ?>" /><br/> 
			Customer Last Name: <input type = "text" name = "curr_l_name" id = "<?= $curr_l_name ?>" value ="<?= $curr_l_name ?>" /><br/>
			Customer Address: <input type = "text" name = "curr_addr" id = "<?= $curr_addr ?>" value ="<?= $curr_addr ?>" /><br/>                       
			Customer Phone: <input type = "text" name = "curr_phone" id = "<?= $curr_phone ?>" value ="<?= $curr_phone ?>" /><br/> 
			Customer Email: <input type = "text" name = "curr_email" id = "<?= $curr_email ?>" value ="<?= $curr_email ?>" /><br/> 
			Customer Date of Birth: <input type = "text" name = "curr_dob" id = "<?= $curr_dob ?>" value ="<?= $curr_dob ?>" /><br/> 
			Customer Emergency Contact: <input type = "text" name = "curr_emg_contact" id = "<?= $curr_emg_contact ?>" value ="<?= $curr_emg_contact ?>" /><br/> 
<?php
		}
?>
	    <fieldset >
            <input type="submit" name="updateCust" id="updateCust" value="Update Customer" /><br />
	        <input type="submit" name="removeCust" id="removeCust" value="Remove Customer" /><br />
            <input type="submit" name="cancelOnEditCust" id="cancelOnEditCust" value="Cancel" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>
<?php
    oci_free_statement($stmt);
    oci_close($conn);
}
    ?>