<?php
	function InfoVendor()
	{
		$ven_name = strip_tags($_POST['ven_name']);
		$ven_id = strip_tags($_POST['ven_id']);
?>
<html>
	<head>

		

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'ven_names',
					name: 'edit_ven_name'
				}).appendTo('#ven_info_form');
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'ven_phone',
					name: 'edit_ven_phone'
				}).appendTo('#ven_info_form');
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'ven_address',
					name: 'edit_ven_address'
				}).appendTo('#ven_info_form');
			});
		</script>

		<script type="text/javascript">
			$(function(){
				$('<input>').attr({
					type: 'hidden',
					id:'ven_id',
					name: 'edit_ven_id'
				}).appendTo('#ven_info_form');
			});
		</script>

		<script type="text/javascript">
				$(function(){
					var ven_id = "<?php echo $ven_id ?>";
					var table = document.getElementById('vendor_info').rows[1].cells.item(1).innerHTML;
					var table2 = document.getElementById('vendor_info').rows[1].cells.item(2).innerHTML;
					var table3 = document.getElementById('vendor_info').rows[1].cells.item(0).innerHTML;
					$("#ven_names").val(table3);
				  $("#ven_phone").val(table);
					$("#ven_address").val(table2);
					$("#ven_id").val(ven_id);
				});
		</script>

	</head>
	<body>
	    <div id="pageHeader"> Vendor Information </div>
				 <form method ="post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" id="ven_table_form">
					 <fieldset>
						 <table name="vendor_info" id="vendor_info" required >
							 <tr>
								 <th>
									 Vendor's Name
								 </th>
								 <th>
									 Vendor's Phone
								 </th>
								 <th>
									 Vendor's Address
								 </th>
							 </tr>
<?php
						 $username = strip_tags($_SESSION['username']);  //We grab the username and password the user input and logs the user in with the inputs
						 $password = strip_tags($_SESSION['password']);
						 $conn = hsu_conn_sess($username, $password);

						 foreach($conn->query("SELECT ven_name, ven_phone, ven_address
												 FROM Vendor
												 WHERE ven_id = '$ven_id'") as $row)
						 {
							 $cur_ven_name = $row["ven_name"];
							 $cur_ven_phone = $row["ven_phone"];
							 $cur_ven_address = $row["ven_address"];
?>
							 <tr>
							  <td> <?=$cur_ven_name?> </td>
							  <td> <?=$cur_ven_phone?> </td>
							  <td> <?=$cur_ven_address?> </td>
						  </tr>
<?php
						 }
?>
						 </table>
					 </fieldset>
				 </form>
		<div>
	    <form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post" id="ven_info_form">
		    <fieldset >
	            <input type="submit" name="back" id="back" value="Back" /><br />
		        	<input type="submit" name="editVen" id="editVen" value="Edit Vendor" /><br />
	            <input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
		    </fieldset>
		  </form>
	  </div>
	</body>
</html>
<?php
			$conn = null;
	}
?>
