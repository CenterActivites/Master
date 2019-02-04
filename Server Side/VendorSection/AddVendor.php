<?php
    function AddVendor()
     {
?>
        <html>
          <head>

            <script>
                function is_blank()
                {
                  if (document.getElementById('venName').value.length == 0 || document.getElementById('venPhone').value.length == 0 || document.getElementById('venLoc').value.length == 0){
                    if(confirm("Some fields are left blank, Continue?"))
                    {
                      return true;
                    }
                    else {
                      return false;
                    }
                  }
                }
            </script>


          </head>
           <body>
              <div id="pageHeader"> Adding Vendor </div>


			  <div>
        <!-- had to figure out the domain so that we could navigate to our posthandler. The domain exisits in the index.php file. -->
				 <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	                 <fieldset >
                   Vendor:       <input type = "text" name = "venName" id = "venName" value ="" /><br/>
                   Phone Number: <input type = "text" name = "venPhone" id = "venPhone" value ="" /><br/>
                   Location:     <input type = "text" name = "venLoc" id = "venLoc" value ="" /><br/>
                  <input type="submit" name="AddVendor" id="AddVendor" value="Add Vendor" onclick="return is_blank()" />
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
