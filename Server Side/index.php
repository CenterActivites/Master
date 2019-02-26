<?php
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire');
    session_start();
    // read this page when you get a chance Lam.
    //https://stackoverflow.com/questions/19215637/navigate-back-with-php-form-submission
    //http://php.net/manual/en/function.session-cache-limiter.php

?>
<html>

<head>

	<style>
		.background
		{
			margin: 0px auto;
			text-align: centered;
			width: 80%;
			background-color: #f2f2f2;
			border:1.5px solid #008000;
			opacity: 0.98;
			height: auto;
		}
	</style>

    <title> Center Activities </title>
    <meta charset="utf-8" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.backstretch.min.js"></script>
	<script type="text/javascript">
		$.backstretch("Images/humboldt-activities-center.jpg", {speed: 150});
	</script>


<?php
    /* Here we add every new page we create (Linking every page together) */
	date_default_timezone_set('America/Los_Angeles');
    define("domain", "http://centeractivitiesequipment.reclaim.hosting/");
	require_once('hsu_conn_sess.php');
	require_once('HomePage.php');
    require_once('Login.php');
	require_once('NavBar.php'); //added the require for main menu back up here because as long everything is in the
			                      //php function nothing unwanted html will show on the correct page
    require_once('/home/centerac/public_html/VendorSection/MainVendor.php');  //Since the files are under a subdirectory, the require_once
				                                                                  //statement have to look like this
	require_once('/home/centerac/public_html/VendorSection/AddVendor.php');
	require_once('/home/centerac/public_html/VendorSection/EditVendor.php');
	require_once('/home/centerac/public_html/VendorSection/VendorInfo.php');
	//require_once('/home/centerac/public_html/VendorSection/addvendor-posthandler.php');
	require_once('/home/centerac/public_html/ItemTranSection/Items_to_pick_up.php');
	require_once('/home/centerac/public_html/ItemTranSection/Items_to_return.php');
	require_once('/home/centerac/public_html/ItemTranSection/Receipt.php');
	require_once('/home/centerac/public_html/ItemselectionSection/ItemSelectionMenu.php');
	require_once('/home/centerac/public_html/ItemselectionSection/AddingNewInventory.php');
    require_once('/home/centerac/public_html/ItemselectionSection/AddingNewItems.php');
	require_once('/home/centerac/public_html/ItemselectionSection/ItemInfo.php');
	require_once('/home/centerac/public_html/ItemselectionSection/EditItem.php');
    require_once('/home/centerac/public_html/ItemselectionSection/editinventory.php');
	require_once('/home/centerac/public_html/CustomerselectionSection/CustomerSelectionMain.php');
	require_once('/home/centerac/public_html/CustomerselectionSection/CustomerInfor.php');
	require_once('/home/centerac/public_html/CustomerselectionSection/CustomerTransaction.php');
	require_once('/home/centerac/public_html/CustomerselectionSection/EditCustomer.php');
    require_once('/home/centerac/public_html/CustomerselectionSection/addcust.php');
	require_once('/home/centerac/public_html/CustomerselectionSection/PastReceipt.php');
	require_once('/home/centerac/public_html/RentalSection/RentalItemSelection.php');
	require_once('/home/centerac/public_html/RentalSection/CalculatePayments.php');
	require_once('/home/centerac/public_html/EmployeeSection/EmployeeSelectionMain.php');
	require_once('/home/centerac/public_html/EmployeeSection/EmployeeInfor.php');
	require_once('/home/centerac/public_html/EmployeeSection/EmployeeAction.php');
	require_once('/home/centerac/public_html/EmployeeSection/EditEmployee.php');
    require_once('/home/centerac/public_html/EmployeeSection/addempl.php');
?>


</head>
<body>

