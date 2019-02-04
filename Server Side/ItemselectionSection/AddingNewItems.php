<?php
//this page handles inventory enteries
	function AddItems()
	{
		$username = strip_tags($_SESSION['username']);  //We grab the username and password the user input and logs the user in with the inputs
		$password = strip_tags($_SESSION['password']);
		$conn = hsu_conn_sess($username, $password);
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/add_item.css"/>
	<script type="text/javascript">
	// Makes an input object for category
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'cat_id',
				name: 'cat_id'
			}).appendTo('#inv_input');
		});
	</script>

	<script type="text/javascript">
	//grabs the value of category and appends it to cat_id object when the page loads
		$(document).ready(function(){
			$('#category').ready(function(){
				var ven_id = $('#category').val();
				$("#cat_id").val(ven_id);
			});
		});
	</script>


	<script type="text/javascript">
	//grabs the value of category and appends it to cat_id object when a click action happens
		$(document).ready(function(){
			$('#category').click(function(){
				var ven_id = $('#category').val();
				$("#cat_id").val(ven_id);
			});
		});
	</script>


</head>

<body>

    <div id="pageHeader"> Adding New Inventory </div>
    <div id=main_div>
        <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="inv_input">
					<input type = "text" name = "new_inv_name" id = "new_inv_name" placeholder="Item Name For Inventory"/>
				  <select name="category" id="category" size="1"  required >
						<option value="">Select-Category-For-Inventory</option>
<?php
				//query for category
				foreach($conn->query("SELECT  cat_id, cat_name
										FROM Category") as $row)
				{
					$cur_cat_name = $row["cat_name"];
					$cur_cat_id = $row["cat_id"];
?>
			<option id ='catinf' value ="<?= $cur_cat_id ?>"> <?=$cur_cat_name?> </option>

<?php
				}
?>
				</select><br/>
				  <input type = "text" name = "new_stu_day_price" id = "new_stu_day_price" placeholder="Student Day Price"/>
				  <input type = "text" name = "new_public_day_price" id = "new_public_day_price" placeholder="Public Day Price"/><br/>
				  <input type = "text" name = "new_student_week_price" id = "new_student_week_price" placeholder="Student Week Price"/>
				  <input type = "text" name = "new_public_week_price" id = "new_public_week_price" placeholder="Public Week Price"/><br/>
				  <input type = "text" name = "new_student_weekend_price" id = "new_student_weekend_price" placeholder="Studen Weekend Price"/>
				  <input type = "text" name = "new_public_weekend_price" id = "new_public_weekend_price" placeholder="Public Weekend Price"/>

						<fieldset id ="button_fieldset" style="border:none" >
						 <input type="submit" name="add" id="add" value="Add" />


				</form>

				<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="inv_inpu">
					<input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
				</form>
				</fieldset>
    </div>
</body>
</html>


<?php
	// ends connnection to database
	$conn = null;
	}
?>
