<?php session_start(); ?>
<?php if (isset($_SESSION['ua_id'])) : ?>
    <?php
    $output=null;
    $output='';
    include 'config/config.php';
    include 'libraries/Database.php';
    include 'helpers/format_helper.php';

    $db = new Database();
    $id = $_POST['id'];
    $query = "DELETE FROM posts WHERE id=" . $id;
    $delete_row = $db->delete($query);
    $query="DELETE FROM comments WHERE post_id=".$id;
    $delete_row=$db->delete($query);
    $query = "SELECT posts.*, categories.name FROM posts INNER JOIN categories ON posts.category=categories.id ORDER BY posts.id DESC";
    $posts = $db->select($query);
   ?>
    <?php
    $output.='<table class="table table-condensed table-striped table-hover table-responsive" id="post-tbl">
                                        <tr>
                                            <th>Post ID</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Comments</th>
                                            <th>Created</th>
                                            <th></th>
                                        </tr>';
                                            while ($row = $posts->fetch_assoc()){
                                                $query = "SELECT * FROM comments WHERE post_id=" . $row['id'];
                                                $comments = $db->select($query);
                                                if ($comments) {
                                                    $total_comments = $comments->num_rows;
                                                }
                                                $output.=' <tr>
                                                <td>'.$row['id'].'</td>
                                                <td>'.$row['title'].'</td>
                                                <td>'.$row['name'].'</td>
                                                <td>'.$row['author'].'</td>
                                                <td><span class="badge">';
                                                        if ($comments) {
                                                            $output.=$total_comments;
                                                        } else {
                                                            $output.='0';
                                                        }
                                                    $output.='</span></td>
                                                <td>'.formatTime($row['time']).'</td>
                                                <td>
                                                    <a data-action-type="edit" data-post-id="'.$row['id'].'" class="btn btn-warning btn-sm" id="tedit">Edit</a>
                                                    <a data-action-type="delete" data-post-id="'.$row['id'].'" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>';
    }

        $output.='</table>';
        
        echo $output;
              $output=null; ?>

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
    
<?php endif; ?>

