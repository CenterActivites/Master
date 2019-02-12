<?php
	function Itemselection()
	{
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$conn = hsu_conn_sess($username, $password);
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../ItemselectionSection/item_css/item_selection.css"/>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
	<script type="text/javascript" src="jquery.quicksearch.js"></script>  <!-- Plugin for the item Search function -->
	<script type="text/javascript">
		$(function ()
		{
			$('input#searchItem').quicksearch('#table_info tbody tr'); //On key search for customer names here
		});
	</script>

	<script type="text/javascript">
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'item_id',
				name: 'item_id'
			}).appendTo('#button');
		});
	</script>
	
	<!-- <script type="text/javascript">
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'dbw_value',
				name: 'dbw_value',
				value: "no"
			}).appendTo('#button');
		});
	</script>
	
	<script type="text/javascript">
		$(function(){
			$('<input>').attr({
				type: 'hidden',
				id:'public_value',
				name: 'public_value',
				value: 'no'
			}).appendTo('#button');
		});
	</script> -->

	<script type="text/javascript">
		function is_blank(){
			if(document.getElementById('item_id').value.length == 0){
				alert("please select an item");
				return false;
		 }
		}
	</script>

	<script type="text/javascript">

		$(document).ready(function(){
			$("#item").click(function(){
				var item_num = $("#item").val();
				$("#item_id").val(item_num);
			});
		});

	</script>

	<script type="text/javascript">
	// count items that are ready in database
	$(document).ready(function(){
		var stuff = $("#item option").length;
		//console.log(stuff);
	});

	</script>

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

								 var tr = document.createElement('tr');

								 tr.innerHTML = "<td id='hide_me'>" + "<input id ='radio_in' type='radio' name='item_id[]' value = '"+item_Backid+"'/>" +"</td>" + "<td>" + item_Frontid + "</td>"  + "<td>" + item_size + "</td>"
																 +"<td>"+item_modeltype+"</td>" + "<td>"+inv_name+"</td>" + "<td>"+pub_use+"</td>" + "<td>"+stat_info+"</td>";

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

</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
  <div id="main_div">
   <div id="form_div">
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="inv">
			<fieldset id="form_feildset">
				<legend style="font-size: 35px; text-align:center;"> Select An Item </legend>
				<fieldset id=fieldset_lable>
					<label id=header_for_table>Item Selection</label>
				</fieldset>
			</br>
				<div id="table_div" >

					<table id="table_info" class = "fixed" >
					<thead>
						<tr>
							<th id = "hide_me"> </th>
							<th id ="th_front">Front Id</th>
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
							<td id='status_stuff'><?=$curr_stat_info?></td>
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
				<label id="search_lable">Search:</label> <input type = "text" name = "searchItem" id = "searchItem" placeholder="Search for Items..." /> </br>
				</br>

				<label id="search_lable">Sort By:</label>
				<select id='change'>
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
				</br>
				DBW: <select id="dbw"> 
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
				Public: <select id="public">
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
				Location: <select id="location">
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

		 	</fieldset>
		</form>
		<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="button">
				<fieldset id="button_feildset">
				<input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /> &nbsp;&nbsp;
				<input type="submit" name="moreinfo" id="moreinfo" value="Item Info" onclick="return is_blank()" /> &nbsp;&nbsp;
				<input type="submit" name="additem" id="additem" value="Add Item" /> &nbsp;&nbsp;
				<input type="submit" name="addinventory" id="addinventory" value="Add Inventory" /><br /> &nbsp;&nbsp;
				</fieldset>
		</form>
		
		<form action="../ItemselectionSection/sampleExcel.php">
			<input type="submit" value="Download Excel" />
		</form>
		
    </div>
	</div>

</body>
</html>


<?php
$conn=null;
	}
?>
