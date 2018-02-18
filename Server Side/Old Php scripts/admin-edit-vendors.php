<?php
	require_once("php-database.php");
	
	//checks see if it is being passed something from post from vendors edit
	if(isset($_POST['edit_ven']) && (!is_null($_POST['edit_ven'])) && 
	  (isset($_POST['edit_ven2']) && (!is_null($_POST['edit_ven2'])) && 
	  (isset($_POST['ven_submit_edit']) && (!is_null($_POST['ven_submit_edit'])))))
	{
		$venname = $_POST['edit_ven'];
		
		$table = 'Vendors';
		$col = 'ven_name';
		
		echo $_POST['edit_ven'].'<br>';
		echo $_POST['edit_ven2'].'<br>';
		echo $_POST['ven_submit_edit'].'<br>';
		//call to remove function		
		updata_db($table,$where,$col,$value);
		
		header("Refresh:.00000000000000000000000000000000000000000000000000000000000000001; url=index.php?page=vendors");
	}
	else
	{
		return -1;
	}



<?