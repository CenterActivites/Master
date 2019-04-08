<?php
/*
File: Admin Add Vendors Page

*/
?>
<head>
	<!-- CSS -->
	<!-- Java Script -->
	<link href="<?= domain?>/css/admin-add-vendors.css" type="text/css" rel="stylesheet" />
	<link href="<?= domain?>/css/admin-edit-vendors.css" type="text/css" rel="stylesheet" />
</head>
<body>

<center>

<p>Add Vendor(s)</p>

<div>
<!-- Form For add users -->
<form method="post" 
	onsubmit="return add_vendors();" 
	name ="addven"
    action="<?=domain?>/php-inputhandler.php">
	<!-- Creating a field set to seperate the buttons and forms -->
	<!-- enterd data will then be commited to the database when the add button is pressed -->
	<fieldset>
		<table>
			<tr>
				<td>Company Name:</td>
				<td><input type="text" name="ven_name"><br></td>
			</tr>
			<tr>
				<td>Contact Phone:</td>
				<td><input type="text" name="ven_phone"><br></td>
			</tr>
			<tr>
				<td>Contact Email:</td>
				<td><input type="text" name="ven_email"><br></td>
			</tr>
			<tr>
				<td>Company's Adress:</td>
				<td><input type="text" name="ven_location"><br></td>
			</tr>
		</table>
	</fieldset>
	<!-- Creating a field set to seperate the buttons and forms -->
        <fieldset>
            <div>
				<input type="hidden" name = "Vendors_Input" value = "1"/>
				<button name="button" value="Add Vendor" onclick="return add_vendors();"> Add Vendor</button>
            </div>
        </fieldset>
</form>
</div>

		<div id="del_button2">
			<button type="button" name="submit" value="Delete" onclick="add_del_show()"> Delete </button>
        </div>
		<br>
		
		<div id = "edit_button">
			<button type="button" name="submit" value="Edit" onclick="edit_show()"> Edit Vendor Info </button>
		</div>
		
		
	<!-- new Form for popup deletion css hides the form and pops up when the delete button is clicked-->
	
<div id="popdel">

<div id="popupdel">
<form action="<?=domain?>/admin-delete.php" id="popformdel" method="post" name="popform">
	
<center><h2>Delete Vendor</h2></center>
<hr>
<div id="ven_nam">

		Vendor Name:
					<select class="marg" id="del" name="del_ven" style="width: 20em" >
<?php
//this querry does a search for names 
//then the selected name is theown into a fill function
    $select  = 'VEN_NAME';
	$from    = 'Vendors';
	$where   = '1=1';

	$contents = db_query($select, $from, $where);
	$id_row = 'VEN_NAME';
	$size = sizeof($contents[$id_row]);
?>
<!-- a select with full names of company contents -->
				 <option value="ven_name" > <?=select_fill('VEN_NAME',$contents,$size)?> </option>
				 </select><br>
</div>
				 <br>
<input type="submit" id="del_button" name="submit" value="Delete" />
</form>
		<div id="cancel_button">
			<button id="cancle_" onclick ="add_div_hide();">Cancel</button>
		</div>
</div>

</div>

<!-- This is the Edit Form  -->

<div id="popedit">

<div id="popupedit">
<form action="<?=domain?>/admin-edit-vendors.php" id="popformedit" method="post" name="popform2">
	
<center><h3>Edit Vendor Field</h3></center>
<hr>


<div id="ven_edit_name">Vendor Name:<select class="marg" id="ven_name_form" name="edit_ven" style="width: 20em" >
<?php
	// querry required for the fill vector
	//This is for the name selection where some one will select the name of
	//the company they want to change fields in.
    $select  = 'VEN_NAME';
	$from    = 'Vendors';
	$where   = '1=1';

	$contents = db_query($select, $from, $where);
	$id_row = 'VEN_NAME';
	$size = sizeof($contents[$id_row]);
?>
<!-- Option for Name -->
				 <option value="ven_edit_info" > <?=select_fill('VEN_NAME',$contents,$size)?> </option>
				 </select><br>
</div>




<div>
<!-- Option for catagory they want to change -->
<div id="select_field">select Field for Edit:<select class="marg" id="ven_info" name="edit_ven2" style="width: 20em" >
				 <option value="blank1">  </option>
				 <option value="ven_name2"> Vendor Name </option>
				 <option value="ven_phone2"> Vendor Phone </option>
				 <option value="ven_email2"> Vendor Email </option>
				 <option value="ven_location2"> Vendor Location </option>
				 </select><br></div>
</div>



<!-- This is where the user inserts text and commits the changes made to the vendors field -->
<div id ="text_change">
	Insert Edit: <input type="text" name="ven_submit_edit" style="width: 20em"><br></td>
</div>

				 <br>
<button type="button" id="commit_button" name="edit_commit">Commit Edit </button>
</form>
		<div id="cancel_button2">
			<button id="cancle_2" onclick ="edit_div_hide();">Cancel</button>
		</div>
</div>

</div>









</center>
</body>