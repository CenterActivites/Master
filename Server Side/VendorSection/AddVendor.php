<?php
    function AddVendor()
     {
?>
        <html>
          <head>
			<link rel="stylesheet" type="text/css" href="../VendorSection/ven_css/ven_main_menu.css"/>
            <script>
                function is_blank()
                {
                  if (document.getElementById('venName').value.length == 0 || document.getElementById('venPhone').value.length == 0 || document.getElementById('venLoc').value.length == 0){
                    if(confirm("There are some empty fields left"))
                    {
                      return false;
                    }
                  }
                }
            </script>

          </head>
           <body>
				<fieldset id='fieldset_label' style="width:25%; margin-left:37%; border:none;">
					<label id='header_for_table' style="padding-left: 5%; font-size: 30px"> Adding New Vendor </label>
				</fieldset>

        <!-- had to figure out the domain so that we could navigate to our posthandler. The domain exisits in the index.php file. -->
				<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	                
					<table id="adding_vendor">
						<tr>
							<th>
								Vendor:
							</th>
							<td>
								<input type = "text" name = "venName" id = "venName" value ="" placeholder="Vendor Name"/>
							</td>
						</tr>
						
						<tr>
							<th>
								Phone Number:
							</th>
							<td>
								<input type = "text" name = "venPhone" id = "venPhone" value ="" placeholder="Vendor Phone Number"/>
							</td>
						</tr>
						
						<tr>
							<th>
								Location: 
							</th>
							<td>
								<input type = "text" name = "venLoc" id = "venLoc" value ="" placeholder="Vendor Location"/>
							</td>
						</tr>
						
					</table>
					
					<input type="submit" name="AddVendor" id="AddVendor" value="Add Vendor" onclick="return is_blank()" />
				</form>

          <form action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method = 'post'>
                <input type="submit" name="cancel" id="cancel" value="Cancel" />
          </form>
		  
        </body>
</html>

<?php
     }
?>
