<?php
    function PastReceipt()
    {
?>
		<html>
			<head>
				<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
				<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
				
				<!-- CSS trick to get the print to only print the receipt and nothing else -->
				<style>
					@media print {
					  body * {
						visibility: hidden;
					  }
					  #section_to_print, #section_to_print * {
						visibility: visible;
					  }
					   #no_print {
						visibility: hidden;
					  }
					  #section_to_print {
						position: absolute;
						top: 10%;
						width: 100%;
						transform: scale(0.6, 0.6);
						-ms-transform: scale(0.6, 0.6); /* IE 9 */
						-webkit-transform: scale(0.6, 0.6); /* Safari and Chrome */
						-o-transform: scale(0.6, 0.6); /* Opera */
						-moz-transform: scale(0.6, 0.6); /* Firefox */
					  }
					}
					
					.background
					{
						visibility: hidden;
					}
				</style>
				
				<!-- Printing script for the print receipt button -->
				<script type="text/javascript">
					function myFunction() 
					{
						window.print();
						
					}
				</script>
			
			</head>
			
			<body>
<?php
				//Connecting to the Database
				$conn = db();
				
				//Grab the customer and transaction id
				$cust_id = (int)$_POST['cust_id'];
				$rent_id = (int)$_POST['time_stamp_select'];
				
				//-------
				//Rental tranaction receipt
				
				$reserve_his_infor = $conn->prepare("SELECT request_date, due_date, total_cost, sub_total_cost, loc_id, deposit
											FROM Rental
											WHERE rent_id = :a");
				$reserve_his_infor->bindValue(':a', $rent_id, PDO::PARAM_INT);
				$reserve_his_infor->execute();
				$reserve_his_infor = $reserve_his_infor->fetchAll();
				
				$loc_info = $conn->prepare("select loc_name, loc_address, loc_city, loc_state, loc_zip, loc_phone_num
												from Location
												where loc_id = :a");
				$loc_info->bindValue(':a', $reserve_his_infor[0][4], PDO::PARAM_INT);
				$loc_info->execute();
				$loc_info = $loc_info->fetchAll();
				
				//Formating the date and time we got from the Transaction table into a more readable format for users
				$his_request_date = date("F j, Y", strtotime($reserve_his_infor[0][0]));
				$his_due_date = date("F j, Y", strtotime($reserve_his_infor[0][1]));
?>
				<!-- Styling and structure are basically the same as the return tranaction receipt -->
				<div class="container" id="section_to_print">
					<div class="row">
						<div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<address>
										<strong><?= $loc_info[0]['loc_name'] ?></strong>
										<br>
											<?= $loc_info[0]['loc_address'] ?>
										<br>
											<?= $loc_info[0]['loc_city'] ?>, <?= $loc_info[0]['loc_state'] ?> <?= $loc_info[0]['loc_zip'] ?>
										<br>
											Phone: <?= $loc_info[0]['loc_phone_num'] ?>
									</address>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6 text-right">
									<p>
										<em>Date: <?= $his_request_date ?></em>
									</p>
									<p>
										<em>Tranaction Type: Rental</em>
									</p>
									<p>
										<em>Request Date:&nbsp;<?= $his_request_date ?></em>
									</p>
									<p>
										<em>Due Date:&nbsp;<?= $his_due_date ?></em>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="text-center">
									<h1>Receipt</h1>
								</div>
								</span>
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Item: </th>
											<th class="text-center">Id#: </th>
											<th class="text-center">Price</th>
											<th class="text-center">Deposit</th>
										</tr>
									</thead>
									<tbody>
<?php
										$item_query = $conn->prepare("SELECT item_Frontid, inv_name, cost_at_time, deposit_at_time
																			FROM Inventory a, Item b, Reserve1 c
																			WHERE a.inv_id = b.inv_id and b.item_Backid = c.item_Backid
																					and c.rent_id = :a");
										$item_query->bindValue(':a', $rent_id, PDO::PARAM_INT);
										$item_query->execute();
										$item_display = $item_query->fetchAll();
										for($i = 0; $i < count($item_display); $i++)
										{	
?>
											<tr>
												<td class="col-md-6"><em> <?= $item_display[$i]['inv_name'] ?> </em></h4></td>
												<td class="col-md-1 text-center"> <?= $item_display[$i]['item_Frontid'] ?> </td>
												<td class="col-md-1 text-center"> <?= $item_display[$i]['cost_at_time'] ?> </td>
												<td class="col-md-1 text-center"> <?= $item_display[$i]['deposit_at_time'] ?> </td>
											</tr>
<?php
										}
?>
										<tr>
											<td></td>
											<td class="text-right">
												<p>
													<strong>Subtotal:</strong>
												</p>
												<p>
													<strong>Tax:</strong>
												</p>
											</td>
											<td class="text-center">
												<p>
													<strong>$<?= $reserve_his_infor[0][3] ?></strong>
												</p>
												<p>
													<strong>$<?= $reserve_his_infor[0][2] - $reserve_his_infor[0][3] ?></strong>
												</p>
											</td>
										</tr>
										<tr>
											<td></td>
											<td class="text-right"><h4><strong>Total:</strong></h4></td>
											<td class="text-center text-danger"><h4><strong>$<?= $reserve_his_infor[0][2] ?></strong></h4></td>
											
											<td class="text-center">
												<p>
													<h4>
														<strong class="text-center text-danger">$<?= $reserve_his_infor[0][5] ?></strong>
													</h4>
												</p>
											</td>
										</tr>
									</tbody>
								</table>
								<button type="button" class="btn btn-success btn-lg btn-block" id="no_print" onclick="myFunction()">
									Print Receipt <span id="no_print" class="glyphicon glyphicon-chevron-right"></span>
								</button>
							</div>
						</div>
					</div>
				</div>

			<form method= "post" action ="../CustomerselectionSection/email_receipt.php">
				<button>
					Email
				</button>
			</form>
			
			</body>
		</html>
<?php
		//Disconnecting the connection to the database
		$conn = null;
    }
?>