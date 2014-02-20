<!DOCTYPE html>
<html lang="en">
<head>
<title>Sample Form One</title>
<meta charset="utf-8">
<meta name="author" content="Robert M. Erickson">
<meta name="description" content="Stpes to creating a form">

<meta name="viewport" content="width=device-width, initial-scale=1">

<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
<![endif]-->
	
<link rel="stylesheet" href="style.css" type="text/css" media="screen">

<?php
// parse the url into htmlentites to remove any suspicous vales that someone
// may try to pass in. htmlentites helps avoid security issues
// break the url up into an array, then pull out just the filename
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
$path_parts = pathinfo($phpSelf);

?>	

</head>

<?php

print '<body id="' . $path_parts['filename'] . '">';

include "header.php";
include "nav.php";

?>