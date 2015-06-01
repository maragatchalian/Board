<?php

function validate_between($check, $min, $max)
{
    $check = trim($check);
    $n = mb_strlen($check);
    return $min <= $n && $n <= $max;
}

function is_logged_in()
{
    return isset($_SESSION['user_id']);
}


function is_valid_username($username)
{
    $valid = array('-', '_', '.');    
    return ctype_alnum(str_replace($valid, '', $username));
}

function is_valid_name($string)
{
    $valid = array('-', ' ');    
    return ctype_alpha(str_replace($valid, '', $string));
}