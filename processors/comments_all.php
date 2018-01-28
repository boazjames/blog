<?php session_start(); ?>
<?php if (!empty($_POST)) : ?>
    <?php
    include '../config/config.php';
    include '../libraries/Database.php';
    include '../helpers/format_helper.php';
    $db = new Database();

 $p_id = $_POST['post_id'];
    $query = "SELECT * FROM posts WHERE id=" . $p_id;
    $post = $db->select($query)->fetch_assoc();
    $postId = $post['id'];
    $query = "SELECT * FROM comments WHERE post_id=" . $postId." ORDER BY id DESC";
    $comments = $db->select($query);
    


?>
 <div class="blog-comments" id="comments">
     <?php
     $query = "SELECT * FROM comments WHERE post_id=" . $postId;
$comments_total= $db->select($query);
if($comments){
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
                        <?php else : ?>
                            <div class="alert alert-info">Be the first to comment</div>
                        <?php endif; ?>

                    </div>

<?php endif; ?>
