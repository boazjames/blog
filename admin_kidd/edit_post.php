<?php session_start(); ?>
<?php if(isset($_SESSION['ua_id'])) : ?>
<?php
include 'config/config.php';
    include 'libraries/Database.php';
    include 'helpers/format_helper.php';
    ?>
 
<?php 
$db=new Database();
$post_id=$_POST['id'];
    $title= mysqli_real_escape_string($db->link,$_POST['title']);
    $body= mysqli_real_escape_string($db->link,$_POST['body']);
    $category= mysqli_real_escape_string($db->link,$_POST['category']);
    //$tags= mysqli_real_escape_string($db->link,$_POST['tags']);
   
    if($_POST){
        $query="UPDATE posts SET category='$category',title='$title',body='$body' WHERE id=".$post_id;
        $update_row=$db->update($query);
    }

?>
<?php
$query = "SELECT posts.*, categories.name FROM posts INNER JOIN categories ON posts.category=categories.id ORDER BY posts.id DESC";
    $posts = $db->select($query);
?>
<table class="table table-condensed table-striped table-hover table-responsive" id="post-tbl">
                                        <tr>
                                            <th>Post ID</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Comments</th>
                                            <th>Created</th>
                                            <th></th>
                                        </tr>
                                            <?php while ($row = $posts->fetch_assoc()) : ?>
                                            <tr>
                                                <?php
                                                $query = "SELECT * FROM comments WHERE post_id=" . $row['id'];
                                                $comments = $db->select($query);
                                                if ($comments) {
                                                    $total_comments = $comments->num_rows;
                                                }
                                                ?>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['author']; ?></td>
                                                <td><span class="badge">
                                                        <?php
                                                        if ($comments) {
                                                            echo $total_comments;
                                                        } else {
                                                            echo 0;
                                                        }
                                                        ?>
                                                    </span></td>
                                                <td><?php echo formatTime($row['time']); ?></td>
                                                <td>
                                                    <a data-action-type="edit" data-post-id="<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" id="tedit">Edit</a>
                                                    <a data-action-type="delete" data-post-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
    <?php endwhile; ?>

                                    </table>
<script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            
            <script>



                $(document).ready(function () {

                    $('table#post-tbl tr td a').on('click', function (e) {
                        e.preventDefault();

                        var action_type = $(this).attr('data-action-type');
                        var post_id = $(this).attr('data-post-id');

                        if (action_type == 'edit') {
                            $('#edit_post').modal('show');
                            $.ajax({
                                        url: "edit_post_disp.php",
                                        method: "POST",
                                        data: "id="+post_id,
                                        dataType: "",
                                        success: function (data) {
                                            //category value
                                            $('#edit_value').html(data);
                                            $('button#edit_post').on('click',function(e){
                                               e.preventDefault();
                                              $.ajax({
                                        url: "edit_post.php",
                                        method: "POST",
                                        data: "id="+post_id+"&"+$('#edit_post_form').serialize(),
                                        dataType: "",
                                        success: function (data) {
                                            //hide modal
                                            $('#edit_post').modal('hide');
                                            //show modal success
                                            $('#edit_success').modal('show');
                                            //reload categories table
                                            $('#post-tbl').html(data);
                                             action_type = null;
                        post_id = null;

                                        }
                                    });
                                            });

                                        }
                                    });

                        } else if (action_type == 'delete') {
                            $('#myModal').modal('show');


                            $('button').on('click', function (e) {
                                e.preventDefault();
                                var action_type = $(this).attr('data-action-type');
                                if (action_type == 'delete_ok') {

                                    $.ajax({
                                        url: "del_post.php",
                                        method: "POST",
                                        data: {'id': post_id},
                                        dataType: "",
                                        success: function (data) {
                                            //hide modal
                                            $('#myModal').modal('hide');
                                            //show modal success
                                            $('#del_success').modal('show');
                                            //reload categories table
                                            $('#post-tbl').html(data);
                                           

                                        }
                                    });

                                }
                            });


                        }

                    });


                });

            </script>

<?php else : ?>

<?php endif; ?>
