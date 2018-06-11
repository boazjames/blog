<?php session_start(); ?>
<?php if (isset($_SESSION['ua_id'])) : ?>
    <?php include 'config/config.php'; ?>
    <?php include 'libraries/Database.php'; ?>
    <?php include 'helpers/format_helper.php'; ?>
    <?php
    $db = new Database();
    $query = "SELECT posts.*, categories.name FROM posts INNER JOIN categories ON posts.category=categories.id ORDER BY posts.id DESC";
    $posts = $db->select($query);
    $total_posts = $posts->num_rows;

    $query = "SELECT * FROM categories";
    $categories = $db->select($query);
    $total_categories = $categories->num_rows;
    $query = "SELECT * FROM users ORDER BY user_id DESC";
    $users = $db->select($query);
    $total_users = $users->num_rows;
    $query = "SELECT * FROM categories";
    $categories = $db->select($query);
    $query = "SELECT * FROM videos";
    $videos = $db->select($query);
    $total_videos = $videos->num_rows;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Area | Posts</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    </head>
    <body>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
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
                    <li><a href="add_video.php">Add Video</a></li>
                    <li><a href="../blog.php">Visit Blog</a></li>
                    <li><a href="../index.php">Visit Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a>Welcome, <?php echo $_SESSION['ua_uid'] ?></a></li>
                    <li>
                        <form method="post" action="logout.php">
                            <button class="btn btn-danger" name="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Posts
                        <small>Manage Blog Posts</small>
                    </h1>
                </div>

            </div>
    </header>

    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li>Dashboard</li>
                <li class="active">Posts</li>
            </ol>
        </div>
    </section>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a class="list-group-item active main-color-bg">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                        </a>

                        <a href="posts.php" class="list-group-item active"><span class="glyphicon glyphicon-pencil"
                                                                                 aria-hidden="true"></span> Posts <span
                                    class="badge"><?php echo $total_posts; ?></span></a>
                        <a href="categories.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt"
                                                                               aria-hidden="true"></span> Categories
                            <span class="badge"><?php echo $total_categories; ?></span></a>
                        <a href="videos.php" class="list-group-item"><span class="glyphicon glyphicon-film"
                                                                           aria-hidden="true"></span> Videos <span
                                    class="badge"><?php echo $total_videos; ?></span></a>
                        <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user"
                                                                          aria-hidden="true"></span> Users <span
                                    class="badge"><?php echo $total_users; ?></span></a>
                    </div>

                    <div class="well">
                        <h4>Disk Space Used</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                 aria-valuemax="100" style="width: 60%;">
                                60%
                            </div>
                        </div>
                        <h4>Bandwidth Used </h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                 aria-valuemax="100" style="width: 40%;">
                                40%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Posts</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="form-control" type="text" placeholder="Filter Posts...">
                                </div>
                            </div>
                            <br>


                            <table class="table table-condensed table-striped table-hover table-responsive"
                                   id="post-tbl">
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
                                            <a data-action-type="edit" data-post-id="<?php echo $row['id']; ?>"
                                               class="btn btn-warning btn-sm" id="tedit">Edit</a>
                                            <a data-action-type="delete" data-post-id="<?php echo $row['id']; ?>"
                                               class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal delete confirm -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">
                    <div><strong>Do you want to delete this post</strong></div>
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
                    <div><strong>You successfully deleted the post</strong></div>
                </div>
                <div id="btns">
                    <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal edit post-->
    <div id="edit_post" class="modal fade" role="dialog">
        <div class="modal-dialog"><!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="title">Edit post</h3></div>
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
                    <div><strong>You successfully edited the post</strong></div>
                </div>
                <div id="btns">
                    <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>

        </div>
    </div>


    <footer id="footer">
        <p>Copyright KiddNation254, &COPY; <?php echo date('Y'); ?></p>
    </footer>

    <!-- Modals -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php if (isset($_GET['added'])) : ?>
        <script>
            alert('Post added successfully');
            location.replace("posts.php");
        </script>
    <?php endif; ?>
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

    </body>
    </html>
<?php else : ?>

<?php endif; ?>
