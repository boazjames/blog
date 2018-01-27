<?php
if(isset($_POST['submit'])){
    session_start();
    $id=$_POST['id'];
    session_unset($_SESSION['u_id']);
    header("Location: ../blog-single.php?id=$id");
    exit();
} 

