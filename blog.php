<?php include './includes/blog-header-blog.php'; ?>

<?php
require ('./processors/paginator.php');

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'blog';

$mysqli = new mysqli($host, $user, $pass, $db);
if(isset($_GET['category'])){
    $category= mysqli_real_escape_string($mysqli,$_GET['category']);
    $query = "SELECT * FROM posts WHERE category=" . $category . " ORDER BY id DESC";
}else{
//DO NOT limit this query with LIMIT keyword, or...things will break!
$query = "SELECT * FROM posts ORDER BY ID DESC";
}
//these variables are passed via URL
$limit = ( isset($_GET['limit']) ) ? $_GET['limit'] : 5; //movies per page
$page = ( isset($_GET['page']) ) ? $_GET['page'] : 1; //starting page
$links = 5;

$paginator = new Paginator($mysqli, $query); //__constructor is called
$results = $paginator->getData($limit, $page);

//print_r($results);die; $results is an object, $result->data is an array
//print_r($results->data);die; //array
?>

<?php
$db = new Database();
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $query = "SELECT * FROM posts WHERE category=" . $category . " ORDER BY id DESC";
    $posts = $db->select($query);
} else {
    $query = "SELECT * FROM posts ORDER BY id DESC";
    $posts = $db->select($query);
}
?>
<!-- Search -->
<div class="col-sm-12 col-xs-12 hidden-lg hidden-md">
    <form method="post" id="search_form_sm">
        <div class="input-group input-group-lg" id="search_wrapper">
            <input type="text" class="form-control" placeholder="search" id="search_sm" name="search_sm">
            <span class="input-group-btn">
                <button type="submit" name="submit" id="eemail" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <div id="search_result_main_sm">
            <div id="search_result_sm">

            </div>
        </div>
</div>
<!-- /Search -->
<!-- Blog -->
<div id="blog" class="section md-padding">

    <!-- Container -->
    <div class="container">

        <!-- Row -->
        <div class="row">
            <div id="hidden_on_search">
            <aside id="aside" class="col-md-3 pull-right hidden-sm hidden-xs">
<?php
$query = "SELECT * FROM categories";
$categories = $db->select($query);
$query = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
$post = $db->select($query);
?>
                <!-- Search -->
                <div class="widget">
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
                    
<?php if ($post) : ?>
    <?php while ($row = $post->fetch_assoc()) : ?>


                            <!-- single post -->
                            <div class="widget-post">
                                <a href="blog-single.php?id=<?php echo $row['id']; ?>">
                                    <img id="post_img_small" src="<?php echo $row['post_image']; ?>" alt=""> <?php echo $row['title']; ?>
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

                <!-- Tags --><!--
                <div class="widget">
                        <h3 class="title">Tags</h3>
                        <div class="widget-tags">
                                <a href="#">Web</a>
                                <a href="#">Design</a>
                                <a href="#">Graphic</a>
                                <a href="#">Marketing</a>
                                <a href="#">Development</a>
                                <a href="#">Branding</a>
                                <a href="#">Photography</a>
                        </div>
                </div>-->
                <!-- /Tags -->

            </aside>
            <!-- /Aside -->
            </div>
<div id="blog-main-blog">
<?php if ($posts) : ?>
    <?php for ($p = 0; $p < count($results->data); $p++) : ?>
        <?php
        //store in $movie variable for easier reading
        $row = $results->data[$p];
        ?>
                    <!-- blog -->
                    <div class="col-md-9" id="blog-main">
                        <div class="blog">
                            <div class="blog-img">
                                <img id="post_img" class="img-responsive" src="<?php echo $row['post_image']; ?>" alt="">
                            </div>
                            <div class="blog-content">
                                <ul class="blog-meta">
                                    <li><i class="fa fa-user"></i><?php echo $row['author']; ?></li>
                                    <li><i class="fa fa-clock-o"></i><?php echo formatTime($row['time']); ?></li>

                                </ul>
                                <h3><?php echo $row['title']; ?></h3>
        <?php echo shortenText($row['body']); ?>
                                <div class="text-center"><a id="read_more" class="btn btn-default" href="blog-single.php?id=<?php echo urlencode($row['id']); ?>">Read more</a></div>
                            </div>
                        </div>
                    </div>
                    <!-- /blog -->

    <?php endfor; ?>

