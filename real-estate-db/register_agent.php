<?php
session_start();

    // include the files we need
    include("connection.php");
    include("functions.php");

    // using SERVER, check if the user has clicked on the post button (if request method = POST)
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // something was posted, so collect the data from the post variable
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_no = $_POST['contact_no'];
		$email = $_POST['email'];
        $password = $_POST['password'];
        $association = $_POST['association'];

        // if not empty (make sure they've entered some value
		// can add other validity checks for inputs here if we want
        if (!empty($first_name) && !empty($last_name) && !empty($contact_no) && !empty($email) && !empty($password) && !empty($association)) {
            // if all good, save to database (via query)
			$query = "insert into real_estate_agent (First_Name,Last_Name,Contact_No,Email,Password,Association) values ('$first_name', '$last_name', '$contact_no', '$email', '$password', '$association')";
            
            mysqli_query($conn, $query);

			// give success response
			header("HTTP/1.0 200 OK");
            // redirect to login page so that they can login
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
<head>
	<title>Agent Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="box">
		<form method="post">
			<div style="font-size: 20px; margin: 10px; color: black;">Agent Registration</div>

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
            <p>
				<label>Phone Number:</label> 
				<input id="text" type="password" name="contact_no"/>
			</p>
            <p>
				<label>Association:</label> 
				<input id="text" type="password" name="association"/>
			</p>
			
			<input id="button" type="submit" value="Register"><br><br>

			<a href="login.php">Click to Login</a><br><br>
			<a href="register.php">Click to Register as User</a><br><br>
		</form>
	</div>
</body>
</html>