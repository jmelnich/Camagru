<?php
function convertHash($string) {
	$regex = "/#+([a-zA-Z0-9]+)/";
	$string = preg_replace($regex, '<a href="index?hash=$1">$0</a>', $string);
	return $string;
}