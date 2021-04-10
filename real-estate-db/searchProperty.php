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
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $prop_type = $_POST['property'];
        $city = $_POST['city'];

        $query = "(SELECT * FROM property WHERE City = '$city')";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            //Print every row from filtered query
            while ($row = mysqli_fetch_assoc($result)) {
                echo "Address: " . $row['Address'] . "<br>";
            }
        } else {
            echo "No houses found :(";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Property</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form method="post">
		<div id="mydiv">
			<label id="searchLabel">Search many listings from trusted real estate agents</label> 
			<br>
		</div>

		<div>
			<label>Select a property type:</label>
			<select name="property">
				<option value="res">Residential</option>
				<option value="com">Commercial</option>
			</select>
		</div>

		<div>
			<label>Country:</label> 
			<input type="text" name="country" placeholder="Enter country name"/>
		</div>

		<div>
			<label>City:</label> 
			<input type="text" name="city" placeholder="Enter city name"/>
		</div>

		<div>
			<label>Price:</label>
			<select name="price">
				<option value="0-25,000">$0-$25,000</option>
				<option value="25,000-75,000">$25,000-$75,000</option>
				<option value="75,000-125,000">$75,000-$125,000</option>
				<option value="125,000-175,000">$125,000-$175,000</option>
				<option value="175,000-225,000">$175,000-$225,000</option>
				<option value="225,000-275,000">$225,000-$275,000</option>
				<option value="275,000-300,000">$275,000-$300,000</option>
				<option value="300,000+">$300,000+</option>
			</select>
		</div>
		
		<div>
			<label>Beds:</label>
			<select name="beds">
				<option value="one">1</option>
				<option value="two">2</option>
				<option value="three">3</option>
				<option value="four">4</option>
				<option value="five">5</option>
				<option value="fivePlus">5+</option>
			</select>
		</div>
		
		<div>
			<label>Baths:</label>
			<select name="baths">
				<option value="one">1</option>
				<option value="two">2</option>
				<option value="three">3</option>
				<option value="four">4</option>
				<option value="five">5</option>
				<option value="fivePlus">5+</option>
			</select>
		</div>
			
		<div>
			<input type="submit" name="submit" value="Search">
		</div>

		</form>
	</div>
</body>
</html>