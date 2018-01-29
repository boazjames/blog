<?php include 'config/config.php'; ?>
<?php include 'libraries/Database.php'; ?>
<?php
$db=new Database();
if(isset($_POST['submit'])){
    $email= mysqli_real_escape_string($db->link,$_POST['email']);
    if(!empty($email)){
        $query="SELECT * FROM users WHERE user_email='$email'";
        $select_email=$db->select($query);
        if($select_email){
            header("Location: ./forgot_password.php?success");
        }else{
            header("Location: ./forgot_password.php?incorrectEmail");
        }
    }else {
        header("Location: ./forgot_password.php?empty");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
  </head>
  <body>
      <div class="container-fluid">

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
              <h2 class="text-center"><img class="" src="./img/logo3.png"></h2>
          </div>
        </div>
      </div>
    </header>
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <form id="login" method="post" action="./forgot_password.php" class="well">
                  <?php if(isset($_GET['incorrectEmail'])) : ?>
                  <div class="alert alert-danger">
                      Email doesn't exist
                  </div>
                  <?php elseif(isset($_GET['empty'])) : ?>
                  <div class="alert alert-danger">
                      Please fill the email field
                  </div>
                  <?php elseif(isset($_GET['success'])) : ?>
                  <div class="alert alert-success">
                      Click on the link sent to your email to change password.
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                  </div>
                  <button type="submit" id="return" class="btn btn-default btn-block" name="submit">Reset</button>
                  <br>
                  <p>Go back to <a href="login_blog.php">log in </a>page.</p>
              </form>
              
          </div>
        </div>
      </div>
    </section>
          <p class="text-center"><a href="blog.php" class="btn btn-default" id="return">Return to Blog Page</a></p>
  
      </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
