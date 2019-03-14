<?php
  function editinventory()
  {
	//Connecting to the Database
	$conn = hsu_conn_sess();

    $inv_id = strip_tags($_POST["inv_id"]);
?>

<html>
  <head>

    <link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/edit_inv.css"/>

  </head>
  <body>
    <fieldset id="pageheader_fieldset">
      <lable id="pageheader"> Inventory Edit </lable>
    </fieldset>
  <div id = "main_div">
    <div id="form_div">
      <form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="inv_edit">
        <fieldset id="holds_info_inv_set">
<?php
//inventory query
foreach($conn->query("SELECT inv_name, cat_id, stu_day_price, day_price, stu_weekend_price, weekend_price, stu_week_price, week_price
            FROM Inventory
            WHERE inv_id = '$inv_id'") as $row)
            {
              $curr_inv_name = $row["inv_name"];
              $curr_cat_id = $row["cat_id"];
              $curr_stu_day_price = $row["stu_day_price"];
              $curr_day_price = $row["day_price"];
              $curr_student_weekend_price = $row["stu_weekend_price"];
              $curr_weekend_price = $row["weekend_price"];
              $curr_stu_week_price = $row["stu_week_price"];
              $curr_week_price = $row["week_price"];
            }
 ?>
        <fieldset id="inv_name_fieldset">
          <label id="inv_lable">Inventory Name:</lable><br/><input type = "text" name = "curr_inv_name" id = "curr_inv_name" value ="<?= $curr_inv_name ?>" />
        </fieldset>

        <fieldset id="cat_fieldset">
          <label id="inv_lable">Category:</lable><br/> <select name = "cat_select" id="cat_select" size="1"  required >
  			<?php
              //Category query
  							foreach($conn->query("SELECT  cat_id, cat_name
  													FROM Category") as $row)
  							{
  								$cur_cat_name = $row["cat_name"];
  								$cur_cat_id = $row["cat_id"];


  								// what I need to do is get the original status of the item to fill this box.

  			?>
  						<option id ='catinv' value ="<?= $cur_cat_id ?>"> <?=$cur_cat_name?> </option>

  			<?php
  							}
  			?>
  							</select><br/>
        </fieldset>

        <fieldset id="stu_day_price_fieldset">
          <label id="inv_lable">Student Day Price:</lable><br/> <input type = "text" name = "curr_stu_day_price" id = "curr_stu_day_price" value ="<?= $curr_stu_day_price ?>" /><br/>
        </fieldset>

        <fieldset id="reg_day_price_fieldset">
          <label id="inv_lable">Regular Day Price:</lable><br/> <input type = "text" name = "curr_day_price" id = "curr_day_price" value ="<?= $curr_day_price ?>" /><br/>
        </fieldset>

        <fieldset id="stu_weekend_price_fieldset">
          <label id="inv_lable">Student Weekend Price:</lable><br/> <input type = "text" name = "curr_stu_weekend_price" id = "curr_stu_weekend_price" value ="<?= $curr_student_weekend_price ?>" /><br/>
        </fieldset>

        <fieldset id="regular_weekend_price_fieldset">
          <label id="inv_lable">Regular Weekend Price:</lable><br/> <input type = "text" name = "curr_weekend_price" id = "curr_weekend_price" value ="<?= $curr_weekend_price ?>" /><br/>
        </fieldset>

        <fieldset id="stu_week_price_fieldset">
          <label id="inv_lable">Student Week Price:</lable><br/> <input type = "text" name = "curr_stu_week_price" id = "curr_stu_week_price" value ="<?= $curr_stu_week_price ?>" /><br/>
        </fieldset>

        <fieldset id="regular_week_price_fieldset">
          <label id="inv_lable">Regular Week Price:</lable><br/> <input type = "text" name = "curr_week_price" id = "curr_week_price" value ="<?= $curr_week_price ?>" /><br/>
        </fieldset>

        </fieldset>
      </div>
      <div id="button_div">
        <fieldset id="holds_buttons">
          <input type="submit" name="updateInv" id="updateInv" value = "Update"/>
          <input type="submit" name="removeInv" id="removeInv" value = "Remove" onclick = "return remove()"/><br />
          <input type="submit" name="cancel_inv_edit" id="cancel_inv_edit" value ="Cancel"  /><br />
        </fieldset>
      </form>
    </div>
  </div>

  </body>

    <script type="text/javascript">
    //creates an inv_id input object and appends the current inv_id value passed from the $_POST array
      $(function(){
        $('<input>').attr({
          type: 'hidden',
          id:'inv_id',
          name: 'inv_id'
        }).appendTo('#inv_edit');
        var hold_this = "<?php echo $inv_id?>";
        $("#inv_id").val(hold_this);
      });
    </script>
	
    <script type="text/javascript">
    //fucntion meant to warn the user that they are going to delete an item from  the database
      function remove(){
        var inv_name = "<?php echo $curr_inv_name ?>"
        if(confirm("You're about to delete " + inv_name + ". Continue?")){
          return true;
        }else{
          return false;
        }
      }
    </script>

    <script type="text/javascript">
    //appends current cat_id to it's input object
    $(document).ready(function(){
      var curr_cat = "<?php echo $curr_cat_id ?>"
      $("#cat_select").val(curr_cat);
      });
    </script>
	
</html>


<?php
//close connection of database
$conn = null;

}

 ?>
