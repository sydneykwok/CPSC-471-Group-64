<?php
session_start();

// include the files we need
include("connection.php");
include("functions.php");

// using SERVER, check if the user has clicked on the post button (if request method = POST)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// something was posted, so collect the data from the post variable
	$email = $_POST['email'];
	$password = $_POST['password'];

	// if not empty (make sure they've entered some value)
	if (!empty($email) && !is_numeric($email) && !empty($password)) {
		
		// check if user is buyer
		$query = "(select Password from buyer where Email = ?) limit 1";
		// create prepared statement
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $query)) {
			echo "Failed to prepare statement";
		} else {
			// bind parameters, "s" for type string
			mysqli_stmt_bind_param($stmt, "s", $email);
			// execute the query
			mysqli_stmt_execute($stmt);
			// get the result
			$result = mysqli_stmt_get_result($stmt);

			// check if result is good & we have atleast one result
			if ($result && mysqli_num_rows($result) > 0) {
				// get user data
				$user_data = mysqli_fetch_assoc($result);
				// check if user data's password (from db) matches user supplied password
				if ($user_data['Password'] == $password) {
					// if true, assign session id
					$_SESSION['Email'] = $email;
					// and account type
					$_SESSION['Account_Type'] = "buyer";
					// give success response
					header("HTTP/1.0 200 OK");
					// then redirect to index page
					header("Location: index.php");
					die;
				}
			}
		}

		// check if user is seller
		$query = "(select Password from seller where Email = ?) limit 1";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $query)) {
			echo "Failed to prepare statement";
		} else {
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($result && mysqli_num_rows($result) > 0) {
				// get user data
				$user_data = mysqli_fetch_assoc($result);
				// check if user data's password (from db) matches user supplied password
				if ($user_data['Password'] == $password) {
					// if true, assign session id
					$_SESSION['Email'] = $email;
					// and account type
					$_SESSION['Account_Type'] = "seller";
					// give success response
					header("HTTP/1.0 200 OK");
					// then redirect to index page
					header("Location: index.php");
					die;
				}
			}
		}

		// check if user is agent
		$query = "(select Password from real_estate_agent where Email = ?) limit 1";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $query)) {
			echo "Failed to prepare statement";
		} else {
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($result && mysqli_num_rows($result) > 0) {
				// get user data
				$user_data = mysqli_fetch_assoc($result);
				// check if user data's password (from db) matches user supplied password
				if ($user_data['Password'] == $password) {
					// if true, assign session id
					$_SESSION['Email'] = $email;
					// and account type
					$_SESSION['Account_Type'] = "agent";
					// give success response
					header("HTTP/1.0 200 OK");
					// then redirect to index page
					header("Location: index.php");
					die;
				}
			}
		}

		echo "Wrong email or password!";
		// give client error response 401 Unauthorized: user must authenticate themself to get the requested response (index.php)
		header("HTTP/1.0 401 Unauthorized");
	} else {
		echo "Please enter some valid information :(";
		// give client error response 400 Bad Request
		header("HTTP/1.0 400 Bad Request");
	}
}
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
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