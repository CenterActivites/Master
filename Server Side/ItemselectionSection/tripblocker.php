<?php
	//Item Selection Page. Where users are going to select the items the customers want to rent out 
	function TripBlock()
	{
		//PDO Connection to the Databse
        $conn = db();
		
		$trips = $conn->prepare("SELECT *
								FROM Trip");
		$trips->execute();
		$trips = $trips->fetchAll();
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/modal_css.css"/>
	<style>
		.grid-container 
		{
		  display: grid;
		  grid-template-columns: auto auto auto auto auto auto auto;
		  padding: 10px;
		}
		.grid-item 
		{
		  padding: 10px;
		  text-align: center;
		}
		.grid-item:hover 
		{
			background: ddd; 
		}
		.div_for_selection
		{
		  border-style: solid;
		  border-color:008000;
		  width:90%; 
		  margin-left:auto; 
		  margin-right:auto;
		}
		#trip_list
		{
			width:100%;
		}
		#trip_list td 
		{
			padding: 8px;
			text-align: center;
			font-size: 17px;
			font-family: "Times New Roman", Times, serif;
			border:none;
		}
		label
		{
			font-weight: bold;
			font-size: 20px;
		}
		#block, #back
		{
			background-color: #008000;
			color: white;
			padding: 14px 20px;
			white-space: normal;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 20px;
			font-family: "Times New Roman", Times, serif;
			position: relative;
			text-align: center;
			color: #EEE8AA;
			box-sizing:content-box;
			word-wrap: break-word;
			white-space: normal;
			float:left;
			margin-left: 6%;
		}
		#block
		{
			margin-left: 42.5%;
		}
		#back
		{
			margin-left: 2%;
		}
		#block:hover, #back:hover 
		{
			background-color: #006400;
		}
		.highlight 
		{ 
			background: #DCDCDC;
			border-style: solid;
			border-color: f2f2f2;

		}
	</style>
	
</head>
<body>

	<fieldset id='fieldset_label' style="border:none; text-align: center;">
		<label id='header_for_table' style="font-size: 35px"> Trips </label>
	</fieldset>
	</br>
	</br>
	
	<div id="div_name_block" name="div_name_block" style="text-align:center; margin-left:auto; margin-right:auto;">
		<label for="name_block"> Name of Trip: </label>
		<input id="name_block" id="name_block" />
	</div>

	</br>
	
	<div id='input_dates' name='input_dates' style='display: block; text-align:center; margin-left:auto; margin-right:auto;'>
		<!-- The "Pick up" and "Return" date inputs. Have it where users can not select past dates for rentals -->
		
		<label for="start_date"> Start date: </label>
		<input type = "date" name = "start_date" id = "start_date" min="<?php echo date('Y-m-d'); ?>"/>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		
		<label for="end_date"> End date: </label>
		<input type = "date" name = "end_date" id = "end_date" min="<?php echo date('Y-m-d'); ?>"/>
	</div>
    
	</br>
    <div style="text-align:center;"> 
	
		<fieldset style="border:none; word-wrap: break-word;">
			<label id="label_for_trip_list" for="trip_list"> List of pre-loaded list </label>
			<table id="trip_list" name="trip_list">
				<!-- Searchable functionals for a more narrower search in a table for styling purposes -->
				<tr>
<?php
					foreach($trips as $row)
					{
?>
						<th> <?= $row['trip_name'] ?> </th>
<?php
					}
?>
				</tr>
				<tr>
				
<?php
					foreach($trips as $row)
					{
?>
						<td> <input type="radio" id="trip" name="trip[]" value="<?= $row['trip_id'] ?>"> </td>
<?php
					}
?>
				</tr>
			</table>
	
			<div id="div_for_selection" class="div_for_selection">
				<fieldset id='fieldset_label' style="border:none; text-align: center;">
					<label id='label_for_inventory_selection' style="font-size: 20px"> Inventory List: </label>
				</fieldset>
				<div id="inv_select" name="inv_select" class="grid-container">
<?php
					//Query for item selection with Items status 'Ready'
					foreach($conn->query("SELECT a.inv_id, inv_name
											FROM Inventory a, Item b
											WHERE a.inv_id = b.inv_id and
													b.loc_id = 1
                                            GROUP BY inv_name
                                            ORDER BY inv_name") as $row)
					{
?>

					<div class="grid-item" id="<?= $row['inv_id'] ?>">
						<input type="checkbox" id="<?= $row['inv_id'] ?>" name="inventory[]" value="<?= $row['inv_id'] ?>">
						</br>
						<?= $row['inv_name'] ?>
					</div>
<?php
					}
?>
				</div>
			</div>
		</fieldset>
		
		<!-- Modal content. The box that appears when the "Rental" button is clicked -->
		<div id="myModal" class="modal">
			<div class="modal-content">
				<div id='waiting_success_icons' name='waiting_success_icons' style='display: block; text-align:center; margin-left:auto; margin-right:auto; padding:10%;'>
					<img id="waiting_icon" src="../Images/waiting_icon.png" height="100px" width="100px" style="display:block;">
					<img id="success_icon" src="../Images/success_icon.png" height="120px" width="120px" style="display:none;">
				</div>
			</div>
		</div>
		
	    <fieldset style="border:none;">
			<input type="hidden" name="inv_array" id="inv_array"/>
			<input type="hidden" name="empl_id" id="empl_id" value="<?= $_SESSION['empl_id'] ?>"/>
			<input type="button" id="block" name="block" value="Block"/>
			<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
				<input type="submit" name="back" id="back" value="Back" /><br /> 
			</form>
	    </fieldset>
</body>

	<!-- JavaScript Starts here -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
	
	<script type="text/javascript">
		$(document).ready(function()
		{
			$("#inv_array").val("");
			
			//Once the 'Checkin' button been clicked
			$("#block").click(function()
			{
				$("#inv_array").val("");
				//Go through all checked checkbox 
				$('#inv_select').find('input[type="checkbox"]:checked').each(function () 
				{
					//Grab the checkbox value which is the item_Backid
					var box_value = $(this).val();
					
					//Checks if the string is empty or not, if so that means we can just set the string to the item_Backid
					if($("#inv_array").val() == "")
					{
						$("#inv_array").val(box_value);
					}
					//If not empty, then we will just keep adding item_Backid to the string with "," as the separater between each item_Backid
					else
					{
						var get_val = $("#inv_array").val();
						$("#inv_array").val(get_val + "," + box_value);
					}
				});
				
				//Checks if the user had selected any items for pick-up
				if($("#inv_array").val().length == 0)
				{
					//If user did not select any items, they will get a alert and won't be able to move on to the reciept
					alert("No inventory was selected for blockage");
					return false;
				}
				else if($("#name_block").val().length == 0)
				{
					alert("No name for blockage was entered");
					return false;
				}
				else if($("#start_date").val().length == 0)
				{
					alert("No start date was selected for blockage");
					return false;
				}
				else if($("#end_date").val().length == 0)
				{
					alert("No end date was selected for blockage");
					return false;
				}
				else
				{
					//Modal script got from online with little adjustments for this page purpose
					//Grabs the hidden div called 'myModal" and the span tag
					var modal = document.getElementById('myModal');
					var success = document.getElementById('success_icon');
					var waiting = document.getElementById('waiting_icon');
					var error = document.getElementById('error_icon');
					
					modal.style.display = "block";
					success.style.display = "none";
					waiting.style.display = "block";
					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) 
					{
						if (event.target == modal) 
						{
							modal.style.display = "none";
						}
					}
					
					$.ajax(
					{
					 
						url: "../ItemselectionSection/block_helper.php",
						type: "post",
						data:
						{
							'empl_id': $('#empl_id').val(),
							'name_block':$('#name_block').val(),
							'start_date':$('#start_date').val(),
							'inv_array':$('#inv_array').val(),
							'end_date':$('#end_date').val()
						},
						success:function(data)
						{
							success.style.display = "block";
							waiting.style.display = "none";
						},
							error: function(XMLHttpRequest, textStatus, errorThrown)
						{ 
							console.log("something went wrong");
						}       
					});
				}
			});
			
			$("#inv_select").click(function(e) 
			{
				console.log(e.target.id);
				if($("input[type=checkbox][value=" + e.target.id + "]").is(':checked'))
				{
					$("input[type=checkbox][value=" + e.target.id + "]").prop("checked",false);
					$("#" + e.target.id).removeClass("highlight");
				}
				else
				{
					$("input[type=checkbox][value=" + e.target.id + "]").prop("checked",true);
					$("#" + e.target.id).addClass("highlight");
				}
			});
			
			$('#trip_list input[type=radio]').change(function()
			{
				$("#inv_array").val("");
				$.ajax(
				{
					url: "../ItemselectionSection/pre_load_trip_helper.php",
					type: "post",
					data:
					{
						'trip_id': $(this).val()
					},
					success:function(data)
					{
						var json_object = JSON.parse(data); //Grabs the data that is in JSON format and parse it so it is usable
						$('input[type=checkbox]').prop('checked',false);
						
						$("#inv_select>div.highlight").removeClass("highlight");
						
						for(var a = 0; a < json_object.length; a++)
						{
							var obj = json_object[a];
							
							$("input[type=checkbox][value=" + obj['inv_id'] + "]").prop("checked",true);
							
							$("#" + obj['inv_id']).addClass("highlight");
						}
					},
						error: function(XMLHttpRequest, textStatus, errorThrown)
					{ 
						console.log("something went wrong");
					}       
				});
			});
		});
	</script>
	
</html>


<?php
		$conn = null;   //also remember to close the connection to the database
	}
?>