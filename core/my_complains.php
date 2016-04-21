<?php

session_start();

//if not LOGGED-IN redirect to LOGIN
if(!isset($_SESSION['user_id']))
{
	require ('login_tools.php');
	load();
}

$page_title = "My Complains | MUJ Grievance Registration System";

//PAGE HEADER
include('includes/header.html');
include('includes/content.html');

//get USER profile ID
if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	$id = $_SESSION['user_id'];
}	
	//set LIMIT for no. of ITEMS displayed per PAGE
	$rec_limit = 10;
	
	//count no. of ITEMS
	require ('includes/php/connect_db.php');
	$q = "SELECT count(complain_id) FROM complains";
	$r = mysqli_query($dbc, $q);
	
	if(!$r)
	{
		die('Could not get data: ' . mysql_error());
	}
	
	$row = mysqli_fetch_array($r, MYSQLI_NUM);
	$rec_count = $row[0];
	
	if(isset($_GET{'page'}))
	{
		$page = $_GET{'page'} + 1;
		$offset = $rec_limit * $page ;
	
	}else{
		$page = 0;
		$offset = 0;
	}
	
	$left_rec = $rec_count - ($page * $rec_limit) - 1;
	
	$q = "SELECT * FROM complains WHERE user_id = {$_SESSION['user_id']} ORDER BY complain_date DESC LIMIT $offset, $rec_limit";
	$r = mysqli_query($dbc, $q);
	
	if(!$r)
	{
		die('Could not get data: ' . mysql_error());
	}

	echo '<h1>My Complains</h1>';
	echo '<table>';
	echo '<thead>';
    echo '<tr>';
    echo '<td>Ref. ID</td>';
    echo '<td>Category</td>';
	echo '<td>Description</td>';
	echo '<td>Registered On</td>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{
		//print DETAILS on SCREEN
		echo '<tr>';
		echo '<td width="5%" class="tbody-center">'.$row['complain_id'].'</td>';
		echo '<td width="15%">'.$row['category'].'</td>';
		echo '<td>'.$row['complain_text'].'</td>';
		echo '<td width="15%">'.$row['complain_date'].'</td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	
	if($page == 0)
	{
		if($left_rec < $rec_limit)
		{
			echo "<br>Nothing more to display";
		
		}else{
			
			echo "<a href=\"my_complains.php?page=$page\">Older >>></a>";
			
		}
		
	
	}else if($left_rec < $rec_limit)
	{
		$last = $page - 2;
		echo "<a href=\"my_complains.php?page=$last\"><<< Newer</a>";
	
	}else{
		
		$last = $page - 2;
		echo "<a href=\"my_complains.php?page=$last\">Last 10 Records</a> |";
		echo "<a href=\"my_complains.php?page=$page\">Next 10 Records</a>";
		
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


	//PAGE FOOTER
	include('includes/footer.html');

?>