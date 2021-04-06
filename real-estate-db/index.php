<?php
// on every page where you want to use the session, have to put session_start()
// on every page that you want the website to check if the user is logged in, put all of this.
// then if the user is not logged in, it will redirect to the login page.
session_start();

    // include the files we need
    include("connection.php");
    include("functions.php");

    // collect user data in user_data variable
    // check_login() is a function we're going to create. takes connection to database, in variable conn
    $user_data = check_login($conn);
	// if user is not logged in, they will be redirected to login page
	// if they are logged in, this user_data will contain their info.

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