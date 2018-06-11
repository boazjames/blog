<?php include 'includes/blog-header.php'; ?>
<?php if(isset($_GET['id'])) :?>
<?php if(!$_GET['id']==null): ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$db = new Database();
$query = "SELECT * FROM posts WHERE id=" . $id;
$post = $db->select($query)->fetch_assoc();
$postId = $post['id'];
$query = "SELECT * FROM comments WHERE post_id=" . $postId;
$comments = $db->select($query);
if ($comments) {
    $total = $comments->num_rows;
}
?>
<!-- Search -->
<div class="col-sm-12 col-xs-12 hidden-lg hidden-md">
    <form id="search_form_sm" method="post">
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

            <!-- Main -->
            <main id="main" class="col-md-9">
                <div class="blog">
                    <div class="blog-img">
                        <img class="img-responsive" id="post_img" src="./post_images/<?php echo $post['post_image']; ?>" alt="">
                    </div>
                    <div class="blog-content">
                        <ul class="blog-meta">
                            <li><i class="fa fa-user"></i><?php echo $post['author']; ?></li>
                            <li><i class="fa fa-clock-o"></i><?php echo formatDate($post['time']); ?></li>
                            <?php if ($comments) : ?>
                                <li><i class="fa fa-comments"></i><?php echo $total; ?></li>
                            <?php endif; ?>
                        </ul>
                        <h3><?php echo $post['title']; ?></h3>

                        <?php
                        $query = "SELECT * FROM users WHERE user_id=" . $post['author_id'];
                        $author = $db->select($query)->fetch_assoc();
                        ?>
                        <!-- blog author -->
                        <div class="blog-author">
                            <div class="media">
                                <div class="media-left">
                                    <img id="author_img" class="media-object" src="./user_images/<?php echo $author['user_image']; ?>" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <h3><?php echo $author['user_uid']; ?></h3>
                                        <div class="author-social">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                        </div>
                                    </div>
                                    <p><?php echo $author['user_description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- /blog author -->

                        <?php echo $post['body']; ?>
                        <!-- blog tags --><!--
                        <div class="blog-tags">
                            <h5>Tags :</h5>
                            <a href="#"><i class="fa fa-tag"></i>Web</a>
                            <a href="#"><i class="fa fa-tag"></i>Design</a>
                            <a href="#"><i class="fa fa-tag"></i>Marketing</a>
                            <a href="#"><i class="fa fa-tag"></i>Development</a>
                            <a href="#"><i class="fa fa-tag"></i>Branding</a>
                            <a href="#"><i class="fa fa-tag"></i>Photography</a>
                        </div>-->
                        <!-- blog tags -->
                    </div>

                    <!-- blog tags -->

                    <!-- blog tags -->


                    <!-- blog comments -->
                    <div class="blog-comments" id="comments">
                        <?php if ($comments) : ?>
                            <h3 class="title">(<?php echo $total; ?>) Comments</h3>
                        <?php endif; ?>
                        <?php
                        $query = "SELECT * FROM comments WHERE post_id=" . $postId . " ORDER BY id DESC LIMIT 4";
                        $comments = $db->select($query);
                        ?>
                        <?php if ($comments) : ?>
                            <?php while ($row = $comments->fetch_assoc()) : ?>

                                <?php if ($row['comment']) : ?>
                                    <!-- comment -->
                                    <?php $cmt_id = $row['id']; ?>
                                    <?php
                                    date_default_timezone_set("Africa/Nairobi");
                                    ?>
                                    <div class="media">
                                        <div class="media-left">
                                            <img id="user_img" class="media-object" src="./user_images/<?php echo $row['user_image']; ?>" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $row['user_uid']; ?>
                                                <span class="time text-lowercase"><?php echo timeAgo($row['time']); ?></span>

            <!--<a id="rep" class="reply" data-toggle="modal" data-target="#myModal1">Reply <i class="fa fa-reply"></i></a>-->
                                            </h4>

                                            <p><?php echo $row['comment']; ?></p>

                                        </div>
                                    </div>
                                    <!-- /comment -->


                                <?php endif; ?>

                            <?php endwhile; ?>
                            <?php if ($total > 4) : ?>
                                <form id="post_id" method="post">
                                    <input name="post_id" hidden type="text" value="<?php echo $id; ?>">
                                    <button type="submit" id="show_all_cmt" class="btn btn-default">Show all comments</button>
                                </form>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="alert alert-info">Be the first to comment</div>
                        <?php endif; ?>

                    </div>
                    <!-- /blog comments -->

                    <?php if (isset($_SESSION['u_uid'])) : ?>
                        <!-- reply form -->
                        <div class="reply-form">
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="main-btn" data-toggle="modal" data-target="#myModal"><strong>Add a comment</strong></button>
                        </div>
                        <!--Comment Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 class="title">Add a comment</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form id="insert_form" method="post" >
                                            <input type="text" class="hidden" name="id" value="<?php echo $id; ?>">
                                            <textarea name="msg" placeholder="Add Your Commment" required></textarea>
                                            <button id="cmt" type="submit" class="main-btn" name="cmt">Comment</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
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






                    <?php else : ?>
                        <div class="alert alert-warning">
                            Please log in to add a comment <a class="btn btn-default" id="plog" href="login.php?id=<?php echo $id; ?>">Login</a>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
            <?php else: ?>
            <p>An error was encountered while loading the post. Visit <a href="./blog.php">blog page</a></p>
            <?php endif; ?>
            <?php else : ?>
            <p>An error was encountered while loading the post. Visit <a href="./blog.php">blog page</a></p>
            <?php endif; ?>
            <?php include 'includes/blog-footer.php'; ?>
            <script>
                $('#search_result').hide();
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
                $('#search_result_sm').hide();
                $('input#search_sm').keyup(function (e) {
                    e.preventDefault;
                    var text = $(this).val();
                    if (text != " ") {
                        $.ajax({
                            url: "./processors/search_sm.php",
                            method: "POST",
                            data: "text=" + text,
                            dataType: "text",
                            success: function (data) {
                                $('#search_result_main_sm').show();
                                $('#search_result_main_sm').html(data);
                            }
                        });
                    }

                });
            </script>
            <script>
                $(document).ready(function () {
                    $('button#show_all_cmt').click(function (e) {
                        e.preventDefault();
                        $.ajax({
                            url: "./processors/comments_all.php",
                            method: "POST",
                            data: $('#post_id').serialize(),
                            dataType: "",
                            success: function (data) {
                                ;
                                //show all comments
                                $('#comments').html(data);
                            }
                        });
                    });
                });
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
                document.getElementById('author_img').style.width = "120px";
                document.getElementById('author_img').style.height = "120px";
                $(document).ready(function () {
                    $('#insert_form').on('submit', function (event) {
                        event.preventDefault();

                        $.ajax({
                            url: "./processors/comment.php",
                            method: "POST",
                            data: $('#insert_form').serialize(),
                            dataType: "html",
                            success: function (data) {
                                $('#insert_form')[0].reset();
                                $('#myModal').modal('hide');
                                $('#comments').html(data);
                            }
                        });
                    });
                });
            </script>

            <script>
                $(document).ready(function () {
                    $('#cmt_reply').click(function (event) {
                        event.preventDefault();

                        $.ajax({
                            url: "./processors/comment_reply.php",
                            method: "POST",
                            data: $('#insert_form_reply').serialize(),
                            dataType: "html",
                            success: function (data) {
                                $('#insert_form_reply')[0].reset();
                                $('#myModal1').modal('hide');
                                $('#comments').html(data);
                            }
                        });
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
                                $('#main').html(data);
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
                                $('#main').html(data);
                            }
                        });
});
            </script>
