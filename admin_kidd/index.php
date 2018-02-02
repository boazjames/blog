<?php session_start(); ?>
<?php if(isset($_SESSION['ua_id'])) : ?>
<?php include 'config/config.php'; ?>
<?php include 'libraries/Database.php'; ?>
<?php include 'helpers/format_helper.php'; ?>
<?php
$db=new Database();
$query="SELECT posts.*, categories.name FROM posts INNER JOIN categories on posts.category=categories.id ORDER BY posts.id DESC";
$posts=$db->select($query);

 $query="SELECT * FROM categories";
        $categories=$db->select($query);
        $total_categories=$categories->num_rows;
        
         $query="SELECT * FROM users";
        $users=$db->select($query);
        $total_users=$users->num_rows;
         $query="SELECT * FROM posts";
        $posts=$db->select($query);
        $total_posts=$posts->num_rows;
        $query="SELECT * FROM videos";
        $videos = $db->select($query);
    $total_videos = $videos->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
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
            <li class="active"><a href="#">Dashboard</a></li>
            <li><a href="add_post.php">Add Post</a></li>
            <li><a href="add_category.php">Add Category</a></li>
            <li><a href="add_video.php">Add Video</a></li>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Site</small></h1>
          </div>
         
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a class="list-group-item main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              
              <a href="posts.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posts <span class="badge"><?php echo $total_posts; ?></span></a>
              <a href="categories.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Categories <span class="badge"><?php echo $total_categories; ?></span></a>
              <a href="videos.php" class="list-group-item"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> Videos <span class="badge"><?php echo $total_videos; ?></span></a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo $total_users; ?></span></a>
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
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Website Overview</h3>
              </div>
              <div class="panel-body">
                   <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <?php echo $total_posts; ?></h2>
                    <h4>Posts</h4>
                  </div>
                </div>
                  <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <?php echo $total_categories; ?></h2>
                    <h4>Categories</h4>
                  </div>
                </div>
                  <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-film" aria-hidden="true"></span> <?php echo $total_videos; ?></h2>
                    <h4>Videos</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $total_users; ?></h2>
                    <h4>Users</h4>
                  </div>
                </div>
                
               
                <div class="col-md-12">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 12,334</h2>
                    <h4>Visitors</h4>
                  </div>
                </div>
              </div>
              </div>

              <!-- Latest Users -->
             <!--<div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Latest Users</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                      </tr>
                      <tr>
                        <td>Jill Smith</td>
                        <td>jillsmith@gmail.com</td>
                        <td>Dec 12, 2016</td>
                      </tr>
                      <tr>
                        <td>Eve Jackson</td>
                        <td>ejackson@yahoo.com</td>
                        <td>Dec 13, 2016</td>
                      </tr>
                      <tr>
                        <td>John Doe</td>
                        <td>jdoe@gmail.com</td>
                        <td>Dec 13, 2016</td>
                      </tr>
                      <tr>
                        <td>Stephanie Landon</td>
                        <td>landon@yahoo.com</td>
                        <td>Dec 14, 2016</td>
                      </tr>
                      <tr>
                        <td>Mike Johnson</td>
                        <td>mjohnson@gmail.com</td>
                        <td>Dec 15, 2016</td>
                      </tr>
                    </table>
                </div>
              </div>-->
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
        <p>Copyright KiddNation254, &copy; <?php echo date('Y'); ?></p>
    </footer>

    <!-- Modals -->

    
  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php else: ?>

<?php endif; ?>