<?php else : ?>
                <P>Sorry, there are no posts on this category.</P>
            <?php endif; ?>
                
        </div>
            <div id="show_on_search">
    <!-- Aside -->
<aside id="aside" class="col-md-3 hidden-sm hidden-xs">
<?php
$query = "SELECT * FROM categories";
$categories = $db->select($query);
$query = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
$post = $db->select($query);
?>
                <!-- Search -->
                <div class="widget">
                    <div class="widget-search">
                        <form method="post" id="search_form">
                <input class="search-input" type="text" placeholder="search" id="search_input_show" name="search">
            <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
            </form>
                    </div>
                    <div id="search_show">
                        <div id="search_result_show">

                        </div>
                    </div>
                </div>
                <!-- /Search -->

                <!-- Category -->
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
                    
<?php if ($post) : ?>
    <?php while ($row = $post->fetch_assoc()) : ?>


                            <!-- single post -->
                            <div class="widget-post">
                                <a href="blog-single.php?id=<?php echo $row['id']; ?>">
                                    <img id="post_img_small" src="<?php echo $row['post_image']; ?>" alt=""> <?php echo $row['title']; ?>
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

                <!-- Tags --><!--
                <div class="widget">
                        <h3 class="title">Tags</h3>
                        <div class="widget-tags">
                                <a href="#">Web</a>
                                <a href="#">Design</a>
                                <a href="#">Graphic</a>
                                <a href="#">Marketing</a>
                                <a href="#">Development</a>
                                <a href="#">Branding</a>
                                <a href="#">Photography</a>
                        </div>
                </div>-->
                <!-- /Tags -->

            </aside>
            <!-- /Aside -->
    <!-- /Aside -->
    
</div>
            <div class="col-md-9 text-center hidden-sm hidden-xs" id="pagination">
            <?php echo $paginator->createLinks($links, 'pagination'); ?> 
            </div>
            <aside id="aside" class="col-md-3 hidden-lg hidden-md">
            <?php
            $query = "SELECT * FROM categories";
            $categories = $db->select($query);
            $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
            $post = $db->select($query);
            ?>
                <!-- Search -->
                <div class="widget">
                    <div class="widget-search hidden">
                        <input class="search-input" type="text" placeholder="search">
                        <button class="search-btn" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <!-- /Search -->

                <!-- Category -->
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
<?php if ($post) : ?>
    <?php while ($row = $post->fetch_assoc()) : ?>


                            <!-- single post -->
                            <div class="widget-post">
                                <a href="blog-single.php?id=<?php echo $row['id']; ?>">
                                    <img id="post_img_small" src="<?php echo $row['post_image']; ?>" alt=""> <?php echo $row['title']; ?>
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

                <!-- Tags --><!--
                <div class="widget">
                        <h3 class="title">Tags</h3>
                        <div class="widget-tags">
                                <a href="#">Web</a>
                                <a href="#">Design</a>
                                <a href="#">Graphic</a>
                                <a href="#">Marketing</a>
                                <a href="#">Development</a>
                                <a href="#">Branding</a>
                                <a href="#">Photography</a>
                        </div>
                </div>-->
                <!-- /Tags -->

            </aside>
            <!-- /Aside -->

            <div class="col-md-9 text-center hidden-lg hidden-md" id="pagination">
<?php echo $paginator->createLinks($links, 'pagination'); ?> 
            </div>

            <!--Upload image Modal -->
            <div id="upload_img_modal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="title">Upload an Image</h3>
                        </div>
                        <div class="modal-body">
                            <form id="insert_img" method="post" enctype="multipart/form-data">
                                <br>
                                <input class="form-control" type="file" name="img_upload" id="img_upload" required>
                                <br>
                                <button id="upload_img" data-action-type="upload_img" type="submit" class="main-btn" name="cmt">Upload</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

