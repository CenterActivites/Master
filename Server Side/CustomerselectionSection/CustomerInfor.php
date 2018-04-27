<?php

	function CustomerInfo()
	{
?>
<html>
<body>
    <div id="pageHeader"> Customer Information </div>
   <div>
		<textarea rows="10" cols="60">
<?php
			$cust_info = 'select f_name, l_name, c_dob, c_addr, c_phone, c_email, emerg_contact '.
							'from Customer '.
							'where cust_id = :sel_user';
							
			$conn = hsu_conn_sess($_SESSION['username'], $_SESSION['password']);
			if(isset($_POST["select"]))
			{
				$sel_user = htmlspecialchars(strip_tags($_POST["customer"]));
				$_SESSION['sel_user'] = $sel_user;
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
					Customer Name: <?= $curr_f_name ?> <?= $curr_l_name ?>            
					Customer Address: <?= $curr_addr ?>                       
					Customer Phone: <?= $curr_phone ?> 
					Customer Email: <?= $curr_email ?> 
					Customer Date of Birth: <?= $curr_dob ?> 
					Customer Emergency Contact: <?= $curr_emg_contact ?> 
<?php
				}
			}
			else
			{
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
					Customer Name: <?= $curr_f_name ?> <?= $curr_l_name ?>            
					Customer Address: <?= $curr_addr ?>                       
					Customer Phone: <?= $curr_phone ?> 
					Customer Email: <?= $curr_email ?> 
					Customer Date of Birth: <?= $curr_dob ?> 
					Customer Emergency Contact: <?= $curr_emg_contact ?> 
<?php
				}
			}
?>
		</textarea>
    </div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="viewTran" id="viewTran" value="View Transactions" /><br />
            <input type="submit" name="editCust" id="editCust" value="Edit Customer" /><br />
			<input type="submit" name="back" id="back" value="Back" /><br />
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