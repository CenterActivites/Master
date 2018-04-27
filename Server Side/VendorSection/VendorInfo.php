<?php

	function InfoVendor()
	{
?>
<html>
<body>
    <div id="pageHeader"> Vendor Information </div>
    <div>
		<textarea rows="10" cols="60">
			Vendor's Name
			Location
			Phone Number
		</textarea>
    </div>
	<div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="back" id="back" value="Back" /><br />
	        <input type="submit" name="editVen" id="editVen" value="Edit Vendor" /><br />
            <input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>