<?php session_start(); ?>
<?php include 'config/config.php'; ?>
<?php include 'libraries/Database.php'; ?>
<?php session_start(); ?>
<?php
$db = new Database();
?>
<?php
if (isset($_POST['submit_pwd'])) {
    $email = mysqli_real_escape_string($db->link, $_POST['email']);
    $pwd = mysqli_real_escape_string($db->link, $_POST['pwd']);
    $Cpwd = mysqli_real_escape_string($db->link, $_POST['Cpwd']);
    $hash = $_POST['hash'];
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    if (strlen($pwd) < 8) {
        header("Location: ./reset_password.php?shortPwd&email=$email&hash=$hash");
    } elseif ($pwd != $Cpwd) {
        header("Location: ./reset_password.php?notMatch&email=$email&hash=$hash");
    } else {
        $query = "UPDATE users SET user_pwd='$hashedPwd', pwd_active='0' WHERE user_email='" . $email . "' AND pwd_active='1'";
        $update_row = $db->update($query);
        header("Location: ./reset_password.php?success&email=$email&hash=$hash");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reset | Password</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style1.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <?php if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) : ?>
                <?php
                $email = mysqli_real_escape_string($db->link, $_GET['email']);
                $hash = mysqli_real_escape_string($db->link, $_GET['hash']);
                $query = "SELECT change_hash, user_email, pwd_active FROM users WHERE user_email='" . $email . "' AND change_hash='" . $hash . "' AND pwd_active='1'";
                $reset = $db->select($query);
                
                ?>
                <?php if (isset($_GET['success'])) : ?>
                    <div class="alert alert-success" id="verify_div">
                        You've successfully changed your password.You can now <a href="./login_blog.php">Log in</a>.
                    </div>
                <?php endif; ?>
                <?php if ($reset) : ?>
                    <section id="main">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <form id="login" method="post" action="./reset_password.php" class="well">
                                        <?php if (isset($_GET['notMatch'])) : ?>
                                            <div class="alert alert-danger">
                                                Password fields does not match
                                            </div>
                                        <?php elseif (isset($_GET['shortPwd'])) : ?>
                                            <div class="alert alert-danger">
                                                Password must be at least 8 characters
                                            </div>
                                        <?php endif; ?>
                                        <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                                        <input type="text" name="hash" value="<?php echo $hash; ?>" hidden>
                                        <div class="form-group">
                                            <label>New password</label>
                                            <input type="password" class="form-control" name="pwd" placeholder="Enter password" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm password</label>
                                            <input type="password" class="form-control" name="Cpwd" placeholder="Confirm password" required>
                                        </div>
                                        <button type="submit" id="return" class="btn btn-default btn-block" name="submit_pwd">Reset</button>
                                        <br>
                                        <p>Go back to <a href="login_blog.php">log in </a>page.</p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </section>
            <?php else : ?>
                <?php endif; ?>
            <?php else : ?>
                <div id="verify_div" class=" alert alert-danger">
                    Invalid password reset link. <a href="./login_blog.php">Log in</a>
                </div>
            <?php endif; ?>
        </div>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>

