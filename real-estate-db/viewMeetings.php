<?php
    session_start();

    // include the files we need
    include("connection.php");
    include("functions.php");

    $user_data = check_login($conn);

    if (isset($_POST['cancel'])) {
        $meeting_id = substr($_POST['cancel'],15);
        
        // check if the meeting has a tour
        $query = "select Tour_ID from online_meeting_has_tour where Meeting_ID = '$meeting_id'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            // if the meeting has a tour delete from online_meeting_has_tour and tour
            $res_data = mysqli_fetch_assoc($result);
            $tour_id = $res_data['Tour_ID'];
			$query = "delete from `online_meeting_has_tour` where `online_meeting_has_tour`.`Meeting_ID` = '$meeting_id' and `online_meeting_has_tour`.`Tour_ID` = '$tour_id'";
            mysqli_query($conn, $query);
            $query = "delete from `tour` where `tour`.`Tour_ID` = '$tour_id'";
            mysqli_query($conn, $query);
		}

        // delete the meeting from online_meeting
        $query = "delete from `online_meeting` where `online_meeting`.`Meeting_ID` = '$meeting_id'";
        mysqli_query($conn, $query);
        echo "Successfully cancelled meeting " . $meeting_id . ".";
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Meetings</title>
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
		<h2><center>My Meetings:</center></h2> 
	</div>
    <form method="post" action="" >
<?php
    // depending on account type, get the meetings of the user
    $email = $user_data['Email'];
    if ($_SESSION['Account_Type']=="buyer") { 
        $query = "select * from online_meeting where B_Email = '$email'";
    } else if ($_SESSION['Account_Type']=="agent") {
        // get agent id from real_estate_agent based on their email
        $query = "select Agent_ID from real_estate_agent where Email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result)>0) {
            $agent_data = mysqli_fetch_assoc($result);
            $agent_id = $agent_data['Agent_ID'];
            $query = "select * from online_meeting where Agent_ID = '$agent_id'";
        } else {
            echo "There was an error";
            die;
        }
    }
    $result = mysqli_query($conn, $query);
    
    // check if result is good
    if ($result) {
        // and that we have atleast one result
        if (mysqli_num_rows($result) > 0) {
            // display each meeting
            while($meet_data = mysqli_fetch_assoc($result)){ 
                
                $tour_id = $property_id = "N/A";
                // check if meeting has tour
                $meet_id = $meet_data['Meeting_ID'];
                $query = "select Tour_ID from online_meeting_has_tour where Meeting_ID = '$meet_id' limit 1";
                $has_tour = mysqli_query($conn, $query);
                if ($has_tour && mysqli_num_rows($has_tour) > 0) {
                    // get tour data
			        $tour_data = mysqli_fetch_assoc($has_tour);
                    $tour_id = $tour_data['Tour_ID'];
                    $query = "select * from tour where Tour_ID = '$tour_id' limit 1";
                    $tour_data = mysqli_query($conn, $query);
                    if ($tour_data && mysqli_num_rows($tour_data) > 0) {
                        $tour_data = mysqli_fetch_assoc($tour_data);
                        $property_id = $tour_data['Property_ID'];
                    }
                }

                ?>
                <div class="meeting_div">
                    Meeting ID: <?php echo $meet_id;?></br></br>
                    Agent ID: <?php echo $meet_data['Agent_ID'];?></br></br>
                    Buyer Email: <?php echo $meet_data['B_Email'];?></br></br>
                    Date: <?php echo $meet_data['Date'];?></br></br>
                    Time: <?php echo $meet_data['Time'];?></br></br>
                    Tour ID: <?php echo $tour_id;?></br></br>
                    Property ID: <?php echo $property_id;?></br></br>
                    <?php if (!empty($meet_data['Message'])) {
                        echo "Message: " . $meet_data['Message'] . "</br></br>";
                    }?>
                    <input type="submit" name="cancel" value="<?php echo "Cancel Meeting " . $meet_id;?>">
                </div>
            <?php }
        } else {
            echo "You have no meetings.";
        }
    } else {
        echo "There was an error loading your meetings.";
    }
?>
</body>
</html>