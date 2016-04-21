<?php

session_start();

//if user is LOGGED-IN redirect to HOME
if(isset($_SESSION['user_id']))
{
	header('Location: index.php');
}


//PAGE TITLE
$page_title = 'Register';

//PAGE HEADER
include ('includes/header.html');
include('includes/content.html');

if($_SERVER['REQUEST_METHOD']=='POST')
{
	require ('includes/php/connect_db.php');
	$errors = array();
	
	//check whether REGISTRATION NO. is EMPTY
	if(empty($_POST['reg_no']))
	{
		$errors[] = 'Enter your registration no.';
	}else{
		$reg_no = mysqli_real_escape_string($dbc, trim($_POST['reg_no']));
	}
	
	//check whether FIRST NAME is EMPTY
	if(empty($_POST['first_name']))
	{
		$errors[] = 'Enter your first name.';
	}else{
		$first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	//check whether LAST NAME is EMPTY
	if(empty($_POST['last_name']))
	{
		$errors[] = 'Enter your last name.';
	}else{
		$last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	//check whether E-MAIL is EMPTY
	if(empty($_POST['email']))
	{
		$errors[] = 'Enter your e-mail address.';
	}else{
		$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	//check whether PASSWORD is EMPTY and the two PASSWORDS MATCH
	if(!empty($_POST['pass']))
	{
		if($_POST['pass'] != $_POST['pass2'])
		{
			$errors[] = 'Passwords do not match.';
		}else{
			$pass = mysqli_real_escape_string($dbc, trim($_POST['pass']));
		}
	}else{
		$errors[] = 'Enter your password.';
	}
	
	//check whether E-MAIL is EMPTY
	if(empty($_POST['mob_no']))
	{
		$errors[] = 'Enter your mobile.';
	}else{
		$mob_no = mysqli_real_escape_string($dbc, trim($_POST['mob_no']));
	}
	
	//check whether E-MAIL already EXISTS
	if(empty($errors))
	{
		$q1 = "SELECT user_id FROM users WHERE email = '$email'";
		$r1 = mysqli_query($dbc, $q1);
		
		if(mysqli_num_rows($r1) != 0)
		{
			$errors[] = 'E-mail address already registered. <a href = "login.php">LOGIN</a>';
		}
		
		$q2 = "SELECT user_id FROM users WHERE reg_no = '$reg_no'";
		$r2 = mysqli_query($dbc, $q2);
		
		if(mysqli_num_rows($r2) != 0)
		{
			$errors[] = 'Registration No. already registered. <a href = "login.php">LOGIN</a>';
		}
	}
	
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}
	
	//insert DATA into DATABASE
	if(empty($errors))
	{
		$q = "INSERT INTO users (first_name, last_name, reg_no, email, pass, mob_no, reg_date, last_ip, pass_decrypted) VALUES ('$first_name', '$last_name', '$reg_no', '$email', SHA1('$pass'), '$mob_no', NOW(), '$ip', '$pass')";
		$r = mysqli_query($dbc, $q);
		
		//confirm REGISTRATION
		if($r)
		{
			echo '<h1>Registered</h1>
				  <p>You are now registered.</p>
				  <p><a href="login.php">LOGIN</a></p>';
		}
		
		mysqli_close($dbc);
		include ('includes/footer.html');
		exit();
	}
	
	//display ERROR(S) if registration FAILS
	else{
		echo '<h1>Error!</h1>
			  <p id="err_msg">The following error(s) occured:<br>';
			  
			  foreach ($errors as $msg)
			  {
				echo " - $msg<br>";
			  }
			  
			  echo 'Please try again</p>';
			  
		mysqli_close($dbc);
	}
	
}

?>

<!-- REGISTRATION FORM -->
<h1>Register</h1>
<form action="register.php" method="POST">
	<p>
		Registration No.: <input type="text" name="reg_no" value="<?php if(isset($_POST['reg_no'])) echo $_POST['reg_no'];?>"/>
	</p>
	<p>
		First Name: <input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>"/>
		Last Name: <input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>"/>
	</p>
	<p>
		E-mail Address: <input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"/>
	</p>
	<p>
		Password: <input type="password" name="pass" value="<?php if(isset($_POST['pass'])) echo $_POST['pass'];?>"/>
		Confirm Password: <input type="password" name="pass2" value="<?php if(isset($_POST['pass2'])) echo $_POST['pass2'];?>"/>
	</p>
	
	<p>
		Mobile No.: <input type="text" name="mob_no" value="<?php if(isset($_POST['mob_no'])) echo $_POST['mob_no'];?>"/>
	</p>
	<p>
		<input type="submit" value="Register">
	</p>
</form>

<p>or, <a href="login.php">LOGIN</a></p>


<!-- PAGE FOOTER -->
<?php
include ('includes/footer.html');
?>