<?php
/*
File: Admin Add Packages Page

*/
?>
<center>
<p>Add Package(s)</p>
<form method="post" 
	 name="addpack"
	 onsubmit="return add_packages();"
     action="<?=domain?>/php-inputhandler.php">
	<!-- Creating a field set to seperate the buttons and forms -->
	<!-- new Form for popup deletion -->
	<fieldset>
		<table>
			<tr>
				<td>Package Name:</td>
				<td><input type="text" name="pack_name"><br></td>
			</tr>	
		</table>
	</fieldset>
	<!-- Creating a field set to seperate the buttons and forms -->
        <fieldset>
            <div>
				<input type="hidden" name = "Vendors_Input" value = "1"/>
				<input type="submit" name="submit" value="Add Package(s)"onclick="return add_packages();"/>
            </div>
        </fieldset>
</form>
</center>
