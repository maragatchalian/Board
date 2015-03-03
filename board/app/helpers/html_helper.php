<?php
function eh($string){
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
    }

function redirect($url){
	header("Location: " . $url);
	exit();
}
?>
