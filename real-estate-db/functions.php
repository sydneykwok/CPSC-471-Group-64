<?php

// check if a user is logged in
// check whether session id (email) is set
function check_login($conn) {
    
    // check if session value is set
    // checking if inside session there is a user id
    // if that user id exists...if this value is set
    // reading..checking if session value exists
    // checking if this value is set in the session
    // if this value is unset, then we're logged out
    if (isset($_SESSION['Email'])) {
        // check if it's really in our database
        // if session value exists, check if it's real
        $email = $_SESSION['Email'];
        // check in the database by creating a query: 
        // only querying buyers right now...will need to UNION with seller later !!!!!!!!!!!!!11
        $query = "select * from buyer where Email = '$email' limit 1";
        
        // now read from the db
        $result = mysqli_query($conn, $query);
        // check if the result is positive & num of rows of result > 0
        if($result && mysqli_num_rows($result) > 0) {
            // if session value is real, return user's data. if it's not, redirect.
            // good to go. collect this data we got.
            // assoc = associative array. featch the associate array
            $user_data = mysqli_fetch_assoc($result);
            // return the user's data
            return $user_data;
        }
    }

    // if session value does not exist or is not real, redirect to login page
    header("Location: login.php");
    die; // die so that the code doesn't continue
}

?>