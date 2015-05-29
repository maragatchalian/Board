<?php

function readable_text($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

function redirect($url)
{
    header("Location: " . $url);
    exit();
}

const ONE_SECOND = 1;
const TEN_SECONDS = 10;
const ONE_MINUTE_IN_SECONDS = 60;
const ONE_HOUR_IN_SECONDS = 3600;
const ONE_DAY_IN_SECONDS = 86400;
const ONE_WEEK_IN_SECONDS = 604800;
const ONE_MONTH_IN_SECONDS = 2592000;
const ONE_YEAR_IN_SECONDS = 31104000;

function time_difference($date)
{
    $time = time() - strtotime($date);
    if ($time < TEN_SECONDS) {
    return 'Just now';
    }

    $secondConversion = array(ONE_YEAR_IN_SECONDS  => 'year',
        ONE_MONTH_IN_SECONDS => 'month',
        ONE_WEEK_IN_SECONDS => 'week',
        ONE_DAY_IN_SECONDS => 'day',
        ONE_HOUR_IN_SECONDS => 'hour',
        ONE_MINUTE_IN_SECONDS => 'minute',
        ONE_SECOND => 'second'
    );

    foreach ($secondConversion as $seconds => $str) {
        $difference = $time / $seconds;
     
        if ($difference >= ONE_SECOND) {
            $result = round($difference);
            $output = $result . ' ' . $str . ($result > ONE_SECOND ? 's' : '') . " ago";
            
            return $output;
        }
    }
}

/*
* Gets a declared variable from an object and 
* converts it into an array.
*/
function object_to_array($obj)
{
    if (is_array($obj)) {
        return $obj;
    }
    if (!is_object($obj)) {
        return false;
    }
    $array = array();
    foreach ( $obj as $key => $value ) {
        $array[$key] = $value;
    }
    return $array;
}