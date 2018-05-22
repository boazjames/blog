<?php

require_once 'DbConnect.php';

$db = new DbConnect;

$smt = "SELECT * FROM users";
$smt = $db->select($smt);
$smt->bindColumn("id",$id);
$smt->bindColumn("username",$username);
$smt->bindColumn("email",$email);
//$smt->execute();

$smt = "INSERT INTO users(username, email, password) VALUES ('james', 'james@gmail.com', '12345')";
$smt = $db->insert($smt);
$smt->execute();



while ($smt->fetch(PDO::FETCH_OBJ)){
    echo $username;
}