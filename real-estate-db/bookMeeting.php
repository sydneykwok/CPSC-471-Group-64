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
    $agent = $_POST['agent'];
    $date = $_POST['datepicker'];
    $time = $_POST['time'] . ":00:00";
    $tour = $_POST['tour'];
    $property = $_POST['property'];
    $message = $_POST['subject'];
    $b_email = $user_data['Email'];

    if (!empty($date)) {
      if (!empty($tour)) {
        // add the meeting to the online_meeting relation
        $query = "insert into online_meeting (Agent_ID, Date, Time, B_Email, Message) values ('$agent', '$date', '$time', '$b_email', '$message')";
        mysqli_query($conn, $query);
        // get the meeting id of the meeting that was just created in the db
        $meeting_id = mysqli_insert_id($conn);

        if ($tour == "y") {
          // if the user wants a tour, add it to the tour relation
          $query = "insert into tour (Property_ID, Agent_ID) values ('$property', '$agent')";
          mysqli_query($conn, $query);
          // get the tour id of the tour that was just created in the db
          $tour_id = mysqli_insert_id($conn);
          // & add this info to the online_meeting_has_tour relation
          $query = "insert into online_meeting_has_tour (Tour_ID, Meeting_ID) values ('$tour_id', '$meeting_id')";
          mysqli_query($conn, $query);  
        }

        echo "Success!";
      } else {
        echo "Please select whether or not you would like a tour.";
      }
    } else {
      echo "Please choose a date.";
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
    <p>Leave us a message to book an appointment for an online meeting.</p>
    <p>Please note the address of the property that you wish to book a meeting for inquiries on.</p>
  </div>
  <div class="row">
    <div class="column">
      <img src="images/zoom.png" style="width:100%">
    </div>
    <div class="column">
      <form method="post">
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

        <label for="datelabel">Date:</label>
        <input type="date" id="start" name="datepicker" min="2021-04-11" max="2022-04-30"></br></br>

        <label for="timelabel">Time:</label>
        <select id="time" name="time">
          <option value="09">9:00am</option>
          <option value="10">10:00am</option>
          <option value="11">11:00am</option>
          <option value="12">12:00pm</option>
          <option value="13">1:00pm</option>
          <option value="14">2:00pm</option>
          <option value="15">3:00pm</option>
          <option value="16">4:00pm</option>
          <option value="17">5:00pm</option>
          <option value="18">6:00pm</option>
        </select>

        <label for="propertylabel">Property ID:</label>
        <?php 
          // for each property in the property table, add its id as an option
          $query = "select Property_ID from property";
          $result = mysqli_query($conn, $query);
        ?>
        <select id = "property" name="property">
          <?php while($option = mysqli_fetch_assoc($result)){ ?>
            <option value="<?php echo $option['Property_ID']; ?>"><?php echo $option['Property_ID']; ?></option>
          <?php } ?>
        </select>

        <label>Would you like the meeting to include a tour? </label> 
				<input id="radbtn" type="radio" name="tour" value="y"/>Yes
				<input id="radbtn" type="radio" name="tour" value="n"/>No</br></br>

        <label for="subject">Subject:</label>
        <textarea id="subject" name="subject" placeholder="Write an additional message..." style="height:170px"></textarea>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>

</body>
</html>