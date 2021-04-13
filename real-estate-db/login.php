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
		$query = "(select Password from buyer where Email = '$email') limit 1";
		$result = mysqli_query($conn, $query);

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
				// then redirect to index page
				header("Location: index.php");
				die;
			}
		}

		// check if user is seller
		$query = "(select Password from seller where Email = '$email') limit 1";
		$result = mysqli_query($conn, $query);

		if ($result && mysqli_num_rows($result) > 0) {
			// get user data
			$user_data = mysqli_fetch_assoc($result);
			// check if user data's password (from db) matches user supplied password
			if ($user_data['Password'] == $password) {
				// if true, assign session id
				$_SESSION['Email'] = $email;
				// and account type
				$_SESSION['Account_Type'] = "seller";
				// then redirect to index page
				header("Location: index.php");
				die;
			}
		}

		// check if user is agent
		$query = "(select Password from real_estate_agent where Email = '$email') limit 1";
		$result = mysqli_query($conn, $query);

		if ($result && mysqli_num_rows($result) > 0) {
			// get user data
			$user_data = mysqli_fetch_assoc($result);
			// check if user data's password (from db) matches user supplied password
			if ($user_data['Password'] == $password) {
				// if true, assign session id
				$_SESSION['Email'] = $email;
				// and account type
				$_SESSION['Account_Type'] = "agent";
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