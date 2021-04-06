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
	<title>Real Estate Database !!!</title>
</head>
<body>
	<a href="logout.php">Logout</a>
	<h1>This is the index page.</h1>

	<br>
	Hello, <?php echo $user_data['First_Name'];?>.
</body>
</html>