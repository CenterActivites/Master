<?php
    session_start();
?>
<html>

<head>
    <title> Center Activities </title>
    <meta charset="utf-8" />
	
	<link href="test.css"
          type="text/css" rel="stylesheet" />
	<div style="z-index:-1000; opacity:0.9;position:fixed;" >
		<img src="images/wallpaper.jpg" />
	</div>
		  
	<script src ="searchfunct.js" type="text/javascript"></script>
	

    <?php
        /* Here we add every new page we create (Linking every page together) */
		date_default_timezone_set('America/Los_Angeles');
        define("domain", "http://nrs-projects.humboldt.edu/~Alt-F4");
				require_once('hsu_conn_sess.php');
                require_once('Login.php');
				require_once('MainMenu.php'); //added the require for main menu back up here because as long everything is in the
				                              //php function nothing unwanted html will show on the correct page
                require_once('/home/Alt-F4/public_html/VendorSection/MainVendor.php');  //Since the files are under a subdirectory, the require_once
				                                                                         //statement have to look like this
				require_once('/home/Alt-F4/public_html/VendorSection/AddVendor.php');
				require_once('/home/Alt-F4/public_html/VendorSection/EditVendor.php');
				require_once('/home/Alt-F4/public_html/VendorSection/VendorInfo.php');
				require_once('/home/Alt-F4/public_html/VendorSection/addvendor-posthandler.php');
				require_once('/home/Alt-F4/public_html/ItemreturnSection/ReturnItem_main.php');
				require_once('/home/Alt-F4/public_html/ItemreturnSection/Receipt.php');
				require_once('/home/Alt-F4/public_html/ItemreturnSection/complain_and_exit.php');
				require_once('/home/Alt-F4/public_html/ItemreturnSection/destroy_and_exit.php');
				require_once('/home/Alt-F4/public_html/ItemreturnSection/build_mini_form.php');
				require_once('/home/Alt-F4/public_html/ItemreturnSection/CustRentedItems.php');
				require_once('/home/Alt-F4/public_html/ItemselectionSection/ItemSelectionMenu.php');
				require_once('/home/Alt-F4/public_html/ItemselectionSection/AddingNewItems.html');
				require_once('/home/Alt-F4/public_html/ItemselectionSection/ItemInfo.php');
				require_once('/home/Alt-F4/public_html/ItemselectionSection/EditItem.php');
				require_once('/home/Alt-F4/public_html/CustomerselectionSection/CustomerSelectionMain.php');
				require_once('/home/Alt-F4/public_html/CustomerselectionSection/CustomerInfor.php');
				require_once('/home/Alt-F4/public_html/CustomerselectionSection/CustomerTransaction.php');
				require_once('/home/Alt-F4/public_html/CustomerselectionSection/EditCustomer.php');
				require_once('/home/Alt-F4/public_html/RentalSection/RentalStartingPage.php');
				require_once('/home/Alt-F4/public_html/RentalSection/NewCustomer.php');
				require_once('/home/Alt-F4/public_html/RentalSection/RentalItemSelection.php');
				require_once('/home/Alt-F4/public_html/RentalSection/CalculatePayments.php');

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
		$username = strip_tags($_POST['username']);  //We grab the username and password the user input and logs the user in with the inputs
		$password = strip_tags($_POST['password']);
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$conn = hsu_conn_sess($username, $password);
		//Here we call the function 'hsu_conn_sess' which will does the connection to nrs-projects
	    mainmenu();
		$_SESSION['next_page'] = "mainmenu_buttons";
		//var_dump ($_SESSION);
		//The user wouldn't go back to this elseif ever again, none less they press the logout button.
	}


	//======================================================================
	//Main Menu Section
	//======================================================================

	elseif($_SESSION['next_page'] == "mainmenu_buttons")  //Now we're getting into the functional of all the buttons that are on the main menu
	                                                      //(Pretty much what pages the buttons leads to)
	{
		if(isset($_POST["LogOut"])) //LogOut Button. When pressed logs the user out and set the next_page back to mainmenu
		{
			login();
            $_SESSION['next_page'] = "MainMenu";
		}
		elseif(isset($_POST["ViewVen"])) //View/Edit Vendors Button. Send users to the vendor's section where they can add/view/edit vendors
		{
			Vendor();
            $_SESSION['next_page'] = "Vendor_buttons";
            //var_dump ($_SESSION);
		}
		elseif(isset($_POST["Rental"])) //Rental Button. Send users to the rental's section(for rental).
		{
			Rental();
            $_SESSION['next_page'] = "Rental_buttons";
            //var_dump ($_SESSION);
		}
		elseif(isset($_POST["ViewCus"])) //View/Edit Customer Button. Send users to the customer's section where they can add/view/edit customer
		{
			CustomerSelection();
            $_SESSION['next_page'] = "CustomerSelection_buttons";
            //var_dump ($_SESSION);
		}
		elseif(isset($_POST['ReturnI'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
		                                 //that are rented out under their name.
		{
			ReturnItem();
			$_SESSION['next_page'] = "ReturnItem_buttons";
			//var_dump ($_SESSION);
		}
		elseif(isset($_POST['ViewInv'])) //ReturnItem Button. Sends users to the Return Item section where users can return/view items
		                                 //that are rented out under their name.
		{
			Itemselection();
			$_SESSION['next_page'] = "ItemSelection_buttons";
			//var_dump ($_SESSION);
		}
		else  //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
		      //We just move on back the main section page
		{
			mainmenu();
		}
	}


	//======================================================================
	//Vendor Section
	//======================================================================

	elseif($_SESSION['next_page'] == "Vendor_buttons") //When all the functional of all the vendor's button is going to be placed
	{
		if(isset($_POST["AVendor"])) //AddVendor button on the Vendor main menu. Pushes users to the add venders page.
	    {
		    AddVendor();
	    }
		elseif(isset($_POST["mainmenu"])) //MainMenu button. Allows users to go back to the main menu.
	    {
		    mainmenu();
		    $_SESSION['next_page'] = "mainmenu_buttons";
	    }
		elseif(isset($_POST["editVen"])) //Edit Vendor button. Pushes users to the section to add/remove/edit Vendors.
	    {
		    EditVendor();
	    }
		elseif(isset($_POST["updateVen"]) or isset($_POST["cancelEdit"]) or isset($_POST["moreIn"])) //Update button/Cancel button on Edit Vendor page/More Infor. Button
		                                                                                             //Pushes users to the More Infor. for Vendors page
	    {
		    InfoVendor();
	    }
		elseif(isset($_POST["removeVen"]) or isset($_POST["backToMainSection"])) //Remove Vendor button on Edit Vendor page/Back button on Vendor's Infor. page.
		                                                                         //Pushes users the Vendor's main menu.
	    {
		    Vendor();
	    }
		else //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
		     //We just move on back the main section page. We see this mainly when people refresh the page.
		{
			Vendor();
		}
	}


	//======================================================================
	//Item Return Section
	//======================================================================

	elseif($_SESSION['next_page'] == "ReturnItem_buttons")
	{

	    if(isset($_POST["Cancel"]) or isset($_POST["mainmenu"]) or isset($_POST["PrintReceipt"])) //This is ReturnItems CANCEL/MainMenu/PrintReceipt
		                                                                                          //buttons which when press, sends the user back to MainMenu

	   {
		   mainmenu();
	       $_SESSION['next_page'] = "mainmenu_buttons";
		   //var_dump ($_SESSION);
	   }
	   elseif(isset($_POST["Select"]) or isset($_POST["cancelOnReceipt"])) //After finding the customer, the "select" button push the user onto the next page
                                                                        //which is the item check-in page where the user will select which item they are returning today
																		   //Also when the cancel button on the Receipt page is press, the screen will move back to the item check-in
																		   //part of the return section
	   {
        //var_dump ($_SESSION);
		   CustRentedItems();
	   }
	   elseif(isset($_POST["Checkin"])) //Once the user is done selecting the item they are returning today, this button "Checkin" will push the user
	                                    //to the finally page of the item return page which is the Receipt page
	   {
       //var_dump ($_SESSION);
		   Receipt();
	   }
	   else //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
		     //We just move on back the main section page
			 //Also notice that we didn't add a funtion to the "Back" button. Since the "Back" button has the same functionally
			 //as this, anytime a user press the "Back" the site will think that there wasn't a button pressed and move the screen
			 //back to the main section menu.
		{

			ReturnItem();
		}
	}


	//======================================================================
	//Item Selection Section
	//======================================================================

	elseif($_SESSION['next_page'] == "ItemSelection_buttons") //When all the functional of all the vendor's button is
	                                                          //going to be placed
	{
		if(isset($_POST["mainmenu"])) //This is Itemselection MainMenu
		                              //button which when press, sends the user back to MainMenu
	   {
		   mainmenu();
	       $_SESSION['next_page'] = "mainmenu_buttons";
	   }
	    elseif(isset($_POST["additem"])) //Add Item button on the Item Selection Main Menu page. Pushes users to the add item
		                                 //page
	   {
		    AddItems();
	   }
	   elseif(isset($_POST["cancelEdit"]) or isset($_POST["moreinfo"])) //Update button/Cancel button on Edit Vendor page/More Infor. Button
		                                                                //Pushes users to the More Infor. for Vendors page
	    {
		    ItemInfo();
	    }
		elseif(isset($_POST["removeItem"])) //The remove item button on the edit item view
	   {
		    $username = $_SESSION['username']; 
			$password = $_SESSION['password'];
			$conn = hsu_conn_sess($username, $password);
			$sel_item = $_SESSION['sel_item']; //Grabbing the customer that was selected
			$delete_item = "DELETE FROM Item WHERE item_Backid = :sel_item";
			$stmt = oci_parse($conn, $delete_item);
			oci_bind_by_name($stmt, ":sel_item", $sel_item);
			oci_execute($stmt, OCI_DEFAULT);
            oci_commit($conn);
			Itemselection();
			oci_free_statement($stmt);
			oci_close($conn);
	   }
	   elseif(isset($_POST["updateItem"])) //Here for the update button on the edit item view
		{
			$username = $_SESSION['username']; 
			$password = $_SESSION['password'];
			$conn = hsu_conn_sess($username, $password);
			$sel_item = $_SESSION['sel_item']; //Grabbing the item that was selected
			$inv_id = $_SESSION['inv_id'];
			$new_cat_name = htmlspecialchars(strip_tags($_POST["curr_cat_name"])); //Here once the user input any changes on the item information, we then grab all the newly changes 
			$new_inv_name = htmlspecialchars(strip_tags($_POST["curr_inv_name"]));
			$new_item_name = htmlspecialchars(strip_tags($_POST["curr_item_name"]));
			$new_item_size = htmlspecialchars(strip_tags($_POST["curr_item_size"]));
			$new_item_status = htmlspecialchars(strip_tags($_POST["curr_item_status"]));
			// set up the update sql command
            $update_item = "UPDATE Item
                           SET item_name = :new_item_name,
								item_size = :new_item_size,
								item_status = :new_item_status 
                           WHERE item_Backid = :sel_item";
			$new_cat = 'select cat_id '.
						'from Category '.
						'where cat_name = :new_cat_name';
			$update_cat = "UPDATE Inventory
							SET cat_id = :new_cat_id,
								inv_name = :new_inv_name
							WHERE inv_id = :inv_id";
			$stmt = oci_parse($conn, $new_cat);
			oci_bind_by_name($stmt, ":new_cat_name", $new_cat_name);
			oci_execute($stmt, OCI_DEFAULT);
			while(oci_fetch($stmt))
			{
				$new_cat_id = oci_result($stmt, "CAT_ID");
			}
			$stmt1 = oci_parse($conn, $update_item);
			$stmt2 = oci_parse($conn, $update_cat);
			oci_bind_by_name($stmt2, ":new_cat_id", $new_cat_id); //Bind all the newly information 
			oci_bind_by_name($stmt2, ":new_inv_name", $new_inv_name);
			oci_bind_by_name($stmt1, ":new_item_name", $new_item_name);
			oci_bind_by_name($stmt1, ":new_item_size", $new_item_size);
			oci_bind_by_name($stmt1, ":new_item_status", $new_item_status);
			oci_bind_by_name($stmt1, ":sel_item", $sel_item);
			oci_bind_by_name($stmt2, ":inv_id", $inv_id);
			oci_execute($stmt1, OCI_DEFAULT);
			oci_execute($stmt2, OCI_DEFAULT);
            oci_commit($conn);
			ItemInfo();
			oci_free_statement($stmt);
			oci_free_statement($stmt1);
			oci_free_statement($stmt2);
			oci_close($conn);
           }
	   elseif(isset($_POST["editItem"])) //Edit Item button on the Item Infor. page. Pushes users to the editing
		                                 //item page
	   {
		    EditItem();
	   }
	   elseif(isset($_POST["add"]))
	   {
			$username = $_SESSION['username']; 
			$password = $_SESSION['password'];
			$conn = hsu_conn_sess($username, $password);
			$new_cat_name = htmlspecialchars(strip_tags($_POST["category"])); //Here once the user input the new item information, we then grab all of it
			$new_inv_id = htmlspecialchars(strip_tags($_POST["inventory"]));
			$new_item_name = htmlspecialchars(strip_tags($_POST["new_item_name"]));
			$new_item_size = htmlspecialchars(strip_tags($_POST["new_item_size"]));
			$new_item_f_id = htmlspecialchars(strip_tags($_POST["new_item_id"]));
			$max_id_sofar = 'select MAX(item_Backid) '.
							'from Item';
			$insert_dept_str = "insert into Item
								values
								(:new_item_b_id, :new_item_f_id, :new_item_name, :new_item_size, 'ready', :new_inv_id)";
			$stmt = oci_parse($conn, $max_id_sofar);
			oci_execute($stmt, OCI_DEFAULT);
			while(oci_fetch($stmt))
			{
				$new_item_b_id = oci_result($stmt, "MAX(ITEM_BACKID)");
			}
			$new_item_b_id = $new_item_b_id + 1;
			$stmt1 = oci_parse($conn, $insert_dept_str);
			oci_bind_by_name($stmt1, ":new_item_f_id", $new_item_f_id); //Bind all the newly information 
			oci_bind_by_name($stmt1, ":new_item_b_id", intval($new_item_b_id));
			oci_bind_by_name($stmt1, ":new_inv_id", $new_inv_id);
			oci_bind_by_name($stmt1, ":new_item_name", $new_item_name);
			oci_bind_by_name($stmt1, ":new_item_size", $new_item_size);
			oci_execute($stmt1, OCI_DEFAULT);
            oci_commit($conn);
		    Itemselection();
			oci_free_statement($stmt);
			oci_free_statement($stmt1);
			oci_close($conn);
	   }
	   elseif(isset($_POST["cancel"]) or isset($_POST["backoniteminfo"])) //Cancel buttons on the Adding New Items page.
	                                                                      //Back button on the item info page, Remove Item button on
																		 //Editing Item page
	                                                                     //Pushes users to the item selection main menu
	   {
		    Itemselection();
	   }
	   else//A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
         	//We just move on back the main section page
	   {
		   Itemselection();
	   }
    }


	//======================================================================
	//Customer Selection Section
	//======================================================================

	elseif($_SESSION['next_page'] == "CustomerSelection_buttons")
	{
	    if(isset($_POST["mainmenu"])) //This is CustomerSelection/ViewTransaction MainMenu button which when press, sends the user back to MainMenu
	   {
		   mainmenu();
	       $_SESSION['next_page'] = "mainmenu_buttons";
	   }
	   elseif(isset($_POST["select"]) or isset($_POST["backOnCustTran"]) or isset($_POST["cancelOnEditCust"])) //Select button on the main customer/Back button on view transaction
                                                                                                               // Cancel/Update Customer button on the Customer Edit Page
	                                                                                                           // Pushs user to the the Customer's Information Page
	   {
		   CustomerInfo();
	   }
	   elseif(isset($_POST["removeCust"])) //The remove customer button on the edit customer view
	   {
		    $username = $_SESSION['username']; 
			$password = $_SESSION['password'];
			$conn = hsu_conn_sess($username, $password);
			$sel_user = $_SESSION['sel_user']; //Grabbing the customer that was selected
			$delete_cust = "DELETE FROM Customer WHERE cust_id = :sel_user";
			$stmt = oci_parse($conn, $delete_cust);
			oci_bind_by_name($stmt, ":sel_user", $sel_user);
			oci_execute($stmt, OCI_DEFAULT);
            oci_commit($conn);
			CustomerSelection();
			oci_free_statement($stmt);
			oci_close($conn);
	   }
	   elseif(isset($_POST["updateCust"])) //Here for the update button on the edit customer view
			{
				$username = $_SESSION['username']; 
				$password = $_SESSION['password'];
				$conn = hsu_conn_sess($username, $password);
				$sel_user = $_SESSION['sel_user']; //Grabbing the customer that was selected
				$new_f_name = htmlspecialchars(strip_tags($_POST["curr_f_name"])); //Here once the user input any changes on the customer information, we then grab all the newly changes 
				$new_l_name = htmlspecialchars(strip_tags($_POST["curr_l_name"]));
				$new_addr = htmlspecialchars(strip_tags($_POST["curr_addr"]));
				$new_phone = htmlspecialchars(strip_tags($_POST["curr_phone"]));
				$new_email = htmlspecialchars(strip_tags($_POST["curr_email"]));
				$new_dob = htmlspecialchars(strip_tags($_POST["curr_dob"]));
				$new_emg = htmlspecialchars(strip_tags($_POST["curr_emg_contact"]));
				// Set up the update sql command
                $update_cust = "UPDATE Customer
                               SET f_name = :new_f_name,
                                   l_name = :new_l_name,
                                   c_dob = :new_dob,
                                   c_addr = :new_addr,
                                   c_phone= :new_phone,
                                   c_email = :new_email,
                                   emerg_contact = :new_emg 
                                WHERE cust_id = :sel_user";

				$stmt = oci_parse($conn, $update_cust);
				oci_bind_by_name($stmt, ":new_f_name", $new_f_name); //Bind all the newly information 
				oci_bind_by_name($stmt, ":new_l_name", $new_l_name);
				oci_bind_by_name($stmt, ":new_dob", $new_dob);
				oci_bind_by_name($stmt, ":new_addr", $new_addr);
				oci_bind_by_name($stmt, ":new_phone", $new_phone);
				oci_bind_by_name($stmt, ":new_email", $new_email);
				oci_bind_by_name($stmt, ":new_emg", $new_emg);
				oci_bind_by_name($stmt, ":sel_user", $sel_user);

				oci_execute($stmt, OCI_DEFAULT);
                oci_commit($conn);
				CustomerInfo();
				oci_free_statement($stmt);
				oci_close($conn);
           }
	   elseif(isset($_POST["viewTran"]) or isset($_POST["PrintReceipt"]) or isset($_POST["cancelOnReceipt"])) //View Transaction button on Customer Information page
	                                                                                                          //PrintReceipt/Cancel buttons Receipt page.
	                                                                                                          //Pushs users to the View Transaction Page for customers
	   {
		   CustomerTran();
	   }
	    elseif(isset($_POST["viewReceipt"])) //View Receipt button. Pushs users to the receipt for printing purposes.
	   {
		   Receipt();
	   }
	   elseif(isset($_POST["editCust"])) //Edit Customer button. Pushs users to the edit customer page.
	   {
		   EditCustomer();
	   }
	   else //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
		     //We just move on back the main section page
			 //Also notice that we didn't add a funtion to the "Back" button on the Customer Information Page. Since this "Back" button pushs the user back to
			 //the main section menu, anytime a user press the "Back" the site will think that there wasn't a button pressed and move the screen
			 //back to the main section menu.
		{
			CustomerSelection();
		}
	}


	//======================================================================
	//Rental Section
	//======================================================================

	elseif($_SESSION['next_page'] == "Rental_buttons")
	{
	    if(isset($_POST["mainmenu"]) or isset($_POST["cancel"]) or isset($_POST["cancelOnReceipt"]) or isset($_POST["PrintReceipt"])) //This MainMenu/Cancel/PrintReceipt button
		                                                                                                                              //Send the user back to the MainMenu
		                                                                                                                              //In the whole Rental Section, all cancel buttons pushs the user back to the MainMenu
	   {
		    mainmenu();
	        $_SESSION['next_page'] = "mainmenu_buttons";
	   }
	   elseif(isset($_POST["oldCust"])) //The Old/Existing Customer button. Pushes user to the customer selection page.
	   {
		   CustomerSelection();
	   }
	   elseif(isset($_POST["newCust"])) //The New Customer button. Pushes user to the page where they will enter the customer's information for the creation of the new customer account
	   {
		   AddingNewCust();
	   }
	   elseif(isset($_POST["cancelFinal"]))
	   {
		    $username = $_SESSION['username']; 
			$password = $_SESSION['password'];
			$conn = hsu_conn_sess($username, $password);
			$rent_id = $_SESSION['rent_id'];
			$delete = "delete from ItemReservation
						where rental_id = :rent_id";
			$stmt = oci_parse($conn, $delete);
			oci_bind_by_name($stmt, ":rent_id", $rent_id);
			oci_execute($stmt, OCI_DEFAULT);
            oci_commit($conn);
		    mainmenu();
	   }
	    elseif(isset($_POST["finalize"])) //Finalize button. Pushs users to the receipt for printing purposes.
	   {
		    $username = $_SESSION['username']; 
			$password = $_SESSION['password'];
			$conn = hsu_conn_sess($username, $password);
			$item_id = $_SESSION['item_id'];
			$update = "update Item
						set item_status = 'check_out'
						where item_Backid = :item_id";
			$stmt = oci_parse($conn, $update);
			oci_bind_by_name($stmt, ":item_id", $item_id);
			oci_execute($stmt, OCI_DEFAULT);
            oci_commit($conn);
		    Receipt();
	   }
	    elseif(isset($_POST["select"])) //Select button on the Customer Selection page.
                                        //Pushs users to the Rental Item Selectin page.
	   {
		   $sel_user = htmlspecialchars(strip_tags($_POST["customer"]));
			$_SESSION['sel_user'] = $sel_user;
		   RentalItemSelect();
	   }
	   elseif(isset($_POST["continue"]))
	   {
		    $username = $_SESSION['username']; 
			$password = $_SESSION['password'];
			$conn = hsu_conn_sess($username, $password);
			$new_custName = htmlspecialchars(strip_tags($_POST["custName"])); //Here once the user input the new Customer information, we then grab all of it
			$new_custPhone = htmlspecialchars(strip_tags($_POST["custPhone"]));
			$new_custAddress = htmlspecialchars(strip_tags($_POST["custAddress"]));
			$new_dob = htmlspecialchars(strip_tags($_POST["dob"]));
			$new_isStudent = htmlspecialchars(strip_tags($_POST["isStudent"]));
			$new_custEmail = htmlspecialchars(strip_tags($_POST["custEmail"]));
			$new_emerName = htmlspecialchars(strip_tags($_POST["emerName"]));
			$new_emerPhone = htmlspecialchars(strip_tags($_POST["emerPhone"]));
			$max_id_sofar = 'select MAX(cust_id) '.
							'from Customer';
			$insert = "insert into Customer
								values
								(:new_cust_id, :new_cust_f_name, :new_cust_l_name, :new_dob, :new_custAddress, :new_custPhone, :new_custEmail, :new_isStudent, :emer_contract)";
			$stmt = oci_parse($conn, $max_id_sofar);
			oci_execute($stmt, OCI_DEFAULT);
			while(oci_fetch($stmt))
			{
				$new_cust_id = oci_result($stmt, "MAX(CUST_ID)");
			}
			$new_cust_id = $new_cust_id + 1;
			$_SESSION['sel_user'] = $new_cust_id;
			$f_lnames = explode(" ", $new_custName);
			$f_name = $f_lnames[0];
			$l_name = $f_lnames[1];
			$emer_contract = $new_emerName . $new_emerPhone;
			$stmt1 = oci_parse($conn, $insert);
			oci_bind_by_name($stmt1, ":new_cust_f_name", $f_name); //Bind all the newly information 
			oci_bind_by_name($stmt1, ":new_cust_l_name", $l_name);
			oci_bind_by_name($stmt1, ":new_cust_id", intval($new_cust_id));
			oci_bind_by_name($stmt1, ":new_custPhone", $new_custPhone);
			oci_bind_by_name($stmt1, ":new_custAddress", $new_custAddress);
			oci_bind_by_name($stmt1, ":new_dob", $new_dob);
			oci_bind_by_name($stmt1, ":new_custEmail", $new_custEmail);
			oci_bind_by_name($stmt1, ":new_isStudent", $new_isStudent);
			oci_bind_by_name($stmt1, ":emer_contract", $emer_contract);
			oci_execute($stmt1, OCI_DEFAULT);
            oci_commit($conn);
		    RentalItemSelect();
			//echo gettype($new_cust_id);
			//echo "::::", $new_cust_id;
		    oci_free_statement($stmt);
			oci_free_statement($stmt1);
			oci_close($conn);
	   }
	   elseif(isset($_POST["calPay"])) //Continue to Payments button. Pushs users to the CalculatePayments page.
	   {
		    $username = $_SESSION['username']; 
			$password = $_SESSION['password'];
			$conn = hsu_conn_sess($username, $password);
			$sel_cust = $_SESSION['sel_user'];
			$select_item = htmlspecialchars(strip_tags($_POST["item"]));
			$_SESSION['item_id'] = $select_item;
			$request_date = htmlspecialchars(strip_tags($_POST["pickUpDate"]));
			$due_date = htmlspecialchars(strip_tags($_POST["returnDate"]));
			$max_id_sofar = 'select MAX(rental_id) '.
							'from ItemReservation';
			$insert = "insert into ItemReservation
								values
								(:new_rent_id, :select_item, to_date(:request_date, 'dd-mm-yyyy'), NULL, to_date(:due_date, 'dd-mm-yyyy'), NULL, :sel_cust)";
			$stmt = oci_parse($conn, $max_id_sofar);
			oci_execute($stmt, OCI_DEFAULT);
			while(oci_fetch($stmt))
			{
				$new_rent_id = oci_result($stmt, "MAX(RENTAL_ID)");
			}
			$new_rent_id = $new_rent_id + 1;
			$_SESSION['rent_id'] = $new_rent_id;
			$request_date_array = explode("-", $request_date);
			$due_date_array = explode("-", $due_date);
			$_SESSION['request_date'] = date_create($request_date);
			$_SESSION['due_date'] = date_create($due_date);
			switch($request_date_array[1])
			{
				case "01":
					$request_date = $request_date_array[2] . "-" . "JAN" . "-" . $request_date_array[0];
					break;
				case "02":
					$request_date = $request_date_array[2] . "-" . "FEB" . "-" . $request_date_array[0];
					break;
				case "03":
					$request_date = $request_date_array[2] . "-" . "MAR" . "-" . $request_date_array[0];
					break;
				case "04":
					$request_date = $request_date_array[2] . "-" . "APR" . "-" . $request_date_array[0];
					break;
				case "05":
					$request_date = $request_date_array[2] . "-" . "MAY" . "-" . $request_date_array[0];
					break;
				case "06":
					$request_date = $request_date_array[2] . "-" . "JUN" . "-" . $request_date_array[0];
					break;
				case "07":
					$request_date = $request_date_array[2] . "-" . "JUL" . "-" . $request_date_array[0];
					break;
				case "08":
					$request_date = $request_date_array[2] . "-" . "AUG" . "-" . $request_date_array[0];
					break;
				case "09":
					$request_date = $request_date_array[2] . "-" . "SEP" . "-" . $request_date_array[0];
					break;
				case "10":
					$request_date = $request_date_array[2] . "-" . "OCT" . "-" . $request_date_array[0];
					break;
				case "11":
					$request_date = $request_date_array[2] . "-" . "NOV" . "-" . $request_date_array[0];
					break;
				case "12":
					$request_date = $request_date_array[2] . "-" . "DEC" . "-" . $request_date_array[0];
					break;
			}
			switch($due_date_array[1])
			{
				case "01":
					$due_date = $request_date_array[2] . "-" . "JAN" . "-" . $request_date_array[0];
					break;
				case "02":
					$due_date = $request_date_array[2] . "-" . "FEB" . "-" . $request_date_array[0];
					break;
				case "03":
					$due_date = $request_date_array[2] . "-" . "MAR" . "-" . $request_date_array[0];
					break;
				case "04":
					$due_date = $request_date_array[2] . "-" . "APR" . "-" . $request_date_array[0];
					break;
				case "05":
					$due_date = $request_date_array[2] . "-" . "MAY" . "-" . $request_date_array[0];
					break;
				case "06":
					$due_date = $request_date_array[2] . "-" . "JUN" . "-" . $request_date_array[0];
					break;
				case "07":
					$due_date = $request_date_array[2] . "-" . "JUL" . "-" . $request_date_array[0];
					break;
				case "08":
					$due_date = $request_date_array[2] . "-" . "AUG" . "-" . $request_date_array[0];
					break;
				case "09":
					$due_date = $request_date_array[2] . "-" . "SEP" . "-" . $request_date_array[0];
					break;
				case "10":
					$due_date = $request_date_array[2] . "-" . "OCT" . "-" . $request_date_array[0];
					break;
				case "11":
					$due_date = $request_date_array[2] . "-" . "NOV" . "-" . $request_date_array[0];
					break;
				case "12":
					$due_date = $request_date_array[2] . "-" . "DEC" . "-" . $request_date_array[0];
					break;
			}
			$stmt1 = oci_parse($conn, $insert);
			oci_bind_by_name($stmt1, ":new_rent_id", $new_rent_id);
			oci_bind_by_name($stmt1, ":select_item", $select_item);
			oci_bind_by_name($stmt1, ":sel_cust", $sel_cust);
			oci_bind_by_name($stmt1, ":request_date", $request_date);
			oci_bind_by_name($stmt1, ":due_date", $due_date);
			oci_execute($stmt1, OCI_DEFAULT);
			oci_commit($conn);
		    CalPay();
			oci_free_statement($stmt);
			oci_free_statement($stmt1);
			oci_close($conn);
	   }
	   else //A "catch all" thing where if there was ever a time a button has not been press and the page somehow moves on,
		     //We just move on back the main section page
			 //back to the main section menu.
		{
			Rental();
		}
	}




    // I hope I can't reach this...!

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