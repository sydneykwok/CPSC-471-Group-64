<?php
	session_start();

    include("connection.php");	// for use of $conn
    include("functions.php");	// for use of check_login()

    $user_data = check_login($conn);	

    $prop_id = $_SESSION['Property_ID'];
?>

<body>
   <div class="grad">
		<h1 class="logo"> Logo </h1>
	</div>
</body>

<?php

    // get property info
    $query = "SELECT * FROM property WHERE Property_ID = '$prop_id' limit 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result)>0) {
		$prop_data = mysqli_fetch_assoc($result);
		if ($_SESSION['Property_Type'] == "com") {
            echo "Property Type: Commercial</br>";
        } 
		else {
            echo "Property Type: Residential</br>";
        }
		echo "More details on the selected property was successfully retrieved!";	
    } 
	else {
        echo "There was an error retrieving the property info.";
    }

    // if "bookmark" button is pressed
    if (isset($_POST['bookmark'])) {
        
        $email = $user_data['Email'];

        $query = "insert into buyer_bookmarks_property (Email,Property_ID) values ('$email', '$prop_id')";
        mysqli_query($conn, $query);

        echo "Bookmarked!";
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Property <?php echo $prop_id ?></title>
	<link rel="stylesheet" type="text/css" href="style.css"/>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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

		.meeting_div{
			float: left;
			width: 100%;
			border: 1px solid;
			padding: 20px 20px;
			text-align: center;
		}

		.card {
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
			width: 50%;
			text-align: center;
			margin: 0 auto;
			float: none;
			margin-bottom: 10px;
		}

		.card:hover {
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
		}

		.container {
			padding: 2px 16px;
		}
	</style>
</head>
<body>

	<div>
		<h2><center>Property <?php echo $prop_id ?></center></h2> 
	</div>

    <form method="post" action="">
	<center>
    <?php
        if ($_SESSION['Account_Type']=="buyer") { ?>
            <input type="submit" name="bookmark" value="Bookmark This Property">        
        <?php } ?>
	</center>
    </form>

    <h2><center>Could this your new home?</center></h2>

	<h2><center>View The Property Details To Find Out!</center></h2>

	<div class="card">
		<img src="images/house_keys.jpg" style="width:100%">
		<div class="container">
			<h4><b>Property ID: <?php echo $prop_data['Property_ID'] ?></b></h4>
			<p>Address: <?php echo $prop_data['Address'] ?></p> 
			<p>Neighbourhood: <?php echo $prop_data['Neighbourhood'] ?></p>
			<p>City: <?php echo $prop_data['City'] ?></p>
			<p>Zip Code: <?php echo $prop_data['Zip_Code'] ?></p>
			<p>Estimated Value: <?php echo $prop_data['Estimated_Value'] ?></p>
			<p>Square Footage: <?php echo $prop_data['Square_Footage'] ?></p>
		</div>
	</div>

</body>
</html>

<?php
    $img_query = "(SELECT * FROM `property_image` WHERE Property_ID =  '$prop_id')";
	$images = mysqli_query($conn, $img_query);

	if (mysqli_num_rows($images) > 0) {
	?>

	<center>
		<div class="gallery"> 
			<?php while($row = mysqli_fetch_assoc($images)) { ?> 
				<img src="images/<?php echo $row['Image_ID']; ?>.jfif" /> <br><br>
			<?php } ?> 
		</div> 
	</center>

	<?php } 
?>
