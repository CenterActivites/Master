<?php
    function Rental()
     {
?>
        <html>
           <body>
              <div id="pageHeader"> Starting Rental </div>
			  <div>
                 <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	                 <fieldset >
                             <input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
	                         <input type="submit" name="newCust" id="newCust" value="New Customer" /><br />
                             <input type="submit" name="oldCust" id="oldCust" value="Old/Existing Customer" /><br />
	                 </fieldset>
	             </form>
              </div>
			  <div>
                    </div>
						Search: <input type = "text" name = "searchCust" id = "searchCust" value ="Customer Name Search" /><br/>
					<div>
              </div>
           </body>
        </html>


<?php
     }
?>