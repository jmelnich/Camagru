<?php
function convertHash($string) {
	$regex = "/#+([a-zA-Z0-9]+)/";
	$string = preg_replace($regex, '<a href="index?hash=$1">$0</a>', $string);
	echo $string;
	return $string;
}

/* return an array of strings needed */
function getMatches($string) {
	echo "<br/>";
	$regex = "/#+([a-zA-Z0-9]+)/";
	$array = explode(" ", $string);
	$result = preg_grep($regex, $array);
	return $result;
}