<!DOCTYPE>
<?php

     function MainMenu()
     {

?>
	     <html>
             <body>
                         <div id="pageHeader"> Main Menu </div>
		         <div>
                     <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	                     <fieldset >
		                     <!-- Main Menu. 5 buttons so far  -->
                             <input type="submit" name="Rental" id="Rental" value="New Rental" /><br />
	                         <input type="submit" name="ViewCus" id="ViewCus" value="View/Edit Customer" /><br />
                             <input type="submit" name="ViewInv" id="ViewInv" value="View/Edit Inventory" /><br />
				             <input type="submit" name="ViewVen" id="ViewVen" value="View/Edit Vendors" /><br />
                             <input type="submit" name="ReturnI" id="ReturnI" value="Item Return" /><br />
				             <input type="submit" name="LogOut" id="log_out" value="Log Out" /><br />
			             </fieldset>
	                 </form>
                 </div>
             </body>
         </html>
<?php
     }
?>
