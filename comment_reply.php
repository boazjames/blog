<?php
if(!empty($_POST)){
session_start();
include 'config/config.php';
include 'libraries/Database.php';
$db=new Database();


    $u_id= mysqli_real_escape_string($db->link,$_SESSION['u_id']);
    $u_uid= mysqli_real_escape_string($db->link,$_SESSION['u_uid']);
    $query="SELECT * FROM users WHERE user_id=".$u_id;
        $user=$db->select($query)->fetch_assoc();
    $u_img= mysqli_real_escape_string($db->link,$user['user_image']);
    $cmt_id=mysqli_real_escape_string($db->link,$_POST['comment_id']);
$p_id=mysqli_real_escape_string($db->link,$_POST['id']);
    $msg_reply= mysqli_real_escape_string($db->link,$_POST['msg_reply']);
    
    $query="INSERT INTO comments_reply(user_id, user_image, user_uid, comment_reply, comment_id, post_id) VALUES ('$u_id','$u_img','$u_uid','$msg_reply','$cmt_id','$p_id')";
     
   $insert_row=$db->insert($query);
   
   $query="SELECT * FROM posts WHERE id=".$p_id;
        $post=$db->select($query)->fetch_assoc();
        $postId=$post['id'];
        $query="SELECT * FROM comments WHERE post_id=".$p_id;
        $comments=$db->select($query);
        $total=$comments->num_rows;
}
?>
<!-- blog comments -->
                    <div class="blog-comments" id="comments">
                        <?php if ($comments) : ?>
                            <h3 class="title">(<?php echo $total; ?>) Comments</h3>
                        <?php endif; ?>
                        <?php if ($comments) : ?>
                            <?php while ($row = $comments->fetch_assoc()) : ?>

                                <?php if ($row['comment']) : ?>
                                    <!-- comment -->
                                    <?php $cmt_id = $row['id']; ?>
                                    <?php
                                    $db_time = strtotime($row['time']);
                                    date_default_timezone_set("Africa/Nairobi");
                                    $time_diff = time() - $db_time;
                                    ?>
                                    <div class="media">
                                        <div class="media-left">
                                            <img id="user_img" class="media-object" src="<?php echo $row['user_image']; ?>" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $row['user_uid']; ?>
                                                <?php if ($time_diff < 60) : ?>
                                                    <span class="time text-lowercase">just now</span>
                                                <?php elseif (round($time_diff / 60) == 1) : ?>
                                                    <span class="time text-lowercase">a minute ago</span>
                                                <?php elseif (round($time_diff / 60) > 1 && round($time_diff / 60) < 60) : ?>
                                                    <span class="time text-lowercase"><?php echo round($time_diff / 60); ?> minutes ago</span>
                                                <?php elseif (round($time_diff / 3600) == 1) : ?>
                                                    <span class="time text-lowercase">about an hour ago</span>
                                                <?php elseif (round($time_diff / 3600) > 1 && round($time_diff / 3600) < 24) : ?>
                                                    <span class="time text-lowercase">about <?php echo round($time_diff / 3600); ?> hours ago</span>
                                                <?php elseif (round($time_diff / 86400) == 1) : ?>
                                                    <span class="time text-lowercase">about a day ago</span>
                                                <?php elseif (round($time_diff / 86400) > 1 && round($time_diff / 86400) < 7) : ?>
                                                    <span class="time text-lowercase">about <?php echo round($time_diff / 86400); ?> days ago</span>
                                                <?php elseif (round($time_diff / 604800) == 1) : ?>
                                                    <span class="time text-lowercase">about a week ago</span>
                                                <?php elseif (round($time_diff / 604800) > 1 && round($time_diff / 604800) < 4) : ?>
                                                    <span class="time text-lowercase">about <?php echo round($time_diff / 604800); ?> weeks ago</span>
                                                <?php elseif (round($time_diff / 2678400) == 1) : ?>
                                                    <span class="time text-lowercase">about a month ago</span>
                                                <?php elseif (round($time_diff / 2678400) > 1 && round($time_diff / 2678400) < 12) : ?>
                                                    <span class="time text-lowercase">about <?php echo round($time_diff / 2678400); ?> months ago</span>
                                                <?php elseif (round($time_diff / 31536000) == 1) : ?>
                                                    <span class="time text-lowercase">about a year ago</span>
                                                <?php elseif (round($time_diff / 31536000) > 1) : ?>
                                                    <span class="time text-lowercase">about <?php echo round($time_diff / 31536000); ?> years ago</span>
                                                <?php endif; ?>
                                                    <?php if(isset($_SESSION['u_uid'])) : ?>
                                                <a id="reply" class="reply" data-action-type="reply" data-cmt-id="<?php echo $row['id']; ?>">Reply <i class="fa fa-reply"></i></a>
                                            <?php else : ?>
                                                <a id="rep" class="reply" data-comment-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#myModal">Reply <i class="fa fa-reply"></i></a>
                                                    <?php endif; ?>
                                            </h4>

                                            <p><?php echo $row['comment']; ?></p>
                                            <?php
                                            $comment_id = $row['id'];
                                            $query = "SELECT * FROM comments_reply WHERE comment_id=" . $comment_id;
                                            $comments_reply1 = $db->select($query);
                                            ?>
                                            <?php if ($comments_reply1) : ?>
                                                <?php if ($comments_reply1->num_rows > 0) : ?>
                                            <a id="cmt_toggle" data-toggle="collapse" data-target="#<?php echo $row['id']; ?>">Show </a><span><small>Replies(<?php echo $comments_reply1->num_rows; ?>)</small></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                    $query = "SELECT * FROM comments_reply WHERE post_id=" . $p_id;
                                    $comments_reply = $db->select($query);
                                    ?>
                                    <?php if ($comments_reply) : ?>
                                    <div id="<?php echo $row['id']; ?>" class="collapse">
                                        <?php while ($row1 = $comments_reply->fetch_assoc()) : ?>
                                            <?php
                                            $comment_id = $row['id'];
                                            $commentId = $row1['comment_id'];
                                            $comment__id = $row['id'];
                                            ?>
                                            <?php if ($comment_id == $commentId) : ?>
                                                <?php if ($row1['user_id'] != 2) : ?>
                                    
                                                    <div class="media-rep">
                                                        <div class="media-left">
                                                            <img id="user_img" class="media-object" src="<?php echo $row1['user_image']; ?>" alt="">
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><?php echo $row1['user_uid']; ?><span class="time">2 min ago</span></h4>
                                                            <p><?php echo $row1['comment_reply']; ?></p>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="media author-rep">
                                                        <div class="media-left">
                                                            <img id="user_img" class="media-object" src="<?php echo $row1['user_image']; ?>" alt="">
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><?php echo $row1['user_uid']; ?><span class="time">2 min ago</span></h4>
                                                            <p><?php echo $row1['comment_reply']; ?></p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </div>
                                    <?php endif; ?>
                                    <!-- /comment -->


                                <?php endif; ?>

                            <?php endwhile; ?>
                        <?php else : ?>
                            <div class="alert alert-info">Be the first to comment</div>
                        <?php endif; ?>

                    </div>
                    <!-- /blog comments -->
                    
                    <script src="./js/jquery.min.js"></script>
                    <script src="./js/bootstrap.min.js"></script>
                    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
                    <script>
                
                $(document).ready(function () {
                    $('a#reply').click(function(e){
                        e.preventDefault();
                        
                        var action_type=$(this).attr('data-action-type');
                        var comment_id=$(this).attr('data-cmt-id');
                        
                        if(action_type=='reply'){
                             $('#cmt_reply').modal('show');
                        $('#cmt_rep').one('click',function (event) {
                        event.preventDefault();
                        action_type=$(this).attr('data-action-type');
                        
                        if(action_type=='rep'){
                             $.ajax({
                            url: "comment_reply.php",
                            method: "POST",
                            data: "comment_id="+comment_id+"&"+$('#insert_form_reply').serialize(),
                            dataType: "html",
                            success: function (data) {
                               comment_id=null;
                                $('#insert_form_reply')[0].reset();
                                $('#cmt_reply').modal('hide');
                                $('#comments').html(data);
                            }
                        });
                        }
                        
                       
                    });
                        }
                       
                    });
                    
                });
            </script> 