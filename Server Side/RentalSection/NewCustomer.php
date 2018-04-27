<?php
    function AddingNewCust()
     {
?>
        <html>
           <body>
              <div id="pageHeader"> New Customer </div>
              <div>
					Customer Name: <input type = "text" name = "custName" id = "custName" value ="" /><br/>
					Phone Number: <input type = "text" name = "custPhone" id = "custPhone" value ="" /><br/>
					Address: <input type = "text" name = "custAddress" id = "custAddress" value ="" /><br/>
					......: <input type = "text" name = "random" id = "random" value ="" /><br/>
					......: <input type = "text" name = "random" id = "random" value ="" /><br/>
					......: <input type = "text" name = "random" id = "random" value ="" /><br/>
				</div>
			  
			  <div>
				 <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	                 <fieldset >
		                 <!-- Buttons on the add vendor page  -->
                             <input type="submit" name="continue" id="continue" value="Continue/Add" /><br />
	                         <input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
	                 </fieldset>
	          </form>
              </div>
           </body>
        </html>


<?php
     }
?>