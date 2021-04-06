<?php
session_start();

// include the files we need
include("connection.php");
include("functions.php");

// check if the user has clicked on the post button
// use SERVER as a check. if the request method is equal to POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// then something was posted
	// collect the data from the post variable (where the user data is going to be)
	$email = $_POST['email'];
	$password = $_POST['password'];

	// if not empty (bc we don't want to register a user w/o checking if they've written something)
	if (!empty($email) && !is_numeric($email) && !empty($password)) {
		// read from database
		// only checking buyer for now but need to check seller too!!!!
		// checking that the email provided by user is the same as any email in the db
		$query = "select * from buyer where Email = '$email' limit 1";	// limit 1 to get only 1 result

		$result = mysqli_query($conn, $query);
		// check if result is good & we have atleast one result
		if ($result && mysqli_num_rows($result) > 0) {
			// get user data
			$user_data = mysqli_fetch_assoc($result);
			// check if user data's password is the same as user supplied password
			if ($user_data['Password'] == $password) {
				// if true, assign session id
				$_SESSION['Email'] = $user_data['Email'];
				// then redirect to index page
				header("Location: index.php");
				die;
			}
		}
		echo "Wrong email or password!";
	} else {
		echo "Please enter some valid information :(";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="box">
		<form method="post">
			<div style="font-size: 20px; margin: 10px; color: black;">Login</div>
			
			<p>
				<label>Email:</label> 
				<input id="text" type="text" name="email"/>
			</p>
			<p>
				<label>Password:</label>
				<input id="text" type="password" name="password" />
			</p>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="register.php">Click to Create Account</a><br><br>
		</form>
	</div>
</body>
</html>