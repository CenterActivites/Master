<?php
// this will handle post trasitions to other pages
// this file should probably be transitioned into the format of all of the other pages, where it is brought into the top of the code for the sub pages where it is used (probably just one page though)

require_once("php-database.php");

//This checks for insert user page
	if
	((isset($_POST['username'])) &&
	((isset($_POST['password'])) &&
	((isset($_POST['empl_fname'])) &&
	((isset($_POST['empl_lname'])) &&
	((isset($_POST['power_level'])))))))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$empl_fname = $_POST['empl_fname'];
		$empl_lname = $_POST['empl_lname'];
		$power_level = $_POST['power_level'];
		$id = 'USER_ID';
		$uname = 'username';
		$pword = 'password';
		$emp_fname = 'empl_fname';
		$emp_lname = 'empl_lname';
		$p_level = 'power_level';
		$table = 'Users';
		$nextval = db_query_get_nextval($id, $table);
		$col = "$id,$uname,$pword,$emp_fname,$emp_lname,$p_level";
		$value = "$nextval,'$username','$password','$empl_fname','$empl_lname',$power_level";

		db_insert($table,$col,$value);
		
		//header("Refresh:.00000000000000000000000000000000000000000000000000000000000000001; url=index.php");


	}
	elseif
	((isset($_POST['ven_name'])) &&
	((isset($_POST['ven_phone'])) &&
	((isset($_POST['ven_email'])) &&
	((isset($_POST['ven_location']))))))
	{
		$venname = $_POST['ven_name'];
		$venphone = $_POST['ven_phone'];
		$venemail = $_POST['ven_email'];
		$venlocation = $_POST['ven_location'];
		$id ='VEN_ID';
		$ven_name = 'ven_name';
		$ven_phone = 'ven_phone';
		$ven_email = 'ven_email';
		$ven_location = 'ven_location';
		$table = 'Vendors';
		$nextval = db_query_get_nextval($id,$table);
		$col = "$id ,$ven_name,$ven_phone,$ven_email,$ven_location";
		$value = "$nextval,'$venname','$venphone','$venemail','$venlocation'";

		db_insert($table,$col,$value);
		
	    //header("Refresh:.00000000000000000000000000000000000000000000000000000000000000001; url=index.php?page=vendors");
	}
	
	elseif
	((isset($_POST['pack_name']))) 
	{
		$packname = $_POST['pack_name'];
		$id ='PACK_ID';
		$pack_name = 'pack_name';	
		$table = 'Packages';
		$nextval = db_query_get_nextval($id,$table);
		$col = "$id ,$pack_name";
		$value = "$nextval,'$packname'";

		db_insert($table,$col,$value);
		
		header("Refresh:.00000000000000000000000000000000000000000000000000000000000000001; url=index.php");
	}
	


?>