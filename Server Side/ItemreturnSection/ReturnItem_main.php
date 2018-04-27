<!DOCTYPE html>
<html  xmlns="http://www.w3.org/1999/xhtml">

<!--

-->

<head>
    <title> Custom-query </title>
    <meta charset="utf-8" />





	<?php

	require_once('hsu_conn_sess.php');
	require_once('searchfunct.js');
	
	?>



    <link href="http://users.humboldt.edu/smtuttle/styles/normalize.css"
          type="text/css" rel="stylesheet" />

    
	
	
</head>
<body>

<?php
    function ReturnItem()
    {

		if ( (! array_key_exists("username", $_SESSION)) or
            ($_SESSION["username"] == "") or
             (! isset($_SESSION["username"])) )
        {
            complain_and_exit("username");
        }

		$username = strip_tags($_SESSION['username']);  //We grab the username and password the user input and logs the user in with the inputs
		$password = strip_tags($_SESSION['password']);
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$conn = hsu_conn_sess($username, $password);

		$sel_cust_str = 'select f_name, l_name, cust_id, c_addr, c_phone
						 from Customer';

		$sel_cust_stmt = oci_parse($conn, $sel_cust_str);

		oci_execute($sel_cust_stmt, OCI_DEFAULT);
		
		?>
		
		<form method="post"
          action="<?= htmlentities($_SERVER['PHP_SELF'], 
                                   ENT_QUOTES) ?>">
		<!--<div class="dropdown" >
			<div id="myDropdown" class="dropdown-content" >
			<input type="text" placeholder="Search.." id="myInput" name="cust_id" onkeyup="filterFunction()"> -->

			<fieldset>
				<legend> Account Name </legend> 
				<select class="selectpicker" name="cust_id" size="3">
								
		<?php
		
		while (oci_fetch($sel_cust_stmt))
		{
			
			$curr_f_name = oci_result($sel_cust_stmt, "F_NAME");
			$curr_l_name = oci_result($sel_cust_stmt, "L_NAME");
			$curr_c_phone = oci_result($sel_cust_stmt, "C_PHONE");
			$curr_c_addr = oci_result($sel_cust_stmt, "C_ADDR");
			$curr_cust_id = oci_result($sel_cust_stmt, "CUST_ID");
			
			?>
				
				<!--<a name="cust_id"> -->
				<option value="<?= $curr_cust_id ?>">
					<?= $curr_f_name ?>, <?= $curr_l_name ?>, 
					<?= $curr_c_addr ?>, <?= $curr_c_phone ?> </option>
					<!--</a> -->
			
			<?php
			
		}
		
		?>
			</select>
			</fieldset>
			<!--</div> -->
		<!--</div> -->
			<!--</table>
			<input type = "text" id = "myInput" name = "searchCust" onkeyup="myFunction">
			</div> -->

			<div>
			<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
					<input type="submit" name="Select" id="Select" value="Select Cust" /><br />
					<input type="submit" name="Cancel" id="Cancel" value="Cancel Return" /><br />
			</form>
			</div>
		</form>
		</form>
		


<?php
	oci_free_statement($sel_cust_stmt);
	oci_close($conn);
    }
?>


</body>
</html>
