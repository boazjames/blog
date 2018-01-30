<?php session_start(); ?>
<?php if (isset($_SESSION['ua_id'])) : ?>
    <?php include 'config/config.php'; ?>
    <?php include 'libraries/Database.php'; ?>
    <?php include 'helpers/format_helper.php'; ?>
    <?php
    $db = new Database();
    $query = "SELECT * FROM categories";
    $categories = $db->select($query);
    $total_categories = $categories->num_rows;
    $query = "SELECT * FROM users";
    $users = $db->select($query);
    $total_users = $users->num_rows;
    $query = "SELECT * FROM posts";
    $posts = $db->select($query);
    $total_posts = $posts->num_rows;
    $query = "SELECT * FROM videos ORDER BY id DESC";
    $videos = $db->select($query);
    $total_videos = $videos->num_rows;
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Admin Area | Videos</title>
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
                        <a class="navbar-brand"><strong>KiddNation</strong></a>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="./index.php">Dashboard</a></li>
                            <li><a href="./add_post.php">Add Post</a></li>
                            <li><a href="./add_category.php">Add Category</a></li>
                            <li><a href="./add_video.php">Add Video</a></li>
                            <li><a href="../blog.php">Visit Blog</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a>Welcome, <?php echo $_SESSION['ua_uid'] ?></a></li>
                            <li><form method="post" action="logout.php"><button class="btn btn-danger" name="submit">Logout</button></form></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>

            <header id="header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Categories<small>Manage Videos</small></h1>
                        </div>

                    </div>
            </header>

            <section id="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb">
                        <li>Dashboard</li>
                        <li class="active">Videos</li>
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

                                <a href="./posts.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posts <span class="badge"><?php echo $total_posts; ?></span></a>
                                <a href="./categories.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Categories <span class="badge"><?php echo $total_categories; ?></span></a>
                                <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> Videos <span class="badge"><?php echo $total_videos; ?></span></a>
                                <a href="./users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo $total_users; ?></span></a>
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
                                    <h3 class="panel-title">Videos</h3>
                                </div>
                                <?php if (isset($_GET['added'])) : ?>
                                <script> 
                                    $('#add_success').modal('show');
                                location.replace('categories.php');
                                </script>
                                
                                <?php endif; ?>
                               
                                <div class="panel-body">
                                    <table class="table table-condensed table-striped table-hover" id="videos-tbl">
                                        <tr>
                                            <th>Video ID</th>
                                            <th>Title</th>
                                            <th></th>
                                        </tr>
                                        <?php while ($row = $videos->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td>
                                                    <a data-action-type="delete" data-video-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-body">
                            <div><strong>Do you want to delete this Video Iframe</strong></div> 
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
                            <div><strong>You successfully deleted the Video Iframe</strong></div> 
                        </div>
                        <div id="btns">
                            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Ok</button>
                        </div>
                    </div>

                </div>
            </div> 

            

            <!-- modal delete success -->
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
            
            
            <footer id="footer">
                <p>Copyright KiddNation254, &COPY; <?php echo date('Y'); ?></p>
            </footer>


            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="./js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
 <?php if (isset($_GET['added'])) : ?>
                                <script> 
                                    alert('video iframe added successfully');
                                    location.replace('videos.php');
                                </script>
                                
                                <?php endif; ?>
            <script>



        $(document).ready(function () {

            $('table#videos-tbl tr td a').on('click', function (e) {
                e.preventDefault();
                var action_type = null;
                action_type = $(this).attr('data-action-type');
                var video_id = null;
                video_id = $(this).attr('data-video-id');

if (action_type == 'delete') {
                    $('#myModal').modal('show');


                    $('button').on('click', function (e) {
                        e.preventDefault();
                        var action_type = $(this).attr('data-action-type');
                        if (action_type == 'delete_ok') {

                            $.ajax({
                                url: "del_video.php",
                                method: "POST",
                                data: {'id': video_id},
                                dataType: "",
                                success: function (data) {
                                    //hide modal
                                    $('#myModal').modal('hide');
                                    //show modal success
                                    $('#del_success').modal('show');
                                    //reload categories table
                                    $('#videos-tbl').html(data);

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




