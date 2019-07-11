<?php
	function ItemToReturn()
	{
?>
		<html>
		<head>
			<link rel="stylesheet" type="text/css" href="../ItemTranSection/item_selection.css"/>
			
			<legend> Item Return </legend>
			
			<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		</head>
		<body style="text-align: center;">
<?php
			//Grabs the selected customer id and set it in SESSION
			$cust_id = strip_tags($_POST['cust_id']);
			$_SESSION["cust_id"] = $cust_id;
			
			//Connecting to the Database
			$connctn = hsu_conn_sess();
			
			//Does a mysql select to the database to grab item front id, name, back id, and the due date of the item
			$items = $connctn->prepare("SELECT item_Frontid, inv_name, b.item_Backid, due_date, item_modeltype
									FROM Inventory a, Item b, Rental c, CheckOut d
									WHERE a.inv_id = b.inv_id and b.item_Backid = d.item_Backid and d.rent_id = c.rent_id
									and c.cust_id = :a and c.return_date is NULL");
			$items->bindValue(':a', $cust_id, PDO::PARAM_INT);
			$items->execute();
			$display_array = $items->fetchAll();
		
			/*$comments = $connctn->prepare("SELECT note, empl_fname, empl_lname
												FROM Notes a, Employee b, Rental c, NotesRental d
												WHERE a.empl_id = b.empl_id and 
														a.note_id = d.note_id and 
														c.rent_id = d.rent_id and 
														c.rent_id = :z"); 
			$comments->bindValue(':z', $rent_id, PDO::PARAM_INT);
			$comments->execute();
			$comments = $comments->fetchAll();*/
			
			if($comments[0]['note'] == null || $comments[0]['note'] == "")
			{
				$comment_display = "Type Any Comments Here";
			}
			else
			{
				$comment_display = "";
				foreach($comments as $comment)
				{
					$comment_display = $comment_display . $comment['note'] . " -- Made by " . $comment['empl_fname'] . " " . $comment['empl_lname'] . "                                       ";
				}
				$comment_display = $comment_display . "Type Any New Comments Here";
			}
			
			//Grab the size of the data received from the database
			$array_size = count($display_array);
?>
			<div class="container" style="margin-left:auto;margin-right:auto;width:100%;">
			<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
				<div>
					<!-- Start of Table Creation -->
					<table id="item_table" name="item_table" style="width:70%; margin-left:auto; margin-right:auto;">
						<tr>
							<th id='hide_me'></th>
							<th> Item Name: </th>
							<th> Item Model/Brand: </th>
							<th> Item Id: </th>
							<th> Due Date: </th>
						</tr>
<?php
					//Start of the FOR loop that will loop through all the data received from the database
					for($i=0; $i<$array_size; $i++)
					{
?>
						<!-- Display the item name and front id to the screen -->
						<tr>
							<!-- Create a checkbox for each item and sets the item_Backid to the checkbox's value -->
							<td id="hide_me"> <input type="checkbox" id="item_id" name="item_id[]" value="<?= $display_array[$i]['item_Backid'] ?>"></td>
							<td> <?= $display_array[$i]['inv_name'] ?> </td>
							<td> <?= $display_array[$i]['item_modeltype'] ?> </td>
							<td> <?= $display_array[$i]['item_Frontid'] ?> </td>
<?php
							//Format the due date into a more readable format for the users
							$curr_due_date = strtotime($display_array[$i]['due_date']);
							$curr_due_date = date('M d, Y', $curr_due_date);
							
							//Does a check to see if the due_date received from the database is past the current date
							//If so then that mean the item is due to be returned and will be label "Late" 
							if(strtotime($display_array[$i]['due_date']) < strtotime(date('Y-m-d')))
							{
?>
								<td> <?= $curr_due_date ?> &nbsp;&nbsp; LATE </td>
<?php
							}
							else
							{
?>
								<td> <?= $curr_due_date ?> </td>
<?php								
							}
?>
						</tr>
<?php
					}
?>
					</table><br />
					
					<!-- Comments section for any comments about item conditions or anything at all -->
					<label> Comments: </label>
					<textarea name="comments" id="comments" rows="4" cols="50" placeholder="<?= $comment_display ?>" ></textarea> 
					</br>
					
					<!-- Following are 1 hidden input and 2 input buttons -->
					<input type="hidden" name="item_to_be_return" id="item_to_be_return"  />  <!-- Hidden input tag keep track of which items are selected to be returned -->
					<input type="hidden" name="item_leftover" id="item_leftover"  value='0'/>  <!-- Hidden input tag keep track if there are items that isn't being selected for returned -->
					<input type="submit" name="Checkin" id="Checkin" value="Checkin" /> &nbsp;
					<input type="submit" name="cancel" id="cancel" value="Cancel" /><br />
				</div>
			</form>
			</div>
		</body>
			
			<!-- Javascript Starts here -->
			<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
			<script type="text/javascript">
				// Little Javascript function that allows the program to process all selected items for return
				$(document).ready(function()
				{
					//Once the 'Checkin' button been clicked
					$("#Checkin").click(function()
					{
						//Go through all checked checkbox 
						$('#item_table').find('input[type="checkbox"]:checked').each(function () {
							
							//Grab the checkbox value which is the item_Backid
							var box_value = $(this).val();
							console.log(box_value);
							
							//Checks if the string is empty or not, if so that means we can just set the string to the item_Backid
							if($("#item_to_be_return").val() == "")
							{
								$("#item_to_be_return").val(box_value);
							}
							//If not empty, then we will just keep adding item_Backid to the string with "," as the separater between each item_Backid
							else
							{
								var get_val = $("#item_to_be_return").val();
								$("#item_to_be_return").val(get_val + "," + box_value);
							}
						});
						
						$('#item_table').find('input[type="checkbox"]:not:checked').each(function () 
						{
							$("#item_leftover").val('1');
						});
						
						//Checks if the user had selected any items for pick-up
						if($("#item_to_be_return").val().length == 0)
						{
							//If user did not select any items, they will get a alert and won't be able to move on to the reciept
							alert("No Item was Selected for Return");
							return false;
						}
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
			
		</html>
<?php
		$connctn = null;
	}
?>
