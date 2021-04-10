<?php

// check if there is a user logged in (i.e., whether email value is set for the session)
function check_login($conn) {
    
    // if the email value is set for the session...
    if (isset($_SESSION['Email'])) {
        // check that the email really exists in our database by creating a query:
        $email = $_SESSION['Email'];
        // first check if user is an agent
        $query = "select * from real_estate_agent where Email = '$email' limit 1";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0) {
            // good to go. collect & return this user data. (note: assoc = associative array)
            $user_data = mysqli_fetch_assoc($result);
            // return the user's data
            return $user_data;
        }

        // if not an agent, then check if they're a buyer/seller
        $query = "(select * from buyer where Email = '$email') UNION ALL (select * from seller where Email = '$email') limit 1";
        $result = mysqli_query($conn, $query);

        // check if the result is positive & num of rows of result > 0
        if($result && mysqli_num_rows($result) > 0) {
            // good to go. collect & return this user data. (note: assoc = associative array)
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