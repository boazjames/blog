<?php

function formatDate($date) {
    return date('M j, Y g:i a', strtotime($date));
}

function shortenText($text, $chars = 450) {
    $text = $text . "";
    $text = substr($text, 0, $chars);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text . "...";
    return $text;
}

function formatTime($date) {
    return date('M j, Y', strtotime($date));
}

function timeAgo($timestamp) {
    date_default_timezone_set("Africa/Nairobi");
    $time_ago= strtotime($timestamp);
    $current_time=time();
    $time_diff=$current_time-$time_ago;
    $sec=$time_diff;
    $min= round($sec/60);
    $hr= round($sec/3600);
    $days= round($sec/86400);
    $weeks= round($sec/604800);
    $months= round($sec/2629440);
    $year= round($sec/31553280);
    if($sec<=60){
        return "just now";
    }elseif ($min<=60) {
        if($min==1){
            return "a minute ago";
        } else {
            return "$min minutes ago";
        }
    }elseif ($hr<=24) {
       if($hr==1){
           return "an hour ago";
       } else {
           return "$hr hours ago";    
       } 
    }elseif ($days<=7) {
        if($days==1){
            return "a day ago";
        } else {
            return "$days days ago";
        }
    }elseif ($weeks<=4.3) {
        if($weeks==1){
            return "a week ago";
        } else {
            return "$weeks weeks ago";
        }
    }elseif ($months<=12) {
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }else{
        if($year==1){
            return "a year ago";
        } else {
            return "$year years ago";    
        }
    }
}
