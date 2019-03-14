<?php
    function hsu_conn_sess()
    {
		require('connect_info.php');
		require('DB.php');
        error_reporting(E_ERROR | E_PARSE);
		
		$usr =  "centerac_" . $username;
		
		$user = $_SESSION['empl_user'];
		$pass = $_SESSION['empl_pass'];
		
		$connctn = new PDO($DB , $usr, $password, array('charset'=>'utf8'));
	
		$Can_access = $connctn->prepare("SELECT empl_id
									FROM Employee
									WHERE user_n = :user and pass_w = :pass");
		$Can_access->bindValue(':user', $user, PDO::PARAM_STR);
		$Can_access->bindValue(':pass', $pass, PDO::PARAM_STR);
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
			return $connctn;
		}
		
    }
?>