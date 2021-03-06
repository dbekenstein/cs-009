<!DOCTYPE html>
<html lang="en">
<head>
<title>Sample Form</title>
<meta charset="utf-8">
<meta name="author" content="Robert M. Erickson">
<meta name="description" content="Stpes to creating a form">

<meta name="viewport" content="width=device-width, initial-scale=1">

<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
<![endif]-->
	
<link rel="stylesheet" href="style.css" type="text/css" media="screen">

<?php
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^% 
// 
//  PATH SETUP
//
//  $domain = "https://www.uvm.edu" or http://www.uvm.edu;

if($_SERVER['HTTPS']) {
    $domain = "https://";
}else{
    $domain = "http://";
}

$server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

$domain .= $server;

$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);

$basePath = $domain . $path_parts['dirname'] . "/";

if ($debug){
    print "<p>Domain". $domain;
    print "<p>php Self". $phpSelf;
    print "<p>basePath". $basePath;
    print "<p>Path Parts<pre>";
    print_r($path_parts);
    print "</pre>";
}

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^% 
// 
//  inlcude all libraries
//  
require_once('lib/security.php');

?>	

</head>

<?php

print '<body id="' . $path_parts['filename'] . '">';

include "header.php";
include "nav.php";

?>