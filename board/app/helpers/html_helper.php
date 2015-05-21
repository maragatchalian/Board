<?php

function eh($string)
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


/* with yesterday
const ONE_MINUTE = 60;
const ONE_HOUR = 60;
const ONE_DAY = 24;
const A_DAY_AGO = 1;
const ONE_WEEK = 7;

function time_difference($date)
{
    $second = ONE_MINUTE;
    $minute = ONE_HOUR;
    $hour = ONE_DAY;
    $yesterday = A_DAY_AGO;
    $week = ONE_WEEK;

    $date = strtotime($date);
    $now = strtotime(date("Y-m-d H:i:s"));
    $today = strtotime(date("Y-m-d"));
    $day = strtotime(date("Y-m-d", $date));

    $difference = $now - $date;
    $time = date("h:ia", $date);
    $date_difference = ($today - $day) / ($second*$minute*$hour);
    $time_frame = array($second, $minute, $hour);
    $time_title = array('second', 'minute', 'hour');
        
        if ($date_difference === $yesterday) {
            return "yesterday at " . $time;
        } elseif ($date_difference > $yesterday && $date_difference < $week) {
            return $date_difference . " days ago";
        }

    $count = count($time_frame);
        for ($i = 0; $i < $count; $i++) {
                $difference = $difference / $time_frame[$i];
                    
                    if ($difference > 1) {
                        continue;
                    }

            $num = floor($difference * $time_frame[$i]);
            $title = $num > 1 ? $time_title[$i] . "s" : $time_title[$i];
            return isset($num) ? "$num $title ago" : $day;
        }
    return date("Y-m-d h:ia", $date);
}*/

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

?>