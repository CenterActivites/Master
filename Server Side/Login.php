<!DOCTYPE html>

<?php
function Login()
{
?>

<style>

	.login
	{
		overflow: hidden;
		background-color: #228b22;
		width: 80%;
		opacity: 0.5;
		filter: alpha(opacity=25);
		position: absolute;
		top:0;
		bottom: 0;
		left: 0;
		right: 0;
		margin: auto;
		height: 50%;
		border: 6px solid gold;
		border-radius: 40px;
	}
	
	.login:hover
	{
		opacity: 0.95;
		filter: alpha(opacity=75);
	}
	
	#inner_box
	{
		margin-left:auto; 
		margin-right:auto; 
		width:65%; 
		border-top: 1px solid gold; 
		border-bottom: 1px solid gold;
		border-left: 1px solid #228b22; 
		border-right: 1px solid #228b22;
		border-radius: 8px;
	}
	
	#login 
	{
		background-color: white;
		padding-top: 7px;
		padding-bottom: 7px;
		padding-left:17px;
		padding-right:17px;
		white-space: normal;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		font-size: 25px;
		font-family: "Times New Roman", Times, serif;
		position: relative;
		text-align: center;
		color: black;
		box-sizing:content-box;
		word-wrap: break-word;
		white-space: normal;
		margin-left:auto;
		margin-right:auto;
	}
	
	#login:hover
	{
		background-color: grey;
		color: white;
	}
	
	#centeractivities_logo
	{
		background-color: #228b22;
		width:40%
		margin-left:auto;
		margin-right:auto;
	}

</style>

<div class="login" style="text-align: center;">
	</br>
	</br>
	</br>
	<div id="centeractivities_logo">
		<center>
			<img src="https://centeractivities.humboldt.edu/Content/Images/humboldtstate-logo-rec.png">
		</center>
	</div>
	
	</br>
	</br>
    <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
		<fieldset id="inner_box">
			<div style="text-align: center; color: black; font-size: 25px;">
				<div style="float:left; width:45%; margin-left:5%;">
					Username: 
					<img src="../Images/username_icon.jpg" height="20px" width="20px">
					<input type="text" name="username" id="username" required="required"/>
				</div>
					<div style="float:left; width:45%;">
					Password:
					<img src="../Images/password_icon.jpg" height="20px" width="20px">
					<input type="password" name="password" id="password" required="required" />
				</div>
				
				</br>
				</br>
				
				<div style="margin-left:auto; margin-right:auto; width:100%;">
					<input type="submit" id="login" value="Login" />
				</div>
			</div>
		</fieldset>
	</form>
</div>
<?php

}
?>