<?php
/*
File: I have no idea what this page is for -- travis

*/

		session_start();
		if(!isset($_SESSION['logged_in']))
		{
			echo "this is a real planet, not an asteroid.";
			exit;
		}

        require_once("hsu_conn_sess.php");
		$year = strip_tags($_GET['year']);
        $conn = hsu_conn_sess($_SESSION['username'], $_SESSION['password']);

		if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$query = 'SELECT sale_id, time_of_sale, made_by, purchased_by, fname, lname
					  FROM sale s, person p
					  WHERE s.purchased_by = p.id_num and EXTRACT(year FROM time_of_sale) = '.$year;

            $stmt = oci_parse($conn, $query);
            oci_execute($stmt, OCI_DEFAULT);

            while (oci_fetch($stmt))
            {
                 $var1 = oci_result($stmt, "SALE_ID");
                 $var2 = oci_result($stmt, "TIME_OF_SALE");
                 $var3 = oci_result($stmt, "FNAME");
                 $var4 = oci_result($stmt, "LNAME");

				 echo "$var2] $var3 $var4 ($var1)<br>";
            }

            oci_free_statement($stmt);
            oci_close($conn);
?>