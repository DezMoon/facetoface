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
    <title>Home | facetoface</title>
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
if(isset($_SESSION['user_id'])) {

    $query = "SELECT * FROM user_profile_pic WHERE user_id = '".$_SESSION['user_id']."'";

    $result = mysqli_query($link, $query) or

    die(mysqli_error($link));

?>

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
  <!---------left-sidebar------------->
  <div class="left-sidebar">
  <div class="imp-links">
  <a href="#"><img src="assets/images/news.png"> Letest news</a>
  <a href="#"><img src="assets/images/friends.png"> Friends</a>
  <a href="#"><img src="assets/images/group.png"> Group</a>
  <a href="#"><img src="assets/images/marketplace.png">Marketplace</a>
  <a href="#"><img src="assets/images/watch.png">watch</a>
  <a href="#">See More</a>
  </div>
  <div class="shortcut-link">
  <p>Your Shortcuts</p>
  <a href="#"><img src="assets/images/shortcut-1.png"> Web Developers</a>
  <a href="#"><img src="assets/images/shortcut-2.png"> Web Design course</a>
  <a href="#"><img src="assets/images/shortcut-3.png"> Full Stack Development</a>
  <a href="#"><img src="assets/images/shortcut-4.png"> Website Experts</a>
 
   </div>
  </div>
  <!---------main-content------------->
  <div class="main-containt">
     
     <div class="story-gallery">
       <div class="story story1">
         <img src="assets/images/upload.png">
         <p>Post Story</p>
       </div>
         <div class="story story2">
         <img src="assets/images/member-1.png">
         <p>Alison</p>
       </div>
        <div class="story story3">
         <img src="assets/images/member-2.png">
         <p>Jackson</p>
       </div>
        <div class="story story4">
         <img src="assets/images/member-3.png">
         <p>Samona</p>
       </div>
        <div class="story story5">
         <img src="assets/images/member-4.png">
         <p>John Doe</p>
       </div>
     </div>
     <div class="write-post-container">
       <div class="user-profile">
         <img src="assets/images/profile-pic.png">
         <div>
           <p>John Nicolson</p>
           <small>Public <i class="fas fa-caret-down"></i></small>
         </div>
       </div>

       <div class="Post-input-container">
           <label>
               <textarea rows="3" placeholder="what are you thinking about,john"></textarea>
           </label>
           <div class="add-post-link">
          <a href="#"><img src="assets/images/live-video.png">live Video</a>
          <a href="#"><img src="assets/images/photo.png">Photo Video</a>
          <a href="#"><img src="assets/images/feeling.png">feeling/Activity</a>

       </div>
     </div>
   </div>

    <div class="post-container">
      <div class="post-row">
       <div class="user-profile">
         <img src="assets/images/profile-pic.png">
         <div>
             <p>John Nicolson</p>
             <span>Jun 24 2022,13:40 pm</span>
         </div>
       </div>
       <a href="#"><i class="fas fa-ellipsis-v"></i></a>
       </div>
       <p class="post-text">facetoface<span> let,s get together</span> with all over the world and make <a href="#">friends on </a> <a href="#">facetoface</a></p>
       <img src="assets/images/feed-image-1.png" class="post-img">

       <div class="post-row">
         <div class="Activity-icons">
          <div><img src="assets/images/like-blue.png">120</div>
          <div><img src="assets/images/comments.png">45</div>
          <div><img src="assets/images/share.png">20</div>
         </div>
         <div class="post-profile-icon">
          <img src="assets/images/profile-pic.png"> <i class="fas fa-caret-down"></i>
         </div>
       </div>
     </div>

     <div class="post-container">
      <div class="post-row">
       <div class="user-profile">
         <img src="assets/images/profile-pic.png">
         <div>
             <p>John Nicolson</p>
             <span>Jun 24 2022,13:40 pm</span>
         </div>
       </div>
       <a href="#"><i class="fas fa-ellipsis-v"></i></a>
       </div>
       <p class="post-text">facetoface please like and share this app with all your friends (facebook page)ask any doubt on this app <span> let,s get together</span> with all over the world and make <a href="#">friends on </a> <a href="#">facetoface</a></p>
       <img src="assets/images/feed-image-2.png" class="post-img">

       <div class="post-row">
         <div class="Activity-icons">
          <div><img src="assets/images/like.png">120</div>
          <div><img src="assets/images/comments.png">45</div>
          <div><img src="assets/images/share.png">20</div>
         </div>
         <div class="post-profile-icon">
          <img src="assets/images/profile-pic.png"> <i class="fas fa-caret-down"></i>
         </div>
       </div>
     </div>
     
       <div class="post-container">
      <div class="post-row">
       <div class="user-profile">
         <img src="assets/images/profile-pic.png">
         <div>
             <p>John Nicolson</p>
             <span>Jun 24 2022,13:40 pm</span>
         </div>
       </div>
       <a href="#"><i class="fas fa-ellipsis-v"></i></a>
       </div>
       <p class="post-text">facetoface please like and share this app with all your friends (facebook page)ask any doubt on this app <span> let,s get together</span> with all over the world and make <a href="#">friends on </a> <a href="#">facetoface</a></p>
       <img src="assets/images/feed-image-3.png" class="post-img">

       <div class="post-row">
         <div class="Activity-icons">
          <div><img src="assets/images/like.png">120</div>
          <div><img src="assets/images/comments.png">45</div>
          <div><img src="assets/images/share.png">20</div>
         </div>
         <div class="post-profile-icon">
          <img src="assets/images/profile-pic.png"> <i class="fas fa-caret-down"></i>
         </div>
       </div>
     </div>

      <div class="post-container">
      <div class="post-row">
       <div class="user-profile">
         <img src="assets/images/profile-pic.png">
         <div>
             <p>John Nicolson</p>
             <span>Jun 24 2022,13:40 pm</span>
         </div>
       </div>
       <a href="#"><i class="fas fa-ellipsis-v"></i></a>
       </div>
       <p class="post-text">facetoface please like and share this app with all your friends (facebook page)ask any doubt on this app <span> let,s get together</span> with all over the world and make <a href="#">friends on </a> <a href="#">facetoface</a></p>
       <img src="assets/images/feed-image-3.png" class="post-img">

       <div class="post-row">
         <div class="Activity-icons">
          <div><img src="assets/images/like.png">120</div>
          <div><img src="assets/images/comments.png">45</div>
          <div><img src="assets/images/share.png">20</div>
         </div>
         <div class="post-profile-icon">
          <img src="assets/images/profile-pic.png"> <i class="fas fa-caret-down"></i>
         </div>
       </div>
     </div>

      <div class="post-container">
      <div class="post-row">
       <div class="user-profile">
         <img src="assets/images/profile-pic.png">
         <div>
             <p>John Nicolson</p>
             <span>Jun 24 2022,13:40 pm</span>
         </div>
       </div>
       <a href="#"><i class="fas fa-ellipsis-v"></i></a>
       </div>
       <p class="post-text">facetoface please like and share this app with all your friends (facebook page)ask any doubt on this app <span> let,s get together</span> with all over the world and make <a href="#">friends on </a> <a href="#">facetoface</a></p>
       <img src="assets/images/feed-image-4.png" class="post-img">

       <div class="post-row">
         <div class="Activity-icons">
          <div><img src="assets/images/like.png">120</div>
          <div><img src="assets/images/comments.png">45</div>
          <div><img src="assets/images/share.png">20</div>
         </div>
         <div class="post-profile-icon">
          <img src="assets/images/profile-pic.png"> <i class="fas fa-caret-down"></i>
         </div>
       </div>
     </div>

      <div class="post-container">
      <div class="post-row">
       <div class="user-profile">
         <img src="assets/images/profile-pic.png">
         <div>
             <p>John Nicolson</p>
             <span>Jun 24 2022,13:40 pm</span>
         </div>
       </div>
       <a href="#"><i class="fas fa-ellipsis-v"></i></a>
       </div>
       <p class="post-text">facetoface please like and share this app with all your friends (facebook page)ask any doubt on this app <span> let,s get together</span> with all over the world and make <a href="#">friends on </a> <a href="#">facetoface</a></p>
       <img src="assets/images/feed-image-5.png" class="post-img">

       <div class="post-row">
         <div class="Activity-icons">
          <div><img src="assets/images/like.png">120</div>
          <div><img src="assets/images/comments.png">45</div>
          <div><img src="assets/images/share.png">20</div>
         </div>
         <div class="post-profile-icon">
          <img src="assets/images/profile-pic.png"> <i class="fas fa-caret-down"></i>
         </div>
       </div>
     </div>
    <button type="button" class="load-more-btn">Load More</button>
     </div>
  <!---------right-sidebar------------->
      <div class="right-sidebar">
       
          <div class="sidebar-title">
        <h4>Events</h4>
        <a href="#">See All</a>
        </div>

      <div class="event">
        <div class="left-event">
          <h3>26</h3>
          <span>Janury</span>
        </div>
        <div class="right-event">
          <h4>Social Media</h4>
          <p><i class="fas fa-map-marker-alt"></i> New York</p>
          <a href="#">More Info</a>
        </div>
      </div>
     <div class="event">
        <div class="left-event">
          <h3>22</h3>
          <span>Jun</span>
        </div>
        <div class="right-event">
          <h4>Mobile Marketing</h4>
          <p><i class="fas fa-map-marker-alt"></i> New York</p>
          <a href="#">More Info</a>
        </div>
    </div>
     <div class="sidebar-title">
        <h4>Advertisement</h4>
        <a href="#">Close</a>
   </div>
   <img src="assets/images/Advertisement.png" class="sidebar-ads">

   <div class="sidebar-title">
        <h4>Conversation</h4>
        <a href="#">Hide Chat</a>
   </div>
   
   <div class="online-list">
    <div class="online">
      <img src="assets/images/member-1.png">
    </div>
    <p>Alison Mina</p>
  </div>
  <div class="online-list">
    <div class="online">
      <img src="assets/images/member-2.png">
    </div>
    <p>Jackson Aston</p>
  </div>
<div class="online-list">
    <div class="online">
      <img src="assets/images/member-3.png">
    </div>
    <p>Samona Rose</p>
  </div>
 </div>
</div>

<div class="footer">
<p>Copyright 2022-facetoface Social Media app</p>
</div>

<script src="assets/js/script.js"></script>

<?php
}
?>
</body>
</html>