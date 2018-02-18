<?php
/*
File: Admin Delete Admin Page
	  
*/

require_once("php-database.php");
	//checks see if it is being passed something from post from vendors delete
	if(isset($_POST['del_ven']) && (!is_null($_POST['del_ven'])))
	{
		$venname = $_POST['del_ven'];
		$table = 'Vendors';
		$col = 'ven_name';
		
		echo $_POST['del_ven'].'<br>';
		//call to remove function		
		remove_from_db($table,$venname,$col);
		
		header("Refresh:.00000000000000000000000000000000000000000000000000000000000000001; url=index.php?page=vendors");
	}
	else
	{
		return -1
	}
	

?>