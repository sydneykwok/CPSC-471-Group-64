<?php
	session_start();

    include("connection.php");	// for use of $conn
    include("functions.php");	// for use of check_login()

    $user_data = check_login($conn);	

    $prop_id = $_SESSION['Property_ID'];

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
	</style>
</head>
<body>
    <div class="grad">
		<h1 class="logo"> Logo </h1>
	</div>
    <div>
		<h2><center>Property <?php echo $prop_id ?></center></h2> 
	</div>
</body>
</html>

<?php 

    // get property info
    $query = "SELECT * FROM property WHERE Property_ID = '$prop_id' limit 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result)>0) {
        $prop_data = mysqli_fetch_assoc($result);
        if ($_SESSION['Property_Type'] == "com") {
            echo "Property Type: Commercial</br>";
        } else {
            echo "Property Type: Residential</br>";
        }
        echo "Property ID: " . $prop_data['Property_ID'] . "</br>";
        echo "Address: " . $prop_data['Address'] . "</br>";
        echo "Neighbourhood: " . $prop_data['Neighbourhood'] . "</br>";
        echo "City: " . $prop_data['City'] . "</br>";
        echo "Zip Code: " . $prop_data['Zip_Code'] . "</br>";
        echo "Estimated Value: " . $prop_data['Estimated_Value'] . "</br>";
        echo "Square Footage: " . $prop_data['Square_Footage'] . "</br>";
    } else {
        echo "There was an error retrieving the property info.";
    }

	$img_query = "(SELECT * FROM `property_image` WHERE Property_ID =  '$prop_id')";
	$images = mysqli_query($conn, $img_query);

	if (mysqli_num_rows($images) > 0) {
	?>
		<div class="gallery"> 
			<?php while($row = mysqli_fetch_assoc($images)) { ?> 
				<img src="images/<?php echo $row['Image_ID']; ?>.jfif" /> 
				<br>
			<?php } ?> 
		</div> 
	<?php } 
?>

