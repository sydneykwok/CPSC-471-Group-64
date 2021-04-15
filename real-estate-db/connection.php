<?php

// make our connection to the database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";  // ENTER YOUR PASSWORD FROM STEP 1 HERE
$db_name = "real_estate_db";

if (!$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
    die("failed to connect :(");
}

?>