<?php include 'includes/blog-footer2.php'; ?>
<script>
                $('#search_result').hide();
                $('#show_on_search').hide();
                $('input#search').keyup(function (e) {
                    e.preventDefault;
                    var text = $(this).val();
                    if (text != " ") {
                        $.ajax({
                            url: "./processors/search.php",
                            method: "POST",
                            data: "text=" + text,
                            dataType: "text",
                            success: function (data) {
                                $('#search_result_main').show();
                                $('#search_result_main').html(data);
                            }
                        });
                    }

                });
            </script>
            <script>
               $('input#search_input_show').keyup(function (e) {
                    e.preventDefault;
                    var text = $(this).val();
                    if (text != " ") {
                        $.ajax({
                            url: "./processors/search_show.php",
                            method: "POST",
                            data: "text=" + text,
                            dataType: "text",
                            success: function (data) {
                                $('#search_show').show();
                                $('#search_show').html(data);
                            }
                        });
                    }

                });
            </script>
            <script>
                $('#search_result_sm').hide();
            $('input#search_sm').keyup(function(e){
                e.preventDefault;
                var text=$(this).val();
                if(text!=" "){
                    $.ajax({
                    url: "./processors/search_sm.php",
                    method: "POST",
                    data: "text="+text,
                    dataType: "text",
                    success: function(data){
                        $('#search_result_main_sm').show();
                        $('#search_result_main_sm').html(data);
                    }
                });
                }
                
            });
            </script>

            <script>
                $(document).ready(function () {
                    $('a#upload').click(function (e) {
                        e.preventDefault();
                        var action_type = $(this).attr('data-action-type');
                        if (action_type = 'upload') {
                            $('#upload_img_modal').modal('show');
                            $('button#upload_img').one('click', function (e) {
                                e.preventDefault();
                                action_type = $(this).attr('data-action-type');
                                if (action_type = 'upload_img') {
                                    var img_upload = $('#img_upload').val();
                                    if (img_upload == '') {
                                        alert('Please, select an image');
                                    } else {
                                        /*var formData=new FormData();
                                         formData.append('file', $('input[type=file]')[0].files[0]);*/
                                        //var form=$('form').get(0);
                                        var form = $('#insert_img');
                                        var form_data = new FormData(form[0]);
                                        $.ajax({
                                            url: "./processors/upload_image.php",
                                            method: "POST",
                                            data: form_data,
                                            contentType: false,
                                            cache: false,
                                            processData: false,
                                            success: function (data) {
                                                $('#insert_img')[0].reset();
                                                $('#upload_img_modal').modal('hide');
                                                $('#li_img').html(data);
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    });
                });
            </script>
<script>
$('form#search_form').submit(function(e){
    e.preventDefault();
    $.ajax({
                            url: "./processors/search_click.php",
                            method: "POST",
                            data: $(this).serialize(),
                            dataType: "html",
                            success: function (data) {
                                $('#search_form')[0].reset();
                                $('#search_result_main').hide();
                                $('#pagination').hide();
                                $('#hidden_on_search').hide();
                                $('#show_on_search').show();
                                //$('#show_on_search').css({"float":"right","position":"relative"});
                                $('#blog-main-blog').html(data);
                                $('#blog-main-blog').addClass('col-md-9');
                                $('#search_show').hide();
                            }
                        });
});
            </script>
            
            <script>
$('form#search_form_sm').submit(function(e){
    e.preventDefault();
    $.ajax({
                            url: "./processors/search_click_sm.php",
                            method: "POST",
                            data: $(this).serialize(),
                            dataType: "html",
                            success: function (data) {
                                $('#search_form_sm')[0].reset();
                                $('#search_result_main_sm').hide();
                                $('#pagination').hide();
                                $('#blog-main-blog').html(data);
                            }
                        });
});
            </script>