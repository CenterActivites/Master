<?php

    function hsu_conn_sess($usr, $pwd)
    {
      
        error_reporting(E_ERROR | E_PARSE);
		
		$usr =  "centerac_" . $usr;
		
		$empl_user = $_SESSION['empl_user'];
		$empl_pass = $_SESSION['empl_pass'];
		
		$connctn = new PDO("mysql:host=localhost", $DB, $usr, $pwd, array('charset'=>'utf8'));
			
		$Can_access = $connctn->prepare("SELECT empl_id
									FROM Employee
									WHERE empl_fname = :f_name and empl_lname = :l_name");
		$Can_access->bindValue(':f_name', $empl_user, PDO::PARAM_STR);
		$Can_access->bindValue(':l_name', $empl_pass, PDO::PARAM_STR);
		$Can_access->execute();
		$display_array = $Can_access->fetchAll();
		
		if($display_array[0][0]=="")
		{
			require_once('Login.php');
			echo "<br>";
            echo "Sorry, it seem you entered your Username and Password incorrectly";
			$_SESSION = [];
            session_destroy();
?>
            <form action="http://centeractivitiesequipment.reclaim.hosting">
				<input type="submit" value="Back to Login Screen" />
			</form>
<?php
            exit;
		}
		else
		{
			$_SESSION['lvl_access'] = $display_array[0][0];
			return $connctn;
		}
		
    }
?>