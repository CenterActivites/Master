<?php

	function RentalItemSelect()
	{
?>
<html>
<body>
    <div id="pageHeader"> Selection of Items </div>
    <div>
        <select size="6">
            <option value="time">TimeStamp1</option>
			<option value="time">TimeStamp2</option>
			<option value="time">TimeStamp3</option>
			<option value="time">TimeStamp4</option>
			<option value="time">TimeStamp5</option>
			<option value="time">TimeStamp6</option>
			<option value="time">TimeStamp7</option>
			<option value="time">TimeStamp8</option>
		</select>

		<select size="6">
            <option value="item">Item1</option>
			<option value="item">Item2</option>
			<option value="item">Item3</option>
			<option value="item">Item4</option>
			<option value="item">Item5</option>
			<option value="item">Item6</option>
			<option value="item">Item7</option>
			<option value="item">Item8</option>
		</select>
    </div>
	<div>
		Search: <input type = "text" name = "searchitem" id = "seatchitem" value ="Search Item Name" /><br/>
	</div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="calPay" id="calPay" value="Continue to Payments" /><br />
            <input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>