<?php
	session_start();

    include("connection.php");	// for use of $conn
    include("functions.php");	// for use of check_login()

    $user_data = check_login($conn);	

    if (isset($_POST['submit'])) {

        $prop_id = $_POST['prop'];
        // update database
        $query = "insert into property_image (Property_ID) values ('$prop_id')";
        mysqli_query($conn, $query);
        // get the id of the photo that was just created in the db
        $img_id = mysqli_insert_id($conn);

        $file = $_FILES['file'];
        $file_ext = strtolower(end(explode('.', $_FILES['file']['name'])));
        $file_tmp_loc = $_FILES['file']['tmp_name'];
        $file_err = $_FILES['file']['error'];

        // check if file is of correct file type
        if ($file_ext=="jfif") {
            // check if any error in uploading the file
            if ($file_err === 0) {
                // no error
                $fileNameNew = $img_id . "." . $file_ext;
                $fileDestination = 'images/'.$fileNameNew;
                move_uploaded_file($file_tmp_loc, $fileDestination);
                chmod($fileDestination, 777);
                // success message
                echo "Property image was successfully uploaded!"; 
            } else {
                echo "There was an error uploading your file.";
            }
        } else {
            echo "Property images must be of type JFIF.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload Property Image</title>
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
		<h2><center>Upload Property Image</center></h2> 
	</div>
    <form action="" method="POST" enctype="multipart/form-data">
        <?php 
          // get all properties
          $query = "select * from property";
          $result = mysqli_query($conn, $query);
        ?>
        
        <center> <label for="proplabel">Property ID:</label> <select id = "prop" name="prop"> </center>
          <?php 
          
            // check if result is good
            if ($result) {
                // and that we have atleast one result
                if (mysqli_num_rows($result) > 0) {
                    // display each property
                    while($option = mysqli_fetch_assoc($result)){ ?>
                        <option value="<?php echo $option['Property_ID']; ?>"><?php echo $option['Property_ID']; ?></option>
                      <?php } 
                } else {
                    echo "There are no properties.";
                }
            } else {
                echo "There was an error loading the properties.";
            } ?>
        </select>
        <input type="file" name="file">
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>