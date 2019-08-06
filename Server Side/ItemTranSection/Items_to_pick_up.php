<?php
	function ItemToPickUp()
	{
?>
		<html>
		<head>
			<link rel="stylesheet" type="text/css" href="../ItemTranSection/item_selection.css"/>
		
			<legend> Item Pick-Up </legend>
			
			<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
			
		</head>
		<body style="text-align: center;">
<?php
			//Grabbing the selected customer id and setting it in SESSION
			$rent_id = strip_tags($_POST['rent_id']);
			$_SESSION["rent_id"] = $rent_id;
			
			//Connecting to the Database
			$connctn = db();
			
			//We do a mysql select here to get all the items that are being "reserved" for the customer to be picked up
			$items = $connctn->prepare("SELECT item_Frontid, inv_name, b.item_Backid, request_date, cust_id, item_modeltype
										FROM Inventory a, Item b, Rental c, Reserve1 d
										WHERE a.inv_id = b.inv_id and 
												b.item_Backid = d.item_Backid and 
												d.rent_id = c.rent_id and 
												rental_status = 'On-Going' and 
												c.rent_id = :a and 
												c.pick_up_date is NULL");
			$items->bindValue(':a', $rent_id, PDO::PARAM_INT);
			$items->execute();
			$display_array = $items->fetchAll();
		
			$comments = $connctn->prepare("SELECT note, empl_fname, empl_lname
												FROM Notes a, Employee b, Rental c, NotesRental d
												WHERE a.empl_id = b.empl_id and 
														a.note_id = d.note_id and 
														c.rent_id = d.rent_id and 
														c.rent_id = :z"); 
			$comments->bindValue(':z', $rent_id, PDO::PARAM_INT);
			$comments->execute();
			$comments = $comments->fetchAll();
			
			if($comments[0]['note'] == null || $comments[0]['note'] == "")
			{
				$comment_display = "Type Any Comments Here";
			}
			else
			{
				$comment_display = "";
				foreach($comments as $comment)
				{
					$comment_display = $comment_display . $comment['note'] . " -- Made by " . $comment['empl_fname'] . " " . $comment['empl_lname'] . "&#13;&#10;";
				}
				$comment_display = $comment_display . "Type Any New Comments Here";
			}
			
			$_SESSION["cust_id"] = $display_array[0]['cust_id'];
			
			//Grab the size of the data we got from the select statement for the following FOR loop
			$array_size = count($display_array);
?>
			<div class="container" style="margin-left:auto;margin-right:auto;width:100%;">
			<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
				<div>
					<!-- Table Creation -->
					<table id="item_table" name="item_table" style="width:70%; margin-left:auto; margin-right:auto;">
						<tr>
							<th id='hide_me'></th>
							<th> Item Name: </th>
							<th> Item Model/Brand: </th>
							<th> Item Id: </th>
							<th> Date to be Pick Up </th>
						</tr>
<?php
					//Start of the FOR loop
					for($i=0; $i<$array_size; $i++)
					{
						//The following two lines is for formatting reasons. Basically to make the date we get from the database more readable for users
						$curr_request_date = strtotime($display_array[$i]['request_date']);
						$curr_request_date = date('M d, Y', $curr_request_date);
?>
						<tr>
							
							<!-- Create a checkbox for each item to be selected. Also here we set the item_Backid to the checkbox value -->
							<td id='hide_me'> <input type="checkbox" id="item_id" name="item_id[]" value="<?= $display_array[$i]['item_Backid'] ?>"> </td>
							
							<!-- Displaying the item name and front id to the screen -->
							<td> <?= $display_array[$i]['inv_name'] ?> </td>
							<td> <?= $display_array[$i]['item_modeltype'] ?> </td>
							<td> <?= $display_array[$i]['item_Frontid'] ?> </td>
							<td> <?= $curr_request_date ?> </td>
						</tr>
<?php
					}
?>
					</table><br />
					
					<!-- Comments section for any comments about the transaction or items condition -->
					<label> Comments </label>
					<textarea name="comments" id="comments" rows="4" cols="50" placeholder="<?= $comment_display ?>" ></textarea> 
					</br>
					
					<!-- Following are inputs that are either hidden or buttons -->
					<input type="hidden" name="item_to_be_pick_up" id="item_to_be_pick_up"  />  <!-- Hidden input tag keep track of which items are selected to be picked up -->
					<input type="hidden" name="item_leftover" id="item_leftover"  value='0'/>  <!-- Hidden input tag keep track if there are items that the customer isn't picking up -->
					<input type="submit" name="Checkout" id="Checkout" value="Checkout" /> &nbsp; <!-- Checkout Button -->
					<input type="submit" name="cancelReserve" id="cancelReserve" value="Cancel Reserve" /> &nbsp; <!-- Cancel Reserve Button. Which will cancel the Reserve entireally -->
					<input type="submit" name="mod_rental" id="mod_rental" value="Modify Rental" /> &nbsp; <!-- Modify Button. Which will modify the Reserve -->
					<input type="submit" name="back" id="back" value="Back" /> &nbsp; <!-- Plain old Cancel button. Which just take user back to the Homepage. Used mainly for accidentally selecting the wrong customer -->
				</div>
			</form>
			</div>
		</body>
		
			<!-- Javascript Starts here -->
			<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
			
			<!-- Javascript function that allows the program to see which item been selected by the checkbox to be picked up -->
			<script type="text/javascript">
				$(document).ready(function()
				{
					//Once the 'Checkout' button been clicked
					$("#Checkout").click(function()
					{
						//We look at all the items with their checkbox checked
						//This is kinda like a 'FOR' loop in the sense that we go through each checkbox, one at a time, and does the following to them
						$('#item_table').find('input[type="checkbox"]:checked').each(function () {
							
							//Grab the value of the checkbox which is the item_Backid
							var box_value = $(this).val();
							console.log(box_value);
							
							//See if the string is empty or not. If the string is empty, that means we just started adding items to the string for processing.
							//Since at the start, we can just set the string equal to the item_Backid
							if($("#item_to_be_pick_up").val() == "")
							{
								$("#item_to_be_pick_up").val(box_value);
							}
							//If the string is not empty, that means we are continuing to adding more and more selected items.
							//We will have to add on to the string which will have a ',' to saperate each item_Backid
							else
							{
								var get_val = $("#item_to_be_pick_up").val();
								$("#item_to_be_pick_up").val(get_val + "," + box_value);
							}
						});
						
						//Checks if the user had selected any items for pick-up
						if($("#item_to_be_pick_up").val().length == 0)
						{
							//If user did not select any items, they will get a alert and won't be able to move on
							alert("No Item was Selected for Pick Up");
							return false;
						}
						
						$('#item_table').find('input[type="checkbox"]:not:checked').each(function () 
						{
							$("#item_to_be_pick_up").val('1');
						});
					});
				});
			</script>
			
			<script type="text/javascript">
				$(document).ready(function(){
					//Toggle script that either checks or uncheck the hidden checkbox
					$("#item_table tr").click(function(){
							$(this).find('td input:checkbox').click();
						});
					});
			</script>

			<script type = "text/javascript">
				// this script calls a CSS class called .highlight in the CSS file
				// So that when a click happens It hightlights the row letting the user know that they've selected it and 
				//    when already highlighted row is click, it will de-highlight so that user know that they de-selected it
				$(document).ready(function(){
					$("input[type='checkbox']").change(function (e) 
					{
						if ($(this).is(":checked")) 
						{ //If the checkbox is checked
							$(this).closest('tr').addClass("highlight"); 
							//Add class on checkbox checked
						} 
						else 
						{
							$(this).closest('tr').removeClass("highlight");
							//Remove class on checkbox uncheck
						}
					});
					
				});
			</script>
			
			<script type="text/javascript">
				$(document).ready(function()
				{
					//Toggle script that either checks or uncheck the hidden checkbox
					$("#cancelReserve").click(function()
					{
						if(confirm("You are about to cancel a rental reserve. Are you sure?"))
						{
							return true;
						}
						else
						{
							return false;
						}
					});
				});
			</script>
		
		</html>
<?php
		$connctn = null;
	}
?>
