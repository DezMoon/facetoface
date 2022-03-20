<?php
session_start();
if(!isset($_SESSION["email"])) {
    header("Location: ../../signin-signup.php");
    exit();
}

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'facetoface';

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_SESSION['user_id'])) {
    $sql = mysqli_query($link, "SELECT * FROM user_profile_pic where user_id = '" . $_SESSION['user_id'] . "' ");
    $roww = mysqli_fetch_array($sql);


    if (isset($_REQUEST['upload_image'])) {

        $image_file = isset($_FILES["image"]["name"]);
        $type = isset($_FILES["image"]["type"]);
        $size = isset($_FILES["image"]["size"]);
        $temp = isset($_FILES["image"]["tmp_name"]);

        $path = "../../assets/f2f/upload/" .$image_file; //set upload folder path

        $directory = "../../assets/f2f/upload/";

        if ($image_file) {
            if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') {
                if (!file_exists($path)) {
                    if ($size < 5000000) {
                        unlink($directory . $roww['image']);
                        move_uploaded_file($temp, "../../assets/f2f/upload/" . true);
                    } else {
                        $php_errormsg = "Your File is too large, Please upload an image less than 5MB of size";
                    }
                } else {
                    $php_errormsg = "File already exists. Check Upload folder";
                }
            } else {
                $php_errormsg = "Only images of filetype JPG, JPEG, PNG and GIF are allowed.";
            }
        } else {
            $image_file = isset($roww['image']);
        }

        if(!isset($php_errormsg)) {
            try {
                $uid = $_SESSION['user_id'];
                $update_stmt = mysqli_query($link, "UPDATE user_profile_pic SET image = $image_file WHERE user_id = $uid");

                if ($update_stmt) {
                    $_SESSION['message'] = 'Profile successfully Updated';
                    header("refresh:3;../../profile.php");
                } else {
                    $_SESSION['err_message  '] = "Something went wrong, Please try again";
                    header('Location: ../../profile.php');
                }
            }
            catch (mysqli_sql_exception $e) {
                var_dump($e);
                exit;
            }
        }
    }


    if(isset($_REQUEST['upload_new_image'])){

        $image_file = isset($_FILES["file"]["name"]);
        $type = isset($_FILES["file"]["type"]);
        $size = isset($_FILES["file"]["size"]);
        $temp = isset($_FILES["file"]["tmp_name"]);

        $path = "../../assets/f2f/upload/" .$image_file; //set upload folder path


        if (empty($image_file)){
            $php_errormsg = "Please Select image";
        }
            else if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') {
                if (!file_exists($path)) {
                    if ($size < 5000000) {
                        move_uploaded_file($temp, "../../assets/f2f/upload/" .true);
                    } else {
                        $php_errormsg = "Your File is too large, Please upload an image less than 5MB of size";
                    }
                } else {
                    $php_errormsg = "File already exists. Check Upload folder";
                }
            } else {
                $php_errormsg = "Only images of filetype JPG, JPEG, PNG and GIF are allowed.";
            }

        if(!isset($php_errormsg)) {
            try {
                $uid = $_SESSION['user_id'];
                $query = "INSERT INTO user_profile_pic (user_id, image) VALUES ($uid, $image_file)";
                $upload_pic = mysqli_query($link, $query);

                if ($upload_pic) {
                    $_SESSION['message'] = 'Profile Picture successfully uploaded';
                    header("refresh:3;../../profile.php");
                } else {
                    $_SESSION['err_message  '] = "Something went wrong, Please try again";
                    header('Location: ../../profile.php');
                }
            }
            catch (mysqli_sql_exception $e) {
                var_dump($e);
                exit;
            }
        }
    }
}