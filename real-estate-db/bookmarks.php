<?php
	session_start();

    include("connection.php");	// for use of $conn
    include("functions.php");	// for use of check_login()

    $user_data = check_login($conn);
    $email = $user_data['Email'];	

    // if user presses View button...
    if (isset($_POST['view'])) {
        $_SESSION['Property_ID'] = substr($_POST['view'],13);
		// then redirect to viewProperty page
		header("Location: viewProperty.php");
		die;
    }

    // if user presses Delete button...
    if (isset($_POST['delete'])) {

        $prop_id = substr($_POST['delete'], 14);
        
        // delete the corresponding email-property tuple from the buyer_bookmarks_property relation
        $query = "delete from `buyer_bookmarks_property` where `buyer_bookmarks_property`.`Email` = '$email' and `buyer_bookmarks_property`.`Property_ID` = '$prop_id'";
        mysqli_query($conn, $query);
        
        echo "Unbookmarked Property " . $prop_id . ".";
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Bookmarks</title>
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
		<h2><center>My Bookmarks</center></h2> 
	</div>
    <form method="post" action="" >
<?php
    // get the bookmarks of the user
    $query = "select * from buyer_bookmarks_property where Email = '$email'";
    $result = mysqli_query($conn, $query);
    
    // check if result is good
    if ($result) {
        // and that we have atleast one result
        if (mysqli_num_rows($result) > 0) {
            // display each bookmark
            while($listing_data = mysqli_fetch_assoc($result)){ ?>
                <div class="meeting_div">
                    Property ID: <?php echo $listing_data['Property_ID'];?></br></br>
                    <input type="submit" name="view" value="<?php echo "View Listing " . $listing_data['Property_ID'];?>">
                    <input type="submit" name="delete" value="<?php echo "Remove Listing " . $listing_data['Property_ID'];?>">
                </div>
            <?php }
        } else {
            echo "You have no bookmarks.";
        }
    } else {
        echo "There was an error loading your bookmarks.";
    }
?>
</body>
</html>