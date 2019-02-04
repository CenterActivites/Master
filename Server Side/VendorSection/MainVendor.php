<?php
    function Vendor()
     {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="../VendorSection/ven_css/ven_main_menu.css"/>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
      <script type="text/javascript" src="jquery.quicksearch.js"></script>  <!-- Plugin for the item Search function -->
      <script type="text/javascript">
        $(function ()
        {
          $('input#search').quicksearch('#wet_hands tbody tr'); //On key search for customer names here
        });
      </script>

      <script type="text/javascript">
        $(function(){
          $('<input>').attr({
            type: 'hidden',
            id:'ven_name',
            name: 'ven_name'
          }).appendTo('#button');
        });
      </script>

      <script type="text/javascript">
        $(function(){
          $('<input>').attr({
            type: 'hidden',
            id:'ven_id',
            name: 'ven_id'
          }).appendTo('#button');
        });
      </script>

      <script>
        function is_blank()
        {
          if (document.getElementById('ven_name').value.length == 0 && document.getElementById('ven_id').value.length == 0){
            alert("please select a vendor before continuing");
            return false;
          }
        }
      </script>

      <script type="text/javascript">
      $(document).ready(function(){
  			$("#table_div").click(function(){
  				$('input[type="radio"]:checked').each(function(){
  					var box_value = $(this).val();
  					$('#ven_id').val(box_value);
  				});
  			});
  		});
      </script>

      <script type="text/javascript">
      // this function is triggered when a table row is clicked it checks the radio button in that row
        $(document).ready(function(){
          $("#wet_hands tr").click(function(){
              $(this).find('td input:radio').prop('checked',true);
            });
          });
      </script>

      <script type = "text/javascript">
        // this script calls a CSS class called .highlight in the CSS file
        // So that when a click happens It hightlights the row letting the user know that they've selected it.
        $(document).ready(function(){
          $("#wet_hands tr").click(function(){
            $("#wet_hands tr").removeClass("highlight");
            $(this).addClass("highlight");
          });
        });
      </script>



   </head>
   <body>
     <div id="pageHeader" style="font-size: 35px; text-align: center;"> Vendor Main Menu </div>
        <form method ="post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
          <feildset id="select_feildset">
            <legend> Select A Vendor </legend>
<?php
            $username = strip_tags($_SESSION['username']);  //We grab the username and password the user input and logs the user in with the inputs
            $password = strip_tags($_SESSION['password']);
            $conn = hsu_conn_sess($username, $password);
?>
          <div id=table_div>
            <table id="wet_hands" class="pixel">
              <thead>
                <tr>
                  <th>Vendor Name</th>
                  <th>Vendor Phone</th>
                  <th>Vendor Address</th>
                  <th id="hide_me"></th>
                </tr>
              </thead>
                <tbody>
<?php

            foreach($conn->query("SELECT ven_id, ven_name, ven_phone, ven_address
                        FROM Vendor") as $row)
            {
              $cur_ven_name = $row["ven_name"];
              $cur_ven_id = $row["ven_id"];
              $cur_ven_phone = $row["ven_phone"];
              $cur_ven_address = $row["ven_address"];
?>
                <tr>
                  <td><?=$cur_ven_name?></td>
                  <td><?=$cur_ven_phone?></td>
                  <td><?=$cur_ven_address?></td>
                  <td id = "hide_me"><input id ="radio_in" type="radio"  name="item_id[]" value = "<?= $cur_ven_id ?>"/></td>
                </tr>
<?php
            }
?>

              </tbody>
            </table>
          </div>
      </form>
      <fieldset id="search_fieldset" style="border:none">
        <lable id=search_lable for="search">Search:</lable><input type="text" name="search" id="search"/>
      </fieldset>
			<div id = "button_div">
          <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="button" style="border:none">
	                <fieldset style="border:none" >
                           <input type="submit" name="AVendor" id="AVendor" value="Add Vendor" />
	                         <input type="submit" name="moreIn" id="moreIn" value="More Info." onclick="return is_blank()" />
                           <input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
                           <br />
	                </fieldset>
	        </form>
      </div>
   </body>
</html>


<?php
	     $conn = null;
     }
?>
