<?php

	function AddItems()
	{
?>
<html>
<body>
    <div id="pageHeader"> Adding New Items </div>
    
   
    <div>
        Name of Item: <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
		Id: <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
		... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
		... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
		... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
		... : <input type = "text" name = "searchitem" id = "seatchitem" value ="" /><br/>
    </div>

	<div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="add" id="add" value="Add" /><br />
	        <input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>