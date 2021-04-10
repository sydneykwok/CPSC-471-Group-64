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
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="firstname" placeholder="Your name...">

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lastname" placeholder="Your last name...">

        <label for="ctry">Country:</label>
        <input type="text" id="ctry" name="country" placeholder="Your country...">

        <label for="addr">Address:</label>
        <input type="text" id="addr" name="address" placeholder="The address of interested property...">

        <label for="date">Date:</label>
        <input type="text" id="date" name="address" placeholder="The preferred date of the meeting...">

        <label for="time">Select a Timeslot:</label>
        <select id="time" name="time">
          <option value="9-9:45">9:00am-9:45am</option>
          <option value="10-10:45">10:00am-10:45am</option>
          <option value="11-11:45">11:00am-11:45am</option>
          <option value="12-12:45">12:00pm-12:45pm</option>
          <option value="1-1:45">1:00pm-1:45pm</option>
          <option value="2-2:45">2:00pm-2:45pm</option>
          <option value="3-3:45">3:00pm-3:45pm</option>
          <option value="4-4:45">4:00pm-4:45pm</option>
          <option value="5-5:45">5:00pm-5:45pm</option>
          <option value="6-6:45">6:00pm-6:45pm</option>
        </select>
        
        <label for="subject">Subject:</label>
        <textarea id="subject" name="subject" placeholder="Write an additional message..." style="height:170px"></textarea>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>

</body>
</html>