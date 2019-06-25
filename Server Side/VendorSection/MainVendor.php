<?php
    function Vendor()
     {
?>
<!-- DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" -->
<html>
   <head>
      <link rel="stylesheet" type="text/css" href="../VendorSection/ven_css/ven_main_menu.css"/>
		
<?php
		$lvl_access = strip_tags($_SESSION['lvl_access']);
		if($lvl_access == "4" || $lvl_access == "3" || $lvl_access == "2")
		{
			$lvl_2 = "type = 'submit'";	
			$disabled_2="";
		}
		else
		{
			$lvl_2 = "type = 'hidden'";
			$disabled_2="disabled";
		}
?>

   </head>
   <body>
     <div id="pageHeader" style="font-size: 35px; text-align: center;"> Vendor Main Menu </div>
        <form method ="post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>"> </br>
            <fieldset id='fieldset_label' style="text-align: left; background-color: #D3D3D3; width:96%; border:none; margin-left:auto; margin-right:auto;">
				<label id='header_for_table' style="font-size: 20px; padding-left: 5%;">Vendor List</label>
			</fieldset> </br>
<?php
			//Connecting to the Database
            $conn = hsu_conn_sess();
?>
          <div id="table_div">
            <table id="vendor_table" class="pixel">
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

				foreach($conn->query("SELECT ven_id, ven_name, ven_phone, ven_street_address, ven_city, ven_state, ven_zip_code
							FROM Vendor") as $row)
				{
					$cur_ven_name = $row["ven_name"];
					$cur_ven_id = $row["ven_id"];
					$cur_ven_phone = $row["ven_phone"];
					$cur_ven_street_address = $row["ven_street_address"];
					$cur_ven_city = $row["ven_city"];
					$cur_ven_state = $row["ven_state"];
					$cur_ven_zip = $row["ven_zip_code"];
?>
					<tr>
					  <td><?=$cur_ven_name?></td>
					  <td><?=$cur_ven_phone?></td>
					  <td> <?=$cur_ven_street_address?>&nbsp;<?=$cur_ven_city?>,&nbsp;<?=$cur_ven_state?>
									&nbsp;<?=$cur_ven_zip?> </td>
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
        <label id="search_lable" for="search">Search:</label> 
		<input type="text" name="search" id="search"/>
      </fieldset>
			<div id = "button_div">
          <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="button" style="border:none">
	                <fieldset style="border:none" >
						<input <?= $lvl_2 ?> name="AVendor" id="AVendor" value="Add Vendor" <?= $disabled_2 ?>/>
						<input <?= $lvl_2 ?> name="editVen" id="editVen" value="Edit Vendor" <?= $disabled_2 ?> onclick="return is_blank()" />
	                </fieldset>
	        </form>
      </div>
   </body>
		
	<!-- Javascript Starts here -->
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
      <script type="text/javascript" src="jquery.quicksearch.js"></script>  <!-- Plugin for the item Search function -->
      <script type="text/javascript">
        $(function ()
        {
          $('input#search').quicksearch('#vendor_table tbody tr'); //On key search for customer names here
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
          if (document.getElementById('ven_id').value.length == 0){
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
          $("#vendor_table tr").click(function(){
              $(this).find('td input:radio').prop('checked',true);
            });
          });
      </script>

      <script type = "text/javascript">
        // this script calls a CSS class called .highlight in the CSS file
        // So that when a click happens It hightlights the row letting the user know that they've selected it.
        $(document).ready(function(){
          $("#vendor_table tr").click(function(){
            $("#vendor_table tr").removeClass("highlight");
            $(this).addClass("highlight");
          });
        });
      </script>
</html>


<?php
	     $conn = null;
     }
?>
