<?php
session_start();

    // include the files we need
    include("connection.php");
    include("functions.php");

    // using SERVER, check if the user has clicked on the post button (if request method = POST)
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // something was posted, so collect the data from the post variable
        $account_type = $_POST['account_type'];
		$email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];

        // if not empty (make sure they've entered some value
		// can add other validity checks for inputs here if we want
        if (!empty($account_type) && !empty($email) && !is_numeric($email) && !empty($first_name) && !empty($last_name) && !empty($password)) {
            // if all good, save to database (via query)
			if ($account_type == "b") {
				$query = "insert into buyer (Email,First_Name,Last_Name,Password) values (?, ?, ?, ?)";
			} else {
				$query = "insert into seller (Email,First_Name,Last_Name,Password) values (?, ?, ?, ?)";
			}
			$stmt = mysqli_prepare($conn, $query);
			mysqli_stmt_bind_param($stmt, "ssss", $email, $first_name, $last_name, $password);
			mysqli_stmt_execute($stmt);

			// give success response
			header("HTTP/1.0 200 OK");
            // redirect user to login page so that they can login
            header("Location: login.php");
            die;
        } else {
            echo "Please enter some valid information :)";
			// give client error response 400 Bad Request
			header("HTTP/1.0 400 Bad Request");
        }
    }

?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<title>User Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="box">
		<form method="post">
			<div style="font-size: 20px; margin: 10px; color: black;">User Registration</div>
			
			<p>
				<label>Account Type:</label> 
				<input id="radbtn" type="radio" name="account_type" value="b"/>Buyer
				<input id="radbtn" type="radio" name="account_type" value="s"/>Seller
			</p>
			<p>
				<label>Email:</label> 
				<input id="text" type="text" name="email"/>
			</p>
			<p>
				<label>First Name:</label> 
				<input id="text" type="text" name="first_name"/>
			</p>
			<p>
				<label>Last Name:</label> 
				<input id="text" type="text" name="last_name"/>
			</p>
            <p>
				<label>Password:</label> 
				<input id="text" type="password" name="password"/>
			</p>
			
			<input id="button" type="submit" value="Register"><br><br>

			<a href="login.php">Click to Login</a><br><br>
			<a href="register_agent.php">Click to Register as Agent</a><br><br>
		</form>
	</div>
</body>
</html>