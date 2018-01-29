<?php include_once '../libraries/Database.php'; ?>
<?php include_once '../config/config.php'; ?>
<?php if(isset($_POST['subscription_input'])) : ?>
<?php
    $db=new Database();
    $email= mysqli_real_escape_string($db->link,$_POST['subscription_input']);
    $query="SELECT * FROM subscriptions WHERE email='$email'";
    $subscriptions=$db->select($query);
    ?>
<?php if($subscriptions) : ?>
<div class="alert-warning" id="subscriptions_div">
    You had subscribed
</div>
<?php else : ?>
<?php
$query="INSERT INTO subscriptions(email) VALUES('$email')";
$insert_row=$db->insert($query);
?>
<div class="alert-success" id="subscriptions_div">
    You have successfully subscribed
</div>
<?php endif; ?>
<?php endif; ?>