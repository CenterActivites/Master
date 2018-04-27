<?php
    function Vendor()
     {
?>
        <html>
          <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script>
                $("#search").on("keyup",function(){
                      var value = $(this).val();
                      value = 0;
                      console.log(value);
                      $("tr").each(function(index) {
                        if(index != 0 ){
                          $row = $(this);
                          echo $row;
                        }
                        var id = $row.find("td").text();

                        if (id.indexOf(value) != 0) {
                                      $(this).hide();

                        }
                        else {
                            $(this).show();
                        }
                      }
                    });
                  });
            </script>
          </head>
           <body>



          

            <?php
             if ( (! array_key_exists("username", $_SESSION)) or
                     ($_SESSION["username"] == "") or
                      (! isset($_SESSION["username"])) )
                 {
                     complain_and_exit("username");
                 }

             $username = strip_tags($_SESSION['username']);  //We grab the username and password the user input and logs the user in with the inputs
             $password = strip_tags($_SESSION['password']);
             $_SESSION['username'] = $username;
             $_SESSION['password'] = $password;
             $conn = hsu_conn_sess($username, $password);

             $sel_ven_str = 'select ven_name
                      from Vendor';

             $sel_ven_stmt = oci_parse($conn, $sel_ven_str);

             oci_execute($sel_ven_stmt, OCI_DEFAULT);

             ?>

              <div id="pageHeader"> Vendor Main Menu </div>
                <div id = "ven_table">
                  <table id = "myTable">
          					<tr>
          						<th scope="col"> Vendor Name</th>
          					</tr>

                    <?php
                    while (oci_fetch($sel_ven_stmt))
                    {

                      $curr_cust_ven_name = oci_result($sel_ven_stmt, "VEN_NAME");
                    ?>
                  <tr>
                    <td scope="row"> <?= $curr_cust_ven_name ?> </td>
                  </tr>
                <?php
                   }
                ?>
                </div>

			  <div>
                 <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
	                 <fieldset >
                             <input type="submit" name="AVendor" id="AVendor" value="Add Vendor" /><br />
	                         <input type="submit" name="moreIn" id="moreIn" value="More Info." /><br />
                             <input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
                             <input type="text" name="search" id="search"/>
                             <br />
	                 </fieldset>
	          </form>
              </div>
           </body>
        </html>


<?php
     }
?>
