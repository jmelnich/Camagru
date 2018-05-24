<?php
if (Session::exists('success')) {
	echo Session::flash('success');
}
if (Session::exists('recovery')) {
	echo Session::flash('recovery');
}
?>
Home page
