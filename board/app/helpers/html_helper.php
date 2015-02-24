<?php

function eh($string){
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
    }

//View Modification (Line Break)
function readable_text($s){
    $s = htmlspecialchars($s, ENT_QUOTES);
    $s = nl2br($s);
    return $s;                    
    }	

function redirect($url){
	header("Location: " . $url);
	exit();
}

function logged_in(){
    if(isset($_SESSION['user_id'])) {
         redirect(url('user/home'));
        }
}



?>