<?php

	if (! array_key_exists('next_page', $_SESSION))       //Here when we first enter the site and check the if there is a session or at all.
    {
        login();     //We call the Login function which allows users login
		$_SESSION['next_page'] = "MainMenu"; //We set the session key 'next_page' equal the spring value 'MainMenu'
    }
	elseif($_SESSION['next_page'] == "MainMenu")
	{

		$empl_user = htmlspecialchars($_POST["username"]);	//We grab the username and password the user input and logs the user in with the inputs
		$empl_pass = htmlspecialchars($_POST["password"]);

		//We grab the username and password the user input and logs the user in with the inputs
		$username = "test";
		$password = "Testing123+";
		//PDO Connection to the Database
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		
		$_SESSION['empl_user'] = $empl_user;
		$_SESSION['empl_pass'] = $empl_pass;
		
		$conn = hsu_conn_sess($username, $password); //Here we call the function 'hsu_conn_sess' which will does the connection to nrs-projects

		NavBar();
?>
		<div class="background">
<?php
			
			$_SESSION['next_page'] = "HomePage";
			HomePage();
?>
		</div>
<?php
		//The user wouldn't go back to this elseif ever again, none less they press the logout button.
	}


	//======================================================================
	//Vendor Section
	//======================================================================

	elseif($_SESSION['next_page'] == "Vendor_buttons") //When all the functional of all the vendor's button is going to be placed
	{
		if(isset($_POST["LogOut"]))
	    {
		    login();
			$_SESSION['next_page'] = "MainMenu";
	    }
		else
		{
			NavBar();

?>
			<div class="background">
<?php
				if(isset($_POST["AVendor"])) //LogOut Button. When pressed logs the user out and set the next_page back to mainmenu
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					AddVendor();
				}
				elseif(isset($_POST["HomePage"])) //HomePage Button. When pressed sends users to the Home Page.
				{
					$_SESSION['next_page'] = "HomePage";
					HomePage();
				}
				elseif(isset($_POST["ViewVen"])) //View/Edit Vendors Button. Send users to the vendor's section where they can add/view/edit vendors
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					Vendor();
				}
				elseif(isset($_POST["Cust"])) //View/Edit Customer Button. Send users to the customer's section where they can add/view/edit customer
				{
					$_SESSION['next_page'] = "Customer_Section";
					CustomerSelection();
				}
				elseif(isset($_POST['ReturnI'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ReturnItem_buttons";
					$_SESSION['itemReturn'] = "Yes";
					CustomerSelection();
					$_SESSION['itemReturn'] = "No";
				}
				elseif(isset($_POST['ViewInv'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ItemSelection_buttons";
					Itemselection();
				}
				elseif(isset($_POST["Empl"])) //Employee button, sends users to employee section.
				{
					$_SESSION['next_page'] = "Employee";
					Employee();
				}
				elseif (isset($_POST["AddVendor"]))
				{
					//removal of post handler from files is needed
					//this is an input of vendors into the Database
					//make a connection to database
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					//set variables to the values input by user
					$new_ven_name = htmlspecialchars(strip_tags($_POST["venName"]));
					$new_ven_phone = htmlspecialchars(strip_tags($_POST["venPhone"]));
					$new_ven_address = htmlspecialchars(strip_tags($_POST["venLoc"]));
					//set up insert statement
					$insert = $conn ->prepare("insert into Vendor
												(ven_id, ven_name, ven_phone, ven_address)
												values
												(Default, ?, ?, ?)");
					//execute the statement with variables
					$insert ->execute([$new_ven_name, $new_ven_phone, $new_ven_address]);
					//end connection
					$conn = null;
					//return to vendors page to see updates
					Vendor();
				}
				elseif(isset($_POST["editVen"])) //Edit Vendor button. Pushes users to the section to add/remove/edit Vendors.
				{
					EditVendor();
				}
				elseif (isset($_POST['updateVen']))
				{

					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					
					$conn = hsu_conn_sess($username, $password);

					$new_ven_name = htmlspecialchars(strip_tags($_POST["ven_name_edit"]));
					$new_ven_phone = htmlspecialchars(strip_tags($_POST["ven_phone_edit"]));
					$new_ven_address = htmlspecialchars(strip_tags($_POST["ven_loc_edit"]));
					$ven_id = htmlspecialchars(strip_tags($_POST["change_ven_id"]));


					$update = $conn ->prepare("UPDATE Vendor
												SET ven_name = '$new_ven_name',
													ven_phone = '$new_ven_phone',
													ven_address = '$new_ven_address'
												WHERE ven_id = '$ven_id'");

					$update ->execute();

					$conn = null;

					Vendor();
				}
				elseif (isset($_POST["removeVen"]))
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					$ven_id = htmlspecialchars(strip_tags($_POST["change_ven_id"]));

					$remove = $conn -> prepare("DELETE FROM Vendor
												WHERE ven_id = '$ven_id'");
					$remove -> execute();

					$conn = null;

					Vendor();
				}
				elseif(isset($_POST["moreIn"])) //Update button/Cancel button on Edit Vendor page/More Infor. Button
												//Pushes users to the More Infor. for Vendors page
				{
					InfoVendor();
				}
				elseif(isset($_POST["backToMainSection"]) or isset($_POST["cancelEdit"]) or isset($_POST["updateVen"])) //Remove Vendor button on Edit Vendor page/Back button on Vendor's Infor. page.
																														//Pushes users the Vendor's main menu.
				{
					Vendor();
				}
				else //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
					//We just move on back the main section page. We see this mainly when people refresh the page.
				{
					Vendor();
				}
?>
			</div>
<?php
		}
	}

	
	
	//======================================================================
	//Home Page Section
	//======================================================================

	elseif($_SESSION['next_page'] == "HomePage") //When all the functional of all the vendor's button is going to be placed
	{
		if(isset($_POST["LogOut"]))
	    {
		    login();
			$_SESSION['next_page'] = "MainMenu";
	    }
		else
		{
			NavBar();

?>
			<div class="background">
<?php
				if(isset($_POST["AVendor"])) //LogOut Button. When pressed logs the user out and set the next_page back to mainmenu
				{
					AddVendor();
					$_SESSION['next_page'] = "Vendor_buttons";
				}
				elseif(isset($_POST["HomePage"])) //HomePage Button. When pressed sends users to the Home Page.
				{
					HomePage();
					$_SESSION['next_page'] = "HomePage";
				}
				elseif(isset($_POST["ViewVen"])) //View/Edit Vendors Button. Send users to the vendor's section where they can add/view/edit vendors
				{
					Vendor();
					$_SESSION['next_page'] = "Vendor_buttons";
				}
				elseif(isset($_POST["Cust"])) //View/Edit Customer Button. Send users to the customer's section where they can add/view/edit customer
				{
					CustomerSelection();
					$_SESSION['next_page'] = "Customer_Section";
				}
				elseif(isset($_POST['ReturnI'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['itemReturn'] = "Yes";
					CustomerSelection();
					$_SESSION['itemReturn'] = "No";
					$_SESSION['next_page'] = "ReturnItem_buttons";
				}
				elseif(isset($_POST['ViewInv'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					Itemselection();
					$_SESSION['next_page'] = "ItemSelection_buttons";
				}
				elseif(isset($_POST["Empl"])) //Employee button, sends users to employee section.
				{
					Employee();
					$_SESSION['next_page'] = "Employee";
				}
				elseif($_POST['which_table'] == "Late")
				{
					ItemToReturn();
					$_SESSION['next_page'] = "ReturnItem_buttons";
				}
				elseif($_POST['which_table'] == "Pick")
				{
					ItemToPickUp();
				}
				elseif(isset($_POST["Checkout"])) //Once the user is done selecting the item the customer is picking today, this button "Checkout" will push the user
				{
					//Create the connection to the database
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					
					//Grabbing the comments about the items the user entered when doing the item return
					$comments = strip_tags($_POST['comments']);
					
					//Grabbing the item array/list that were returned
					$item_to_pick_up = $_POST["item_to_be_pick_up"];
					
					$items_to_pick_up = explode(',', $item_to_pick_up); //Filtering throught the array/list. Dropping all empty spots
					$_SESSION["item_array"] = $items_to_pick_up; //Enter the newly filtered array/list into SESSION

					//Grabbing customer id
					$cust_id = $_SESSION["cust_id"];
					
					//Here we're going to be grabbing the 'rh_id' from the Reserve table to allow us to update the correct ReserveHis row
					$rh_id_select = $conn->prepare("select rh_id
													from Reserve
													where cust_id = :cust_id");
					$rh_id_select->bindValue(':cust_id', $cust_id, PDO::PARAM_INT);
					$rh_id_select->execute();
					$rh_id_select = $rh_id_select->fetchAll();
					$rh_id = $rh_id_select[0][0];
					
					//Format the current date into a date without the hours and mins for both ReserveHis and Reserve table.
					$current_date = date('Y-m-d');
					$update = $conn->prepare("update ReserveHis
												set pick_up_date = :current_date
												where rh_id = :rh_id");
					$update->bindValue(':current_date', $current_date, PDO::PARAM_STR);
					$update->bindValue(':rh_id', $rh_id, PDO::PARAM_INT);
					$update->execute(); //execute the query
					
					$update = $conn->prepare("update Reserve
												set pick_up_date = :current_date
												where cust_id = :cust_id");
					$update->bindValue(':current_date', $current_date, PDO::PARAM_STR);
					$update->bindValue(':cust_id', $cust_id, PDO::PARAM_INT);
					$update->execute(); //execute the query

					//Grabbing current date with hours and min format for Transaction time_stamp
					$current_date = date('Y-m-d H:i:s');

					//Insert statement for Transaction to record the returns
					$insert = $conn->prepare("insert into Transaction
												(time_stamp, cust_id, trans_type, comments, rh_id)
												values
												(:time_stamp, :cust_id, 'pick-up', :comments, :rh_id)"); //Remember to added in the quotes for the dates or result of the insert will look like "0000-00-00" on dates
					//Binding the vars along with their respected datatype
					$insert->bindValue(':time_stamp', $current_date, PDO::PARAM_STR);
					$insert->bindValue(':comments', $comments, PDO::PARAM_STR);
					$insert->bindValue(':cust_id', $cust_id, PDO::PARAM_INT);
					$insert->bindValue(':rh_id', $rh_id, PDO::PARAM_INT);
					$insert->execute();
					$tran_id = $conn->lastInsertId();
					
					foreach($items_to_pick_up as $item_id)
					{
						$item_id_int = (int)$item_id;

						//Insert statement for ItemTran
						$insert = $conn->prepare("insert into ItemTran
													(item_Backid, tran_id)
													values
													(:item_id, :tran_id)");
						//Binding the vars along with their respected datatype
						$insert->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$insert->bindValue(':tran_id', $tran_id, PDO::PARAM_INT);
						$insert->execute();
						//print $insert->errorCode();

						//Updating the status of the item to 'Check-out'.
						//Remember: 'Ready' = 1, 'Repair' = 2, 'Check-out' = 3, 'Check-in' = 4, 'Missing' = 5, 'Retire' = 6, 'Reserved' = 7, 'Drying' = 8, and 'In Wash' = 9
						$update = $conn->prepare("update Item
													set stat_id = 3
													where item_Backid = :item_id");
						$update->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$update->execute(); //execute the query
					}
					
					//Remember to always to disconnect the database connection
					$conn = null;
					
					HomePage();
				}
				else //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
					//We just move on back the main section page. We see this mainly when people refresh the page.
				{
					HomePage();
				}
?>
			</div>
<?php
		}
	}
	
	
	
	

	//======================================================================
	//Item Return Section
	//======================================================================

	elseif($_SESSION['next_page'] == "ReturnItem_buttons")
	{
		if(isset($_POST["LogOut"]))
	    {
		    login();
			$_SESSION['next_page'] = "MainMenu";
	    }
		else
		{
			NavBar();
?>
			<div class="background">
<?php
				if(isset($_POST["AVendor"])) //LogOut Button. When pressed logs the user out and set the next_page back to mainmenu
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					AddVendor();
				}
				elseif(isset($_POST["HomePage"])) //HomePage Button. When pressed sends users to the Home Page.
				{
					$_SESSION['next_page'] = "HomePage";
					HomePage();
				}
				elseif(isset($_POST["ViewVen"])) //View/Edit Vendors Button. Send users to the vendor's section where they can add/view/edit vendors
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					Vendor();
				}
				elseif(isset($_POST["Cust"])) //View/Edit Customer Button. Send users to the customer's section where they can add/view/edit customer
				{
					$_SESSION['next_page'] = "Customer_Section";
					CustomerSelection();
				}
				elseif(isset($_POST['ReturnI'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ReturnItem_buttons";
					$_SESSION['itemReturn'] = "Yes";
					CustomerSelection();
					$_SESSION['itemReturn'] = "No";
				}
				elseif(isset($_POST['ViewInv'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ItemSelection_buttons";
					Itemselection();
				}
				elseif(isset($_POST["Empl"])) //Employee button, sends users to employee section.
				{
					$_SESSION['next_page'] = "Employee";
					Employee();
				}
				elseif(isset($_POST["select"]) or isset($_POST["cancelOnReceipt"])) //After finding the customer, the "select" button push the user onto the next page
																					//which is the item check-in page where the user will select which item they are returning today														   //Also when the cancel button on the Receipt page is press, the screen will move back to the item check-in																	   //part of the return section
				{
					ItemToReturn();
				}
				elseif(isset($_POST["Checkin"])) //Once the user is done selecting the item they are returning today, this button "Checkin" will push the user
												//to the finally page of the item return page which is the Receipt page
				{
					//Create the connection to the database
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					
					//Grabbing the comments about the items the user entered when doing the item return
					$comments = strip_tags($_POST['comments']);
					
					//Grabbing the item array/list that were returned
					$item_to_return = $_POST["item_to_be_return"];
					$items_to_return = explode(',', $item_to_return); //Filtering throught the array/list. Dropping all empty spots
					$_SESSION["item_array"] = $items_to_return; //Enter the newly filtered array/list into SESSION

					//Grabbing customer id
					$cust_id = $_SESSION["cust_id"];

					//Grabbing current date
					$current_date = date('Y-m-d H:i:s');
					
					//Here we're going to be grabbing the 'rh_id' from the Reserve table to allow us to update the correct ReserveHis row
					$rh_id_select = $conn->prepare("select rh_id
													from Reserve
													where cust_id = :cust_id");
					$rh_id_select->bindValue(':cust_id', $cust_id, PDO::PARAM_INT);
					$rh_id_select->execute();
					$rh_id_select = $rh_id_select->fetchAll();
					$rh_id = $rh_id_select[0][0];

					//Insert statement for Transaction to record the returns
					$insert = $conn->prepare("insert into Transaction
												(time_stamp, cust_id, trans_type, comments, rh_id)
												values
												(:time_stamp, :cust_id, 'return', :comments, :rh_id)"); //Remember to added in the quotes for the dates or result of the insert will look like "0000-00-00" on dates
					//Binding the vars along with their respected datatype
					$insert->bindValue(':time_stamp', $current_date, PDO::PARAM_STR);
					$insert->bindValue(':comments', $comments, PDO::PARAM_STR);
					$insert->bindValue(':cust_id', $cust_id, PDO::PARAM_INT);
					$insert->bindValue(':rh_id', $rh_id, PDO::PARAM_INT);
					$insert->execute();
					$tran_id = $conn->lastInsertId();
					
					//Format the current date into a date with the hours and mins for ReserveHis table.
					$current_date = date('Y-m-d', strtotime($current_date));
					$update = $conn->prepare("update ReserveHis
												set return_date = :current_date
												where rh_id = :rh_id");
					$update->bindValue(':current_date', $current_date, PDO::PARAM_STR);
					$update->bindValue(':rh_id', $rh_id, PDO::PARAM_INT);
					$update->execute(); //execute the query

					foreach($items_to_return as $item_id)
					{
						$item_id_int = (int)$item_id;

						//Deleting the reserve cause the item was returned
						$delete = $conn->prepare("delete from ItemReserve
													where item_Backid = :item_id");
						$delete->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$delete->execute();

						//Insert statement for ItemTran
						$insert = $conn->prepare("insert into ItemTran
													(item_Backid, tran_id)
													values
													(:item_id, :tran_id)");
						//Binding the vars along with their respected datatype
						$insert->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$insert->bindValue(':tran_id', $tran_id, PDO::PARAM_INT);
						$insert->execute();

						//Updating the status of the item to 'Check-in'. 
						//Remember: 'Ready' = 1, 'Repair' = 2, 'Check-out' = 3, 'Check-in' = 4, 'Missing' = 5, 'Retire' = 6, 'Reserved' = 7, 'Drying' = 8, and 'In Wash' = 9
						$update = $conn->prepare("update Item
													set stat_id = 4
													where item_Backid = :item_id");
						$update->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$update->execute(); //execute the query
					}
					
					//Checking if all items under the customer have been returned
					$items_returned = $conn->prepare("SELECT b.item_Backid
									FROM Reserve a, ItemReserve b
									WHERE a.rental_id = b.rental_id and a.cust_id = :cust_id");
					$items_returned->bindValue(':cust_id', $cust_id, PDO::PARAM_INT);
					$items_returned->execute();
					$display_array = $items_returned->fetchAll();
					$array_size = count($display_array);
					
					//If all items have been return then delete the reserve
					if($array_size == 0)
					{
						//Deleting the reserve cause all items was returned
						$delete = $conn->prepare("delete from Reserve
													where cust_id = :cust_id");
						$delete->bindValue(':cust_id', $cust_id, PDO::PARAM_INT);
						$delete->execute();
					}
?>
			</div>
<?php
					//Calls the receipt page
					Receipt();
?>
			<div class="background">
<?php

					//Remember to always to disconnect the database connection
					$conn = null;
				}
				else //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
					//We just move on back the main section page
					//Also notice that we didn't add a funtion to the "Back" button. Since the "Back" button has the same functionally
					//as this, anytime a user press the "Back" the site will think that there wasn't a button pressed and move the screen
					//back to the main section menu.
				{
					$_SESSION['itemReturn'] = "Yes";
					CustomerSelection();
					$_SESSION['itemReturn'] = "No";
				}
?>
			</div>
<?php
		}
	}


	//======================================================================
	//Item Selection Section
	//======================================================================

	elseif($_SESSION['next_page'] == "ItemSelection_buttons") //When all the functional of all the vendor's button is
	                                                          //going to be placed
	{
		if(isset($_POST["LogOut"]))
	    {
		    login();
			$_SESSION['next_page'] = "MainMenu";
	    }
		else
		{
			NavBar();
?>
			<div class="background">
<?php
				if(isset($_POST["AVendor"])) //LogOut Button. When pressed logs the user out and set the next_page back to mainmenu
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					AddVendor();
				}
				elseif(isset($_POST["HomePage"])) //HomePage Button. When pressed sends users to the Home Page.
				{
					$_SESSION['next_page'] = "HomePage";
					HomePage();
				}
				elseif(isset($_POST["ViewVen"])) //View/Edit Vendors Button. Send users to the vendor's section where they can add/view/edit vendors
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					Vendor();
				}
				elseif(isset($_POST["Cust"])) //View/Edit Customer Button. Send users to the customer's section where they can add/view/edit customer
				{
					$_SESSION['next_page'] = "Customer_Section";
					CustomerSelection();
				}
				elseif(isset($_POST['ReturnI'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ReturnItem_buttons";
					$_SESSION['itemReturn'] = "Yes";
					CustomerSelection();
					$_SESSION['itemReturn'] = "No";
				}
				elseif(isset($_POST['ViewInv'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ItemSelection_buttons";
					Itemselection();
				}
				elseif(isset($_POST["Empl"])) //Employee button, sends users to employee section.
				{
					$_SESSION['next_page'] = "Employee";
					Employee();
				}
				elseif(isset($_POST["addinventory"])) //Add Item button on the Item Selection Main Menu page. Pushes users to the add item
													//page
				{
					AddInventory();
				}
				elseif(isset($_POST["additem"])) //Add Item button on the Item Selection Main Menu page. Pushes users to the add item
												//page
				{
					AddItems();
				}
				elseif(isset($_POST["moreinfo"])) //Update button/Cancel button on Edit Vendor page/More Infor. Button
												  //Pushes users to the More Infor. for Vendors page
				{
					ItemInfo();
				}
				elseif(isset($_POST["removeItem"])) //The remove item button on the edit item view
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);

					$item_id = htmlspecialchars(strip_tags($_POST["item_Backid"]));

					$remove =$conn -> prepare("DELETE FROM Item
												WHERE item_Backid = '$item_id'");

					$remove ->execute();


					//print $remove->errorCode();


					$conn = null;



					Itemselection();
				}
				else if(isset($_POST["removeInv"]))
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);

					$inv_id = htmlspecialchars(strip_tags($_POST["inv_id"]));


					$remove =$conn -> prepare("DELETE FROM Inventory
												WHERE inv_id = '$inv_id'");

					$remove ->execute();

					$conn = null;

					Itemselection();
				}
				else if(isset($_POST["updateInv"]))
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);

					$inv_id = htmlspecialchars(strip_tags($_POST["inv_id"]));
					$inv_name = htmlspecialchars(strip_tags($_POST["curr_inv_name"]));
					$cat_id = htmlspecialchars(strip_tags($_POST["cat_select"]));
					$stu_day_price = htmlspecialchars(strip_tags($_POST["curr_stu_day_price"]));
					$day_price = htmlspecialchars(strip_tags($_POST["curr_day_price"]));
					$stu_weekend_price = htmlspecialchars(strip_tags($_POST["curr_stu_weekend_price"]));
					$weekend_price = htmlspecialchars(strip_tags($_POST["curr_weekend_price"]));
					$stu_week_price = htmlspecialchars(strip_tags($_POST["curr_stu_week_price"]));
					$week_price = htmlspecialchars(strip_tags($_POST["curr_week_price"]));


					$update = $conn ->prepare("UPDATE Inventory
												SET inv_name = '$inv_name',
													cat_id = '$cat_id',
													stu_day_price = '$stu_day_price',
													day_price = '$day_price',
													stu_weekend_price = '$stu_weekend_price',
													weekend_price = '$weekend_price',
													stu_week_price = '$stu_week_price',
													week_price = '$week_price'
												WHERE inv_id = '$inv_id'");

					$update ->execute();
					print $update -> errorCode();
					$conn = null;

					Itemselection();
				}
				elseif(isset($_POST["updateItem"])) //Here for the update button on the edit item view
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);

					$item_backid = htmlspecialchars(strip_tags($_POST["item_Backid"]));
					$item_frontid = htmlspecialchars(strip_tags($_POST["curr_item_Frontid"]));
					$item_name = htmlspecialchars(strip_tags($_POST["curr_item_name"]));
					$item_size = htmlspecialchars(strip_tags($_POST["curr_item_size"]));
					$stat_id = htmlspecialchars(strip_tags($_POST["stat_id"]));
					$item_location = htmlspecialchars(strip_tags($_POST["curr_item_loc"]));
					$item_pur_price = htmlspecialchars(strip_tags($_POST["curr_item_pur_price"]));
					$item_vendor = htmlspecialchars(strip_tags($_POST["curr_item_ven"]));
					$item_owned_dbw = htmlspecialchars(strip_tags($_POST["dbw_own"]));
					$item_pur_date = htmlspecialchars(strip_tags($_POST["curr_item_pur_data"]));
					$item_vin_num = htmlspecialchars(strip_tags($_POST["curr_item_vin_num"]));
					$item_pub_use = htmlspecialchars(strip_tags($_POST["pub_use"]));
					$item_notes = htmlspecialchars(strip_tags($_POST["curr_item_notes"]));
					$item_class = htmlspecialchars(strip_tags($_POST["Classification"]));

					$update = $conn ->prepare("UPDATE Item
												SET item_modeltype = '$item_name',
												item_Frontid = '$item_frontid',
												item_size = '$item_size',
												stat_id = '$stat_id',
      									location = '$item_location',
      									pur_price = '$item_pur_price',
      									ven_id = '$item_vendor',
      									dbw_own = '$item_owned_dbw',
      									pur_date = '$item_pur_date',
      									vin_num = '$item_vin_num',
      									public = '$item_pub_use',
      									notes = '$item_notes',
      						     inv_id = '$item_class'
											WHERE item_Backid = '$item_backid'");
					$update ->execute();
					$conn = null;

					Itemselection();
				}
				elseif(isset($_POST["editItem"])) //Edit Item button on the Item Infor. page. Pushes users to the editing
												 //item page
				{
					EditItem();
				}
				elseif(isset($_POST["editInv"])) //Edit Item button on the Item Infor. page. Pushes users to the editing
											 //item page
				{
					editinventory();
				}
				elseif(isset($_POST["add"]))
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);

					$new_inv_name = htmlspecialchars(strip_tags($_POST["new_inv_name"]));
					$new_cat = (int)htmlspecialchars(strip_tags($_POST["cat_id"]));
					$new_stu_day_price = htmlspecialchars(strip_tags($_POST["new_stu_day_price"]));
					$new_public_day_price = htmlspecialchars(strip_tags($_POST["new_public_day_price"]));
					$new_student_week_price = htmlspecialchars(strip_tags($_POST["new_student_week_price"]));
					$new_public_week_price = htmlspecialchars(strip_tags($_POST["new_public_week_price"]));
					$new_student_weekend_price = htmlspecialchars(strip_tags($_POST["new_student_weekend_price"]));
					$new_public_weekend_price =htmlspecialchars(strip_tags($_POST["new_public_weekend_price"]));


					$insert = $conn ->prepare("insert into Inventory
					(inv_id, inv_name, cat_id, stu_day_price, day_price, stu_weekend_price, weekend_price, stu_week_price, week_price)
					values
					(Default, ?, ?, ?, ?, ?, ?, ?, ?)");

					$insert ->execute([$new_inv_name, $new_cat, $new_stu_day_price, $new_public_day_price, $new_student_week_price, $new_public_week_price, $new_student_weekend_price, $new_public_weekend_price]);

					$conn = null;
					Itemselection();
				}
				elseif (isset($_POST["add2"]))
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);

					$inv_id = (int)htmlspecialchars(strip_tags($_POST["inv_id"]));
					$front_id = htmlspecialchars(strip_tags($_POST["new_front_id"]));
					$item_name = htmlspecialchars(strip_tags($_POST["new_item_name"]));
					$item_size = htmlspecialchars(strip_tags($_POST["new_size"]));
					$item_status = htmlspecialchars(strip_tags($_POST["status"]));
					$item_loc = htmlspecialchars(strip_tags($_POST["new_location"]));
					$pur_price = (int)htmlspecialchars(strip_tags($_POST["new_purchase_price"]));
					$ven_id = (int)htmlspecialchars(strip_tags($_POST["ven_id"]));
					$dbw = (int)htmlspecialchars(strip_tags($_POST["dbw"]));
					$date_pur = htmlspecialchars(strip_tags($_POST["new_purchase_date"]));
					$vin_num = (int)htmlspecialchars(strip_tags($_POST["new_vin"]));
					$pub = (int)htmlspecialchars(strip_tags($_POST["pub"]));
					$notes = (int)htmlspecialchars(strip_tags($_POST["new_notes"]));


					$insert = $conn ->prepare("insert into Item
												(item_Frontid, item_modeltype, item_size, inv_id, stat_id, location, pur_price, ven_id, dbw_own, pur_date, vin_num, public, notes)
												values
												(:item_Frontid, :item_modeltype, :item_size, :inv_id, :stat_id, :location, :pur_price, :ven_id, :dbw_own, :pur_date,
												:vin_num, :public, :notes)");

					$insert -> bindValue(':item_Frontid', $front_id, PDO::PARAM_STR);
					$insert -> bindValue(':item_modeltype', $item_name, PDO::PARAM_STR);
					$insert -> bindValue(':item_size', $item_size, PDO::PARAM_STR);
					$insert -> bindValue(':inv_id', $inv_id, PDO::PARAM_INT);
					$insert -> bindValue(':stat_id', $item_status, PDO::PARAM_INT);
					$insert -> bindValue(':location', $item_loc, PDO::PARAM_STR);
					$insert -> bindValue(':pur_price', $pur_price, PDO::PARAM_INT);
					$insert -> bindValue(':ven_id', $ven_id, PDO::PARAM_INT);
					$insert -> bindValue(':dbw_own', $dbw, PDO::PARAM_INT);
					$insert -> bindValue(':pur_date', $date_pur, PDO::PARAM_STR);
					$insert -> bindValue(':vin_num', $vin_num, PDO::PARAM_INT);
					$insert -> bindValue(':public', $pub, PDO::PARAM_INT);
					$insert -> bindValue(':notes', $notes, PDO::PARAM_STR);

					$insert ->execute();
					//print $insert->errorCode(); // <<----- The code to print the error code

					$conn = null;
					Itemselection();
				}
				elseif(isset($_POST["cancel"]) or isset($_POST["backoniteminfo"]) or isset($_POST["cancelEdit"]) ) //Cancel buttons on the Adding New Items page.
																				//Back button on the item info page, Remove Item button on
																				 //Editing Item page
																				 //Pushes users to the item selection main menu
				{
					Itemselection();
				}
				elseif(isset($_POST['refine']))
				{
					refine_search();
					// trying some new stuff since we have time
				}
				else//A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
					//We just move on back the main section page
				{
					Itemselection();
				}
?>
			</div>
<?php
		}
    }


	//======================================================================
	//Customer Selection Section
	//======================================================================

	elseif($_SESSION['next_page'] == "Customer_Section")
	{
	    if(isset($_POST["LogOut"]))
	    {
		    login();
			$_SESSION['next_page'] = "MainMenu";
	    }
		else
		{
			NavBar();
?>
			<div class="background">
<?php
				if(isset($_POST["AVendor"])) //LogOut Button. When pressed logs the user out and set the next_page back to mainmenu
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					AddVendor();
				}
				elseif(isset($_POST["HomePage"])) //HomePage Button. When pressed sends users to the Home Page.
				{
					$_SESSION['next_page'] = "HomePage";
					HomePage();
				}
				elseif(isset($_POST["ViewVen"])) //View/Edit Vendors Button. Send users to the vendor's section where they can add/view/edit vendors
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					Vendor();
				}
				elseif(isset($_POST["Cust"])) //View/Edit Customer Button. Send users to the customer's section where they can add/view/edit customer
				{
					$_SESSION['next_page'] = "Customer_Section";
					CustomerSelection();
				}
				elseif(isset($_POST['ReturnI'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ReturnItem_buttons";
					$_SESSION['itemReturn'] = "Yes";
					CustomerSelection();
					$_SESSION['itemReturn'] = "No";
				}
				elseif(isset($_POST['ViewInv'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ItemSelection_buttons";
					Itemselection();
				}
				elseif(isset($_POST["Empl"])) //Employee button, sends users to employee section.
				{
					$_SESSION['next_page'] = "Employee";
					Employee();
				}
				elseif(isset($_POST["custInfo"]) or isset($_POST["backOnCustTran"]) or isset($_POST["cancelOnEditCust"])) //Select button on the main customer/Back button on view transaction
																													   // Cancel/Update Customer button on the Customer Edit Page
																													   // Pushs user to the the Customer's Information Page
				{
					if(isset($_POST["custInfo"]))
					{
						$_SESSION['cust_id'] = strip_tags($_POST['cust_id']);
					}
					CustomerInfo();
				}
				elseif(isset($_POST["removeCust"])) //The remove customer button on the edit customer view
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					$cust_id = strip_tags($_POST['cust_id']);

					$delete = $conn ->prepare("DELETE FROM Customer
												WHERE cust_id = '$cust_id'");

					$delete -> execute();

					$conn = null;
					CustomerSelection();
				}
				elseif(isset($_POST["updateCust"])) //Here for the update button on the edit customer view
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					$cust_id = strip_tags($_POST['cust_id']);
					$cust_fname = strip_tags($_POST['cust_fname']);
					$cust_lname = strip_tags($_POST['cust_lname']);
					$cust_phone = strip_tags($_POST['cust_phone']);
					$cust_email = strip_tags($_POST['cust_email']);
					$cust_emerg_contact = strip_tags($_POST['emerg_contact']);
					$cust_address = strip_tags($_POST['cust_address']);
					$cust_is_student = strip_tags($_POST['is_student']);
					$cust_is_empl = strip_tags($_POST["empl_stat"]);
					$cust_stu_id = strip_tags($_POST['cust_stu_id']);


					$update = $conn ->prepare("UPDATE Customer
												SET f_name = '$cust_fname',
													l_name = '$cust_lname',
													c_stu_id= '$cust_stu_id',
													c_addr = '$cust_address',
													c_phone = '$cust_phone',
													c_email = '$cust_email',
													is_student = '$cust_is_student',
													is_employee = '$cust_is_empl',
													emerg_contact = '$cust_emerg_contact'
												WHERE cust_id = '$cust_id'");

					$update ->execute();


					$conn = null;
					//next inserts
					CustomerInfo();

				}
				elseif(isset($_POST["viewTran"]) or isset($_POST["PrintReceipt"]) or isset($_POST["cancelOnReceipt"])) //View Transaction button on Customer Information page
																													  //PrintReceipt/Cancel buttons Receipt page.
																													  //Pushs users to the View Transaction Page for customers
				{
					CustomerTran();
				}
				elseif(isset($_POST["viewReceipt"])) //View Receipt button. Pushs users to the receipt for printing purposes.
				{
?>
			</div>
<?php
					PastReceipt();
?>
			<div class="background">
<?php
				}
				elseif(isset($_POST["editCust"])) //Edit Customer button. Pushs users to the edit customer page.
				{
					EditCustomer();
				}
				elseif(isset($_POST["newCust"]))
				{
					addcust();
				}
				elseif(isset($_POST["Addcust"]))
				{
					//make a connection to database
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					
					//set variables to the values input by user
					$new_custName = htmlspecialchars(strip_tags($_POST["cust_name"]));
					$new_dob = htmlspecialchars(strip_tags($_POST["dob"]));
					$new_address = htmlspecialchars(strip_tags($_POST["address"]));
					$new_phone = htmlspecialchars(strip_tags($_POST["Phone"]));
					$new_email = htmlspecialchars(strip_tags($_POST["email"]));
					$new_is_student = htmlspecialchars(strip_tags($_POST["is_student"]));
					$new_is_empl = htmlspecialchars(strip_tags($_POST["empl_stat"]));
					$new_emerName = htmlspecialchars(strip_tags($_POST["emerName"]));
					$new_emerPhone = htmlspecialchars(strip_tags($_POST["emerPhone"]));

					//Separate the first and last name for the insert into database
					$f_lnames = explode(" ", $new_custName);
					$f_name = $f_lnames[0];
					$l_name = $f_lnames[1];

					//Combines the Emergency contact name and phone number
					$emer_contract = $new_emerName . " " . $new_emerPhone;

					//set up insert statement
					$insert = $conn ->prepare("insert into Customer
												(cust_id, f_name, l_name, c_stu_id, c_addr, c_phone, c_email, is_student, is_employee, emerg_contact)
												values
												(Default, ?, ?, ?, ?, ?, ?, ?, ?, ? )");
					//execute the statement with variables
					$insert ->execute([$f_name, $l_name, $new_dob, $new_address, $new_phone, $new_email, $new_is_student, $new_is_empl, $emer_contract]);
					//print $insert -> errorCode(); //<======= Prints Error Code For INSERT Statement =======>
					
					//end connection
					$conn = null;
					
					CustomerSelection();
				}
				
				
				
				
				//======================================================================
				//Rental Section
				//======================================================================
				
				elseif(isset($_POST["cancelFinal"]))
				{
					CustomerSelection(); //Pulls up the rental section customer select page
				}
				elseif(isset($_POST["finalize"])) //Finalize button. Pushes users to the receipt for printing purposes.
				{
				   //PDO connection to the database
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);

					//Grabbing the cust_id
					$cust_id = $_SESSION['sel_user'];

					//Grab the array of items selected
					$array_of_items = $_SESSION['array_of_items'];

					//First we got the current date and see if the current date is the same with the request date. If so then logically this means the customer
					//is planning to pick up the item as well then we just take this time to change the item status to "check-out" so it wouldn't show up for rent
					$curr_date = Date("Y-m-d");
					$current_date = date('Y-m-d H:i:s');
					
					//Grabbing all the information we need for the insert to ReserveHis, Reserve, and ItemReserve tables
					$request_date = $_SESSION['request_date'];
					$due_date = $_SESSION['due_date'];
					$sel_cust = $_SESSION['sel_user'];
					$total_price = (int)$_SESSION['total_price'];
					
					//Formatting the both request and due dates into the mysql format which is YYYY-MM-DD
					$sql_request_date = date('Y-m-d', strtotime($request_date));
					$sql_due_date = date('Y-m-d', strtotime($due_date));
					
					//The following "if" statement sees if the request date is the current date. If so then the customer probably is picking up the item right there and then.
					//So if then the code will have to insert the current date instead of NULL as it usually is for a future date
					if($request_date == $curr_date)
					{
						//Formatting the current date into mysql format for insert
						$curr_date = date('Y-m-d', strtotime($curr_date));
						
						//Insert statement for ReserveHis. For having a searchable history for all reserves that happens
						$insert = $conn->prepare("insert into ReserveHis
													(request_date, return_date, due_date, pick_up_date, total_cost, cust_id)
													values
													(:sql_request_date, NULL, :sql_due_date, :curr_date, :total_price, :cust_id)"); //Remember to added in the quotes for the dates or result of the insert will look like "0000-00-00" on dates

						//Binding the vars along with their respected datatype
						$insert->bindValue(':sql_request_date', $sql_request_date, PDO::PARAM_STR);
						$insert->bindValue(':sql_due_date', $sql_due_date, PDO::PARAM_STR);
						$insert->bindValue(':curr_date', $curr_date, PDO::PARAM_STR);
						$insert->bindValue(':total_price', $total_price, PDO::PARAM_INT);
						$insert->bindValue(':cust_id', $sel_cust, PDO::PARAM_INT);
						$insert->execute();
						//print "Insert to Reserve History: " . $insert->errorCode();
						//echo "</br>";
						$rh_id = $conn->lastInsertId();
						
						//Insert statement for Item Reservation
						$insert = $conn->prepare("insert into Reserve
													(request_date, due_date, pick_up_date, cust_id, rh_id)
													values
													(:sql_request_date, :sql_due_date, :curr_date, :cust_id, :rh_id)"); //Remember to added in the quotes for the dates or result of the insert will look like "0000-00-00" on dates

						//Binding the vars along with their respected datatype
						$insert->bindValue(':sql_request_date', $sql_request_date, PDO::PARAM_STR);
						$insert->bindValue(':sql_due_date', $sql_due_date, PDO::PARAM_STR);
						$insert->bindValue(':curr_date', $curr_date, PDO::PARAM_STR);
						$insert->bindValue(':cust_id', $sel_cust, PDO::PARAM_INT);
						$insert->bindValue(':rh_id', $rh_id, PDO::PARAM_INT);
						$insert->execute();
						//print "Insert to Reserve: " . $insert->errorCode();
						//echo "</br>";
						$_SESSION['rental_id'] = $conn->lastInsertId();

						//Insert statement for Transaction
						$insert = $conn->prepare("insert into Transaction
													(time_stamp, cust_id, trans_type, comments, rh_id)
													values
													(:time_stamp, :cust_id, 'pick-up', NULL, :rh_id)"); //Remember to added in the quotes for the dates or result of the insert will look like "0000-00-00" on dates
						//Binding the vars along with their respected datatype
						$insert->bindValue(':time_stamp', $current_date, PDO::PARAM_STR);
						$insert->bindValue(':cust_id', $cust_id, PDO::PARAM_INT);
						$insert->bindValue(':rh_id', $rh_id, PDO::PARAM_INT);
						$insert->execute();
						//print "Insert to Transaction: " . $insert->errorCode();
						//echo "</br>";
						$tran_id = $conn->lastInsertId();
					}
					else
					{
						//Insert statement for ReserveHis. For having a searchable history for all reserves that happens
						$insert = $conn->prepare("insert into ReserveHis
													(request_date, return_date, due_date, pick_up_date, total_cost, cust_id)
													values
													(:sql_request_date, NULL, :sql_due_date, NULL, :total_price, :cust_id)"); //Remember to added in the quotes for the dates or result of the insert will look like "0000-00-00" on dates

						//Binding the vars along with their respected datatype
						$insert->bindValue(':sql_request_date', $sql_request_date, PDO::PARAM_STR);
						$insert->bindValue(':sql_due_date', $sql_due_date, PDO::PARAM_STR);
						$insert->bindValue(':total_price', $total_price, PDO::PARAM_INT);
						$insert->bindValue(':cust_id', $sel_cust, PDO::PARAM_INT);
						$insert->execute();
						//print "Insert to Reserve History: " . $insert->errorCode();
						//echo "</br>";
						$rh_id = $conn->lastInsertId();
						
						//Insert statement for Item Reservation
						$insert = $conn->prepare("insert into Reserve
													(request_date, due_date, pick_up_date, cust_id, rh_id)
													values
													(:sql_request_date, :sql_due_date, NULL, :cust_id, :rh_id)"); //Remember to added in the quotes for the dates or result of the insert will look like "0000-00-00" on dates

						//Binding the vars along with their respected datatype
						$insert->bindValue(':sql_request_date', $sql_request_date, PDO::PARAM_STR);
						$insert->bindValue(':sql_due_date', $sql_due_date, PDO::PARAM_STR);
						$insert->bindValue(':cust_id', $sel_cust, PDO::PARAM_INT);
						$insert->bindValue(':rh_id', $rh_id, PDO::PARAM_INT);
						$insert->execute();
						//print "Insert to Reserve: " . $insert->errorCode();
						//echo "</br>";
						$_SESSION['rental_id'] = $conn->lastInsertId();

						//Insert statement for Item Transaction
						$insert = $conn->prepare("insert into Transaction
													(time_stamp, cust_id, trans_type, comments, rh_id)
													values
													(:time_stamp, :cust_id, 'reserve', NULL, :rh_id)"); //Remember to added in the quotes for the dates or result of the insert will look like "0000-00-00" on dates
						//Binding the vars along with their respected datatype
						$insert->bindValue(':time_stamp', $current_date, PDO::PARAM_STR);
						$insert->bindValue(':cust_id', $cust_id, PDO::PARAM_INT);
						$insert->bindValue(':rh_id', $rh_id, PDO::PARAM_INT);
						$insert->execute();
						//print "Insert to Transaction: " . $insert->errorCode();
						//echo "</br>";
						$tran_id = $conn->lastInsertId();
					}

					//Start of the FOR loop to insert all the selected items into the ItemReserve, ItemTran, and an update for the Item Tables
					foreach($array_of_items as $item_id)
					{
						//Insert statement for ItemReserve
						$insert = $conn->prepare("insert into ItemReserve
													(item_Backid, rental_id)
													values
													(:item_id, :rental_id)");
						$insert->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$insert->bindValue(':rental_id', $_SESSION['rental_id'], PDO::PARAM_INT);
						$insert->execute();
					
						//If request_date is the same as the current date, then that means that the customer is picking up the item today
						//We then will change the chosen item's status to 3 which is "Check-out"
						if($_SESSION['request_date'] == $curr_date)
						{
							//Setting up the update query
							//Remember: 'Ready' = 1, 'Repair' = 2, 'Check-out' = 3, 'Check-in' = 4, 'Missing' = 5, 'Retire' = 6, 'Reserved' = 7, 'Drying' = 8, and 'In Wash' = 9
							$update = $conn->prepare("update Item
										set stat_id = 3
										where item_Backid = :item_id");
							$update->bindValue(':item_id', (int)$item_id, PDO::PARAM_INT);
							$update->execute(); //execute the query
						}

						//Insert statement for ItemTran
						$insert = $conn->prepare("insert into ItemTran
													(item_Backid, tran_id)
													values
													(:item_id, :tran_id)");
						//Binding the vars along with their respected datatype
						$insert->bindValue(':item_id', $item_id, PDO::PARAM_INT);
						$insert->bindValue(':tran_id', $tran_id, PDO::PARAM_INT);
						$insert->execute();
					}

					//remember to close the PDO connection
					$conn = null;
?>
			</div>
<?php
					Receipt();
?>
			<div class="background">
<?php
				}
				elseif(isset($_POST["on_to_rental"])) //Select button on the Customer Selection page.
														//Pushes users to the Rental Item Selecting page.
				{
					//the date the customer wants to take it
					$_SESSION['request_date'] = htmlspecialchars(strip_tags($_POST["pickUpDate"]));
					//the date the customer wants to return it
					$_SESSION['due_date'] = htmlspecialchars(strip_tags($_POST["returnDate"]));
					
					//Grab the user
					$sel_user = strip_tags($_POST['cust_id']);
					$_SESSION['sel_user'] = $sel_user;
					
					RentalItemSelect();
				}
				elseif(isset($_POST["calPay"])) //Continue to Payments button. Pushes users to the CalculatePayments page.
				{
				   //PDO connection to the database
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);

					//grabbing the array of item ids
					$select_item = htmlspecialchars(strip_tags($_POST["item_array"]));
					$item_array = explode(',', $select_item); //First we grab the item string, and explode it into a array of ints
					$empty_index = array_filter($item_array); //We then filter out any empty spots in the array just in case
					$array_of_string_items = array_values($empty_index); //Once after the filter, we reset the array.
					$array_of_int_items = array_map('intval', $array_of_string_items);

					$_SESSION["array_of_items"] = $array_of_int_items;         //input the array of item ids into session for later purposes
					
					CalPay();      //moves the user to the calculate payment page

					//remember to close the PDO connection
					$conn = null;
				}

				else //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
					 //We just move on back the main section page
					 //back to the main section menu.
				{
					CustomerSelection();
				}
?>
			</div>
<?php
		}
	}
	
	//======================================================================
	//Employee Section
	//======================================================================

	elseif($_SESSION['next_page'] == "Employee")
	{
	    if(isset($_POST["LogOut"]))
	    {
		    login();
			$_SESSION['next_page'] = "MainMenu";
	    }
		else
		{
			NavBar();
?>
			<div class="background">
<?php
				if(isset($_POST["AVendor"])) //LogOut Button. When pressed logs the user out and set the next_page back to mainmenu
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					AddVendor();
				}
				elseif(isset($_POST["HomePage"])) //HomePage Button. When pressed sends users to the Home Page.
				{
					$_SESSION['next_page'] = "HomePage";
					HomePage();
				}
				elseif(isset($_POST["ViewVen"])) //View/Edit Vendors Button. Send users to the vendor's section where they can add/view/edit vendors
				{
					$_SESSION['next_page'] = "Vendor_buttons";
					Vendor();
				}
				elseif(isset($_POST["Cust"])) //View/Edit Customer Button. Send users to the customer's section where they can add/view/edit customer
				{
					$_SESSION['next_page'] = "Customer_Section";
					CustomerSelection();
				}
				elseif(isset($_POST['ReturnI'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ReturnItem_buttons";
					$_SESSION['itemReturn'] = "Yes";
					CustomerSelection();
					$_SESSION['itemReturn'] = "No";
				}
				elseif(isset($_POST['ViewInv'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
												//that are rented out under their name.
				{
					$_SESSION['next_page'] = "ItemSelection_buttons";
					Itemselection();
				}
				elseif(isset($_POST["Empl"])) //Employee button, sends users to employee section.
				{
					$_SESSION['next_page'] = "Employee";
					Employee();
				}
				elseif(isset($_POST["emplInfo"]) or isset($_POST["backOnCustTran"]) or isset($_POST["cancelOnEditEmpl"])) //Select button on the main customer/Back button on view transaction
																													   // Cancel/Update Customer button on the Customer Edit Page
																													   // Pushs user to the the Customer's Information Page
				{
					if(isset($_POST["emplInfo"]))
					{
						$_SESSION['empl_id'] = strip_tags($_POST['empl_id']);
					}
					EmployeeInfo();
				}
				elseif(isset($_POST["removeEmpl"])) //The remove customer button on the edit customer view
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					$empl_id = $_SESSION['empl_id'];

					$delete = $conn ->prepare("DELETE FROM Employee
												WHERE empl_id = '$empl_id'");

					$delete -> execute();

					$conn = null;
					Employee();
				}
				elseif(isset($_POST["updateEmpl"])) //Here for the update button on the edit customer view
				{
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					$empl_id = $_SESSION['empl_id'];
					$empl_fname = strip_tags($_POST['empl_fname']);
					$empl_lname = strip_tags($_POST['empl_lname']);
					$phone_num = strip_tags($_POST['phone_num']);
					$empl_email = strip_tags($_POST['empl_email']);
					$title = strip_tags($_POST['title']);
					$access_lvl = strip_tags($_POST['access_lvl']);


					$update = $conn ->prepare("UPDATE Employee
												SET empl_fname = '$empl_fname',
													empl_lname = '$empl_lname',
													phone_num = '$phone_num',
													empl_email = '$empl_email',
													title = '$title',
													access_lvl = '$access_lvl'
												WHERE empl_id = '$empl_id'");

					$update ->execute();


					$conn = null;
					//next inserts
					EmployeeInfo();

				}
				/*elseif(isset($_POST["viewAct"])) //View Actions button on Customer Information page
																													  //PrintReceipt/Cancel buttons Receipt page.
																													  //Pushs users to the View Transaction Page for customers
				{
					EmployeeAction();
				}*/
				elseif(isset($_POST["editEmpl"])) //Edit Customer button. Pushs users to the edit customer page.
				{
					EditEmployee();
				}
				elseif(isset($_POST["newEmpl"]))
				{
					addempl();
				}
				elseif(isset($_POST["Addempl"]))
				{
					//make a connection to database
					$username = $_SESSION['username'];
					$password = $_SESSION['password'];
					$conn = hsu_conn_sess($username, $password);
					
					//set variables to the values input by user
					$new_emplName = htmlspecialchars(strip_tags($_POST["empl_name"]));
					$new_phone = htmlspecialchars(strip_tags($_POST["Phone"]));
					$new_email = htmlspecialchars(strip_tags($_POST["email"]));
					$access_lvl_granted = htmlspecialchars(strip_tags($_POST["access_lvl"]));
					$title = htmlspecialchars(strip_tags($_POST["title"]));

					//Separate the first and last name for the insert into database
					$f_lnames = explode(" ", $new_emplName);
					$f_name = $f_lnames[0];
					$l_name = $f_lnames[1];
					
					//Combines the Emergency contact name and phone number
					$emer_contract = $new_emerName . " " . $new_emerPhone;

					//set up insert statement
					$insert = $conn->prepare("insert into Employee
												(empl_id, empl_fname, empl_lname, phone_num, title, access_lvl, empl_email)
												values
												(Default, ?, ?, ?, ?, ?, ?)");
					//execute the statement with variables
					$insert ->execute([$f_name, $l_name, $new_phone, $title, $access_lvl_granted, $new_email]);
					//print $insert -> errorCode(); //<======= Prints Error Code For INSERT Statement =======>
					//echo "\nPDO::errorInfo():\n";
					//print_r($insert->errorInfo());
					
					//end connection
					$conn = null;
					
					Employee();
				}

				else //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
					 //We just move on back the main section page
					 //back to the main section menu.
				{
					Employee();
				}
?>
			</div>
<?php
		}
	}

    // If we reach this, something went wrong
    else
    {
        ?>
        <p> <strong> YIKES! should NOT have been able to reach
            here! </strong> </p>
        <?php

        session_destroy();
        session_regenerate_id(TRUE);
        session_start();
    }
?>
</body>
</html>
