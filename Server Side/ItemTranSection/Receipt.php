<?php
    function Receipt()
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
						left: 150;
						top: 75;
						width: 60%
					  }
					}

					.background
					{
						visibility: hidden;
					}
				</style>
				
				<!-- Printing script for the print receipt button -->
				<script type="text/javascript">
					function printfunction() 
					{
						window.print();
					}
				</script>
			
			</head>
			
			<body>
<?php
				//Connecting to the Database
				$conn = hsu_conn_sess();
			
				//Formating current, request, and due dates into more readable format for user. More readable format: EX. January 18, 2019 11:21am. 
				//Current date is the only one with time in it.
				$curr_date_and_time = date("F j, Y  g:ia");
				
				//Check whether the receipt needs to be a Rental or Return tranaction
				if(isset($_POST["Checkin"]))
				{
					//Returns tranaction receipt
					
					//Grabs the array of selected items that were returned 
					$items_to_return = $_SESSION["item_array"];

?>
					<!-- Most of the following code is just "style" purposes for receipt -->
					<div class="container" id="section_to_print">
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
											<em>Date: <?= $curr_date_and_time ?></em>
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
											//Grabbing the rest of the items information from just using the item's back id
											foreach($items_to_return as $item)
											{
												$item_query = $conn->prepare("SELECT item_Frontid, inv_name, item_modeltype, cat_name
																				FROM Inventory a, Item b, Category c
																				WHERE a.inv_id = b.inv_id and c.cat_id = a.cat_id 
																				and b.item_Backid = :a");
												$item_query->bindValue(':a', $item, PDO::PARAM_INT);
												$item_query->execute();
												$item_display = $item_query->fetchAll();
												//Checks if the item model is NULL or blank. If so then have "No Model" display
												if($item_display[0]['item_modeltype'] == NULL || $item_display[0]['item_modeltype'] == '')
												{
													$item_display[0]['item_modeltype'] = 'No Model';
												}
?>
												<!-- Displaying each item information -->
												<tr>
													<td class="col-md-6"><em> <?= $item_display[0]['cat_name'] ?> </em></h4></td>
													<td class="col-md-6" style="text-align: center"> <?= $item_display[0]['inv_name'] ?> </td>
													<td class="col-md-6" style="text-align: center"> <?= $item_display[0]['item_modeltype'] ?> </td>
													<td class="col-md-4 text-center"> <?= $item_display[0]['item_Frontid'] ?> </td>
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
									<button type="button" id="no_print" class="btn btn-success btn-lg btn-block" onclick="printfunction()">
										Print Receipt <span id="no_print" class="glyphicon glyphicon-chevron-right"></span>
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
					
					//Formating both the request and due dates to be more readable for users
					$request_date = date("F j, Y", strtotime($_SESSION['request_date']));
					$due_date = date("F j, Y", strtotime($_SESSION['due_date']));
					
					//Grabbing the array of items that are being rented out along with the total calculated price and each item price
					$total_price = $_SESSION['sub_total_price'];
					$on_site_check = $_SESSION['on_site'];
					$tax_amount = $_POST['tax_amount'];
					$total_price_with_tax = $_SESSION['total_price_with_tax'];
					$loc_id = $_SESSION['loc'];
					if($on_site_check == NULL)
					{
						
						//$array_of_items = $_SESSION['array_of_items'];
						$receipt_prices = $_SESSION['receipt_prices'];
						$receipt = "";
					}
					else
					{
						$pack_name = $_SESSION['pack_name'];
						$receipt = "(On-Site Rental)";
					}
					
					$loc_info = $conn->prepare("select loc_name, loc_address, loc_city, loc_state, loc_zip, loc_phone_num
												from Location
												where loc_id = :loc_id");
					$loc_info->bindValue(':loc_id', $loc_id, PDO::PARAM_INT);
					$loc_info->execute();
					$loc_info = $loc_info->fetchAll();

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
											<em>Date: <?= $curr_date_and_time ?></em>
										</p>
										<p>
											<em>Tranaction Type: Rental</em>
										</p>
										<p>
											<em>Request Date:<?= $request_date ?></em>
										</p>
										<p>
											<em>Due Date:<?= $due_date ?></em>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="text-center">
										<h1>Receipt <?= $receipt ?></h1>
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
											if($on_site_check == NULL)
											{
												foreach($receipt_prices as $item)
												{
													if (strpos($item['name'], '(') !== false) 
													{
?>
														<tr>
															<td class="col-md-6"><em> <?= $item['name'] ?> </em></h4></td>
															<td class="col-md-1 text-center"> <?= $item['id'] ?> </td>
															<td class="col-md-1 text-center"> $0 </td>
															<td></td>
														</tr>
<?php
													}
													else
													{
?>
														<tr>
															<td class="col-md-6"><em> <?= $item['name'] ?> </em></h4></td>
															<td class="col-md-1 text-center"> <?= $item['id'] ?> </td>
															<td class="col-md-1 text-center"> $<?= $item['price'] ?> </td>
															<td></td>
														</tr>
<?php
													}
												}
											}
											else
											{
?>
												<tr>
													<td class="col-md-6"><em> <?= $pack_name ?> </em></h4></td>
													<td class="col-md-1 text-center"> </td>
													<td class="col-md-1 text-center"> $<?= $total_price_with_tax ?> </td>
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
														<strong>$<?= $total_price ?></strong>
													</p>
													<p>
														<strong>$<?= $tax_amount ?></strong>
													</p>
												</td>
											</tr>
											<tr>
												<td></td>
												<td class="text-right"><h4><strong>Total:</strong></h4></td>
												<td class="text-center text-danger"><h4><strong>$<?= $total_price_with_tax ?></strong></h4></td>
											</tr>
										</tbody>
									</table>
									<button type="button" id="no_print" class="btn btn-success btn-lg btn-block" onclick="printfunction()">
										Print Receipt <span id="no_print" class="glyphicon glyphicon-chevron-right"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
<?php
				}
		//Disconnecting the connection to the database
		$conn = null;
    }
?>