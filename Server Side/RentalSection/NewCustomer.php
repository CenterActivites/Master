<?php
    function AddingNewCust()
     {
?>
        <html>
           <body>
              <div id="pageHeader"> New Customer </div>
				<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
              <div>
					Customer Name: <input type = "text" name = "custName" id = "custName" value ="" required/>
					Phone Number: <input type = "text" name = "custPhone" id = "custPhone" value ="" required/>
					Address: <input type = "text" name = "custAddress" id = "custAddress" value =""required/>
					Birthdate: <input type = "text" name = "dob" id = "dob" value ="" required/>
					Email: <input type = "text" name = "custEmail" id = "custEmail" value ="" required/>
					Student: <select name="isStudent" required> 
								<option>yes</option>
								<option>no</option>
							</select>
					Emergency Contact Name: <input type = "text" name = "emerName" id = "emerName" value ="" required/>
					Emergency Contact Phone Number: <input type = "text" name = "emerPhone" id = "emerPhone" value ="" required/>
				</div>
			  
			  <div>
	                 <fieldset >
                             <input type="submit" name="continue" id="continue" value="Continue/Add" /><br />
	                 </fieldset>
	          </form>
			  <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	                <input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
				</form>
              </div>
           </body>
        </html>


<?php
     }
?>