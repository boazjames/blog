<?php if (!empty($_POST)) : ?>
    <?php
    session_start();
    include '../config/config.php';
    include '../libraries/Database.php';
    include '../helpers/format_helper.php';
    $db = new Database();


    $u_id = mysqli_real_escape_string($db->link, $_SESSION['u_id']);
    $query = "SELECT * FROM users WHERE user_id=" . $u_id;
    $user = $db->select($query)->fetch_assoc();
    $u_uid = mysqli_real_escape_string($db->link, $_SESSION['u_uid']);
    $u_img = mysqli_real_escape_string($db->link, $user['user_image']);

    $p_id = mysqli_real_escape_string($db->link, $_POST['id']);
    $msg = mysqli_real_escape_string($db->link, $_POST['msg']);
    $query = "INSERT INTO comments(post_id, user_id, user_uid, user_image, comment) VALUES('$p_id','$u_id','$u_uid','$u_img','$msg')";

    $insert_row = $db->insert($query);


    $query = "SELECT * FROM posts WHERE id=" . $p_id;
    $post = $db->select($query)->fetch_assoc();
    $postId = $post['id'];
    $query = "SELECT * FROM comments WHERE post_id=" . $postId . " ORDER BY id DESC LIMIT 4";
    $comments = $db->select($query);
    ?>
    <div class="blog-comments" id="comments">
    <?php
    $query = "SELECT * FROM comments WHERE post_id=" . $postId;
    $comments_total = $db->select($query);
    if ($comments) {
        $total = $comments_total->num_rows;
    }
    ?>
        <h3 class="title">(<?php echo $total; ?>) Comments</h3>

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
                            <img id="user_img" class="media-object" src="<?php echo $row['user_image']; ?>" alt="">
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
                    <input name="post_id" hidden type="text" value="<?php echo $postId; ?>">
                    <button type="submit" id="show_all_cmt" class="btn btn-default">Show all comments</button>
                </form>
        <?php endif; ?>
    <?php else : ?>
            <div class="alert alert-info">Be the first to comment</div>
        <?php endif; ?>

    </div>
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
    </script>
<?php endif; ?>
