<?php
error_reporting(false);
$con= mysqli_connect("localhost", "root", "", "shoutit");

if(mysqli_connect_errno()){
    echo "failed to connect:". mysqli_connect_errno();
}

if(isset($_POST['save'])){
    $name=$_POST['name'];
    $comment=$_POST['comment'];
    $sql="INSERT INTO shouts(user,message) VALUES('$name','$comment')";
    if(mysqli_query($con, $sql)){
        $id= mysqli_insert_id($con);
        $saved_comment='<li><strong>'.$name.'</strong></li>
            <li>'.$comment.'<span class="edit btn btn-warning"  data-id="'.$id.' class="edit btn btn-warning" style="float: right">edit</span> <span class="delete btn btn-danger" data-id="'.$id.' class="delete btn btn-danger" style="float: right">delete</span></li>';
    
        echo $saved_comment;
        
    }
    exit();
}

$query="SELECT * FROM shouts ORDER BY id DESC";
$shouts= mysqli_query( $con,$query);
$comments='<div id="shouts">
                <ul>';
while($row=mysqli_fetch_assoc($shouts)){
    $comments.='<li><strong>'.$row['user'].'</strong></li>
            <li>'.$row['message'].'<span class="edit btn btn-warning"  data-id="'.$row['id'].' class="edit btn btn-warning" style="float: right">edit</span> <span class="delete btn btn-danger" data-id="'.$row['id'].' class="delete btn btn-danger" style="float: right">delete</span></li>';
}
$comments.='</div>';

