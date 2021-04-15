<?php
	session_start();

    include("connection.php");	// for use of $conn
    include("functions.php");	// for use of check_login()

    $user_data = check_login($conn);	

    // if user presses Sell button...
    if (isset($_POST['sell'])) {
        //echo "Sold: " . substr(substr($_POST['sell'], 14), 0,-8);
        $prop_id = substr(substr($_POST['sell'], 14), 0,-8);
        
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
        
        echo "Property " . $prop_id . " marked as sold!";
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mark Property As Sold</title>
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
		<h2><center>Mark Property As Sold</center></h2> 
	</div>
    <form method="post" action="">
<?php
    // get all the properties in the database
    $query = "select * from property";
    $result = mysqli_query($conn, $query);
    
    // check if result is good
    if ($result) {
        // and that we have atleast one result
        if (mysqli_num_rows($result) > 0) {
            // display each property
            while($listing_data = mysqli_fetch_assoc($result)){ ?>
                <div class="meeting_div">
                    Property ID: <?php echo $listing_data['Property_ID'];?></br></br>
                    Address: <?php echo $listing_data['Address'];?></br></br>
                    <input type="submit" name="sell" value="<?php echo "Mark Property " . $listing_data['Property_ID'] . " As Sold";?>">
                </div>
            <?php }
        } else {
            echo "There are no properties.";
        }
    } else {
        echo "There was an error loading the properties.";
    }
?>
    </form>
</body>
</html>