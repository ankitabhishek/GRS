<?php

//function to LOAD page in ARGUMENT
function load($page = 'login.php')
{
	$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/'.$page;
	
	header("Location: $url");
	exit();
}

//function to VALIDATE user LOGIN
function validate($dbc, $reg_no = '', $pass = '')
{
	$errors = array();
	
	//check if E-MAIL is PROVIDED
	if(empty($reg_no))
	{
		$errors[] = 'Enter your registration no.';
	}else{
		$e = mysqli_real_escape_string($dbc, trim($reg_no));
	}
	
	//check if PASSWORD is PROVIDED
	if(empty($pass))
	{
		$errors[] = 'Enter your password.';
	}else{
		$p = mysqli_real_escape_string($dbc, trim($pass));
	}
	
	//check if user EXISTS in DATABASE, if yes then FETCH user DETAILS
	if(empty($errors))
	{
		$q = "SELECT user_id, first_name, last_name FROM users WHERE reg_no = '$e' AND pass = SHA1('$p')";
		$r = mysqli_query($dbc, $q);
		
		if(mysqli_num_rows($r) == 1)
		{
			$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
			return array(true, $row);
		}else{
			$errors[] = 'Registration No. and/or password incorrect.';
		}
	}
	
	//return ERRORS if login FAILS
	return array(false, $errors);
}

?>