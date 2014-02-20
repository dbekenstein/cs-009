<?php
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//performs a few security checks
function securityCheck($form = "") {
    
    // globals defined in top.php
    global $yourURL;

    $status = true; // start off thinking everything is good until a test fails
    $fromPage = getenv("http_referer"); 

    if ($debug) print "<p>From: " . $fromPage . " should match yourUrl: " . $yourURL;

    if($fromPage != $yourURL){
        $status=false;
        
    } 
    
    return $status;
}
?>