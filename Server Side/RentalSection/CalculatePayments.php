<?php

	function CalPay()
	{
?>
<html>
<body>
    <div id="pageHeader"> Calculate Payments </div>
        Deposit Amount: <output name="deposit" for="deposit"></output>
		Total Cost of Rental: <output name="totalCost" for="totalCost"></output>

    <div>
		<textarea rows="10" cols="60">
			Return Policy
			.....
			.....
			.....
			.....
			.....
			.....
		</textarea>
    </div>
	<div>
    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	    <fieldset >
            <input type="submit" name="finalize" id="finalize" value="Finalize" /><br />
	        <input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
	    </fieldset>
	</form>
    </div>
</body>
</html>


<?php
	}
?>
