<?php
require('assets/php/config.php');
include("assets/php/auth_session.php");

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | facetoface</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymouse"></script>

    <!--Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

</head>
<body>


<?php
if(isset($_SESSION['email'])){

    $query = "SELECT firstname, lastname FROM users WHERE email= '".$_SESSION['email']."'";

    $result = mysqli_query($link, $query) or

    die(mysqli_error($link));

    ?>

    <nav>
        <div class="nav-left">
            <a href="home.php"> <img src="assets/images/logo.png" class="logo" alt=""> </a>
            <ul>
                <li><a href="#"><img src="assets/images/notification.png" alt=""></a></li>
                <li><a href="#"><img src="assets/images/inbox.png" alt=""></a></li>
                <li><a href="#"><img src="assets/images/video.png"></a></li>
            </ul>
        </div>
        <div class="nav-right">

            <div class="search-box">
                <img src="assets/images/search.png">
                <input type="text" placeholder="search">
            </div>
            <div class="nav-user-icon online"onclick="SettingsMenuToggle()">
                <img src="assets/images/profile-pic.png">
            </div>

        </div>
        <!---------settings-menu------------->
        <div class="settings-menu">

            <div id="dark-btn">
                <span></span>
            </div>
            <div class="settings-menu-inner">
                <div class="user-profile">
                    <?php

                    $image = 'assets/images/user.png';


                    $sql=mysqli_query($link,"SELECT * FROM user_profile_pic where user_id = '".$_SESSION['user_id']."' ");
                    $roww  = mysqli_fetch_array($sql);
                    $file = isset($roww['image']);

                    if (file_exists('assets/f2f/upload/<?php echo $file ?>')){

                        $image = 'assets/f2f/upload/<?php echo $file ?>';


                        ?>
                        <img src="assets/f2f/upload/<?php echo $image?>"  alt=""/>

                        <?php
                    }
                    ?>

                    <div>
                        <p><?php while($row = mysqli_fetch_array($result)){

                                echo $row['firstname']." ".$row['lastname'];

                            } ?></p>

                        <a href="profile.php">See your profile</a>
                    </div>
                </div>
                <hr>
                <div class="user-profile">
                    <img src="assets/images/feedback.png">
                    <div>
                        <p>Give Feedback</p>
                        <a href="#">Help us to improve the new Design</a>
                    </div>
                </div>
                </hr>
                <div class="settings-links">
                    <img src="assets/images/setting.png" class="settings-icon">
                    <a href="#">Settings & privacy <img src="assets/images/arrow.png"
                                                        width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="assets/images/help.png" class="settings-icon">
                    <a href="#">Help & support <img src="assets/images/arrow.png"
                                                    width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="assets/images/Display.png" class="settings-icon">
                    <a href="#">Display & Accessibility <img src="assets/images/arrow.png"
                                                             width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="assets/images/logout.png" class="settings-icon">
                    <a href="assets/php/logout.php">logout <img src="assets/images/arrow.png"
                                                                width="10px"></a>
                </div>

            </div>
        </div>

    </nav>
    <?php
}
?>

<div class="container">
<div class="left-sidebar">
    <p>left side bar</p>
</div>

<!---------main-content------------->
<div class="main-containt">
    <?php

    $image = 'assets/images/user.png';


    $sql=mysqli_query($link,"SELECT * FROM user_profile_pic where user_id = '".$_SESSION['user_id']."' ");
    $roww  = mysqli_fetch_array($sql);
    $file = isset($roww['image']);

    if (file_exists('assets/f2f/upload/<?php echo $file ?>')){

    $image = 'assets/f2f/upload/<?php echo $file ?>';

    ?>

    <form action="assets/user_profile/update_profile.php" method="post">
        <div class="form-group">
            <label>File</label>
            <input type="file" name="image" value="<?php echo $image; ?>">
            <p><img src="assets/f2f/upload/<?php echo $image; ?>" width="100" height="100"></p>
        </div>

        <div class="form-group">
            <input  type="submit" class="dtn btn-primary" name="image_upload" value="Upload" />
        </div>
    </form>


    <?php
    }
    ?>
</div>

<div class="right-sidebar">
    <p>right side bar</p>
</div>
</div>

<div class="footer">
    <p>Copyright 2022-facetoface Social Media app</p>
</div>

<script src="assets/js/script.js"></script>

</body>
</html>