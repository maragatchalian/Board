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

?>