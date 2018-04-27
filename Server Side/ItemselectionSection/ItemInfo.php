<?php

	function ItemInfo()
	{
?>
<html>
<body>
    <div id="pageHeader"> Item Information </div>
    <div>
		<textarea rows="10" cols="60">
			Item's Name
			Id Number
			Status
			.....
			.....
			.....
			.....
		</textarea>
    </div>
	<div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="backoniteminfo" id="backoniteminfo" value="Back" /><br />
	        <input type="submit" name="editItem" id="editItem" value="Edit Item" /><br />
            <input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>
