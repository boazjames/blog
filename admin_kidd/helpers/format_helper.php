<?php

function formatDate($date){
    return date('M j, Y g:i a', strtotime($date));
}

function shortenText($text, $chars=450){
    $text=$text."";
    $text= substr($text, 0, $chars);
    $text= substr($text, 0, strrpos($text,' '));
    $text=$text."...";
    return $text;
}

function formatTime($date){
    return date('M j, Y', strtotime($date));
}