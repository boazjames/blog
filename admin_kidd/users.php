<?php session_start(); ?>
<?php if (isset($_SESSION['ua_id'])) : ?>
    <?php include 'config/config.php'; ?>
    <?php include 'libraries/Database.php'; ?>
    <?php include 'helpers/format_helper.php'; ?>
    <?php
    $db = new Database();
    $query = "SELECT * FROM users ORDER BY user_id DESC";
    $users = $db->select($query);
    $total_users = $users->num_rows;
    $query = "SELECT * FROM categories";
    $categories = $db->select($query);
    $total_categories = $categories->num_rows;

    $query = "SELECT * FROM posts";
    $posts = $db->select($query);
    $total_posts = $posts->num_rows;
    $videos = $db->select($query);
    $total_videos = $videos->num_rows;
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Admin Area | Users</title>
            <!-- Bootstrap core CSS -->
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/style.css" rel="stylesheet">
        </head>
        <body>

            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand"><strong>KiddNation254</strong></a>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php">Dashboard</a></li>
                            <li><a href="add_post.php">Add Post</a></li>
                            <li><a href="add_category.php">Add Category</a></li>
                            <li><a href="#">Add Video</a></li>
                            <li><a href="../blog.php">Visit Blog</a></li>
                            <li><a href="../index.php">Visit Home</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a>Welcome, <?php echo $_SESSION['ua_uid']; ?></a></li>
                            <li><form method="post" action="logout.php"><button class="btn btn-danger" name="submit">Logout</button></form></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>

            <header id="header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Users<small>Manage Blog Users</small></h1>
                        </div>

                    </div>
            </header>

            <section id="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb">
                        <li>Dashboard</li>
                        <li class="active">Users</li>
                    </ol>
                </div>
            </section>

            <section id="main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="list-group">
                                <a href="index.html" class="list-group-item active main-color-bg">
                                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                                </a>

                                <a href="posts.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posts <span class="badge"><?php echo $total_posts; ?></span></a>
                                <a href="categories.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Categories <span class="badge"><?php echo $total_categories; ?></span></a>
                                <a href="videos.php" class="list-group-item"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> Videos <span class="badge"><?php echo $total_videos; ?></span></a>
                                <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo $total_users; ?></span></a>
                            </div>

                            <div class="well">
                                <h4>Disk Space Used</h4>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        60%
                                    </div>
                                </div>
                                <h4>Bandwidth Used </h4>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                                        40%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-heading main-color-bg">
                                    <h3 class="panel-title">Categories</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" placeholder="Search users...">
                                        </div>
                                    </div>
                                    <br>
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
                                                        <!--<a data-action-type="edit" data-user-id="<?php// echo $row['user_id']; ?>" class="btn btn-warning btn-sm" id="tedit">Edit</a>-->
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
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <footer id="footer">
                <p>Copyright KiddNation254, &COPY; <?php echo date('Y'); ?></p>
            </footer>

             <!-- Modal delete confirm -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-body">
                            <div><strong>Do you want to delete this user</strong></div> 
                        </div>
                        <div id="btns">
                            <button type="button" data-action-type="delete_ok" class="btn btn-lg btn-danger">Ok</button>
                            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- modal delete success -->
            <div id="del_success" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-body">
                            <div><strong>You successfully deleted the user</strong></div> 
                        </div>
                        <div id="btns">
                            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Ok</button>
                        </div>
                    </div>

                </div>
            </div> 

            <!-- Modal edit post-->
            <div id="edit_post" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="title">Edit post</h3>
                        </div>
                        <div class="modal-body">
                            <form id="edit_post_form" method="post" enctype="multipart/form-data">
                                <div id="edit_value">
                                    
                                </div>
                                <button id="edit_post" type="submit" class="btn btn-danger" name="cmt">Edit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- modal edit success -->
            <div id="edit_success" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-body">
                            <div><strong>You successfully edited the category</strong></div> 
                        </div>
                        <div id="btns">
                            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Ok</button>
                        </div>
                    </div>

                </div>
            </div> 



            <script>
                //CKEDITOR.replace( 'editor1' );
            </script>

            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="./js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
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
        </body>
    </html>
<?php else : ?>

<?php endif; ?>
