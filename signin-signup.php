<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | FacatoFace</title>

    <link rel="stylesheet" href="assets/css/login.css">

    <!--Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

</head>
<body>

<img src="assets/images/logo%20green.png" alt="logo"/>


<h2>Sign in or Sign up to continue.</h2>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="assets/php/register.php" method="post">
            <h1>Create Account</h1>
            <!--<div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div> -->
            <span>use your email for registration</span>
            <input type="text" name="firstname" placeholder="First Name" class="form-control" required />
            <input type="text" name="lastname" placeholder="Last Name" class="form-control" required/>
            <input type="email" name="email" placeholder="Email" class="form-control" required/>

            <input type="password" name="password" placeholder="Password" class="form-control" required/>

            <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required/>

            <br/>
            <label>Gender</label>
            <label>
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="Rather not say">Rather not say</option>
                </select>
            </label>

            <br/>
            <label>Birthday</label>
            <label>
                <input type="date" name="birthday" placeholder="Birthday" required/>
            </label>
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="assets/php/login.php" method="post">

        <div class="message">
            <?php
            if(isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
        </div>

            <br/>

            <h1>Sign in</h1>
            <!-- <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div> -->
            <span>use your account</span>

            <br/>

            <div class="err_message">
            <?php
            if(isset($_SESSION['err_message'])) {
                echo $_SESSION['err_message'];
                unset($_SESSION['err_message']);
            }
            ?>
            </div>

            <br/>

            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />
            <a href="#">Forgot your password?</a>
            <button>Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>
        &copy; FacetoFace 2022. All rights reserved.
        Powered by
        <a target="_blank" href="#">VizionIT Zambia</a>
    </p>
</footer>

<script src="assets/js/login.js"></script>
</body>
</html>