<?php include 'config/config.php'; ?>
<?php include 'libraries/Database.php'; ?>
<?php session_start(); ?>
<?php include 'helpers/format_helper.php'; ?>
<?php
$db=new Database();
$query="SELECT * FROM videos ORDER BY id DESC LIMIT 1";
$video=$db->select($query);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113425356-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113425356-1');
</script>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>KiddNation254</title>
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
        <header id="home">
            <!-- Background Image -->
            <div class="bg-img" style="background-image: url('img/IMG2.png');">
                    <div class="overlay"></div>
            </div>
            <!-- /Background Image -->

            <!-- Nav -->
            <nav id="nav" class="navbar nav-transparent">

                <div class="container">

                    <div class="navbar-header">
                        <!-- Logo -->
                        <div class="navbar-brand">
                            <a href="index.php">
                                <img class="logo" src="img/logo-dark1.png" alt="logo">
                                <img class="logo-alt" src="img/logo3.png" alt="logo">
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
                    <ul class="main-nav nav navbar-nav navbar-right">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#video">Video</a></li>
                        <li><a href="#team">Team</a></li>
                        <li class="has-dropdown"><a>Blog</a>
                            <ul class="dropdown">
                                <li><a href="#blog">Latest Post</a></li>
                                <li><a href="blog.php">Blog Page</a></li>
                            </ul>
                        </li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <!-- /Main navigation -->

                </div>
            </nav>
            <!-- /Nav -->
            
            <!-- home wrapper -->
            <div class="home-wrapper">
                <div class="container">
                    <div class="row">

                        <!-- home content -->
                        <div class="col-md-10 col-md-offset-1">
                            <div class="home-content">
                                <h1 class="white-text">This is KiddNation254</h1>
                                <h3 class="white-text">A place worth being.
                                </h3>
                                <a href="#about" id="get_started"><button class="main-btn btn-lg">Get Started!</button></a>
                                <!--<button class="main-btn">Learn more</button>-->

                            </div>
                        </div>

                        <!-- /home content -->

                    </div>
                </div>
            </div>
            <!-- /home wrapper -->

        </header>
        <!-- /Header -->

        <!-- About -->
        <div id="about" class="section md-padding">
            <!-- Background Image -->
            <!--<div class="bg-img" style="background-image: url('img/img27.jpg');">
                    <div class="overlay"></div>
            </div>-->
            <!-- Container -->
            <div class="container">

                <!-- Row -->
                <div class="row">

                    <!-- Section header -->
                    <div class="section-header text-center">
                        <h2 class="title">Welcome to KiddNation254</h2>
                    </div>
                    <!-- /Section header -->

                    <!-- about -->
                    <div class="col-md-4 col-sm-6 col-lg-4">
                        <div class="about">
                            <img class="img-responsive" id="about_img" src="img/entertainment2.png">
                            <br>
                            <h3>Entertainment</h3>
                            <p>
                                        KiddNation254 is focused in making the Kenyan entertainment industry more
                                        dynamic than ever before. Kenyan Industry should be internationally recognized 
                                        as one of the best entertainment industries in the world.
                                    </p>
                        </div>
                    </div>
                    <!-- /about -->

                    <!-- about -->
                    <div class="col-md-4 col-sm-6 col-lg-4">
                        <div class="about">
                            <img class="img-responsive" id="about_img" src="img/range2.png">
                            <br>
                            <h3>Dreams</h3>
                            <p>
                                        KiddNation254 brings you closer to your dreams than you've ever been.
                                        With inspirations and motivational writings, facts about life,
                                        long dream and how to get to them.
                                    </p>
                        </div>
                    </div>
                    <!-- /about -->

                    <!-- about -->
                    <div class="col-md-4 col-sm-6 col-lg-4">
                        <div class="about">
                            <img class="img-responsive" id="about_img" src="img/sports.png">
                            <br>
                            <h3>Talent</h3>
                            <p>
                                       You have a talent you want to nurture it? KiddNation254 is the place to be. 
                                       We help you to work on your talent and make your dreams come true.
                                    </p>
                        </div>
                    </div>
                    <!-- /about -->

                    <!-- about -->
                    <div class="col-md-4 col-sm-6 col-lg-4">
                        <div class="about">
                            <img class="img-responsive" id="about_img" src="img/career.png">
                            <br>
                            <h3>Career</h3>
                            <p>
                                        Careers are long life commitments. We, KiddNation254 want to help you get into
                                        the right and satisfying career. We want to make you comfortable where you are 
                                        with facts on career choices and career development. So side with us folks.
                                    </p>
                        </div>
                    </div>
                    <!-- /about -->

                    <!-- about -->
                    <div class="col-md-4 col-sm-6 col-lg-4">
                        <div class="about">
                            <img class="img-responsive" id="about_img" src="img/life-skill.png">
                            <br>
                            <h3>Life skills</h3>
                            <p>
                                We all need life skills on how to deal with our day to day hustles. Life 
                                <b>ni ujanja</b>. Our team gives you the opportunity to learn from us and 
                                other great figures of life skills.
                                    </p>
                        </div>
                    </div>
                    <!-- /about -->



                    <!-- about -->
                    <div class="col-md-4 col-sm-6 col-lg-4">
                        <div class="about">
                            <img class="img-responsive" id="about_img" src="img/education.png">
                            <br>
                            <h3>Education</h3>
                            <p>
                                Every aspect of life is educational. KiddNation254 gives you a first hand 
                                opportunity to learn from its many aspects. Our blog posts are as much as 
                                educational as they are entertaining. Knowledge is power.
                            </p>
                        </div>
                        
                    </div>
                    <!-- /about -->




                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

        </div>
        <!-- /About -->

        <!-- Service -->
        <div id="video" class="section md-padding">

            <!-- Container -->
            <div class="container">

                <!-- Row -->
                <div class="row text-center">

                    <!-- Section header -->
                    <div class="section-header text-center">
                        <h2 class="title">Latest Video</h2>
                    </div>
                    <!-- /Section header -->
                    <?php if($row=$video->fetch_assoc()) : ?>
                    <div>
                        <iframe width="1280" height="720" src="https://www.youtube.com/embed/<?php echo $row['iframe']; ?>?VQ=HD720" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        
                        <h4 id="video_title"><b><?php echo $row['title']; ?></b></h4>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

        </div>
        <!-- /Service -->


        <!-- Why Choose Us -->
        <div id="features" class="section md-padding bg-grey">

            <!-- Container -->
            <div class="container">

                <!-- Row -->
                <div class="row">

                    <!-- why choose us content -->
                    <div class="col-md-6">
                        <div class="section-header">
                            <h2 class="title">Why KiddNation254</h2>
                        </div>
                        <p>
                            Give KiddNation254 a try, you won't regret it. We give you a bunch of reasons to join and stick with us:
                        </p>
                        <div class="feature">
                            <i class="fa fa-check"></i>
                            <p>Entertains you to your satisfaction.</p>
                        </div>
                        <div class="feature">
                            <i class="fa fa-check"></i>
                            <p>Equips youths with life skills.</p>
                        </div>
                        <div class="feature">
                            <i class="fa fa-check"></i>
                            <p>Motivates discouraged individuals.</p>
                        </div>
                        <div class="feature">
                            <i class="fa fa-check"></i>
                            <p>Leads people on how to develop their career.</p>
                        </div>
                    </div>
                    <!-- /why choose us content -->

                    <!-- About slider -->
                    <div class="col-md-6">
                        <div id="about-slider" class="owl-carousel owl-theme">
                            <img class="img-responsive" src="img/bhs.png" alt="">
                            <img class="img-responsive" src="img/shie-slide.png" alt="">
                        </div>
                    </div>
                    <!-- /About slider -->

                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

        </div>
        <!-- /Why Choose Us -->


        <!-- Numbers -->


        <!-- Pricing -->



        <!-- Testimonial -->
        <div id="testimonial" class="section md-padding">

            <!-- Background Image -->
            <div class="bg-img" style="background-image: url('img/img26.jpg');">
                <div class="overlay"></div>
            </div>
            <!-- /Background Image -->

            <!-- Container -->
            <div class="container">

                <!-- Row -->
                <div class="row">

                    <!-- Testimonial slider -->
                    <div class="col-md-10 col-md-offset-1">
                        <div id="testimonial-slider" class="owl-carousel owl-theme">

                            <!-- testimonial -->
                            <div class="testimonial">
                                <div class="testimonial-meta">
                                    <img src="img/bii.png" alt="">
                                    <h3 class="white-text">Bii</h3>
                                </div>
                                <p class="white-text">Bii is a professional psychologist. He says it's not just fun you get, but also a lot on life.
                                But you know, fun be there too.
                                </p>
                            </div>
                            <!-- /testimonial -->

                            <!-- testimonial -->
                            <div class="testimonial">
                                <div class="testimonial-meta">
                                    <img src="img/shie2.png" alt="">
                                    <h3 class="white-text">Shie</h3>
                                </div>
                                <p class="white-text"> 
                                A beautiful soul, fun to be around and watch. You wouldn't want to miss out on what she will be offering
                                at KiddNation254.
                                </p>
                            </div>
                            <!-- /testimonial -->

                            <!-- testimonial -->
                            <div class="testimonial">
                                <div class="testimonial-meta">
                                    <img src="img/hilla.png" alt="">
                                    <h3 class="white-text">Kidd</h3>
                                </div>
                                <p class="white-text">
                                The driving force behind KiddNation254, the guy that has put in much to make sure that KiddNation254 is out
                                there for you all to enjoy and learn from.
                                </p>
                            </div>
                            <!-- /testimonial -->


                        </div>
                    </div>
                    <!-- /Testimonial slider -->


                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

        </div>
        <!-- /Testimonial -->

        <!-- Team -->
        <div id="team" class="section md-padding">
            <!-- Background Image -->
            <div class="bg-img" style="background-image: url('img/img26.jpg');">
                <div class="overlay"></div>
            </div>
            <!-- Container -->
            <div class="container">

                <!-- Row -->
                <div class="row">

                    <!-- Section header -->
                    <div class="section-header text-center">
                        <h2 class="title">The Team</h2>
                    </div>
                    <!-- /Section header -->

                    <!-- team -->
                    <div class="col-sm-4">
                        <div class="team">
                            <div class="team-img">
                                <img class="img-responsive" src="img/bii.png" alt="">
                                <div class="overlay">
                                    <div class="team-social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-content">
                                <h3>Bii</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /team -->

                    <!-- team -->
                    <div class="col-sm-4">
                        <div class="team">
                            <div class="team-img">
                                <img class="img-responsive" src="./img/shie2.png" alt="">
                                <div class="overlay">
                                    <div class="team-social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-content">
                                <h3>Shie</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /team -->

                    <!-- team -->
                    <div class="col-sm-4">
                        <div class="team">
                            <div class="team-img">
                                <img class="img-responsive" src="img/hilla.png" alt="">
                                <div class="overlay">
                                    <div class="team-social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-content">
                                <h3>Kidd</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /team -->

                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

        </div>
        <!-- /Team -->