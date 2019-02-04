<!DOCTYPE>
<?php

     function MainMenu()
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
						filter: alpha(opacity=100); /* For IE8 and earlier */
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
					}

					.navbar input:hover
					{
						background: #008000;
						color: black;
					}

					.main
					{
						padding: 16px;
						margin-top: 30px;
						height: 1500px;
					}
				</style>
			</head>

			<body>

				<form action ="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>" method= "post">
					<div class="navbar">
						<input type="submit" name="HomePage" id="HomePage" value="Home Page" />
						<input type="submit" name="Cust" id="Cust" value="Customer" />
						<input type="submit" name="ViewInv" id="ViewInv" value="View/Edit Inventory" />
						<input type="submit" name="ViewVen" id="ViewVen" value="View/Edit Vendors" />
						<input type="submit" name="ReturnI" id="ReturnI" value="Item Return" />
						<input type="submit" name="LogOut" id="log_out" value="Log Out" />
					</div>
	            </form>
				
				</br>
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
