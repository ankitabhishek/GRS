<?php

session_start();

//if not LOGGED-IN redirect to LOGIN
if(!isset($_SESSION['user_id']))
{
	require ('login_tools.php');
	load();
}

$page_title = "Home | MUJ Grievance Registration System";

//PAGE HEADER
include('includes/header.html');
include('includes/content.html');

//fixing the "No name change on front page after profile update" BUG
//retrive PROFILE data from DATABASE

$id = $_SESSION['user_id'];

require ('../connect_db.php');
$q = "SELECT * FROM users WHERE user_id = '$id'";
$r = mysqli_query($dbc, $q);
	
//fetch DETAILS in ARRAY
$row = mysqli_fetch_array($r, MYSQLI_ASSOC);


echo "<h1>HOME</h1>
	  <p>Hello, {$row['first_name']} {$row['last_name']}</p>";

//close CONNECTION with DATABASE
mysqli_close($dbc);

//BOTTOM MENU
echo '<p>
	  <a href="index.php">Home</a> | 
	  <a href="register_complain.php">Register Complain</a> | 
	  <a href="profile.php?id='.$_SESSION['user_id'].'">Profile</a> | 
	  <a href="my_complains.php">My Complains</a> | 
	  <a href="logout.php">Logout</a>
	  </p>';

//PAGE FOOTER
include('includes/footer.html');

?>