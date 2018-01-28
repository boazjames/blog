<?php session_start(); ?>
<?php include 'config/config.php'; ?>
<?php include 'libraries/Database.php'; ?>

<?php include 'helpers/format_helper.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Blog Page</title>

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

        <!-- Header -->
        <header>

            <!-- Nav -->
            <nav id="nav" class="navbar">
                <div class="container">

                    <div class="navbar-header">
                        <!-- Logo -->
                        <div class="navbar-brand">
                            <a href="index.php">
                                <img class="logo" src="img/logo-dark1.png" alt="logo">
                            </a>
                        </div>
                        <!-- /Logo -->

                        <!-- Collapse nav button -->
                        <div class="nav-collapse">
                            <span></span>
                        </div>
                        <!-- /Collapse nav button -->
                    </div>

                    <!--  Main navigation  -->
                    <ul class="main-nav nav navbar-nav navbar-right" id="nav_bar">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php#about">About</a></li>
                        <li><a href="index.php#video">Video</a></li>
                        <li><a href="index.php#team">Team</a></li>
                        <li class="has-dropdown"><a>Blog</a>
                            <ul class="dropdown">
                                <li><a href="index.php#blog">Latest Post</a></li>
                                <li><a href="blog.php">Blog Page</a></li>
                            </ul>
                        </li>
                        <li><a href="index.php#contact">Contact</a></li>
                        <?php if (isset($_SESSION['u_id'])) : ?>
                            <?php
                            $db = new Database();
                            $user_id = $_SESSION['u_id'];
                            $query = "SELECT user_image FROM users WHERE user_id=" . $user_id;
                            $user_img = $db->select($query);
                            if($user_img){
                               $user_img = $db->select($query)->fetch_assoc();
                            }
                            ?>
                        <?php if($user_img['user_image']) : ?>
                        <li id="li_img"><img id="user_nav_img" class="img-responsive img-circle" src="<?php echo $user_img['user_image']; ?>"></li>
                        <?php else : ?>
                        <li id="li_img"><img id="user_nav_img" class="img-responsive img-circle" src="./user_images/user.jpg"></li>
                        <?php endif; ?>
                            <li id="menu">
                                <button id="menu-btn" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><strong>Menu</strong></button>
                                <ul class="dropdown-menu"> 
                                    <li class="active"> <a><i class="fa fa-user-circle"></i> <?php echo $_SESSION['u_uid']; ?></a> </li> 
                                    <li> <a id="upload" href="" data-action-type="upload" data-user-id="<?php echo $_SESSION['u_id']; ?>"><i class="fa fa-image"></i> Upload Image</a> </li>
                                    <li> <a> 
                                            <form action="./processors/logout.php" method="post" >
                                                <i class="fa fa-sign-out"></i><input id="logout-btn" class="btn-default" name="submit" type="submit" value="Logout">
                                                <input class="hidden" name="id" type="text" value="<?php echo $id; ?>">
                                            </form>
                                        </a></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li><a href="login.php?id=<?php echo $id; ?>">Login</a></li>
                            <li><a href="signup.php">Signup</a></li>
                        <?php endif; ?>
                    </ul>
                    <!-- /Main navigation -->

                </div>
            </nav>
            <!-- /Nav -->

            <!-- header wrapper -->
            <div class="header-wrapper sm-padding bg-grey">
                <div class="container">
                    <h2>Blog Page</h2>

                </div>
            </div>
            <!-- /header wrapper -->

        </header>
        <!-- /Header -->