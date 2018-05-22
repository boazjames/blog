<?php

require_once 'DbConnect.php';


class DbOperations
{
    private $db;

    function __construct()
    {
        $db = new DbConnect;
        $this->db = $db;
    }

    public function createUser($username, $email, $phone, $pwd, $confirmPwd)
    {
        if($this->validateEmail($email)){
            return 3;
        }elseif ($this->validatePhone($phone)){
            return 4;
        }elseif ($this->validatePassword($pwd,$confirmPwd)){
            return 5;
        }elseif ($this->doesUserExist($username, $email, $phone)) {
            return 0;
        } else {
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $smt = "INSERT INTO users(user_uid,user_email, phone_number, user_pwd) VALUES (:username, :email, :phone, :pwd)";
            $smt = $this->db->insert($smt);
            $smt->bindParam(":username", $username);
            $smt->bindParam(":email", $email);
            $smt->bindParam(":phone", $phone);
            $smt->bindParam(":pwd", $pwd);

            if ($smt->execute()) {
                return 2;
            }

            return false;
        }


    }

    public function userLogin($username, $password)
    {
        $smt = "SELECT * FROM users WHERE user_uid=:username";
        $smt = $this->db->select($smt);
        $smt->bindParam(":username", $username);
        $smt->bindColumn("user_pwd", $pwd);
        $smt->execute();

        if ($smt->rowCount() > 0) {
            if ($smt->fetch(PDO::FETCH_OBJ)) {
                return password_verify($password, $pwd);
            }
        }

        return false;
    }

    public function getUser($username)
    {
        $smt = "SELECT * FROM users WHERE user_uid=:username";
        $smt = $this->db->select($smt);
        $smt->bindParam(":username", $username);
        $smt->execute();

        return $smt->fetch(PDO::FETCH_OBJ);


    }

    private function doesUserExist($username, $email, $phone)
    {
        $smt = "SELECT * FROM users WHERE user_uid=:username OR user_email=:email OR phone_number=:phone";
        $smt = $this->db->select($smt);
        $smt->bindParam(":username", $username);
        $smt->bindParam(":email", $email);
        $smt->bindParam(":phone", $phone);
        $smt->execute();

        return $smt->rowCount() > 0;
    }

    private function validateEmail($email)
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validatePassword($password, $confirmPassword)
    {
        return strlen($password) < 8 && $password != $confirmPassword;
    }

    private function validatePhone($phone){
        return strlen($phone) != 10;
    }

    public function showPost($id){
        $smt = "SELECT * FROM posts WHERE id=:id";
        $smt = $this->db->select($smt);
        $smt->bindParam(':id', $id);
        $smt->execute();
        return $smt->fetch(PDO::FETCH_OBJ);
    }

    public function showMoreComments($postId, $start, $limit){
        $smt = "SELECT * FROM comments WHERE post_id=:postId ORDER BY id DESC LIMIT ".$start.", ".$limit;
        $smt = $this->db->select($smt);
        $smt->bindParam(":postId", $postId);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function showFewComments($postId, $limit){
        $smt = "SELECT * FROM comments WHERE post_id=:postId ORDER BY id DESC LIMIT ".$limit;
        $smt = $this->db->select($smt);
        $smt->bindParam(":postId", $postId);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function commentsCount($postId){
        $smt = "SELECT * FROM comments WHERE post_id=:postId";
        $smt = $this->db->select($smt);
        $smt->bindParam(":postId", $postId);
        $smt->execute();
        return $smt->rowCount();
    }

    public function insertComment($post_id, $user_id, $date, $username, $user_img, $comment){
        $smt = "INSERT INTO comments (post_id, user_id, time, user_uid, user_image, comment)".
            " VALUES (:post_id, :user_id, :time, :username, :user_img, :comment)";
        $smt = $this->db->insert($smt);
        $smt->bindParam(":post_id", $post_id);
        $smt->bindParam(":user_id", $user_id);
        $smt->bindParam(":time", $date);
        $smt->bindParam(":username", $username);
        $smt->bindParam(":user_img", $user_img);
        $smt->bindParam(":comment", $comment);

        if($smt->execute()){
            return true;
        }

    }

    public function getUserWithId($user_id)
    {
        $smt = "SELECT * FROM users WHERE user_id=:user_id";
        $smt = $this->db->select($smt);
        $smt->bindParam(":user_id", $user_id);
        $smt->execute();

        return $smt->fetch(PDO::FETCH_OBJ);


    }

    public function showFewPosts($limit){
        $smt = "SELECT * FROM posts ORDER BY id DESC LIMIT ".$limit;
        $smt = $this->db->select($smt);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function showMorePosts($start, $limit){
        $smt = "SELECT * FROM posts ORDER BY id DESC LIMIT ".$start.", ".$limit;
        $smt = $this->db->select($smt);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function postsCount(){
        $smt = "SELECT * FROM posts";
        $smt = $this->db->select($smt);
        $smt->execute();
        return $smt->rowCount();
    }

    public function showFewVideos($limit){
        $smt = "SELECT * FROM videos ORDER BY id DESC LIMIT ".$limit;
        $smt = $this->db->select($smt);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function showMoreVideos($start, $limit){
        $smt = "SELECT * FROM videos ORDER BY id DESC LIMIT ".$start.", ".$limit;
        $smt = $this->db->select($smt);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function videosCount(){
        $smt = "SELECT * FROM videos";
        $smt = $this->db->select($smt);
        $smt->execute();
        return $smt->rowCount();
    }

    public function showLatestQuote(){
        $smt = "SELECT * FROM quotes ORDER BY id DESC LIMIT 1";
        $smt = $this->db->select($smt);
        $smt->execute();
        return $smt->fetch(PDO::FETCH_OBJ);
    }

    public function updateUserImageLink($user_id, $image_link){
        $smt = "UPDATE users SET user_image=:image_link WHERE user_id=:user_id";
        $smt = $this->db->select($smt);
        $smt->bindParam(":user_id", $user_id);
        $smt->bindParam(":image_link", $image_link);
        if($smt->execute())
            return true;
    }

    public function searchFewPosts($search_term, $limit){
        $smt = "SELECT * FROM posts WHERE title LIKE '%".$search_term."%' ORDER BY id DESC LIMIT ".$limit;
        $smt = $this->db->select($smt);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function searchMorePosts($search_term, $start, $limit){
        $smt = "SELECT * FROM posts WHERE title LIKE '%".$search_term."%' ORDER BY id DESC LIMIT ".$start.", ".$limit;
        $smt = $this->db->select($smt);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function searchPostsCount($search_term){
        $smt = "SELECT * FROM posts WHERE title LIKE '%".$search_term."%'";
        $smt = $this->db->select($smt);
        $smt->execute();
        return $smt->rowCount();
    }

    public function searchFewVideos($search_term, $limit){
        $smt = "SELECT * FROM videos WHERE title LIKE '%".$search_term."%' ORDER BY id DESC LIMIT ".$limit;
        $smt = $this->db->select($smt);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function searchMoreVideos($search_term, $start, $limit){
        $smt = "SELECT * FROM videos WHERE title LIKE '%".$search_term."%' ORDER BY id DESC LIMIT ".$start.", ".$limit;
        $smt = $this->db->select($smt);
        $smt->execute();

        while ( $row = $smt->fetch(PDO::FETCH_OBJ) ) {
            $results[]  = $row;

        }

        return (object) $results;
    }

    public function searchVideosCount($search_term){
        $smt = "SELECT * FROM videos WHERE title LIKE '%".$search_term."%'";
        $smt = $this->db->select($smt);
        $smt->execute();
        return $smt->rowCount();
    }

}
