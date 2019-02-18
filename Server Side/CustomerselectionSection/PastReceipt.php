<?php
    function PastReceipt()
    {
?>
		<html>
			<head>
				<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
				<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
				
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
				//Connection to the database
				$username = $_SESSION["username"];
				$password = $_SESSION["password"];
				$conn = hsu_conn_sess($username, $password);
				
				$cust_id = (int)$_POST['cust_id'];
				$tran_id = (int)$_POST['time_stamp_select'];
				
				$type_tran = $conn->prepare("SELECT trans_type, time_stamp, rh_id
												FROM Transaction
												WHERE trans_id = :tran_id");
				$type_tran->bindValue(':tran_id', $tran_id, PDO::PARAM_INT);
				$type_tran->execute();
				$tran = $type_tran->fetchAll();
				
				//Formating the date and time we got from the Transaction table into a more readable format for users
				$Past_date_and_time = date("F j, Y g:ia", strtotime($tran[0][1]));
				
				//Grab the ReserveHis id to getting the total price, request_date, due_date 
				$rh_id = $tran[0][2];
				
				//Check whether the receipt needs to be a Rental or Return tranaction
				if($tran[0][0] == "return")
				{
					//Returns tranaction receipt
?>
					<!-- Most of the following code is just "style" purposes for receipt -->
					<div class="container">
						<div class="row">
							<div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<address>
											<!-- Center Activities information display -->
											<strong>Center Activites</strong>
											<br>
												1 Harpst St
											<br>
												Arcata, CA 95521
											<br>
												Phone: (707) 826-3357
										</address>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6 text-right">
										<!-- The current date and time -->
										<p>
											<em>Date: <?= $Past_date_and_time ?></em>
										</p>
										<!-- Tranaction type. Its just going to be either Rental or Return -->
										<p>
											<em>Tranaction Type: Return</em>
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
											<!-- Headers for each columns -->
											<tr>
												<th>Category: </th>
												<th class="text-center">Item: </th>
												<th class="text-center">Model: </th>
												<th class="text-center">Id#: </th>
											</tr>
										</thead>
										<tbody>
<?php
											$item_query = $conn->prepare("SELECT item_Frontid, inv_name, item_modeltype, cat_name
																			FROM Inventory a, Item b, Category c, ItemTran d
																			WHERE a.inv_id = b.inv_id and c.cat_id = a.cat_id and b.item_Backid = d.item_Backid
																			and d.tran_id = :a");
											$item_query->bindValue(':a', $tran_id, PDO::PARAM_INT);
											$item_query->execute();
											$item_display = $item_query->fetchAll();
											for($i = 0; $i < count($item_display); $i++)
											{
												
												//Checks if the item model is NULL or blank. If so then have "No Model" display
												if($item_display[$i]['item_modeltype'] == NULL || $item_display[$i]['item_modeltype'] == '')
												{
													$item_display[$i]['item_modeltype'] = 'No Model';
												}
?>
												<!-- Displaying each item information -->
												<tr>
													<td class="col-md-6"><em> <?= $item_display[$i]['cat_name'] ?> </em></h4></td>
													<td class="col-md-6" style="text-align: center"> <?= $item_display[$i]['inv_name'] ?> </td>
													<td class="col-md-6" style="text-align: center"> <?= $item_display[$i]['item_modeltype'] ?> </td>
													<td class="col-md-4 text-center"> <?= $item_display[$i]['item_Frontid'] ?> </td>
												</tr>
<?php
											}
?>
										</tbody>
									</table>
									<p style="text-align: center">
										Thank you for renting out our gear, Hope to see you again.
									</p>
									<!-- Printing Button -->
									<button type="button" class="btn btn-success btn-lg btn-block" onclick="myFunction()">
										Print Receipt <span class="glyphicon glyphicon-chevron-right"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
<?php
				}
				else
				{
					//Rental tranaction receipt
					
					$reserve_his_infor = $conn->prepare("SELECT request_date, due_date, total_cost
												FROM ReserveHis
												WHERE rh_id = :rh_id");
					$reserve_his_infor->bindValue(':rh_id', $rh_id, PDO::PARAM_INT);
					$reserve_his_infor->execute();
					$reserve_his_infor = $reserve_his_infor->fetchAll();
?>
					<!-- Styling and structure are basically the same as the return tranaction receipt -->
					<div class="container">
						<div class="row">
							<div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<address>
											<strong>Center Activites</strong>
											<br>
												1 Harpst St
											<br>
												Arcata, CA 95521
											<br>
												Phone: (707) 826-3357
										</address>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6 text-right">
										<p>
											<em>Date: <?= $Past_date_and_time ?></em>
										</p>
										<p>
											<em>Tranaction Type: Rental</em>
										</p>
										<p>
											<em>Request Date:<?= $reserve_his_infor[0][0] ?></em>
										</p>
										<p>
											<em>Due Date:<?= $reserve_his_infor[0][1] ?></em>
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
											</tr>
										</thead>
										<tbody>
<?php
											$item_query = $conn->prepare("SELECT item_Frontid, inv_name
																				FROM Inventory a, Item b, ItemTran c
																				WHERE a.inv_id = b.inv_id and b.item_Backid = c.item_Backid
																						and c.tran_id = :tran_id");
											$item_query->bindValue(':tran_id', $tran_id, PDO::PARAM_INT);
											$item_query->execute();
											$item_display = $item_query->fetchAll();
											for($i = 0; $i < count($item_display); $i++)
											{
												
?>
												<tr>
													<td class="col-md-6"><em> <?= $item_display[$i]['inv_name'] ?> </em></h4></td>
													<td class="col-md-1 text-center"> <?= $item_display[$i]['item_Frontid'] ?> </td>
													<td class="col-md-1 text-center"></td>
													<td></td>
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
														<strong>$<?= $reserve_his_infor[0][2] ?></strong>
													</p>
													<p>
														<strong>$0</strong>
													</p>
												</td>
											</tr>
											<tr>
												<td></td>
												<td class="text-right"><h4><strong>Total:</strong></h4></td>
												<td class="text-center text-danger"><h4><strong>$<?= $reserve_his_infor[0][2] ?></strong></h4></td>
											</tr>
										</tbody>
									</table>
									<button type="button" class="btn btn-success btn-lg btn-block" onclick="myFunction()">
										Print Receipt <span class="glyphicon glyphicon-chevron-right"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
<?php
				}
?>

				<form method= "post" action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
					<input type="submit" name="mainmenu" id="mainmenu" value="Main Menu" /><br />
				</form>
			</body>
		</html>
<?php
		//Disconnecting the connection to the database
		$conn = null;
    }
?>