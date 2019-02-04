<?php

    function hsu_conn_sess($usr, $pwd)
    {
      
        error_reporting(E_ERROR | E_PARSE);
		
		$usr =  "centerac_" . $usr;
        //$connctn = new PDO("mysql:host=localhost; dbname=centerac_center_activities", $usr, $pwd);
		try
		{
			$connctn = new PDO("mysql:host=localhost; dbname=centerac_center_activities", $usr, $pwd, array('charset'=>'utf8'));
			return $connctn;
		}
		catch(PDOException $ex)
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
    }
?>