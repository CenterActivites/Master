<?php
	function Itemselection()
	{
		//Connecting to the Database
		$conn = hsu_conn_sess();
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/item_selection.css"/>
	

<?php
	//Access level view check. Only users who have level 3 and 4 can add new Inventory includes new prices.
	//Level 2 and up can only add new items
	$lvl_access = strip_tags($_SESSION['lvl_access']);
	if($lvl_access == "4" || $lvl_access == "3")
	{
		$lvl_3 = "type = 'submit'";
		$disabled_3="";
	}
	else
	{
		$lvl_3 = "type = 'hidden'";
		$disabled_3="disabled";
	}
	
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
  <div id="main_div">
   <div id="form_div">
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="inv">
			<fieldset id="form_feildset">
				<legend style="font-size: 35px; text-align:center;"> Select An Item </legend>
				<fieldset id='fieldset_label'>
					<label id='header_for_table'>Item Selection</label>
				</fieldset>
			</br>
				<div id="table_div" >

					<table id="table_info" class = "fixed" >
						<thead>
							<tr>
								<th id = "hide_me"> </th>
								<th id ="th_front">Item Id</th>
								<th>Item Size</th>
								<th>Model</th>
								<th>Item Name</th>
								<th>Public Use</th>
								<th>Status</th>
								<th>Usage</th>
							</tr>
						</thead>
						<tbody id='empty'>
<?php
							$list_of_status = $conn->prepare("SELECT stat_id, stat_name
																	FROM Status");
							$list_of_status->execute();
							$list_of_status = $list_of_status->fetchAll();

							//query for item information
							foreach($conn->query("SELECT item_Backid, item_size, item_modeltype, inv_name, cat_name, item_Frontid, public, D.stat_name
													FROM Item A, Inventory B, Category C, Status D
													WHERE A.inv_id = B.inv_id and B.cat_id = C.cat_id and A.stat_id = D.stat_id
													ORDER BY inv_name, item_modeltype") as $row)
							{
								$curr_item_backid = $row["item_Backid"];
								$curr_item_size = $row["item_size"];
								$curr_inv_name = $row["inv_name"];
								$curr_item_name = $row["item_modeltype"];
								$curr_item_frontid = $row["item_Frontid"];
								$curr_pub_use = $row["public"];
								$curr_stat_info = $row["stat_name"];

								$item_backid = (int)$curr_item_backid;
								
								$number_of_use = $conn->prepare("select count(itemtran_id)
																	from Item A, Transaction B, ItemTran C
																	where A.item_Backid = C.item_Backid and B.trans_id = C.tran_id and B.trans_type = 'return' and C.item_Backid = :a");
								$number_of_use->bindValue(':a', $item_backid, PDO::PARAM_INT);
								$number_of_use->execute();
								$number_of_use = $number_of_use->fetchAll();
								
								$curr_number_of_use = $number_of_use[0][0];
								
								if($curr_pub_use == "1"){
									$curr_pub_use = "Yes";
								}
								else{
									$curr_pub_use = "No";
								}
								
								if($curr_item_size == NULL)
								{
									$curr_item_size = "";
								}
?>
								<tr id='table_row_info'>
									<td id = "hide_me"><input id ="radio_in" type="radio"  name="item_id[]" value = "<?= $curr_item_backid ?>"/><lable class="zombie" for="radio_in"> </lable></td>
									<td id = 'td_front'><?= $curr_item_frontid?></td>
									<td><?= $curr_item_size ?></td>
									<td><?= $curr_item_name ?></td>
									<td><?= $curr_inv_name ?></td>
									<td><?=$curr_pub_use?></td>
									<td id='status_stuff'>
										<div class="select_table_status">
											<select id="table_status" name="table_status" style="background-color: transparent;">
<?php
												foreach($list_of_status as $row)
												{
													$cur_stat_name = $row["stat_name"];
													$cur_stat_id = $row["stat_id"];
													$option_info = "value = " . $cur_stat_id;
													if($cur_stat_name == $curr_stat_info)
													{
														$option_info = $option_info . " selected='selected' ";
													}
?>
													<option <?= $option_info ?> > <?=$cur_stat_name?> </option>
<?php
											}	
?>
											</select>
										</div>
									</td>
									<td><?=$curr_number_of_use?></td>
								</tr>
<?php
							}
?>
						</tbody>
					</table>
				</div>
			</fieldset>
			<fieldset id="search_fieldset">
		</form>
				</br>
				</br>
				<label id="search_lable">Search: </label> 
				<input type = "text" name = "searchItem" id = "searchItem" placeholder="Item Id, Size, Model, Name, Status" /> </br>
				</br>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="inv">
				<label id="search_lable">Sort By: </label>
				</br>
				</br>
				
				<link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/select_style.css"/>
				
				<table id="search_table">
					<!-- Searchable functionals for a more narrower search in a table for styling purposes -->
					
					<tr>
						<th>Status</th>
						<th>DBW</th> 
						<th>Public</th>
						<th>Location</th>
					</tr>
					<tr>
						<!-- A status select where users can select a certain status of the items they just want to see -->
						<td>
							<div class="select_status">
								<select id='change'  name='change'>
									<option value=0 selected="selected"> None </option>
<?php
									//Query for status name
									foreach($conn->query("SELECT * FROM Status") as $row)
									{
										$curr_stat_name = $row['stat_name'];
										$curr_stat_id = $row['stat_id'];
?>
										<option value="<?= $curr_stat_id ?>">		<!-- Pushing the fetch information to the screen -->
											<?= $curr_stat_name ?>
										</option>
<?php
									}
?>
								</select>
							</div>
						</td>

						<!-- A DBW search where users can see either only DBW items, non-DBW items, or both DBW and non-DBW items -->
						<td>
							<div class="select">
								<select id="dbw" name="dbw"> 
									<option value="none" selected="selected">
										Include both
									</option>
									<option value="yes">
										Is DBW
									</option>
									<option value="no">
										Non DBW
									</option>
								</select>
							</div>
						</td>

						<!-- A public search where users can see either only items rentable to the public, non-public-rentable items, or both public-rentable and non-public-rentable items -->
						<td>
							<div class="select">
								<select id="public" name="public">
									<option value="none" selected="selected">
										Include both
									</option>
									<option value="yes">
										Is Public
									</option>
									<option value="no">
										Not Public
									</option>
								</select>
							</div>
						</td>

						<!-- A simple location search select where user can see items according to one location to another, or all locations -->
						<td>
							<div class="select">
								<select id="location" name="location">
									<option value="none" selected="selected">
										Both
									</option>
									<option value="ca">
										Center Activites
									</option>
									<option value="hbac">
										Humboldt Bay Aquatic Center
									</option>
								</select>
							</div>
						</td>
					</tr>
				</table>

		 	</fieldset>
		</form>
		
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="button">
			<!-- Following are just buttons -->
			<fieldset id="button_feildset">
				<input type="submit" name="moreinfo" id="moreinfo" value="Item Info" onclick="return is_blank()" /> &nbsp;&nbsp;
				<input <?= $lvl_2 ?> name="additem" id="additem" value="Add Item" <?= $disabled_2 ?>/> &nbsp;&nbsp;
				<input <?= $lvl_3 ?> name="addinventory" id="addinventory" value="Add Inventory" <?= $disabled_3 ?>/> &nbsp;&nbsp;
		</form>
		
		<!-- Button for downloading a excel sheet of the current item list in the table -->
		<form method= "post" action="../ItemselectionSection/ExcelPrint.php">
				<input type="hidden" id="status_hidden" name="status_hidden" value="0"/>
				<input type="hidden" id="dbw_hidden" name="dbw_hidden" value="none"/>
				<input type="hidden" id="public_hidden" name="public_hidden" value="none"/>
				<input type="submit" id="excel_download" id="excel_download" value="Download Excel" />
			</fieldset>
		</form>
		
    </div>
	</div>

</body>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
	<script type="text/javascript" src="jquery.quicksearch.js"></script>  
	
	<!-- Plugin for the item Search function -->
	<script type="text/javascript">
		$(function ()
		{
			$('input#searchItem').quicksearch('#table_info tbody tr'); //On key search for customer names here
		});
	</script>

	<!-- Hidden item id button. Used for keeping track of the selected item id -->
	<script type="text/javascript">
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'item_id',
				name: 'item_id'
			}).appendTo('#button');
		});
	</script>

	<!-- Little script for if the user didn't select an item, they get the "please select an item" alert -->
	<script type="text/javascript">
		function is_blank(){
			if(document.getElementById('item_id').value.length == 0){
				alert("please select an item");
				return false;
		 }
		}
	</script>

	<!-- Little script that save the item id to the hidden button we created a few lines up  -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#table_div").click(function(){
				$('input[type="radio"]:checked').each(function(){
					var box_value = $(this).val();
					$('#item_id').val(box_value);
				});
			});
		});
	</script>

	<!-- Hover function for the selects -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#change, #dbw, #location, #public").hover(function(){
				$(this).attr('size', 
			  $('option').length);
			}, function() {
				$(this).attr('size', 1);
			});
		});
	</script>
	
	<!-- Little script to disable the 'enter' button from submitting the form -->
	<script type="text/javascript">
		$(document).ready(function() {
		  $(window).keydown(function(event){
			if(event.keyCode == 13) {
			  event.preventDefault();
			  return false;
			}
		  });
		});
	</script>

	<script type="text/javascript">
	//this script goes off when a table row is clicked it checks the radio button
		$(document).ready(function(){
			$("#table_info tbody tr").click(function(){
					$(this).find('td input:radio').prop('checked',true);
				});
			});
	</script>
	
	<script type = "text/javascript">
		// this script calls a CSS class named .highlight in the CSS file
		// So that when a click happens It hightlights the row letting the user know that they've selected it.
		$(document).ready(function(){
			$("#table_info tbody tr").click(function(){
				$("#table_info tbody tr").removeClass("highlight");
				$(this).addClass("highlight");
			});
		});
	</script>
	
	<!-- Little script that save the Public Value to a hidden input field -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#public').change(function()
			{
				var box_value = $(this).val();
				$('#public_hidden').val(box_value);
				console.log("Public Hidden value changed to :" + box_value);
			});
		});
	</script>
	
	<!-- Little script that save the DBW Value to a hidden input field -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#dbw').change(function()
			{
				var box_value = $(this).val();
				$('#dbw_hidden').val(box_value);
				console.log("DBW Hidden value changed to :" + box_value);
			});
		});
	</script>
	
	<!-- Little script that save the Status Value to a hidden input field -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#change').change(function()
			{
				var box_value = $(this).val();
				$('#status_hidden').val(box_value);
				console.log("Status Hidden value changed to :" + box_value);
			});
		});
	</script>
	
	<script type="text/javascript">
	 //AJAX is asynchronous javascript
	 //https://www.w3schools.com/xml/ajax_intro.asp
		 $(function(){
			 $('#change, #dbw, #public').change(function(){
				 $.ajax({
					 // this section of the script
					 //1. finds where the helper file is located
					 url: "../ItemselectionSection/helper.php", //The file where the php select query is at
					 // 2. defines the type of call we're using to contact the server
					 type: "post",
					 // 3. gets the data from the the section of the web page we want
					 data:{
						'stat_id':$('#change').val(),
						'dbw':$('#dbw').val(),
						'public':$('#public').val()
					 },
					 //4. sends the data gathered to this success function after it has quereied
					 success:function(data){
						 console.log("Item data: " + data);//displaying current data gathered from query to see if data was processed.
						 var json_object = JSON.parse(data);

						 $('#empty').empty();
						 
						 var tbody = document.getElementById('empty'); //Grabs the "tbody" select tag
						 //we loop through the entirety of the json object array
						 for(var i = 0; i < json_object.length; i++){
								 var info = json_object[i];
								 item_Backid = info['item_Backid'];
								 item_size = info['item_size'];
								 item_Frontid = info['item_Frontid'];
								 inv_name = info['inv_name'];
								 item_modeltype = info['item_modeltype'];
								 pub_use = info['public'];
								 stat_info = info['stat_name'];
								 usage = info['usage'];

								 if(pub_use == 1){
									pub_use = "Yes";
								 }
								 else{
									pub_use = "No";
								 }

								 if(item_modeltype == null || item_modeltype == " ")
								 {
									item_modeltype = " ";
								 }
								 
								 if(item_size == null)
								 {
									item_size = "";
								 }

								 //Also grab status list
								 var status_list = <?php echo json_encode($list_of_status); ?>;
								
								 option = "";
								 
								 for(var j = 0; j < status_list.length; j++){
									 var row = status_list[j];
									 stat_name = row['stat_name'];
									 stat_id = row['stat_id'];
									 value = "value='" + stat_id + "'";
									 if(stat_name == stat_info)
									 {
										 value = value + " selected='selected'";
									 }
									 option = option + "<option " + value + " >" + stat_name + "</option> "
								 }
								
								 var tr = document.createElement('tr');

								 tr.innerHTML = "<td id='hide_me'>" + "<input id ='radio_in' type='radio' name='item_id[]' value = '" + item_Backid + "'/>" +"</td>" + 
												"<td>" + item_Frontid + "</td>"  + 
												"<td>" + item_size + "</td>" + 
												"<td>" + item_modeltype + "</td>" + 
												"<td>" + inv_name + "</td>" + 
												"<td>" + pub_use + "</td>" + 
												
												"<td>" + 
													"<div class='select_table_status'>" + 
														"<select id='table_status' name='table_status' style='background-color: transparent;'>" + 
															option + 
														"</select>" + 
													"</div>" + 
												"</td>" + 
												
												"<td>" + usage + "</td>";

								 tbody.appendChild(tr);
						 }

						 //this script goes off when a table row is clicked it checks the radio button
						 $(document).ready(function(){
							 $("#table_info tbody tr").click(function(){
									 $(this).find('td input:radio').prop('checked',true);
								 });
							 });

							 // this script calls a CSS class named .highlight in the CSS file
							 // So that when a click happens It hightlights the row letting the user know that they've selected it.
							 $(document).ready(function(){
								 $("#table_info tbody tr").click(function(){
									 $("#table_info tbody tr").removeClass("highlight");
									 $(this).addClass("highlight");
								 });
							 });

							 //this resets the search functioallity after the table is refilled
						 $('input#searchItem').quicksearch('#table_info tbody tr'); //On key search for customer names here
					 }
				 });
			 });
		 });
	</script>
	
	<script type="text/javascript">
		//Ajax call that does the update for the status updates on the item selection table. The status dropdown on the item select table.  
		 $(function(){
			 $('#table_div').on('change', 'select', function() {
				 $.ajax({
					 
					 url: "../ItemselectionSection/status_update_helper.php",
					 type: "post",
					 data:{
						'status_id': $(this).val(),
						'item_id':$('#item_id').val()
					 },
					 success:function(data){
						 console.log("Status Update");
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						 console.log("Something went wrong");
					 }       
				 });
			 });
		 });
	</script>

</html>


<?php
$conn=null;
	}
?>
