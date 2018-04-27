<?php

	function CalPay()
	{
?>
<html>
<body>
<?php
	$username = $_SESSION['username']; 
	$password = $_SESSION['password'];
	$conn = hsu_conn_sess($username, $password);
	$sel_cust = $_SESSION['sel_user'];
	$item_id = $_SESSION['item_id'];
	$if_student = 'select is_student '.
					'from Customer '.
					'where cust_id = :sel_cust';
	$select_item = "select stu_day_price, stu_weekend_price, stu_week_price ".
                       "from Item a, Inventory c ".
					   "where a.inv_id = c.inv_id";
	$stmt = oci_parse($conn, $if_student);
	oci_bind_by_name($stmt, ":sel_cust", $sel_cust);
	oci_execute($stmt, OCI_DEFAULT);
	while(oci_fetch($stmt))
	{
		$is_student = oci_result($stmt, "IS_STUDENT");
	}
	
	$diff = date_diff( $_SESSION['request_date'], $_SESSION['due_date']);
	if($is_student == 'yes')
	{
		if($diff->d <= 2)
		{
			$_price = "select stu_day_price ".
                       "from Item a, Inventory c ".
					   "where a.inv_id = c.inv_id and a.item_Backid = :item_id";
			$stmt1 = oci_parse($conn, $_price);
			oci_bind_by_name($stmt1, ":item_id", $item_id);
			oci_execute($stmt1, OCI_DEFAULT);
			while(oci_fetch($stmt1))
			{
				$price = oci_result($stmt1, "STU_DAY_PRICE");
			}
		}
		elseif($diff->d >= 3 and $diff->d <=4)
		{
			$_price = "select stu_weekend_price ".
                       "from Item a, Inventory c ".
					   "where a.inv_id = c.inv_id and a.item_Backid = :item_id";
			$stmt1 = oci_parse($conn, $_price);
			oci_bind_by_name($stmt1, ":item_id", $item_id);
			oci_execute($stmt1, OCI_DEFAULT);
			while(oci_fetch($stmt1))
			{
				$price = oci_result($stmt1, "STU_WEEKEND_PRICE");
			}
		}
		else
		{
			$_price = "select stu_week_price ".
                       "from Item a, Inventory c ".
					   "where a.inv_id = c.inv_id and a.item_Backid = :item_id";
			$stmt1 = oci_parse($conn, $_price);
			oci_bind_by_name($stmt1, ":item_id", $item_id);
			oci_execute($stmt1, OCI_DEFAULT);
			while(oci_fetch($stmt1))
			{
				$price = oci_result($stmt1, "STU_WEEK_PRICE");
			}
		}
	}
	else
	{
		if($diff->d <= 2)
		{
			$_price = "select day_price ".
                       "from Item a, Inventory c ".
					   "where a.inv_id = c.inv_id and a.item_Backid = :item_id";
			$stmt1 = oci_parse($conn, $_price);
			oci_bind_by_name($stmt1, ":item_id", $item_id);
			oci_execute($stmt1, OCI_DEFAULT);
			while(oci_fetch($stmt1))
			{
				$price = oci_result($stmt1, "DAY_PRICE");
			}
		}
		elseif($diff->d >= 3 and $diff->d <=4)
		{
			$_price = "select weekend_price ".
                       "from Item a, Inventory c ".
					   "where a.inv_id = c.inv_id and a.item_Backid = :item_id";
			$stmt1 = oci_parse($conn, $_price);
			oci_bind_by_name($stmt1, ":item_id", $item_id);
			oci_execute($stmt1, OCI_DEFAULT);
			while(oci_fetch($stmt1))
			{
				$price = oci_result($stmt1, "WEEKEND_PRICE");
			}
		}
		else
		{
			$_price = "select week_price ".
                       "from Item a, Inventory c ".
					   "where a.inv_id = c.inv_id and a.item_Backid = :item_id";
			$stmt1 = oci_parse($conn, $_price);
			oci_bind_by_name($stmt1, ":item_id", $item_id);
			oci_execute($stmt1, OCI_DEFAULT);
			while(oci_fetch($stmt1))
			{
				$price = oci_result($stmt1, "WEEK_PRICE");
			}
		}
	}
	$tax = $price * 0.086;
	$final_price = $price + $tax;
?>
    <div id="pageHeader"> Calculate Payments </div>
        Deposit Amount: <output name="deposit" for="deposit"></output>
		Total Cost of Rental: <output name="totalCost" for="totalCost"><?= $final_price  ?></output>

    <div>
		<textarea rows="10" cols="60">
			Return Policy
			.....
			.....
			.....
			.....
			.....
			.....
		</textarea>
    </div>
	<div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="finalize" id="finalize" value="Finalize" /><br />
	        <input type="submit" name="cancelFinal" id="cancelFinal" value="Cancel" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>