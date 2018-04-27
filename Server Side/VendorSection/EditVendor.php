<?php

	function EditVendor()
	{
?>
<html>
<body>
    <div id="pageHeader"> Editing Vendor </div>
    <div>
    Name of Vendor: <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	Location: <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	Phone Number: <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
    </div>
	<div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="updateVen" id="updateVen" value="Update Vendor" /><br />
	        <input type="submit" name="removeVen" id="removeVen" value="Remove Vendor" /><br />
            <input type="submit" name="cancelEdit" id="cancelEdit" value="Cancel" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>

