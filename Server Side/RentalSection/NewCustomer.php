<?php
    function AddingNewCust()
     {
?>
        <html>
           <body>
              <div id="pageHeader"> New Customer </div>
				<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
              <div>
					Customer Name: <input type = "text" name = "custName" id = "custName" maxlength="50" value ="" placeholder="..." required/><br />
					Phone Number: <input type = "tel" name = "custPhone" id = "custPhone" maxlength="12" value ="" placeholder="..." required/><br />
					Address: <input type = "text" name = "custAddress" id = "custAddress" maxlength="100" value ="" placeholder="..." required/><br />
					Birthdate: <input type = "text" name = "dob" id = "dob" maxlength="10" value ="" placeholder="..." /><br />
					Email: <input type = "text" name = "custEmail" id = "custEmail" maxlength="50" value ="" placeholder="..." required/><br />
					Student: <select name="isStudent" required> <br />
								<option hidden></option>
								<option>yes</option>
								<option>no</option>
							</select>
					Employee: <select name="isEmpl" required> <br />
								<option hidden></option>
								<option>yes</option>
								<option>no</option>
							</select>
					Emergency Contact Name: <input type = "text" name = "emerName" id = "emerName" maxlength="38" value ="" placeholder="..." required/><br />
					Emergency Contact Phone Number: <input type = "text" name = "emerPhone" id = "emerPhone" maxlength="12" value ="" placeholder="..." required/><br />
				</div>
			  
			  <div>
	                 <fieldset >
                             <input type="submit" name="continue" id="continue" value="Continue/Add" /><br />
	                 
	          </form>
			  <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	                <input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
                        </fieldset>
				</form>
              </div>
           </body>
        </html>


<?php
     }
?>