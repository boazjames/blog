<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
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
              <form method="post" action="./processors/sign-up.php" class="well">
                  <div class="form-group">
                     <?php if(isset($_GET['empty'])) : ?>
                      <div class="alert alert-danger">
                          Please fill all fields
                      </div>
                      <?php elseif(isset($_GET['emailmismatch'])) : ?>
                      <div class="alert alert-danger">
                          Email doesn't match
                      </div>
                      <?php elseif(isset($_GET['pwdmismatch'])) : ?>
                      <div class="alert alert-danger">
                          Password doesn't match
                      </div>
                      <?php elseif(isset($_GET['invalid'])) : ?>
                      <div class="alert alert-danger">
                          First/Last name must contain only letters
                      </div>
                      <?php elseif(isset($_GET['email'])) : ?>
                      <div class="alert alert-danger">
                          Invalid email
                      </div>
                      <?php elseif(isset($_GET['pwdshort'])) : ?>
                      <div class="alert alert-danger">
                          Password must be at least 8 characters
                      </div>
                      <?php elseif(isset($_GET['usertaken'])) : ?>
                      <div class="alert alert-danger">
                          Username taken
                      </div>
                      <?php elseif(isset($_GET['emexists'])) : ?>
                      <div class="alert alert-danger">
                          Email exists
                      </div>
                      <?php elseif(isset($_GET['success'])) : ?>
                      <div class="alert alert-success">
                          You successfully signed up. Click the link sent to your email to activate your account.
                          <!--<p>You can now <a href="login_blog.php">Log in</a></p>-->
                      </div>
                      <?php endif; ?>
                      <?php if(isset($_SESSION['first_input'])) : ?>
                      <label>First Name</label>
                      <input  type="text" class="form-control" name="first" placeholder="First name" value="<?php echo $_SESSION['first_input'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="last" placeholder="Last name" value="<?php echo $_SESSION['last_input'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="uid" placeholder="Username" value="<?php echo $_SESSION['uid_input'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $_SESSION['email_input'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Confirm email</label>
                    <input type="text" class="form-control" name="Cemail" placeholder="Comfirm email" value="<?php echo $_SESSION['Cemail_input'] ?>" required>
                  </div>
                      <?php else : ?>
                    <label>First Name</label>
                    <input  type="text" class="form-control" name="first" placeholder="First name" required>
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="last" placeholder="Last name" required>
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="uid" placeholder="Username" required>
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <label>Confirm email</label>
                    <input type="text" class="form-control" name="Cemail" placeholder="Comfirm email" required>
                  </div>
                      <?php endif; ?>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="pwd" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label>Confirm password</label>
                    <input type="password" class="form-control" name="Cpwd" placeholder="Confirm password" required>
                  </div>
                  
                  <button type="submit" class="btn btn-default btn-block" name="submit" id="return">Sign Up</button>
                  <br>
                  <p class="text-center"><strong>OR</strong></p>
                  <p>Already have an account? <a href="login.php">Log in</a></p>
              </form>
              
          </div>
        </div>
      </div>
    </section>
          <p class="text-center"><a class="btn btn-default" id="return">Return to Blog Page</a></p>
      </div>
      
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

