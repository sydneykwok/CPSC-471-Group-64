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

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<style>
		.grad{
			width: 100%;
			height: 50px;
			background-image: linear-gradient(to right, rgba(38,83,126,0.7), rgba(0,33,64,1));
		}

		body{
			margin: 0px;
			padding: 0px;
		}

		.logo{
			color: #ffffff;
			font-size: 25px;
			text-align: left;
			margin-top: 0px;
			float: left;
			margin: 0px;
			line-height: 50px;
			padding-left: 50px;
		}

		.logoutButton {
			border-radius: 4px;
			background-image: linear-gradient(to right, rgba(0,33,64,0.98), rgba(0,33,64,1));
			border: none;
			color: black;
			text-align: center;
			font-size: 18px;
			padding: 9px;
			width: 100px;
			transition: all 0.5s;
			cursor: pointer;
			float: right;
			margin: 5px;
		}

		.logoutButton span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}

		.logoutButton span:after {
			content: '\00bb';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -20px;
			transition: 0.5s;
		}

		.logoutButton:hover span {
			padding-right: 20px;
		}

		.logoutButton:hover span:after {
			opacity: 1;
			right: 0;
		}

	</style>
</head>

<body>
	
	<div class="grad">
		<h1 class="logo">Logo</h1>

		<button class="logoutButton"> <a href="logout.php" style="color: #ffffff"> <span> Logout </span> </a> </button>

	</div>

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
