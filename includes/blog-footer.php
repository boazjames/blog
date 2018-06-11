<?php
$db = new Database();
$query = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
$posts = $db->select($query);
$query = "SELECT * FROM categories";
$categories = $db->select($query);
/* $query="SELECT * FROM tags";
  $tags=$db->select($query); */
?>
<!-- Aside -->
<aside id="aside" class="col-md-3">

    <!-- Search -->
    <div class="widget hidden-sm hidden-xs">
        <div class="widget-search">
            <form method="post" id="search_form">
                <input class="search-input" type="text" placeholder="search" id="search" name="search">
            <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div id="search_result_main">
            <div id="search_result">

            </div>
        </div>
    </div>
    <!-- /Search -->

    <!-- Category -->
    <div class="widget">
        <h3 class="title">Category</h3>
        <div class="widget-category">
            <?php while ($row = $categories->fetch_assoc()) : ?>
                <?php
                $category_id = $row['id'];
                $query = "SELECT * FROM posts WHERE category=" . $category_id;
                $posts_cat = $db->select($query);
                if ($posts_cat) {
                    $total_post_cat = $posts_cat->num_rows;
                }
                ?>
                <a href="blog.php?category=<?php echo $row['id']; ?>"><?php echo $row['name']; ?>
                    <?php if ($posts_cat) : ?>
                        <span>(<?php echo $total_post_cat; ?>)</span>
                    <?php else : ?>
                        <span>(0)</span>
                    <?php endif; ?>
                </a>
            <?php endwhile; ?>
        </div>
    </div>
    <!-- /Category -->

    <!-- Posts sidebar -->
    <div class="widget">
        <h3 class="title">Recent Posts</h3>
        <?php if ($posts) : ?>
            <?php while ($row = $posts->fetch_assoc()) : ?>


                <!-- single post -->
                <div class="widget-post">
                    <a href="blog-single.php?id=<?php echo $row['id']; ?>">
                        <img id="post_img_small" src="./post_images/<?php echo $row['post_image']; ?>" alt=""> <?php echo $row['title']; ?>
                    </a>
                    <ul class="blog-meta">
                        <li><?php echo formatTime($row['time']); ?></li>
                    </ul>
                </div>
                <!-- /single post -->
            <?php endwhile; ?>
        <?php endif; ?>

    </div>
    <!-- /Posts sidebar -->

    <!-- Tags -->
    <!--<div class="widget">
            <h3 class="title">Tags</h3>
            <div class="widget-tags">
    <?php // while($rows=$tags->fetch_assoc()) : ?>
                    <a href=""><?php //echo $rows['name'];  ?></a>
    <?php // endwhile; ?>
            </div>
    </div>-->
    <!-- /Tags -->

</aside>
<!-- /Aside -->

</div>
<!-- /Row -->

</div>
<!-- /Container -->

</div>
<!-- /Blog -->

<!-- Footer -->
<footer id="footer" class="sm-padding bg-dark">

    <!-- Container -->
    <div class="container">

        <!-- Row -->
        <div class="row">
            <div id="find-us" class="section-header text-center ">
                <h2 class="title">Find Us</h2>
            </div>
            <div class="col-md-12">


                <!-- footer follow -->
                <ul class="footer-follow">
                    <li><a href="https://www.facebook.com/KiddNation254"><i class="fa fa-facebook"></i></a></li>
                    <li><a><i class="fa fa-twitter"></i></a></li>
                    <li><a><i class="fa fa-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/channel/UCKlNL5m1pnZ5C_erWy6mJ6w"><i class="fa fa-youtube"></i></a></li>
                </ul>
                <!-- /footer follow -->

                <!-- footer copyright -->

                <!-- /footer copyright -->

            </div>

        </div>
        <!-- /Row -->

    </div>
    <!-- /Container -->
    <!-- /Footer -->

    <!-- Back to top -->
    <div id="back-to-top"></div>
    <!-- /Back to top -->

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- /Preloader -->

    <!-- jQuery Plugins -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

</body>

</html>
