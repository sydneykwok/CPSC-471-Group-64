<?php
// on every page where you want to use the session (check if user is logged in), have to put session_start().
session_start();

    // include the files we need
    include("connection.php");	// for use of $conn
    include("functions.php");	// for use of check_login()

    // collect user data in user_data variable
    // check_login() is a function defined in functions.php that takes connection to database in $conn variable
    $user_data = check_login($conn);	
	// if user is not logged in, they will be redirected to login page
	// if they are logged in, this user_data will contain their info. to access an attribute of the user: $user_data['attribute']

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body>
	<a href="logout.php">Logout</a>
	<h1>Welcome to the Real Estates Home Page!</h1>

	<br>
	Hello, <?php echo $user_data['First_Name'];?>.

	<br>
	Select one of the following options to begin your property search.

	<!-- Create a list of options to go to on the Home Page-->
	<div>
		<a href="searchProperty.php">Click to Search for Properties</a><br><br>
	</div>
</body>
</html>
