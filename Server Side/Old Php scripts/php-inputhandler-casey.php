<?php
// this will handle POST trasitions to other pages

require_once("php-database.php");

//This checks for insert inventory page
	if
	((isset($_POST['id'])) &&
	((isset($_POST['name'])) &&
	((isset($_POST['size'])) &&
	((isset($_POST['type'])) &&
	((isset($_POST['status'])) &&
	((isset($_POST['model'])) &&
	((isset($_POST['price'])) &&
	((isset($_POST['package'])) &&
	((isset($_POST['location'])))))))))))
	
	{
		$id = $_POST['id'];
		$name = $_POST['name'];
		$size = $_POST['size'];
		$type = $_POST['type'];
		$status = $_POST['status'];
		$model = $_POST['model'];
		$price = $_POST['price'];
		$package = $_POST['package'];
		$location = $_POST['location'];
		$vbackid = 'ITEM_BACK_ID';
		$vid = 'item_front_id';
		$vname = 'item_name';
		$vsize = 'item_size';
		$vtype = 'item_type';
		$vresid = 'reserve_id';
		$vstatus = 'status';
		$vmodel = 'model';
		$vprice = 'price';
		$vnotes = 'note';
		$vpackage = 'pack_id';
		$vlocation = 'location';
		$table = 'Item';
		$nextval = db_query_get_nextval($vbackid, $table);
		$col = "$vbackid,$vid,$vname,$vsize,$vtype,$vresid,$vstatus,$vmodel,$vprice,$vnotes,$vpackage,$vlocation";
		$value = "$nextval,'$id','$name','$size','$type',NULL,'$status','$model','$price',NULL,$package,'$location'";

		db_insert($table,$col,$value);
	}
	header("Refresh:.00000000000000000000000000000000000000000000000000000000000000001; url=index.php");

//}


?>