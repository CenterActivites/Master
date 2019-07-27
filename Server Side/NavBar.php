<!DOCTYPE>
<?php
    function NavBar()
    {
?>
	     <html>
			<head>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<style>
					body {margin:0;}

					.navbar
					{
						overflow: hidden;
						background-color: #333;
						position: fixed;
						top: 0;
						width: 100%;
						opacity: 0.6;
						filter: alpha(opacity=80);
					}
					
					.navbar:hover 
					{
						opacity: 0.9;
						filter: alpha(opacity=100);
					}

					.navbar input
					{
						float: left;
						display: block;
						color: #f2f2f2;
						text-align: center;
						padding: 14px 16px;
						text-decoration: none;
						font-size: 13px;
						background: #333;
						border:none;
					}

					.navbar input:hover
					{
						background: #008000;
						color: black;
					}
					
				</style>
				
				<style type="text/css" media="print">
				   .no-print { display: none; }
				</style>
			</head>
			<body>

<?php
				$empl_user = $_SESSION['empl_user'];
				$empl_pass = $_SESSION['empl_pass'];
			
				$conn = db();
				
				$login_lvl = $conn->prepare("SELECT access_lvl
												FROM Employee
												WHERE user_n = :user and pass_w = :pass");
				$login_lvl->bindValue(':user', $empl_user, PDO::PARAM_STR);
				$login_lvl->bindValue(':pass', $empl_pass, PDO::PARAM_STR);
				$login_lvl->execute();
				$display_array = $login_lvl->fetchAll();
				
				$_SESSION['lvl_access'] = $display_array[0][0];
				if($display_array[0][0] == "4")
				{
					$lvl_4 = "type = 'submit'";
					$disabled_4 = "";
				}
				else
				{
					$lvl_4 = "type = 'hidden'";
					$disabled_4 = "disabled";
				}
?>
				<div class="no_print">
					<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
						<div class="navbar">
							<input type="submit" name="HomePage" id="HomePage" value="Home Page" />
							<input type="submit" name="Cust" id="Cust" value="Customer" />
							<input type="submit" name="ViewInv" id="ViewInv" value="View/Edit Inventory" />
							<input type="submit" name="ViewVen" id="ViewVen" value="View/Edit Vendors" />
							<input type="submit" name="ReturnI" id="ReturnI" value="Rental Return" />
							<input type="submit" name="Report" id="Report" value="Report" />
							<input <?= $lvl_4 ?>  name="Empl" id="Empl" value="Employees" <?= $disabled_4 ?> />
							<input type="submit" name="LogOut" id="log_out" value="Log Out" />
						</div>
					</form>
				</div>
				
				</br>
				</br>
				</br>
				</br>
				</br>
				</br>
				</br>

            </body>
        </html>
<?php
    }
?>
