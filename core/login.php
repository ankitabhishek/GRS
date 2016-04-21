<?php

session_start();

//if already LOGGED-IN redirect to HOME
if(isset($_SESSION['user_id']))
{
	header('Location: index.php');
}

//check for ERROR(S)
if(isset($errors) && !empty($errors))
{
	echo '<p id="err_msg">Opps! There was a problem:<br>';
	
	foreach ($errors as $msg)
	{
		echo " - $msg<br>";		
	}
	
	echo 'Please try again or <a href="register.php">REGISTER</a></p>';
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="css/login_style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700|Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->

</head>
 
<body>
	<br>
	<div class="main">
		<div align ="center">
            <img src="images/logo.png" alt="Manipal University Jaipur" height="72px" width="200px">
        </div>
		<div class="user">
			<img src="images/user.png" alt="">
		</div>
		<div class="login">
			<div class="inset">
				<!-----start-main---->
					<form action="login_action.php" method="POST">
				         <div>
							<span><label>Registration No.</label></span>
							<span><input type="text" name="reg_no" class="textbox" id="active"></span>
						 </div>
						 <div>
							<span><label>Password</label></span>
						    <span><input type="password" name="pass" class="password"/></span>
						 </div>
						<div class="sign">
							<div class="submit">
							  <input type="submit" value="LOGIN" >
							</div>
							<span class="forget-pass">
								<a href="register.php">Click Here To Register</a>
							</span>
							</span>
								<div class="clear"> </div>
						</div>
					</form>
				</div>
			</div>
		<!-----//end-main---->
		</div>
		 <!-----start-copyright---->
   					<div class="copy-right">
						<p>Manipal University Jaipur | Grievance Registration System | Prototype: 1.0</p> 
					</div>
					<br>
				<!-----//end-copyright---->
	 
</body>
</html>