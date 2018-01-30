<?php session_start(); ?>
<?php

if (isset($_POST['submit'])) {
    
    include 'config/config.php';
    include 'libraries/Database.php';
    include 'helpers/format_helper.php';
    $db = new Database();
    $id = mysqli_real_escape_string($db->link, $_POST['id']);
    $uid = mysqli_real_escape_string($db->link, $_POST['uid']);
    $pwd = mysqli_real_escape_string($db->link, $_POST['pwd']);
    if (empty($uid) || empty($pwd)) {
        header("Location: ./login.php?empty&id=$id");
        exit();
    } else {
        $query = "SELECT * FROM users WHERE user_uid='$uid' AND admin='1' OR user_email='$uid' AND admin='1'";
        $users = $db->select($query);
        if (!$users) {
            header("Location: ./login.php?uerror");
            exit();
        } else {
            if ($row = $users->fetch_assoc()) {
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                if ($hashedPwdCheck == false) {
                    header("Location: ./login.php?perror");
                    exit();
                } elseif ($hashedPwdCheck == true) {
                    $_SESSION['ua_id'] = $row['user_id'];
                    $_SESSION['ua_first'] = $row['user_first'];
                    $_SESSION['ua_last'] = $row['user_last'];
                    $_SESSION['ua_email'] = $row['user_email'];
                    $_SESSION['ua_uid'] = $row['user_uid'];
                    header("Location: ./index.php");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ./login.php?error");
    exit();
}

