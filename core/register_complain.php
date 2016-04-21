<?php

session_start();

//if not LOGGED-IN redirect to LOGIN
if(!isset($_SESSION['user_id']))
{
	require ('login_tools.php');
	load();
}

$page_title = "Register a complain | MUJ Grievance Registration System";

//PAGE HEADER
include('includes/header.html');
include('includes/content.html');


if($_SERVER['REQUEST_METHOD']=='POST')
{
	require ('includes/php/connect_db.php');
	$errors = array();
	
	//check whether CATEGORY is EMPTY
	if(empty($_POST['category']))
	{
		$errors[] = 'Select category.';
	}else{
		$category = mysqli_real_escape_string($dbc, trim($_POST['category']));
	}
	
	//check whether COMPLAIN TEXT is EMPTY
	if(empty($_POST['complain_text']))
	{
		$errors[] = 'Enter item description.';
	}else{
		$complain_text= mysqli_real_escape_string($dbc, trim($_POST['complain_text']));
	}

	//insert DATA into DATABASE
	if(empty($errors))
	{
		$q = "INSERT INTO complains (user_id, category, complain_text, complain_date) VALUES ({$_SESSION['user_id']}, '$category', '$complain_text', NOW())";
		$r = mysqli_query($dbc, $q);
		
		//confirm registering of COMPLAIN
		if($r)
		{
			echo '<h1>Complain registered successfully</h1>
				  <p>We will get back to you as soon as possible.</p>
				  <p><a href="register_complain.php">Register another complain.</a></p>';
				  
		}
		//if SHARING of item FAILS
		else{
			
			echo '<p>There was a problem registering your complain.</p>
				  <p>Please try again.</p>
				  <p><a href="register_complain.php">Try again</a>
				  </p>';
		}
		
		mysqli_close($dbc);
		
		//BOTTOM MENU
		echo '<p>
				<a href="index.php">Home</a> | 
	  			<a href="register_complain.php">Register Complain</a> | 
	  			<a href="profile.php?id='.$_SESSION['user_id'].'">Profile</a> | 
	  <a href="my_complains.php">My Complains</a> |  
	  			<a href="logout.php">Logout</a>
	  		  </p>';
		
		include ('includes/footer.html');
		exit();
	}
	//display ERROR(S) if sharing FAILS
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

<!-- SHARING FORM -->
<h1>Register a complain</h1>
<form action="register_complain.php" method="POST">
	<p>
		Select Complain Category: <select name="category">
					<option value="IT Infrastructure">IT Infrastructure</option>
					<option value="Academics">Academics</option>
					<option value="Mess Food">Mess Food</option>					
					<option value="Others" selected>Others</option>
				   </select>
	</p>
	<p>
		Description:<br /><textarea rows="10" cols="80" name="complain_text"></textarea>
	</p>
	<p>
		<input type="submit" value="Register Complain">
	</p>
</form>

<?php

//BOTTOM MENU
echo '<p>
	  <a href="index.php">Home</a> | 
	  <a href="register_complain.php">Register Complain</a> | 
	  <a href="profile.php?id='.$_SESSION['user_id'].'">Profile</a> | 
	  <a href="my_complains.php">My Complains</a> |  
	  <a href="logout.php">Logout</a>
	  </p>';

//PAGE FOOTER
include ('includes/footer.html');
?>