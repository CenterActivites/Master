<?php

	function EditItem()
	{
?>
<html>
<body>
    <div id="pageHeader"> Editing Item</div>
    <div>
    Name of Item: <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	Id: <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	.... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	.... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	.... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	.... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	.... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
	.... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
    </div>
	<div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="updateItem" id="updateItem" value="Update Item" /><br />
	        <input type="submit" name="removeItem" id="removeItem" value="Remove Item" /><br />
            <input type="submit" name="cancelEdit" id="cancelEdit" value="Cancel" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>

