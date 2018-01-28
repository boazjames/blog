<?php session_start(); ?>
<?php
if(isset($_POST['submit'])){
    
    include_once '../signup_login/database.php';
    $uid= mysqli_real_escape_string($conn,$_POST['uid']);
    $pwd= mysqli_real_escape_string($conn,$_POST['pwd']);
    if(empty($uid) || empty($pwd)){
    exit();
    } else {
      $sql="SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
               $result= mysqli_query($conn, $sql);
               $resultCheck= mysqli_num_rows($result);
               if($resultCheck<1){
                   header("Location: ../login_blog.php?uerror");
    exit();
               } elseif($row=mysqli_fetch_assoc($result)) {
                   if($row['active']==1){
                       $hashedPwdCheck= password_verify($pwd, $row['user_pwd']);
                       if($hashedPwdCheck==false){
                          header("Location: ../login_blog.php?perror");
    exit(); 
                       }elseif ($hashedPwdCheck==true) {
                    $_SESSION['u_id']=$row['user_id'];
                    $_SESSION['u_first']=$row['user_first'];
                    $_SESSION['u_last']=$row['user_last'];
                    $_SESSION['u_email']=$row['user_email'];
                    $_SESSION['u_uid']=$row['user_uid'];
                    header("Location: ../blog.php");                    
                    
                }
                   }else{
                       header("Location: ../login_blog.php?inactive");
                   }  
               }
    }
} else {
    header("Location: ../blog.php?error");
    exit();
}

