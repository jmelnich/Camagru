<?php
class View {
    function __construct() {
        echo 'View cont ';
    }
    public function render($name, $data = null) {
        require 'views/includes/header.php';
        require 'views/' . $name . '.php';
        require 'views/includes/footer.php';
    }
}