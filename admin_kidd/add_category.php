<?php session_start(); ?>
<?php if(isset($_SESSION['ua_id'])) : ?>
<?php include './config/config.php'; ?>
<?php include './libraries/Database.php'; ?>
<?php include './helpers/format_helper.php'; ?>
<?php
if(isset($_POST['submit'])){
    $db=new Database();
    $name= mysqli_real_escape_string($db->link,$_POST['name']);
    if(empty($name)){
        header("Location: ./add_category.php?err");
    } else {
        $query="INSERT INTO categories (name) VALUES ('$name')";
        $insert_row=$db->insert($query);
        header("Location: ./categories.php?added");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Add Category</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
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
            <a class="navbar-brand" href="../index.html"><strong>KiddNation</strong></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li><a href="index.php">Dashboard</a></li>
            <li><a href="add_post.php">Add Post</a></li>
            <li class="active"><a href="add_category.php">Add Category</a></li>
             <li><a href="#">Add Video</a></li>
            <li><a href="../blog.php">Visit Blog</a></li>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Add Category</h1>
          </div>
          
      </div>
      </div>
    </header>
      <div class="container" id="add">
     <form role="form" method="post" action="add_category.php" enctype="multipart/form-data">
   
    <div class="form-group">
        <label>Category Name</label>
        <input name="name" type="text" class="form-control" placeholder="Enter Name" required>
    </div> 
    <div>
        <input type="submit" name="submit" class="btn btn-success" value="Submit">
    <a href="index.php" class="btn btn-danger">Cancel</a>
    </div>
    <br>
</form>
          </div>
      
       <footer id="footer">
        <p>Copyright KiddNation, &COPY; 2017</p>
    </footer>

    <!-- Modals -->

   

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php else : ?>

<?php endif; ?>
