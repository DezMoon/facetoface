<?php
// Initialize the session
session_start();

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
const DB_SERVER = 'localhost';
const DB_email = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'facetoface';

/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_email, DB_PASSWORD, DB_NAME);

// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


// When form submitted, check and create user session.
if (isset($_POST['email'])) {
    $email = stripslashes($_REQUEST['email']);    // removes backslashes
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    // Check user is exist in the database
    $query    = "SELECT * FROM users WHERE email='$email'
                     AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);

    if (empty($email) && empty($password)) {

        $_SESSION['err_message'] = 'Please provide email and password to continue';
        header("Location: ../../signin-signup.php");
    }
    else {

        if ($rows == 1) {
            $row=mysqli_fetch_assoc( $result );

            $user_id = $row['user_id'];

            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $user_id;
            // Redirect to user home page
            header("Location: ../../home.php");
        } else {

            $_SESSION['err_message'] = 'Incorrect email or password. Please try again.';
            header("Location: ../../signin-signup.php");
        }
    }
}