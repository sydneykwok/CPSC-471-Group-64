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
        // something was posted, so collect the data from the post variable
        $property = $_POST['property'];
        $address = $_POST['address'];
        $neighbourhood = $_POST['neighbourhood'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $status = $_POST['status'];
        $value = $_POST['value'];
        $footage = $_POST['footage'];
        $b_email = $_POST['bEmail'];
        $s_email = $user_data['Email'];
        $agent = $_POST['agent'];

        if (!empty($property)) {
            if (!empty($address)) {
                if (!empty($neighbourhood)) {
                    if (!empty($city)) {
                        if (!empty($zip)) {
                            if (!empty($status)) {
                                if (!empty($value)) {
                                    if (!empty($footage)) {
                                        if (!empty($b_email)) {
                                            // add the property details to the property relation 
                                            $query = "insert into property (Property_ID, Address, Neighbourhood, City, Zip_Code, Status, Estimated_Value, Square_Footage, B_Email, S_Email, Agent_ID) values ('$property', '$address', '$neighbourhood', '$city', '$zip', '$status', '$value', '$footage', '$b_email', '$s_email', '$agent')";
                                            mysqli_query($conn, $query);
                                            // write success confirmation message after inserting data into table for property 
                                            echo "Success! We will now upload your property details to the site for sale.";
                                        }
                                        else {
                                            echo "Please enter the temporary buyer email for the property you would like to sell.";
                                        }
                                    }
                                    else {
                                         echo "Please enter the square footage for the property you would like to sell.";
                                    }
                                }
                                else {
                                    echo "Please enter a price for the property you would like to sell.";
                                }
                            }
                            else {
                                echo "Please enter a purchase status for the property you would like to sell.";
                            }
                        } else {
                            echo "Please enter a ZIP code for the property you would like to sell.";
                        }
                    }
                    else {
                        echo "Please enter a city for the property you would like to sell.";
                    }
                }
                else {
                    echo "Please enter a neighbourhood for the property you would like to sell.";
                }
            }
            else {
                echo "Please enter an address for the property you would like to sell.";
            }
        }
        else {
            echo "Please enter a property ID for the property you would like to sell.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

/* Style inputs */
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

/* Style the container/contact section */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 10px;
}

/* Create two columns that float next to eachother */
.column {
  float: left;
  width: 50%;
  margin-top: 6px;
  padding: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>

<div class="container">
  <div style="text-align:center">
    <h2>Contact Us</h2>
    <p>Are you looking to sell a property?</p>
    <p>Please fill out the form below so we can upload your property to the system.</p>
  </div>
  <div class="row">
    <div class="column">
      <img src="images/for_sale.jpg" style="width:100%">
    </div>
    <div class="column">
      <form method="post">
        <label for="addr">Property ID:</label>
        <input type="text" id="prop" name="property" placeholder="The ID of the property..."></br></br>

        <label for="addr">Address:</label>
        <input type="text" id="addr" name="address" placeholder="The address of the property..."></br></br>

        <label for="neighbour">Neighbourhood:</label>
        <input type="text" id="neighbour" name="neighbourhood" placeholder="The neighbourhood of the property..."></br></br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" placeholder="The city of the property..."></br></br>

        <label for="zip">Zip Code:</label>
        <input type="text" id="zip" name="zip" placeholder="The ZIP code of the property..."></br></br>

        <label for="stat">Status:</label>
        <input type="text" id="stat" name="status" placeholder="Enter a 1 to indicate the status is not bought..."></br></br>

        <label for="val">Estimated Value:</label>
        <input type="text" id="val" name="value" placeholder="The estimated value of the property..."></br></br>

        <label for="sqfoot">Square Footage:</label>
        <input type="text" id="sqfoot" name="footage" placeholder="The square footage of the property..."></br></br>

        <label for="bEmail">Buyer Email:</label>
        <input type="text" id="bEmail" name="bEmail" placeholder="Enter a temporary buyer email or word (ie. test)..."></br></br>

        <label for="agentlabel">Agent (ID):</label>
        <?php 
          // for each agent in the real_estate_agent table, add their id as an option
          $query = "select Agent_ID from real_estate_agent";
          $result = mysqli_query($conn, $query);
        ?>
        <select id = "agent" name="agent">
          <?php while($option = mysqli_fetch_assoc($result)){ ?>
            <option value="<?php echo $option['Agent_ID']; ?>"><?php echo $option['Agent_ID']; ?></option>
          <?php } ?>
        </select>

        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>

</body>
</html>
