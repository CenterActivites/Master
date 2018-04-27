<?php
    function AddVendor()
     {
?>
        <html>
           <body>
              <div id="pageHeader"> Adding Vendor </div>


			  <div>
				 <form action ="<?=domain?>/VendorSection/addvendor-posthandler.php" method= "post">
	                 <fieldset >
                     Name of Vendor: <input type = "text" name = "venName" id = "venName" value ="" /><br/>
                   Location: <input type = "text" name = "venLoc" id = "venLoc" value ="" /><br/>
                   Phone Number: <input type = "text" name = "venPhone" id = "venPhone" value ="" /><br/>
		                 <!-- Buttons on the add vendor page  -->
                             <input type="submit" name="AddVendor" id="AddVendor" value="Add Vendor" />

	                 </fieldset>
	          </form>

          </div>

        <div id ='back_button'>
          <form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method = 'post'>
              <fieldset id= 'backButton'>
                <input type="submit" name="back" id="back" value="Back" />
              </fieldset>
          </form>
        </div>


           </body>
        </html>


<?php
     }
?>
