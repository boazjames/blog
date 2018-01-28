<?php
if(isset($_POST['submit'])){
    session_start();
    session_unset($_SESSION['u_id']);
    header("Location: ../blog.php");
    exit();
} 

