<?php session_start(); ?>
<?php if (isset($_SESSION['ua_id'])) : ?>
<?php
    include 'config/config.php';
    include 'libraries/Database.php';
    include 'helpers/format_helper.php';

    $db = new Database();
    $id = $_POST['id'];
    $query = "DELETE FROM users WHERE user_id=" . $id;
    $delete_row = $db->delete($query);
    $query = "SELECT * FROM users ORDER BY user_id DESC";
    $users = $db->select($query);
   ?>
 <table class="table table-condensed table-striped table-hover table-responsive" id="users_tbl">
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Joined</th>
                                            <th></th>
                                        </tr>
                                        <?php while ($row = $users->fetch_assoc()) : ?>
                                            <?php if ($row['user_id'] != 15 && $row['user_id'] != 14 && $row['user_id'] != 2 && $row['user_id'] != 4) : ?>
                                                <tr>
                                                    <td><?php echo $row['user_id']; ?></td>
                                                    <td><?php echo $row['user_uid']; ?></td>
                                                    <td><?php echo $row['user_email']; ?></td>
                                                    <td><?php echo formatTime($row['time']); ?></td>
                                                    <td>
                                                        <!--<a data-action-type="edit" data-user-id="<?php //echo $row['user_id']; ?>" class="btn btn-warning btn-sm" id="tedit">Edit</a>-->
                                                        <a data-action-type="delete" data-user-id="<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php else : ?>
                                                <tr>
                                                    <td><?php echo $row['user_id']; ?></td>
                                                    <td><?php echo $row['user_uid']; ?></td>
                                                    <td><?php echo $row['user_email']; ?></td>
                                                    <td><?php echo formatTime($row['time']); ?></td>
                                                    <td class="alert alert-warning"><b>Admin</b></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endwhile; ?>

                                    </table>
<?php endif; ?>
<script>



               $(document).ready(function () {
                   $('table#users_tbl tr td a').on('click', function (e) {
                       e.preventDefault();

                       var action_type = $(this).attr('data-action-type');
                       var user_id = $(this).attr('data-user-id');
                       if (action_type == 'edit') {
                           /*$('#edit_post').modal('show');
                           $.ajax({
                               url: "edit_post_disp.php",
                               method: "POST",
                               data: "id=" + post_id,
                               dataType: "",
                               success: function (data) {
                                   //category value
                                   $('#edit_value').html(data);
                                   $('button#edit_post').on('click', function (e) {
                                       e.preventDefault();
                                       $.ajax({
                                           url: "edit_post.php",
                                           method: "POST",
                                           data: "id=" + post_id + "&" + $('#edit_post_form').serialize(),
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
*/
                       } else if (action_type == 'delete') {
                           $('#myModal').modal('show');


                           $('button').one('click', function (e) {
                               e.preventDefault();
                               var action_type = $(this).attr('data-action-type');
                               if (action_type == 'delete_ok') {
                                  $.ajax({
                                       url: "del_users.php",
                                       method: "POST",
                                       data: {'id': user_id},
                                       success: function (data) {
                                           //hide modal
                                           $('#myModal').modal('hide');
                                           //show modal success
                                           $('#del_success').modal('show');
                                           //reload users table
                                           $('#users_tbl').html(data);


                                       }
                                   });

                               }
                           });


                       }

                   });


               });

            </script>