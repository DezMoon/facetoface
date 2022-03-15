<?php
// START THE SESSION
session_start();

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
const DB_SERVER = 'localhost';
const DB_email = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'facetoface';

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_email, DB_PASSWORD, DB_NAME);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// When form submitted, insert values into the database.
if (isset($_REQUEST['email'])) {
    // removes backslashes
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $firstname = stripslashes($_REQUEST['firstname']);
    $firstname = mysqli_real_escape_string($conn, $firstname);
    $lastname = stripslashes($_REQUEST['lastname']);
    $lastname = mysqli_real_escape_string($conn, $lastname);
    $birthday = stripslashes($_REQUEST['birthday']);
    $birthday = mysqli_real_escape_string($conn, $birthday);
    //$create_datetime = date("Y-m-d H:i:s");


        $query = "INSERT into users (email, password, firstname, lastname, birthday)
                     VALUES ('$email', '" . md5($password) . "', '$firstname', '$lastname', '$birthday')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['message'] = 'You have successfully registered. Login to continue';
        }

}
header("Location: ../../signin-signup.php");

