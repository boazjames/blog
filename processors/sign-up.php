<?php session_start(); ?>
<?php

if (isset($_POST['submit'])) {
    include_once '../signup_login/database.php';
    $hash = md5(rand(0, 1000));
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $_SESSION['first_input'] = $_POST['first'];
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $_SESSION['last_input'] = $_POST['last'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $_SESSION['email_input'] = $_POST['email'];
    $Cemail = mysqli_real_escape_string($conn, $_POST['Cemail']);
    $_SESSION['Cemail_input'] = $_POST['Cemail'];
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $_SESSION['uid_input'] = $_POST['uid'];
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $Cpwd = mysqli_real_escape_string($conn, $_POST['Cpwd']);
    $user_img="user.jpg";
    if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
        header("Location: ../signup.php?empty");
        exit();
    } else {
        if ($email != $Cemail) {
            header("Location: ../signup.php?emailmismatch");
        } else {
            if ($pwd != $Cpwd) {
                header("Location: ../signup.php?pwdmismatch");
            } else {
                if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                    header("Location: ../signup.php?invalid");
                    exit();
                } else {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        header("Location: ../signup.php?email");
                        exit();
                    } else {
                        if (strlen($pwd) < 8) {
                            header("Location: ../signup.php?pwdshort");
                        } else {
                            $sql = "SELECT * FROM users WHERE user_uid='$uid'";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);
                            if ($resultCheck > 0) {
                                header("Location: ../signup.php?usertaken");
                                exit();
                            } else {
                                $sql = "SELECT * FROM users WHERE user_email='$email'";
                                $result = mysqli_query($conn, $sql);
                                $resultCheck = mysqli_num_rows($result);
                                if ($resultCheck > 0) {
                                    header("Location: ../signup.php?emaexists");
                                    exit();
                                } else {
                                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                                    $sql = "INSERT INTO users(user_first,user_last,user_email,user_uid,user_pwd,user_image,hash) VALUES('$first','$last','$email','$uid','$hashedPwd','$user_img','$hash')";
                                    $result = mysqli_query($conn, $sql);
                                    $to = $email; // Send email to our user
                                    $subject = 'Signup | Verification'; // Give the email a subject 
                                    $message = '
 
Thanks for signing up!
Your
 account has been created, you can login with the following credentials 
after you have activated your account by pressing the url below.
 
------------------------
Username: ' . $uid . '
------------------------
 
Please click the link below to activate your account:
http://www.kiddnation254.com/verify.php?email=' . $email . '&hash=' . $hash . '
 
'."If clicking the link above doesn't work, copy and paste the url into a
new browser window."; // Our message above including the link

                                    $headers = 'From: KiddNation254 <support@kiddnation254.com>' . "\r\n"; // Set from headers
                                    mail($to, $subject, $message, $headers); // Send our email
                                    header("Location: ../signup.php?success");
                                    session_unset($_SESSION['first_input']);
                                    session_unset($_SESSION['last_input']);
                                    session_unset($_SESSION['email_input']);
                                    session_unset($_SESSION['Cemail_input']);
                                    session_unset($_SESSION['uid_input']);
                                    exit();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}

