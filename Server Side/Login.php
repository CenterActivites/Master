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
		border-bottom: 6px solid red;
	}
	
	.login:hover
	{
		opacity: 0.9;
		filter: alpha(opacity=75);
	}

</style>



<div class="login">
	<center>
		<img src="http://www2.humboldt.edu/centeractivities/sites/default/themes/bootstrap_centeractivites/images/hLDMlme.png">
	</center>
		
<?php
    // do you need to ask for username and password?

    if ( ! array_key_exists("username", $_POST) )
    {
        // no username in $_POST? they need a login form!
?>
		</br>
		</br>
        <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
        <fieldset style="margin-left:auto; margin-right:auto; width:65%;">
            <legend align="center"> Please enter Oracle username/password: </legend>
			
			<div style="text-align: center;">
				<div style="float:left; width:45%;">
					<img src="../Images/username_icon.jpg" height="15px" width="15px">
					<input type="text" name="username" id="username"
						required="required" />
				</div>

				<div style="float:left; width:45%;">
					<img src="../Images/password_icon.jpg" height="15px" width="15px">
					<input type="password" name="password" id="password"
						required="required" />
				</div>

				<div style="float:right; width:5%;">
					<input style="float:right;" type="submit" id="login" value="Log in" />
				</div>
			</div>
        </fieldset>
        </form>
	</center>
		
<?php
	}
?>
</div>
<?php

}
?>