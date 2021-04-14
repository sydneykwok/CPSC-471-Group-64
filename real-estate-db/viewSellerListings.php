<?php
	session_start();

    include("connection.php");	// for use of $conn
    include("functions.php");	// for use of check_login()

    $user_data = check_login($conn);	

    // if user presses View button...
    if (isset($_POST['view'])) {
		//set session variables for the property that was selected
		//$_SESSION['Property_Type'] = substr($_POST['view'],0,3);
		$_SESSION['Property_ID'] = substr($_POST['view'],13);
		// then redirect to viewProperty page
		header("Location: viewProperty.php");
		die;
    }

    // if user presses Delete button...
    if (isset($_POST['delete'])) {
        $prop_id = substr($_POST['delete'], 14);
        
        // check if the property has any tours
        $query = "select Tour_ID from tour where Property_ID = '$prop_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // if the property has scheduled tours, for each tour...
            while ($tour_data = mysqli_fetch_assoc($result)) {
                // get the tour id
                $tour_id = $tour_data['Tour_ID'];

                // get the meeting_id of the meeting that the tour is included in
                $query = "select Meeting_ID from online_meeting_has_tour where Tour_ID = '$tour_id'";
                $meet_data = mysqli_query($conn, $query);
                $meet_data = mysqli_fetch_assoc($meet_data);
                $meeting_id = $meet_data['Meeting_ID'];

                // delete the corresponding tour-meeting entry from online_meeting_has_tour
                $query = "delete from `online_meeting_has_tour` where `online_meeting_has_tour`.`Tour_ID` = '$tour_id' and `online_meeting_has_tour`.`Meeting_ID` = '$meeting_id'";
                mysqli_query($conn, $query);
                // delete the tour from the tour relation
                $query = "delete from `tour` where `tour`.`Tour_ID` = '$tour_id'";
                mysqli_query($conn, $query);
                // delete the corresponding meeting from online_meeting relation
                $query = "delete from `online_meeting` where `online_meeting`.`Meeting_ID` = '$meeting_id'";
                mysqli_query($conn, $query);
            }
		}
        
        // delete the property from the residential relation (whether it exists there or not)
        $query = "delete from `residential_property` where `residential_property`.`Property_ID` = '$prop_id'";
        mysqli_query($conn, $query);
        // delete the property from the commercial relation (whether it exists there or not)
        $query = "delete from `commercial_property` where `commercial_property`.`Property_ID` = '$prop_id'";
        mysqli_query($conn, $query);
        // delete the property from the property image relation (even though it's not yet populated/implemented)
        $query = "delete from `property_image` where `property_image`.`Property_ID` = '$prop_id'";
        mysqli_query($conn, $query);
        // delete the property from the property relation
        $query = "delete from `property` where `property`.`Property_ID` = '$prop_id'";
        mysqli_query($conn, $query);
        
        echo "Successfully deleted Listing " . $prop_id . ".";
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Listings</title>
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
		<h2><center>My Listings</center></h2> 
	</div>
    <form method="post" action="" >
<?php
    // get the listings of the user
    $email = $user_data['Email'];
    $query = "select * from property where S_Email = '$email'";
    $result = mysqli_query($conn, $query);
    
    // check if result is good
    if ($result) {
        // and that we have atleast one result
        if (mysqli_num_rows($result) > 0) {
            // display each meeting
            while($listing_data = mysqli_fetch_assoc($result)){ ?>
                <div class="meeting_div">
                    Property ID: <?php echo $listing_data['Property_ID'];?></br></br>
                    Address: <?php echo $listing_data['Address'];?></br></br>
                    <input type="submit" name="view" value="<?php echo "View Listing " . $listing_data['Property_ID'];?>">
                    <input type="submit" name="delete" value="<?php echo "Delete Listing " . $listing_data['Property_ID'];?>">
                </div>
            <?php }
        } else {
            echo "You have no listings.";
        }
    } else {
        echo "There was an error loading your listings.";
    }
?>
</body>
</html>