<?php
if (Session::exists('success')) {
	echo Session::flash('success');
}
?>
Home page
