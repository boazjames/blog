<?php include 'config/config.php'; ?>
<?php include 'libraries/Database.php'; ?>
<?php session_start(); ?>
<?php include 'helpers/format_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Verify</title>
        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

        <!-- Owl Carousel -->
        <link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
        <link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />

        <!-- Magnific Popup -->
        <link type="text/css" rel="stylesheet" href="css/magnific-popup.css" />

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />

    </head>

    <body>
        <div class="container">
        <?php if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) : ?>
    <?php 
    $db=new Database();
    $email = mysqli_real_escape_string($db->link,$_GET['email']);
    $hash = mysqli_real_escape_string($db->link,$_GET['hash']);
    $query="SELECT user_email, active, hash FROM users WHERE user_email='".$email."' AND hash='".$hash."' AND active='0'";
    $verify=$db->select($query);
    ?>
    <?php if($verify) : ?>
    <?php
    $query="UPDATE users SET active='1' WHERE user_email='".$email."' AND hash='".$hash."' AND active='0'";
    $update_row=$db->update($query);
    ?>
    <div id="verify_div" class="alert alert-success">
        You've successfully verified your account.You can now <a href="./login_blog.php">Log in</a>. 
    </div>
    <?php endif; ?>
    <?php else : ?>
    <div id="verify_div" class=" alert alert-danger">
        The activation link is either invalid or you had activated your account. <a href="./login_blog.php">Log in</a>
    </div>
    <?php endif; ?>
        </div>
        <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>

