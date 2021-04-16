<?php
// on every page where you want to use the session (check if user is logged in), have to put session_start().
session_start();
  // include the files we need
  include("connection.php");	// for use of $conn
  include("functions.php");	// for use of check_login()

  // collect user data in user_data variable
  $user_data = check_login($conn);	

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //property: Property_ID, Address, Neighbourhood, City, Zip_Code, Estimated_Value, Square_Footage, Num_Beds, Num_Baths, S_Email
    $prop_type = $_POST['prop_type'];
    $address = $_POST['address'];
    $neighbourhood = $_POST['neighbourhood'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $value = $_POST['value'];
    $footage = $_POST['footage'];
    $num_beds = $_POST['bed'];
    $num_baths = $_POST['bath'];
    $s_email = $user_data['Email'];

    if (!empty($prop_type)) {
      if (!empty($address)) {
        if (!empty($neighbourhood)) {
          if (!empty($city)) {
            if (!empty($zip)) {
              if (!empty($value)) {
                if (!empty($footage)) {
                  if (!empty($num_beds)) {
                    if (!empty($num_baths)) {
                      // add the property details to the property relation 
                      $query = "insert into property (Address, Neighbourhood, City, Zip_Code, Estimated_Value, Square_Footage, Num_Beds, Num_Baths, S_Email) values ('$address', '$neighbourhood', '$city', '$zip', '$value', '$footage', '$num_beds', '$num_baths', '$s_email')";
                      mysqli_query($conn, $query);
                      // get the property id of the property that was just created in the db
                      $prop_id = mysqli_insert_id($conn);
                      // add the property id to commercial or residential property table based on selection
                      if ($prop_type=="com") {
                        $query = "insert into commercial_property (Property_ID) values ('$prop_id')";
                        mysqli_query($conn, $query);
                      } else {
                        $query = "insert into residential_property (Property_ID) values ('$prop_id')";
                        mysqli_query($conn, $query);
                      }
                      // give success response
				              header("HTTP/1.0 200 OK");
                      // write success confirmation message
                      echo "Success! We will now upload your property details to the site for sale.";
                      //echo $prop_type . "</br>" . $address . "</br>" . $neighbourhood . "</br>" . $city . "</br>" . $zip . "</br>" . $value . "</br>" . $footage . "</br>" . $num_beds . "</br>" . $num_baths;
                    } else {
                      echo "Please enter the number of bathrooms in the property you would like to sell.";
                      // give client error response 400 Bad Request
		                  header("HTTP/1.0 400 Bad Request");
                    }
                  } else {
                    "Please enter the number of bedrooms in the property you would like to sell.";
                    // give client error response 400 Bad Request
		                header("HTTP/1.0 400 Bad Request");
                  }
                } else {
                  echo "Please enter the square footage for the property you would like to sell.";
                  // give client error response 400 Bad Request
		              header("HTTP/1.0 400 Bad Request");
                }
              } else {
                echo "Please enter a price for the property you would like to sell.";
                // give client error response 400 Bad Request
		            header("HTTP/1.0 400 Bad Request");
              }
            } else {
              echo "Please enter a ZIP code for the property you would like to sell.";
              // give client error response 400 Bad Request
		          header("HTTP/1.0 400 Bad Request");
            }
          } else {
            echo "Please enter a city for the property you would like to sell.";
            // give client error response 400 Bad Request
		        header("HTTP/1.0 400 Bad Request");
          }
        } else {
          echo "Please enter a neighbourhood for the property you would like to sell.";
          // give client error response 400 Bad Request
		      header("HTTP/1.0 400 Bad Request");
        }
      } else {
        echo "Please enter an address for the property you would like to sell.";
        // give client error response 400 Bad Request
		    header("HTTP/1.0 400 Bad Request");
      }
    } else {
      echo "Please select whether the property you would like to sell is commercial or residential.";
      // give client error response 400 Bad Request
		  header("HTTP/1.0 400 Bad Request");
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
        <label for="prop_type">Property Type:</label> 
				<input id="radbtn" type="radio" name="prop_type" value="res"/>Residential
				<input id="radbtn" type="radio" name="prop_type" value="com"/>Commercial
        </br></br>

        <label for="addr">Address:</label>
        <input type="text" id="addr" name="address" placeholder="The address of the property..."></br></br>

        <label for="neighbour">Neighbourhood:</label>
        <input type="text" id="neighbour" name="neighbourhood" placeholder="The neighbourhood of the property..."></br></br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" placeholder="The city of the property..."></br></br>

        <label for="zip">Zip Code:</label>
        <input type="text" id="zip" name="zip" placeholder="The ZIP code of the property..."></br></br>

        <label for="val">Estimated Value:</label>
        <input type="text" id="val" name="value" placeholder="The estimated value of the property..."></br></br>

        <label for="sqfoot">Square Footage:</label>
        <input type="text" id="sqfoot" name="footage" placeholder="The square footage of the property..."></br></br>

        <label for="bed">Number of Bedrooms:</label>
        <input type="text" id="beds" name="bed" placeholder="The number of bedrooms in the property..."></br></br>

        <label for="bath">Number of Bathrooms:</label>
        <input type="text" id="baths" name="bath" placeholder="The number of bathrooms in the property..."></br></br>

        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>

</body>
</html>
