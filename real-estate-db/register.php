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
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];

        // if not empty (bc we don't want to register a user w/o checking if they've written something)
        if (!empty($email) && !is_numeric($email) && !empty($first_name) && !empty($last_name) && !empty($password)) {
            // can add other validity checks for email & password here
            // e.g., is not numeric(email) bc you don't want email to be numbers
            // if all good, save to database (write a query)
            // only inserting into buyer for now but need to add something to check user type and then add to seller instead if that is the case!!!!
            $query = "insert into buyer (Email,First_Name,Last_Name,Password) values ('$email', '$first_name', '$last_name', '$password')";

            // save to db
            mysqli_query($conn, $query);

            // redirect user to login page so that they can login
            header("Location: login.php");
            die;
        } else {
            echo "Please enter some valid information :)";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="box">
		<form method="post">
			<div style="font-size: 20px; margin: 10px; color: black;">Register</div>
			
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
		</form>
	</div>
</body>
</html>